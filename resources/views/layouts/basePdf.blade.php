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

            <style>
                /* .page {
                    width: 210mm;
                    min-height: 297mm;
                    padding: 15mm;
                    font-family: 'Times New Roman', Times, serif;
                } */

                .page-break {
                    page-break-after: always;
                    
                }



                /* PAGE PRINCIPALE */
                .page {
                    width: 210mm;
                    min-height: 297mm;
                    background-color: white;
                    color: black;
                    margin: auto;
                    padding: 1mm;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    box-sizing: border-box;
                    font-family: 'Times New Roman', Times, serif;
                }

                /* HEADER */
                .header {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    border-bottom: 1px solid black;
                    padding-bottom: 10px;
                }

                /* LOGO */
                .logo {
                    width: 80px;
                    height: 80px;
                }

                /* TITRE CENTRÉ */
                .title {
                    width: 100%;
                    text-align: center;
                }

                .title h1 {
                    font-size: 20px;
                    font-weight: bold;
                }

                .title h2 {
                    font-size: 18px;
                }

                .title h3 {
                    font-size: 14px;
                }

                /* TITRE PDF */
                .pdf-title {
                    font-size: 23px;
                    font-weight: bold;
                    text-transform: uppercase;
                    text-align: center;
                    margin-top: 20px;
                    text-decoration: underline;
                }

                /* CONTENU */
                .content {
                    margin-top: 20px;
                    font-size: 20px;
                    line-height: 1.5;
                    text-align: justify;
                }
            </style>
            
            
            <section class="page">

                <table class="header" width="100%">
                    <tr>
                        <td width="15%" align="left">
                            <img src="{{ public_path('images/logoUGNH.png') }}" style="height:100px;">
                        </td>

                        <td width="70%" align="center" style="line-height: 1.5;">
    
                            <h1 style="font-size:30px; font-weight:bold; margin:0;">UNGH</h1>

                            <h1 style="font-size:26px; font-weight:bold; margin:0;">
                                Université du Grand Nord d'Haïti
                            </h1>

                            <h2 style="font-size:14px; margin:2px 0;">
                                La science au service du développement
                            </h2>

                            <h3 style="font-size:12px; margin:2px 0;">
                                142, rue 7A, HT1110 - Cap-Haïtien, Haïti
                            </h3>

                        </td>

                        <td width="15%" align="right">
                            <img src="{{ public_path('images/logoUGNH.png') }}" style="height:100px;">
                        </td>
                    </tr>
                </table>

                <!-- TITRE -->
                <section class="pdf-title">
                    @yield('titre')
                </section>

                <!-- CONTENU -->
                <section class="content">
                    @yield('contenu')
                </section>

            </section>
            


        </section>

        
        @livewireScripts
    </body>
</html>
