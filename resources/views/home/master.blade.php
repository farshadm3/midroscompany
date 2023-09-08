<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        name="viewport"
    />
    <meta content="ie=edge" http-equiv="X-UA-Compatible" />
    <!--CSS Links-->
    <link href="{{asset('home/css/index.css')}}" rel="stylesheet" />

    <!--JS Links-->
    <script defer src="{{asset('home/scripts/imageSlider.js')}}"></script>
    <title>MidrosCompany</title>
</head>
<body>

    @yield('content')
    @include('home.section.footer')
</body>
</html>
