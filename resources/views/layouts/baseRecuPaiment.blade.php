<!DOCTYPE html>
<html  @class(['dark'=>true ]) lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
        @livewireStyles
    </head>
    <body class="dark:bg-gray-900">
        {{-- {{ $slot }} --}}

        <section class="dark:text-gray-50">

            <section>
                {{-- <td width="15%" align="left">
                            <img src="{{ public_path('images/logoUGNH.png') }}" style="height:100px;">
                </td> --}}

                <!-- TITRE -->
                <section >
                    @yield('titre')
                </section>

                <!-- CONTENU -->
                <section >
                    @yield('contenu')
                </section>

            </section>
            


        </section>

        
        @livewireScripts
    </body>
</html>
