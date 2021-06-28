{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Backend/DeltaPSU') }}</title>

    <link rel="stylesheet" href="{{asset('/backend-asset/css/dashmix.min.css')}}">
    <style>
        .bg-primary-dark-op {
            background-color: #00a680 !important;
        }

        .btn-hero-success {
            background-color: #00a680 !important;
        }

    </style>

    @yield('css')

</head>

<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark">
        @include('partials.sidenav')
        @include('partials.header')
        @yield('container')
        @include('partials.footer')
    </div>

</body>

<script src="{{asset('/backend-asset/js/core/jquery.min.js')}}"></script>
<script src="{{asset('/backend-asset/js/dashmix.app.min.js')}}"></script>
<script src="{{asset('/backend-asset/js/dashmix.core.min.js')}}"></script>
<script src="{{asset('/backend-asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('/backend-asset/js/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<script src="{{asset('/backend-asset/js/pages/be_pages_dashboard.min.js')}}"></script>

<script>
    jQuery(function () {
        Dashmix.helpers('sparkline');
    });

</script>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <title>DeltaPSU | Backend</title>
  

    <link rel="stylesheet" href="{{asset('backend-asset/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet"
        href="{{asset('backend-asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('backend-asset/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('backend-asset/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend-asset/js/plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('backend-asset/js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" id="css-main" href="{{asset('backend-asset/css/dashmix.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-asset/js/plugins/dropzone/dist/min/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend-asset/css/font.css')}}" media="screen" />
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
    <link rel="stylesheet" href="{{asset('/backend-asset/addons/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-asset/addons/css/datatables-select.min.css')}}">
    @yield('style')
    <style>
        #page-container.page-header-dark #page-header {
            color: #cad4e7;
            background-color: #0087DC;
        }

        .req-fed {
            color: red !important;
        }

        .res-image {
            width: 38%;
        }

        .content-side {
            padding: 1.25rem 0.25rem 1px;
        }

        .warrning-text {
            color: #000;
        }

        .loader {
            position: fixed;
            z-index: 99;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader>img {
            width: 100px;
        }

        .loader.hidden {
            animation: fadeOut 1s;
            animation-fill-mode: forwards;
        }

        @keyframes fadeOut {
            100% {
                opacity: 0;
                visibility: hidden;
            }
        }

        .thumb {
            height: 100px;
            border: 1px solid black;
            margin: 10px;
        }

        .note-fontname {
            visibility: hidden;
            display: block;
        }

    </style>
</head>

<body>

    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark ">
        <!-- Sidebar -->
        @include('partials.sidenav')
        <!-- END Sidebar -->

        <!-- Header -->
        @include('partials.header')
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">

            <!-- Page Content -->
            @yield('content')
            <!-- END Page Content -->
            {{-- <div class="loader">
                        <img src="{{asset('backend-asset/image/4V0b.gif')}}" alt="Loading..." />
    </div> --}}
    </main>
    {{-- <footer id="page-footer" class="bg-body-light">
                        <div class="content py-0">
                            <div class="row font-size-sm">
                                <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                                </div>
                                <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                                    <a class="font-w600" href="https://1.envato.market/r6y" target="_blank">Dashmix 1.5</a> &copy; <span data-toggle="year-copy">2018</span>
                                </div>
                            </div>
                        </div>
                    </footer> --}}
    <!-- END Main Container -->

    </div>
    <script src="{{asset('backend-asset/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/jquery.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/jquery.js')}}"></script>
    <script src="{{asset('backend-asset/js/dashmix.core.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/dashmix.app.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/pages/op_auth_signin.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/pages/be_tables_datatables.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/dropzone/dropzone.min.js')}}"></script>
    <script>
        jQuery(function () {
            Dashmix.helpers(['datepicker', 'colorpicker', 'select2', 'summernote']);
        });

    </script>
        <script src="{{asset('/admin-assets/addons/js/datatables.min.js')}}"></script>
        <script src="{{asset('/admin-assets/addons/js/datatables-select.min.js')}}"></script>


    @yield('js')

    <script>
        $(document).on('change', '.note-image-input', function () {

            var FileSize = this.files[0].size / 1024 / 1024; // in MB
            if (FileSize > 1) {
                alert("File size exceeds 1 MB!");
                this.value = "";
            };
        });

    </script>
    {{-- <script>
             window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
            </script>
           --}}
    <script>
        $(document).ready(function () {
            $('.jsnotenew').summernote({
                height: 400,
                callbacks: {
                    onImageUpload: function (files) {
                        that = $(this);
                        sendFile(files[0], that);
                    }
                }
            });

            function sendFile(file, that) {

                var data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{route('uploadtoTexteditor')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (url) {
                        $(that).summernote('insertImage', url.url, '');
                    }
                });
            }
        });

    </script>


</body>

</html>
