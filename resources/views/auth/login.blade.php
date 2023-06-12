<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIM-KLINIK | Login</title>
    <link rel="icon" href="{{ asset('assets/logos/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
{{-- <body class="h-screen overflow-hidden flex items-center justify-center" style="background: #CCFF99;"> --}}
<body class="h-screen overflow-hidden flex items-center justify-center backdrop-brightness-50" style="background-image: url('{{asset('assets/logos/gedung-6-polije.jpg')}}'); background-repeat: no-repeat; background-size: cover;">
    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-lime-500 to-lime-900 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl shadow">
            </div>
            <div class="relative px-4 py-10 bg-white shadow shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div class="text-center">
                        <img src="{{asset('assets/logos/logo.png')}}" class="h-28 flex-none m-auto mb-5">
                        <h1 class="text-4xl font-semibold font-[helvetica] px-10 tracking-[2px] mb-8">Welcome to <br> Si Klepon</h1>
                        <marquee behavior="" direction="">
                            <h2 class="text-xl font-[montserrat] px-5">Sistem Informasi Manajemen Klinik Politeknik Negeri Jember</h2>
                        </marquee>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <form method="POST" action="{{ url('/login') }}">
                            @csrf
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <input autocomplete="off" id="email" name="email" type="email" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                                    <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Surel</label>
                                </div>
                                <div class="relative mt-5">
                                    <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                    <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Kata Sandi</label>
                                </div>
                                <div class="relative">
                                    <button type="submit" class="bg-lime-900 text-white rounded-md px-4 py-1 mt-2">Masuk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
