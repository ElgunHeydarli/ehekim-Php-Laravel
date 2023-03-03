<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>166 Loyalty Admin</title>
    <link rel="stylesheet" href="{{ asset('manage/assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('manage/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('manage/assets/vendors/css/vendor.bundle.base.css') }}" />
    <link rel="stylesheet" href="{{ asset('manage/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    @stack('css')
    <link rel="stylesheet"
        href="{{ asset('manage/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('manage/assets/css/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('manage/assets/images/favicon.png') }}" />

</head>

<body>
    <div class="container-scroller">
        @include('admin.includes.sidebar')

        <div class="container-scroller page-body-wrapper">
            @include('admin.includes.header')

            <div class="main-panel">
                <div class="content-wrapper pb-0">

                    @yield('content')
                </div>
                @include('admin.includes.footer')
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('manage/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('manage/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('manage/assets/vendors/flot/jquery.flot.pie.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('manage/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('manage/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('manage/assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('manage/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    @stack('js')
</body>

</html>
