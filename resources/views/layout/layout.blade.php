<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <title>Trying Layouting</title> --}}
    <title>@yield('title')</title>
</head>

<body class="font-poppins">
    @include('layout.sidebar')

    {{-- header --}}
    <div class="content p-4 sm:ml-64">
        <div class="text-blue-light">
            {{-- Head / Posisi --}}
            <div class="w-full bg-blue-100 h-14 rounded-xl p-4 items-center font-normal flex mb-4">
                <svg class="h-5" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                    fill="currentColor">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <style type="text/css">
                            .st0 {
                                fill: none;
                                stroke: currentColor;
                                stroke-width: 2;
                                stroke-linecap: round;
                                stroke-linejoin: round;
                                stroke-miterlimit: 10;
                            }

                            .st1 {
                                fill: none;
                                stroke: currentColor;
                                stroke-width: 2;
                                stroke-linejoin: round;
                                stroke-miterlimit: 10;
                            }
                        </style>
                        <polyline class="st0" points="2,16 12,22 22,16 "></polyline>
                        <path class="st0"
                            d="M18,11H6c-2.2,0-4,1.8-4,4v10c0,2.2,1.8,4,4,4h12c2.2,0,4-1.8,4-4V15C22,12.8,20.2,11,18,11z">
                        </path>
                        <line class="st0" x1="21.5" y1="13.1" x2="30" y2="8"></line>
                        <path class="st0" d="M22,21h4c2.2,0,4-1.8,4-4V7c0-2.2-1.8-4-4-4H14c-2.2,0-4,1.8-4,4v4">
                        </path>
                    </g>
                </svg>

                {{-- Membuat format path untuk header --}}
                @php
                    $path = str_replace('_', ' ', request()->path()); // Replace underscores with spaces
                    $formattedPath = ucwords(str_replace('/', ' / ', $path)); // Capitalize each word and add spaces around slashes
                @endphp
                <h1 class="ms-2">
                    Sirata / {{ $formattedPath }}
                </h1>
            </div>

            @yield('content')

        </div>
    </div>

</body>

</html>
