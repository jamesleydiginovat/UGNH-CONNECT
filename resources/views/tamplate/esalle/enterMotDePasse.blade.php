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
    <body 
    x-data="{ open: false ,

            }"
    >
        {{-- {{ $slot }} --}}
        <section  @class([
            'flex h-screen'
        ])>
                <livewire:esalle.enter-mot-de-passe />

        </section>
        @livewireScripts
    </body>
</html>
