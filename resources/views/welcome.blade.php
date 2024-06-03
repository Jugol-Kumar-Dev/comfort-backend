<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("fav.png") }}">
    <link rel="icon" type="image/svg" sizes="32x32" href="{{ asset("fav.png") }}">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{ asset("fav.png") }}">


    <title>Semi Healthcare Products - Comfortwing</title>
    <meta name="description" content="Comfort Wing’s is our registered Brand. Our main activities are building & developing new innovative products in specific category semi Healthcare products." />
    <link rel="canonical" href="https://comfortwing.com/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Web Design Company in Bangladesh" />
    <meta property="og:description" content="Comfort Wing’s is our registered Brand. Our main activities are building & developing new innovative products in specific category semi Healthcare products." />
    <meta property="og:url" content="https://comfortwing.com/" />
    <meta property="og:site_name" content="Best Web Design Company in Bangladesh Creative Tech Park" />
    <meta property="article:publisher" content="https://www.facebook.com/comfortwingspillows/" />
    <meta property="og:image" content="https://comfortwing.com/logo.png" />
    <meta property="og:image:width" content="224" />
    <meta property="og:image:height" content="65" />
    <meta property="og:image:type" content="image/png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Comfortwing | Semi Healthcare Products" />
    <meta name="twitter:description" content="Comfort Wing’s is our registered Brand. Our main activities are building & developing new innovative products in specific category semi Healthcare products." />
    <meta name="twitter:image" content="https://comfortwing.com/logo.png" />
    <meta name="twitter:site" content="@comfortwing" />



    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/plugins.bundle.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/style.bundle.css?=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/login-4.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/light.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/dark.css?v=1') }}" rel="stylesheet" type="text/css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div id="app">


</div>

<script>
    var KTAppSettings = {
        "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>

<script src="{{ asset('backend/assets/js/popper.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('backend/assets/js/bootstrap.min.js') }}" crossorigin="anonymous"></script>

<script src="{{ asset('backend/assets/js/plugins.bundle.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('backend/assets/js/scripts.bundle.js') }}" crossorigin="anonymous"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    $(document).ready(function (){
        console.log($("body").find('.form-control-file'))
        $(".modal").find('.form-control-file')?.addClass('form-control');
        $('input[name="files"]')?.addClass('form-control');

    })

</script>
</body>
<!--end::Body-->
</html>
