<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <title>Midrosholding</title>
    <meta name="description" content="Midrosholding" />
    <meta name="keywords" content="Midrosholding" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Midrosholding" />
    <meta property="og:site_name" content="Midrosholding" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('adminAssets/short_logo.png')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{asset('adminAssets/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('adminAssets/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">--}}
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('header')
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed">

<div id="app">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            @include('admin.sections.sidbar')
        </div>
    </div>
</div>
@include('admin.sections.footer')
@yield('js')
</body>
