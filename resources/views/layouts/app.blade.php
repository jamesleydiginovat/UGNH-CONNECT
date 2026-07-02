<!DOCTYPE html>
<html  
@if (Auth::user()->theme =="false")
    @class(['dark'=> false])
@else
    @class(['dark'=> true])
@endif
lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        {{-- <link rel="icon" href="{{ asset('images/favicon.ico') }}"> --}}
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
        @livewireStyles
    </head>
    <body 
    x-data="{ open: false ,
              opens:false,
              form:false,
              inpuRecherche:false,
              inpuRechercherTop:false,
              openListe:false,
              modalPDF:false,
              modalConfirmation:false,
              accordeon:false,
              formRoles:false,
              formRolesEtPermission:false,
              modalProfil:false,
              tableSlide:false,
              tableSlideNote:false,
              tableSlideNoteByStudent:false,
              formHoraire:false,
              fullInformation:false,  
              progressBar:false,progress: 0, interval: null,
              pdf:false,
              historiqueTransaction:false,
              ficheTransaction:false,
              tarifFaculte:false,
              active: 'home',
              toggleActive:false,
                init() {
                    this.active = localStorage.getItem('activeMenu') || 'home'
                }
              
    }"


    x-data="{
       
    }"
    x-cloak
    class=" bg-ugnh-backColor dark:bg-gray-800 h-full">
        {{-- {{ $slot }} --}}
        <section  @class([
            'flex h-full '
        ])>
            <nav @class([
                'transition-all duration-500 ease-in-out absolute md:relative  md:shadow-none shadow-2xl z-10 h-screen'
            ])
            :class="open ? 'w-[80%] md:w-12' : ' w-0 md:w-70'" 
            
            >
                {{-- @yield('sideBarre') --}}
                <livewire:inclus.side-barre />
            </nav>

            <main @class([
                ' relative transition-all duration-500 ease-in-out bg-ugnh-backColor rounded-l-0 w-full',
                'md:rounded-l-3xl',
                'dark:bg-gray-800'
            ])
             {{-- :class="open ? 'w-full' : 'w-[98%]'"  --}}
            >

                <header @class([
                ''
            ]) 
            >
                    @yield('topBarre')

                    {{-- <livewire:inclus.top-barre /> --}}

                </header>

                <section @class([
                    'h-[94vh] bg-ugnh-backColor overflow-y-auto no-scrollbar',
                    'dark:bg-gray-800'
                ])>
                    @yield('main')


                    {{-- <footer class=" p-2 bg-white mx-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil esse quo dolorum excepturi sint, mollitia laboriosam officiis, neque tempora, molestias eaque! Mollitia, nam atque placeat incidunt iste commodi tempora at.
                    </footer> --}}
                </section>


                
            </main>


        </section>
        @livewireScripts
    </body>
</html>
