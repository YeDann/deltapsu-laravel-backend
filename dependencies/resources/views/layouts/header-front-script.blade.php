<script>
    $(document).ready(function() {
        // 1. Hover behavior (Products, etc.) - Exclude .news-submenu
        $('.dropdown-submenu').not('.news-submenu').mouseenter(function() {
            var $this = $(this);
            
            // Close news submenu if open
            $('.news-submenu').removeClass('show');

            // 當滑鼠進入當前選單：清除所有強制隱藏的樣式，讓 CSS 的 Hover 效果（包含淡入）生效
            $this.find('.dropdown-menu').css({
                'transition': '',
                'transition-delay': '',
                'opacity': '',
                'visibility': ''
            });

            // 強制隱藏「其他」所有子選單：設定 transition: none 讓它瞬間消失，不跑 CSS 的 0.2s 延遲
            $('.dropdown-submenu').not($this).find('.dropdown-menu').css({
                'transition': 'none',
                'transition-delay': '0s',
                'opacity': '0',
                'visibility': 'hidden'
            });
        });

        // 2. Click behavior (News)
        $('.news-submenu > a').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); 
            
            var $submenu = $(this).parent('.news-submenu');
            $submenu.toggleClass('show');

            // Hide other submenus instantly
            $('.dropdown-submenu').not($submenu).find('.dropdown-menu').css({
                'transition': 'none',
                'transition-delay': '0s',
                'opacity': '0',
                'visibility': 'hidden'
            });
        });

        // 3. Close News submenu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.news-submenu').length) {
                $('.news-submenu').removeClass('show');
            }
        });
    });
</script>