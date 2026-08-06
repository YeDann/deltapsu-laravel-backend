/* 行銷資源分塊上傳 + 影片縮圖擷取（create / edit 共用）。需先載入 jQuery 與 resumable.js。
   註：壓縮檔等（非圖片/影片/PDF）的縮圖改由表單一起送出、後端存成主檔同名 .jpg（見 MarketResourceController），
       此處只處理主檔分塊上傳與「影片自動截幀 poster」。 */
window.MRChunkUpload = (function () {
    var pending = 0;                       // 進行中的上傳數（跨多個 input 共用，用來 gate 送出鈕）
    var SUBMIT = 'form button[type="submit"]';
    var VIDEO_EXT = ['mp4', 'webm', 'mov'];

    function syncSubmit() {
        $(SUBMIT).prop('disabled', pending > 0);
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

    // 已選檔但尚未上傳完成就送出 → 擋下（未選檔則維持「檔案非必填」原行為）
    function guardSubmit($form) {
        $form.on('submit', function (e) {
            if (pending > 0) {
                e.preventDefault();
                alert('檔案尚未上傳完成，請稍候。');
            }
        });
    }

    return { init: init, guardSubmit: guardSubmit };
})();
