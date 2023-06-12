<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('assets/logos/logo.png') }}" type="image/x-icon">

    <title>SIM-KLINIK | Perawat</title>

    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css-admin/style.css')}}">
    @yield('extraCSS')
</head>
<body class="bg-yellow-100">
    @include('nurse.components.navbar')
    <div class="h-screen flex flex-row flex-wrap">
        @include('nurse.components.sidebar')
        <div class="bg-yellow-100 flex-1 p-6 md:mt-16 pt-32" style="background-color: #FFD495;"> 
        {{-- <div class="bg-teal-300 pt-32 flex-1 p-6 md:mt-16"> --}}
            <div>
                @if (session('status'))
                    <div class="alert alert-default alert-close mb-5">
                        <button class="alert-btn-close">
                            <i class="fad fa-times"></i>
                        </button>
                        <span>{{session('status')}}</span>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-error alert-close mb-5">
                        <button class="alert-btn-close">
                            <i class="fad fa-times"></i>
                        </button>
                        <span>{{session('error')}}!</span>
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{asset('assets/js-admin/scripts.js')}}"></script>
    @yield('extraJS')
</body>
</html>
