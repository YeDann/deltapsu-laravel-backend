/* 行銷資源分塊上傳 + 影片縮圖擷取（create / edit 共用）。需先載入 jQuery 與 resumable.js。
   註：壓縮檔等（非圖片/影片/PDF）的縮圖改由表單一起送出、後端存成主檔同名 .jpg（見 MarketResourceController），
       此處只處理主檔分塊上傳與「影片自動截幀 poster」。 */
window.MRChunkUpload = (function () {
    var pending = 0;                       // 進行中的上傳數（跨多個 input 共用，用來 gate 送出鈕）
    var SUBMIT = 'form button[type="submit"]';
    var VIDEO_EXT = ['mp4', 'webm', 'mov'];
    var THUMB_MAX_EDGE = 1600;             // 縮圖顯示區只有 200px 高，1600px 對 retina 已綽綽有餘
    var THUMB_QUALITY = 0.85;
    var THUMB_KEEP_BYTES = 1024 * 1024;    // 夠小且尺寸未超標者保留原檔，不壓平 PNG 透明背景

    function syncSubmit() {
        $(SUBMIT).prop('disabled', pending > 0);
    }

    function fmtSize(bytes) {
        return bytes >= 1048576 ? (bytes / 1048576).toFixed(1) + ' MB' : Math.round(bytes / 1024) + ' KB';
    }

    // 瀏覽器端用 <video>+<canvas> 擷取影片一幀，輸出小 JPEG blob（免伺服器 ffmpeg）
    function captureVideoPoster(file, cb) {
        try {
            var url = URL.createObjectURL(file);
            var v = document.createElement('video');
            v.muted = true;
            v.playsInline = true;
            v.preload = 'auto';
            var done = false;
            function grab() {
                if (done) { return; }
                var w = v.videoWidth, h = v.videoHeight;
                if (!w || !h) { return; }
                done = true;
                try {
                    var scale = Math.min(1, 640 / w);
                    var c = document.createElement('canvas');
                    c.width = Math.round(w * scale);
                    c.height = Math.round(h * scale);
                    c.getContext('2d').drawImage(v, 0, 0, c.width, c.height);
                    c.toBlob(function (blob) {
                        URL.revokeObjectURL(url);
                        if (blob) { cb(blob); }
                    }, 'image/jpeg', 0.8);
                } catch (e) { URL.revokeObjectURL(url); }
            }
            // preload='metadata' 時 loadeddata 常不觸發，用 loadedmetadata 觸發 seek，seeked 後擷取
            v.addEventListener('loadedmetadata', function () {
                try { v.currentTime = Math.min(0.5, (v.duration || 1) / 2); } catch (e) { grab(); }
            });
            v.addEventListener('seeked', grab);
            v.addEventListener('loadeddata', grab);
            v.addEventListener('error', function () { URL.revokeObjectURL(url); });
            v.src = url;
        } catch (e) {}
    }

    // 影片縮圖上傳（存成影片同名 .jpg）。上傳期間計入 pending 擋住送出，避免表單先送出、換頁把請求取消。
    function uploadPoster(posterUrl, csrf, videoFile, blob) {
        var fd = new FormData();
        fd.append('video', videoFile);
        fd.append('poster', blob, 'poster.jpg');
        pending++;
        syncSubmit();
        var done = function () { pending = Math.max(0, pending - 1); syncSubmit(); };
        fetch(posterUrl, { method: 'POST', body: fd, credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': csrf } }).then(done, done);
    }

    /**
     * 初始化單一檔案輸入的分塊上傳。
     * o: { input(DOM), chunkUrl, posterUrl, csrf, label, progress, bar, status, hidden }（後五個為 jQuery 物件）
     */
    function init(o) {
        var posterBlob = null, finalFile = null;
        var r = new Resumable({
            target: o.chunkUrl,
            chunkSize: 1 * 1024 * 1024,        // 1MB/塊：繞過 post_max_size / upload_max_filesize，2GB 免拉高主機上限
            simultaneousUploads: 3,
            testChunks: false,
            maxFiles: 1,
            headers: { 'X-CSRF-TOKEN': o.csrf }
        });
        if (!r.support) {
            o.status.text('此瀏覽器不支援分塊上傳，請更新瀏覽器。');
            return;
        }
        r.assignBrowse(o.input);

        r.on('fileAdded', function (file) {
            while (r.files.length > 1) { r.removeFile(r.files[0]); }   // 只保留最後選的一個檔
            o.label.text(file.fileName || file.name);
            o.hidden.val('');
            posterBlob = null;
            finalFile = null;
            var ext = (file.fileName || file.name || '').split('.').pop().toLowerCase();
            if (VIDEO_EXT.indexOf(ext) > -1 && file.file) {
                captureVideoPoster(file.file, function (b) {
                    posterBlob = b;
                    if (finalFile) { uploadPoster(o.posterUrl, o.csrf, finalFile, b); }
                });
            }
            o.progress.removeClass('d-none');
            o.bar.removeClass('bg-danger').css('width', '0%').text('0%');
            o.status.text('上傳中…');
            pending++;
            syncSubmit();
            r.upload();
        });

        r.on('fileProgress', function (file) {
            var p = Math.floor(file.progress() * 100);
            o.bar.css('width', p + '%').text(p + '%');
        });

        r.on('fileSuccess', function (file, msg) {
            var res = {};
            try { res = JSON.parse(msg); } catch (e) {}
            if (res && res.file) {
                o.hidden.val(res.file);
                finalFile = res.file;
                if (posterBlob) { uploadPoster(o.posterUrl, o.csrf, finalFile, posterBlob); }
                o.bar.css('width', '100%').text('100%');
                o.status.text('上傳完成');
                // 短暫顯示 100% 後收起進度條；重選檔時 fileAdded 會再 removeClass 顯示
                setTimeout(function () { o.progress.addClass('d-none'); }, 800);
            } else {
                o.bar.addClass('bg-danger');
                o.status.text('上傳失敗（伺服器未回傳檔名）');
            }
            pending = Math.max(0, pending - 1);
            syncSubmit();
        });

        r.on('fileError', function () {
            o.bar.addClass('bg-danger');
            o.status.text('上傳失敗，請重試');
            pending = Math.max(0, pending - 1);
            syncSubmit();
        });
    }

    /**
     * 解出可畫進 canvas 的圖片來源。
     * 刻意不用 URL.createObjectURL：本站 CSP 的 img-src 只開到 data:，沒有 blob:，
     * <img src="blob:…"> 會被擋而觸發 onerror（影片截幀走 <video>，media-src 有開 blob: 才沒事）。
     * 優先用 createImageBitmap（不經 URL，不受 img-src 約束），不支援時退回 data: URL。
     */
    function loadImageSource(file, cb) {
        if (window.createImageBitmap) {
            createImageBitmap(file).then(cb, function () { cb(null); });
            return;
        }
        var reader = new FileReader();
        reader.onload = function () {
            var img = new Image();
            img.onload = function () { cb(img); };
            img.onerror = function () { cb(null); };
            img.src = reader.result;
        };
        reader.onerror = function () { cb(null); };
        reader.readAsDataURL(file);
    }

    /**
     * 瀏覽器端壓縮縮圖：等比縮到最長邊 THUMB_MAX_EDGE、鋪白底後輸出 JPEG。
     * cb(blob, reason)：'compressed' 壓過了、'kept' 本來就夠小不動它、'failed' 讀不出這張圖。
     */
    function compressImage(file, cb) {
        loadImageSource(file, function (src) {
            if (!src) {
                cb(null, 'failed');
                return;
            }
            var w = src.naturalWidth || src.width;
            var h = src.naturalHeight || src.height;
            var scale = Math.min(1, THUMB_MAX_EDGE / Math.max(w, h));
            if (1 === scale && file.size <= THUMB_KEEP_BYTES) {
                if (src.close) { src.close(); }
                cb(null, 'kept');
                return;
            }
            var c = document.createElement('canvas');
            c.width = Math.round(w * scale);
            c.height = Math.round(h * scale);
            var ctx = c.getContext('2d');
            ctx.fillStyle = '#fff';        // JPEG 沒有 alpha，先鋪白底，否則 PNG 透明區會轉成黑色
            ctx.fillRect(0, 0, c.width, c.height);
            ctx.drawImage(src, 0, 0, c.width, c.height);
            if (src.close) { src.close(); }   // ImageBitmap 需手動釋放
            c.toBlob(function (blob) {
                cb(blob, blob ? 'compressed' : 'failed');
            }, 'image/jpeg', THUMB_QUALITY);
        });
    }

    /**
     * 初始化縮圖輸入：選圖後先在瀏覽器端壓縮，再隨表單一起送出。
     * 縮圖走的是一般表單上傳（非分塊），超過 php.ini upload_max_filesize 的檔案會被 PHP 在進入 Laravel
     * 之前丟棄，而 hasFile() 對被丟棄的檔案只回 false —— 不壓縮就會靜默失敗、使用者以為存好了。
     * 另送 flag 供後端比對「有選卻沒收到」，壓縮失效時仍能提示而非默默跳過。
     * o: { input(DOM), status, flag }（後兩者為 jQuery 物件）
     */
    function initThumb(o) {
        var $label = $('label[for="' + o.input.id + '"]');
        o.input.addEventListener('change', function () {
            var file = o.input.files && o.input.files[0];
            if (!file) {
                o.flag.val('');
                o.status.text('');
                return;
            }
            o.flag.val('1');
            if (0 !== file.type.indexOf('image/')) {
                o.status.text('縮圖請選圖片檔。');
                return;
            }
            // 壓縮期間計入 pending 擋住送出，避免表單搶先送出而帶到未壓縮的原檔
            pending++;
            syncSubmit();
            o.status.text('處理縮圖中…');
            compressImage(file, function (blob, reason) {
                if (blob && blob.size < file.size && window.DataTransfer) {
                    var name = file.name.replace(/\.[^.]+$/, '') + '.jpg';
                    try {
                        var dt = new DataTransfer();
                        dt.items.add(new File([blob], name, { type: 'image/jpeg' }));
                        o.input.files = dt.files;   // 覆寫待送出的檔案；程式化指派不會再觸發 change
                        $label.text(name);
                        o.status.text('已壓縮：' + fmtSize(file.size) + ' → ' + fmtSize(blob.size));
                    } catch (e) {
                        o.status.text('縮圖 ' + fmtSize(file.size) + '（未能壓縮，過大可能無法上傳）');
                    }
                } else if ('failed' === reason) {
                    // 讀不出來就照原檔送，超過主機上限時後端會回報，不會靜默消失
                    o.status.text('縮圖 ' + fmtSize(file.size) + '（無法讀取這張圖，將以原檔上傳）');
                } else {
                    o.status.text('縮圖 ' + fmtSize(file.size));
                }
                pending = Math.max(0, pending - 1);
                syncSubmit();
            });
        });
    }

    // 已選檔但尚未上傳完成就送出 → 擋下（未選檔則維持「檔案非必填」原行為）
    function guardSubmit($form) {
        $form.on('submit', function (e) {
            if (pending > 0) {
                e.preventDefault();
                alert('檔案尚未上傳完成，請稍候。');
            }
        });
    }

    return { init: init, initThumb: initThumb, guardSubmit: guardSubmit };
})();
