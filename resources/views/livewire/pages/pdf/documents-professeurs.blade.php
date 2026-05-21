<section class="dark:text-gray-50">

    <style>
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        font-family: 'Times New Roman', Times, serif;
    }
    .page-break {
        page-break-after: always;
    }
    .entete{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        line-height: 1;
        border-bottom: solid 1px black ;
        padding-bottom: 2px;
    }
    .sigle{
        font-size: 20px;
        font-weight: bold;
    }

    .fin{
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        border-top: solid 1px black;
        padding-top: 5px;
    }
    .definition{
        font-size: 20px;
        font-weight: bold;
    }
    .ligne{
        display: flex;
        justify-content: space-between
    }

    .ligne p{
        min-width: 300px;

    }

    .titre{
        font-weight: bold;
        text-decoration: underline;
        text-align: center;
    }

    .ligne p span{
        width: 100%;
        
    }
    .page-break {
        page-break-after: always;
    }
    .ligne p span{

    }

    .logo{
        width: 10%;
        
    }

    .ugnh-name{
        widows: 80%;
        text-align: center;
    }

    .information{
        line-height: 1;
        padding-left: 5px;
        border-left: solid 10px #e86705cc;
    }

    .signature{
        text-align: center;
        line-height: 1;
        margin-top: 20px;
    }

    </style>

    <div class=" right-0 top-0 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 mx-3'])
            
            >
                <svg x-show="pdf"  @click="pdf = !pdf" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-ugnh-blueFonce hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                <div x-show="!pdf" ></div>


                <svg @click="tableSlideNote = !tableSlideNote" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg> 
        </div>
    </div>

    



    <div 
        class="h-full"
        x-show="!pdf"
        x-cloak
        x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        {{-- x-transition:leave="transition ease-in duration-500" --}}
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-4">
        <div  class="absolute  flex flex-col gap-3 bottom-2 right-2">
        
                <button 
                    @click="progressBar = true "
                    wire:click="export" class="flex flex-row gap-2 text-gray-50 bg-ugnh-blueFonce p-2 rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Exporter
                </button>

                {{-- <a @click="pdf = !pdf">
                    <button class="flex flex-row gap-2 bg-ugnh-blueFonce p-2 rounded-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        Voir le pdf
                    </button>
                </a> --}}

                <button wire:click="isFullInformation" @click="fullInformation = !fullInformation" class="flex flex-row gap-2 text-gray-50 bg-ugnh-blueFonce p-2 rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Toute les Informations
                </button>
            </div>



            <section x-data="{ open: true }" class="mx-3 mb-2 pb-1 shadow-2xl ">

                <!-- Bouton SVG -->
                <div @click="open = !open" class="cursor-pointer flex flex-row gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
                    </svg>
                    Filtre
                </div>

                <!-- Contenu à afficher -->
                <div 
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4"
                    class="mt-2 flex felx-row justify-between"
                >
                
                    <div class="flex flex-row gap-3">
                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce p-1 text-gray-50 rounded'])>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg> --}}
                                Filtrer par sexe: 
                            </div>
                            

                            <select  wire:model.live="filterSexe" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Sexe</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="M">M</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="F">F</option>
                                {{-- <option class="dark:text-ugnh-blueFonce" value="">...</option> --}}
                            </select>
                        </div>



                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce p-1 text-gray-50 rounded'])>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg> --}}
                                Filtrer par status:
                            </div>
                            

                            <select  wire:model.live="filterStatus" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Retraité">Retraité</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Renvoyé">Supprimé</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Suspendu">Suspendu</option>
                            </select>
                        </div>



                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce p-1 text-gray-50 rounded'])>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg> --}}
                                Filtrer par condition matrimoniale:
                            </div>
                            

                            <select  wire:model.live="filterConditionMatrimoniale" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Célibataire">Célibataire</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Marié(e)">Marié(e)</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Veuf / Veuve">Veuf / Veuve</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Divorcé(e)">Divorcé(e)</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Séparé(e)">Séparé(e)</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Union libre">Union libre </option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Fiancé(e)">Fiancé(e)</option>
                            </select>
                        </div>
                    </div>



                    {{-- <div class="flex flex-row gap-3 ">
                        <button  @click="modalConfirmation = !modalConfirmation" class="bg-ugnh-blueFonce p-2 cursor-pointer hover:scale-110 transition-all ease-in-out duration-200 rounded-sm">Dossier personnels</button>
                        <button wire:click="putValue" class="bg-ugnh-blueFonce p-2 cursor-pointer hover:scale-110 transition-all ease-in-out duration-200 rounded-sm">Les personnels utilisateurs</button>
                    </div> --}}
                </div>

            </section>



            
            <section class="flex flex-col gap-2 w-full">

                <div class="page  bg-white text-black mx-auto">
                    <section class="flex flex-row  items-center border-b border-black pb-2">
                        <div>
                            <img class="min-w-20 h-20 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                        </div>

                        <div class="w-full text-center">
                            <h1 class="text-2xl font-bold">UNGH</h1>
                            <h1 class="text-2xl font-bold">Universite du Grand Nord d'Haiti</h1>
                            <h2 class="text-lg">La science au service du developpement</h2>
                            <h3>142, rue 7A, HT1110 - Cap-Haitien, Haiti</h3>
                        </div>

                        <div>
                            <img class="min-w-20 h-20 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                        </div>

                    </section>


                    <section class="text-xl uppercase font-bold text-center mt-5 underline">
                        <h1>{{ $this->Titre }}</h1>
                    </section>


                    <section style="margin-top: 20px;">

                                        

                        @if ($this->codeProf =="")
                            
                                @if ($this->ListeProfesseur->isEmpty())
                                    <p>Aucun!</p>
                                @else
                                    <table x-show="!fullInformation" style="border: solid 1px; " width="100%" cellspacing="0" cellpadding="5">
                                        <thead >
                                            <tr style="border: solid 1px; background-color: rgb(24, 51, 160); color:white;">
                                                <th style="border: solid 1px; padding: 3px; width: 100px;">Code</th>
                                                <th style="border: solid 1px; padding: 3px;">Nom complet</th>
                                                <th style="border: solid 1px; padding: 3px;">Email</th>
                                                <th style="border: solid 1px; padding: 3px;">Telephone</th>
                                                <th style="border: solid 1px; padding: 3px;">Adresse</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($this->ListeProfesseur as $personnel )
                                            <tr style="border: solid 1px;">
                                                
                                                <td style="border: solid 1px; padding: 3px;">{{ $personnel->codeProf }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $personnel->nom." ".$personnel->prenom }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $personnel->email }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $personnel->telephone }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $personnel->adresse }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    <table x-show="fullInformation" width="100%" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            @foreach ($this->ListeProfesseur as $personnel )
                                            <tr class="bg-blue-100">
                                                <td></td>
                                                <td class="text-end font-bold" style="padding: 3px;">{{ $personnel->nom." ".$personnel->prenom }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Code</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->codeProf }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Nom</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->nom }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Prenom</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->prenom }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Sexe</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->sexe }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Email</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->email }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Adresse</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->adresse }}</td>
                                            </tr>


                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Telephone</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->telephone }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Fonction</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->fonction }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Condition matrimoniale</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->conditionMatrimoniale }}</td>
                                            </tr>

                                        


                                            @endforeach
                                        </tbody>
                                    </table>

                                @endif
                        @else

                            <table width="100%" cellspacing="0" cellpadding="5">
                                <tbody>
                                    @foreach ($this->ListeProfesseur as $personnel )
                                    {{-- <tr class="bg-blue-100">
                                        <td class="font-bold text-left" style="padding: 3px;">STATUS</td>
                                        <td class="text-end" style="padding: 3px;">{{ $personnel->status }}</td>
                                    </tr> --}}

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Code</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->codeProf }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Nom</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->nom }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Prenom</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->prenom }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Sexe</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->sexe }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Email</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->email }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Adresse</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->adresse }}</td>
                                    </tr>


                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Telephone</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->telephone }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Fonction</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->fonction }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Condition matrimoniale</td>
                                        <td class="text-left" style="padding: 3px;">{{ $personnel->conditionMatrimoniale }}</td>
                                    </tr>

                                


                                    @endforeach
                                </tbody>
                            </table>
                            
                        @endif

                        {{-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Amet iure, possimus non, itaque laudantium maiores quos sit sapiente laborum inventore eligendi, at doloremque similique voluptatum dolor porro quas numquam velit neque quaerat ex? Aut facilis vero voluptate sunt, voluptates reiciendis sit, voluptatum quae aspernatur officiis doloribus esse? Recusandae sapiente, corporis amet labore rerum consequuntur? Voluptatem delectus fugit nihil. Hic neque exercitationem dolorem consequuntur quidem harum beatae non blanditiis doloribus, vero porro dignissimos commodi ab, pariatur amet voluptate suscipit rem? Doloremque minus possimus sit debitis fugit, blanditiis tenetur perferendis repudiandae. Eius tempore quae nihil fugit earum assumenda error, molestias nemo nesciunt, qui, suscipit optio aperiam repellendus laboriosam itaque tempora quibusdam! Sapiente ea, nemo labore illo nam rem minima quibusdam dolorum aperiam, quo delectus vel tempora saepe deserunt quod magnam a fugiat incidunt natus aliquam repellendus, quas voluptatibus? Est, at. Sint, accusantium! Facilis, animi? Amet sed, perferendis fugit eveniet dicta nihil nesciunt iure architecto. Aperiam aliquam illum mollitia eum non vitae obcaecati eligendi voluptate voluptates commodi. Tenetur facere iure, esse sint ipsum iusto! Blanditiis, pariatur at, expedita enim ab non sunt dolores placeat, hic error libero ullam soluta itaque. Enim, in cupiditate possimus consequuntur maiores odit dignissimos totam magnam aspernatur impedit, vel modi veritatis quod culpa quo aliquid reprehenderit ex iure unde et? Quisquam saepe tempore enim voluptate voluptatibus dolor repudiandae at, sequi quam. Quam nisi ratione ducimus soluta consectetur! Odio et ea maxime accusantium facere, perspiciatis deleniti itaque incidunt vel delectus asperiores, sunt, inventore excepturi dolores porro molestias necessitatibus libero ullam quasi fugiat nobis dolorum dolor laborum! Porro est ipsa mollitia doloremque, quis sint rerum iste nisi officiis dolore unde harum ea? Corrupti dignissimos quos eos, ducimus unde ea labore ex molestias quia reiciendis totam voluptas illo nobis sunt aliquam adipisci officia veniam delectus alias provident tempore animi earum! Deserunt vero nam distinctio placeat id laboriosam sed dolorum error ullam, quidem deleniti sunt saepe omnis porro minima fugiat veniam velit officiis facere! Porro laudantium dolorem veniam sunt neque quos nostrum magnam. Maiores temporibus velit sequi nemo fugiat praesentium, veniam illum fugit tempora laboriosam libero necessitatibus delectus ab ea ipsum est alias autem maxime quaerat, sapiente quis! Mollitia veritatis, eligendi, in iste harum obcaecati, quia vero cumque ducimus temporibus inventore eveniet. Quisquam facilis ipsam doloribus cupiditate ea explicabo beatae vitae, neque veritatis libero deleniti, distinctio omnis laborum rem assumenda iure facere? Ipsa consectetur natus reprehenderit dolorem nobis nostrum, quod hic, id obcaecati quam iste. Accusamus et, laboriosam odit quaerat id soluta repudiandae rerum ducimus aspernatur atque eligendi quia officiis, aliquid quo ipsam veritatis eius. Placeat natus harum tempora enim commodi non deleniti dolor veniam laudantium dicta, ex voluptas velit et possimus at minima maxime illo facilis nihil fugiat. Error repellendus culpa modi ut in, officiis, soluta harum ea accusantium, hic quo aliquam placeat enim necessitatibus nihil fugiat laboriosam. Dolorem aut minima molestias ab architecto illo voluptates amet nisi at, quasi iste aspernatur facilis neque ipsa accusantium modi sint fugit porro non? Esse animi, eum nobis explicabo vitae unde quo quam beatae excepturi qui accusamus? Officiis, fugit omnis veniam quidem similique quasi, ea aut deserunt ipsum incidunt dolores, sapiente odio reiciendis eos ratione quaerat accusamus? Reiciendis enim quibusdam impedit voluptatibus ducimus ratione laboriosam consectetur culpa obcaecati eius illum omnis iste corporis eaque exercitationem, blanditiis, accusamus corrupti praesentium! Distinctio totam omnis quae deleniti modi necessitatibus repudiandae dolorem in, explicabo amet ipsam enim praesentium aut assumenda ea autem magnam perferendis ut, consequuntur tenetur vel? Obcaecati itaque quis minus nobis quo excepturi. Magnam debitis atque ab, fuga optio quia quo deserunt minus repellendus hic sequi corporis ea. Laboriosam consectetur alias incidunt. Beatae, placeat quaerat aperiam aliquam reiciendis sit, voluptatem quo neque hic blanditiis laudantium dolorem et minima consectetur tempora eligendi quod mollitia doloribus dolore voluptate magnam fugiat vero est nihil. Unde dolorum dolor officiis eius atque ducimus laborum delectus odit corporis magni harum beatae earum vero eaque iste, nam amet. Ut, laborum odit voluptatem beatae unde placeat magni! Explicabo velit deserunt veritatis voluptatem aperiam cum, expedita necessitatibus animi, reprehenderit ducimus, illo quae. Perferendis accusantium natus, sunt vitae incidunt dicta enim consequuntur aperiam labore nihil nesciunt aut maxime expedita consequatur veniam ad. Dolorum quaerat minima voluptas, dolorem molestias in repellendus unde a expedita obcaecati ex, modi consequuntur excepturi perferendis tempora, nulla laboriosam nostrum laborum minus voluptatem explicabo blanditiis. Cupiditate recusandae veniam rerum quos magni eius ea ipsam accusantium exercitationem asperiores? Dicta maiores, tempore illum similique reprehenderit maxime nisi facere quisquam ad ut nam quo. Asperiores omnis nulla minus, in quo a unde fuga necessitatibus sunt sed! Laudantium unde illum excepturi suscipit neque eveniet! Cum, dolores. Accusantium id hic qui dignissimos culpa ratione ipsam quibusdam atque impedit eaque unde eum, cum, fugit deleniti nostrum fuga? Repudiandae eum nesciunt sequi, laboriosam perferendis ex eveniet porro suscipit voluptates quibusdam, laborum perspiciatis reiciendis necessitatibus fugiat! Commodi magnam mollitia perspiciatis ipsa quod obcaecati molestias tempore illum quasi distinctio sint ducimus eligendi vero qui harum libero dignissimos, quo nesciunt facere praesentium voluptatibus rerum! Accusamus maxime dolore culpa ipsam error magnam. Est nisi fuga iure ut voluptates? Repudiandae iste quisquam dicta a et dolorum libero animi iusto veritatis? Maiores autem dolores quaerat modi. Mollitia, doloribus quod aut earum commodi incidunt quibusdam, enim eum quas vero impedit et laborum excepturi maxime nobis? Quo doloremque quia et est commodi illo, deleniti iure illum ducimus eligendi aspernatur ipsum hic animi praesentium, harum nulla corporis! Ut at ipsum atque assumenda cum alias ea maxime unde aliquam laborum! Ipsum perferendis a optio officiis magni consequatur ad fuga et tempora, sequi similique. Beatae dolores consectetur, enim at dolore esse odio fuga eaque mollitia repudiandae? Vitae, et ullam? Consequatur esse delectus hic id ullam tempore eaque error aperiam, similique sit distinctio animi, porro cum, at quae consequuntur laboriosam repellendus. Dolores repellendus veniam dolore consequatur esse a excepturi error fuga odio, magni nulla quaerat voluptates deserunt dolorum minima architecto! At quibusdam enim consequatur vel voluptates molestias, odit officia pariatur perspiciatis dolorem, molestiae cumque laboriosam aliquam inventore repellat exercitationem! Laboriosam, numquam odit, magnam aut explicabo molestias fuga tenetur nam at molestiae cumque reiciendis. Est sed aperiam libero facere illum consequatur vel, reprehenderit enim facilis provident, quidem suscipit culpa corporis eveniet repellendus id laborum rem impedit doloribus nisi dolore. Facilis accusantium aperiam maiores. Facere dolorem suscipit, maxime molestiae reprehenderit accusantium magni ipsum amet hic tenetur libero blanditiis architecto iure voluptatem nemo. Aut, natus nostrum. Ratione quibusdam incidunt sit, obcaecati architecto voluptatibus alias reiciendis accusamus quis, provident nesciunt pariatur quae tempore! Exercitationem, velit! Consequuntur esse quos laudantium amet praesentium cumque nulla sequi quas pariatur dignissimos, modi maxime sit atque. Numquam eaque quas nesciunt. Quos qui cupiditate harum alias laudantium inventore magni, exercitationem porro laboriosam rerum, repellendus earum accusamus dolorum natus quasi. Exercitationem quia dicta voluptates in porro ab voluptatibus, dolores, nisi accusantium provident doloremque quo fugiat laboriosam doloribus? Optio beatae ipsum aspernatur ab, inventore, maiores, consequuntur officiis error deleniti corporis voluptatibus quidem rerum ipsam libero animi consectetur mollitia sapiente ea sed perspiciatis odit dolorum voluptas quo! Cupiditate id, corrupti rem porro minus voluptates hic asperiores. Quidem incidunt natus nobis corrupti aut. Dolor sit odit nisi commodi rem sed ullam corrupti, expedita porro consequuntur omnis repellendus cum? Architecto dolore, distinctio temporibus vero doloribus autem quibusdam? Natus maiores error explicabo neque voluptate necessitatibus voluptates maxime nisi recusandae, enim aliquam minima illo ipsa eum! Harum ipsa doloremque recusandae, adipisci natus excepturi asperiores reiciendis minus ea corrupti cupiditate odit veniam a quia eos sequi temporibus enim corporis quidem velit assumenda vel? Temporibus, labore culpa. Cupiditate saepe omnis veniam nulla iure aspernatur. Illo cum sit impedit minus vero fugit veniam numquam suscipit modi totam odit optio dicta aspernatur placeat repellendus, reiciendis, ratione, nostrum harum ipsam doloribus commodi tempore aperiam illum. Iste magni quod sequi assumenda necessitatibus labore a libero dignissimos aperiam. Deleniti quibusdam earum qui, eveniet molestiae aliquam minima quo aperiam officiis, iure recusandae tempora dolor nemo voluptate rem quia sapiente itaque tenetur adipisci cupiditate deserunt! Perspiciatis et porro quas in amet atque, velit illum quod sapiente sunt provident, hic eius reprehenderit, quos mollitia! Est sed natus, temporibus quaerat eum dicta ratione ipsam, esse omnis molestias rerum. Qui mollitia libero similique debitis voluptate voluptas labore deserunt vero maiores hic, vitae amet neque? Nisi optio id possimus tempore obcaecati quo excepturi magnam illum voluptate eos quibusdam sapiente, aperiam quisquam cum reiciendis maiores at facere laudantium ipsa cupiditate omnis dignissimos perferendis! Soluta sit deserunt pariatur laborum neque, fugit placeat laboriosam animi sequi voluptas at. Sit voluptas dolores placeat laboriosam ab corporis, optio eum neque voluptatem eligendi iste dignissimos recusandae ex facere enim amet aut unde facilis error veniam explicabo? Facere, accusamus. Nemo inventore eos ipsum natus laborum nobis cum magnam blanditiis aliquid, architecto perspiciatis exercitationem doloribus numquam facilis. Eos architecto laudantium quae aliquam molestias accusamus adipisci praesentium minima optio aut eum omnis, in dicta provident facere sint eaque. Est consequatur et deleniti ut eligendi vero quia libero iste necessitatibus voluptates id, perferendis laboriosam voluptate. Asperiores, neque excepturi tenetur tempore magnam nulla qui voluptas deleniti ad adipisci nostrum omnis nobis non alias reprehenderit ipsa unde dicta sint eligendi! Possimus maiores asperiores atque! Laudantium aut dolor hic natus quaerat eius optio nemo quibusdam laborum eligendi consequuntur quia iure consequatur unde molestias incidunt labore, odio, necessitatibus pariatur ratione. Voluptatibus ipsa repudiandae deserunt. Unde incidunt odio repellat esse molestiae commodi perspiciatis accusamus saepe animi nihil culpa natus quam eos nemo minima ab aliquid nisi nulla, mollitia dolorum, pariatur, quidem eius non iure! Amet omnis nemo dolorum. Sed vel eius laudantium officia ullam tempora placeat quae culpa autem accusantium consequatur rerum deserunt sequi necessitatibus, nam maiores quibusdam nisi veniam, neque officiis enim ad maxime. Ullam fuga, fugit minima dicta quos quia tempora a cumque unde veniam, ex voluptates eaque delectus, earum quisquam illum sapiente rerum sint libero itaque id non enim. Quasi ab adipisci quas possimus ex eos debitis sequi amet a, consequuntur eveniet illum laborum aspernatur aliquam sint unde magnam reiciendis natus dolorem harum, dicta enim accusantium? Veniam architecto dolorem aperiam suscipit accusamus omnis dicta expedita ipsa cumque tempora ad, aut esse distinctio natus et eligendi perspiciatis sunt possimus animi tempore voluptatum. Itaque expedita dignissimos ducimus? Repellendus quas facere modi! Cupiditate nesciunt libero itaque recusandae ipsum doloremque sed pariatur repellat nam impedit, autem consectetur temporibus. At, excepturi. Dolorum quibusdam repudiandae non neque dolorem, corporis mollitia qui velit vero minus autem, obcaecati eum itaque minima reprehenderit deleniti numquam ipsam fugiat adipisci veniam quae consectetur asperiores distinctio? Molestias minus harum fugit voluptatibus ex, recusandae velit deserunt enim laborum, facilis itaque autem exercitationem ipsam. Nihil laborum quaerat cumque. Dolorem ut exercitationem quidem cupiditate in, delectus incidunt odio facere ab aperiam quisquam necessitatibus quae. Corporis sequi nemo explicabo sunt! Voluptate consequuntur accusamus optio quo perferendis voluptas suscipit laboriosam, eveniet ad libero autem error nemo eum laudantium ipsa odio reprehenderit veniam facilis quaerat nihil dolorem cupiditate quod fugiat earum. Vel sapiente doloremque accusantium itaque enim atque modi aut culpa quo temporibus placeat, voluptas fugiat sequi et, corrupti eos quod. Voluptatibus aliquid enim maxime nemo eaque dolores commodi dolorem dolore distinctio? Eius autem consectetur sint et temporibus at illo aperiam, similique deserunt ab, voluptatibus deleniti culpa ipsam. Dolor unde recusandae necessitatibus ducimus dignissimos quisquam totam sed similique officia mollitia architecto, nihil nostrum rerum ullam quos ipsa ratione neque sint rem, minima in vero debitis! Officia iure saepe facilis, expedita dolorum minus voluptatum minima est quia fuga amet aspernatur, quasi aliquam itaque impedit eligendi fugit facere doloribus quibusdam deserunt eaque, possimus magnam. Eius porro, explicabo voluptatibus voluptas saepe quisquam ea in fugit quia ducimus blanditiis, minima perferendis ratione rem soluta enim inventore eum eligendi quasi molestias quidem fugiat? Saepe officia autem nam recusandae voluptatem, neque nulla similique repellat distinctio dolorum quos numquam accusamus reiciendis. Magni earum nobis beatae a? Odit vero odio officiis mollitia, rem iure accusantium, at labore rerum praesentium commodi! Nesciunt voluptatem assumenda optio sed accusamus sunt ut natus id. Quaerat, nulla temporibus ratione, eaque quidem commodi facilis voluptate voluptatum ex vitae, tempore nam magni. Quasi natus eos rerum consequuntur sunt. Sequi ratione delectus ea quod necessitatibus obcaecati ut recusandae iste, itaque magnam quas facilis? Eum eius incidunt rem rerum? Veniam!</p> --}}
                        
                    </section>
                </div>

                {{-- <div class="page page-break bg-white text-black mx-auto">
                    <h1 class="text-xl font-bold">Page 2</h1>
                </div> --}}

            </section>
        
    
    </div>


   

    <div 
    class="h-full"
     x-on:success-pdf.window="pdf = !pdf"
     x-show="pdf"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
     <section class="mx-3 h-screen">
        {{-- @include('livewire.pages.pdf.iframes.pdf-personnel') --}}
        <livewire:pages.pdf.iframes.pdf-professeur />
    </section>
    
    </div>





    {{-- modal confirmation  --}}
     <section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
    ])
    x-show="modalConfirmation"
    x-transition.duration.300ms
    >



    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-30 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>



    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="bg-white relative rounded-lg p-5 dark:bg-gray-800 lg:min-w-[40%]  sm:min-w-[50%] sm:w-auto w-[93%]  h-auto  shadow-2xl overflow-y-auto ">
         
            <div @class(['absolute z-50 top-0 right-0   cursor-pointer  rounded-tr-lg p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
            @click="modalConfirmation = !modalConfirmation"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            
            <div class="flex sm:flex-row  flex-col">
                <div class="relative w-full sm:w-20  ">
                    <div class=" sm:bg-yellow-200 sm:absolute flex justify-center sm:p-2 rounded-full top-0 left-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-center text-yellow-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                </div>

                <div class="w-full">
                    <h1 class="font-bold ">Entrez le code du personnel</h1>
                    {{-- <p>Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.</p> --}}
                    <input wire:model="codePersonnel" class="p-3 rounded-lg border border-gray-400 w-full" type="text" name="" id="">
                    <div class=" mt-5 flex fle-col gap-3 sm:justify-end justify-between">
                        {{-- <button wire:click="deletePersonnel({{ $personnelSelectionner }})"  @click="modalConfirmation = !modalConfirmation" class="bg-red-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-red-400">Supprimer</button> --}}
                        <button wire:click="putCodePersonnel"  @click="modalConfirmation = !modalConfirmation"  class="bg-gray-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-gray-400">Valider</button>
                    </div>
                </div>
             </div>
        </div>

    </div>
    
</section>    

<div 
    x-show="progressBar"
    x-transition

    x-effect="
        if (progressBar) {
            progress = 0;

            clearInterval(interval);

            interval = setInterval(() => {
                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(() => progressBar = false, 100);
                } else {
                    progress += 30;
                }
            }, 100);
        }
    "

    class="flex flex-col gap-4 bg-white dark:bg-gray-700 shadow-2xl rounded-2xl p-5 
           absolute z-50 top-[45%] md:left-[30%] left-[10%] md:right-[30%] right-[10%]"
>

    <!-- TEXTE -->
    <h2 class="text-lg font-bold text-center text-gray-800 dark:text-white">
        Téléchargement en cours...
    </h2>

    <!-- BARRE -->
    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
        <div 
            class="bg-blue-600 h-4 transition-all duration-100"
            :style="'width: ' + progress + '%'"
        ></div>
    </div>

    <!-- POURCENTAGE -->
    <p class="text-center text-sm text-gray-600 dark:text-gray-300">
        <span x-text="progress"></span>%
    </p>

</div>

</section>
