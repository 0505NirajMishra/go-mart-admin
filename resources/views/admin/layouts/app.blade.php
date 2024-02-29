<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>
       
       Login</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />

    <link rel="shortcut icon"
        href="{{ isset($global_setting_data['favicon'])? asset('files/settings/' . $global_setting_data['favicon'] . ''): asset('admin/dist/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('admin/dist/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/dist/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-dark">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        @include('admin.layouts.partials.flash')
        @yield('content')
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('admin/dist/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('admin/dist/plugins/global/plugins.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    @stack('scripts')
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
