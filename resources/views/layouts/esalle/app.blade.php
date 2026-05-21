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
            <nav @class([
                'transition-all duration-500 ease-in-out absolute md:relative  md:shadow-none shadow-2xl z-10 h-screen'
            ])
            :class="open ? 'w-[80%] md:w-12' : ' w-0 md:w-70'" 
            
            >
                {{-- @yield('sideBarre') --}}
                <livewire:esalle.inclus.sidebar />
            </nav>

            <main @class([
                ' relative transition-all duration-500 ease-in-out bg-ugnh-backColor rounded-l-0 w-full overflow-hidden',
                'dark:bg-gray-800'
            ])
             {{-- :class="open ? 'w-full' : 'w-[98%]'"  --}}
            >

                <section @class([
                    'h-full bg-ugnh-backColor overflow-y-auto no-scrollbar',
                    'dark:bg-gray-800'
                ])>
                    @yield('content')


                    
                </section>


                
            </main>


        </section>
        @livewireScripts
    </body>
</html>
