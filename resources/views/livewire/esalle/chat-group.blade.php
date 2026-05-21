<div 
    class="h-screen flex bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100"
    x-data="{ openUsers: false }"
>

    <!-- OVERLAY (mobile) -->
    <div 
        x-show="openUsers"
        class="fixed inset-0 bg-black/50 z-40 md:hidden"
        @click="openUsers = false"
    ></div>

    <!-- SIDEBAR USERS -->
    <div 
        class="fixed md:static z-50 md:z-auto w-3/4 md:w-1/4 h-full 
               bg-white dark:bg-gray-800 border-r dark:border-gray-700 
               transform md:translate-x-0 transition-transform duration-300"
        :class="openUsers ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    >

        <!-- HEADER -->
        <div class="p-3 font-bold border-b dark:border-gray-700 flex justify-between items-center">
            <span>Groupe E-Salle</span>

            <!-- close button mobile -->
            <button class="md:hidden text-xl" @click="openUsers = false">
                ✕
            </button>
        </div>

        <!-- USERS -->
        <div class="flex-1 overflow-y-auto">
            @if (session('user_type')=='etudiant')
                @foreach ($this->ListeEtudiantEsalle as $lesEtudiants)

                    <div class="flex items-center gap-3 p-3 hover:bg-gray-100 dark:hover:bg-gray-700">

                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                            {{ strtoupper(substr($lesEtudiants->nom, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-sm">
                                {{ $lesEtudiants->nom }} {{ $lesEtudiants->prenom }}
                            </p>
                            {{-- <p class="text-xs text-green-500">En ligne</p> --}}
                        </div>

                    </div>

                @endforeach
            @else
                    {{-- @php
                         dd($this->ListeSalleProf);
                    @endphp --}}
                   
                @foreach ($this->ListeSalleProf as $nomFac)
                    

                    <div wire:click="setValue('{{ $nomFac->codeFac }}', '{{ $nomFac->niveau }}')" class="flex items-center gap-3 p-3 hover:bg-gray-100 dark:hover:bg-gray-700">

                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                            {{ strtoupper(substr($nomFac->codeFac, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-sm">
                                {{ $this->nomFac($nomFac->codeFac) }} - {{ $nomFac->niveau }}
                            </p>
                            
                        </div>

                    </div>

                @endforeach

                
                
            @endif
            

        </div>
    </div>

    <!-- CHAT AREA -->
    <div class="flex-1 flex flex-col relative">

        <!-- TOP BAR -->
        <div class="p-3 bg-white dark:bg-gray-800 border-b dark:border-gray-700 font-bold flex items-center justify-between">
            <div class="flex flex-row gap-10">

                <svg @click="open = !open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>

                <span>
                    Chat - {{ $this->nomFac($this->codeFac) }} - {{ $this->niveau }}
                </span>
            </div>
            

            <!-- BUTTON OPEN USERS (mobile) -->
            <button 
                class="md:hidden bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded"
                @click="openUsers = true"
            >
                Étudiants
            </button>

        </div>

        <!-- MESSAGES -->
        <div 
        x-data
        x-ref="chatBox"
        x-init="$nextTick(() => $refs.chatBox.scrollTop = $refs.chatBox.scrollHeight)"
        class="flex-1 overflow-y-auto p-4 pb-25 space-y-4 no-scrollbar">
            @if (session('user_type')=='etudiant')
                @foreach ($this->MessageGroup as $message)

                    @if ($message->codeUser == session('user_code'))

                        <!-- SENT -->
                        <div class="flex justify-end">
                            <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <span class="text-[10px] text-blue-100">
                                    Moi - {{ $message->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                    @else

                        <!-- RECEIVED -->
                        @if ($this->isEtudiant($message->codeUser))
                            <div class="flex justify-start">
                                <div class="bg-gray-200 dark:bg-gray-700 p-3 rounded-lg max-w-xs">
                                    <p class="text-sm">{{ $message->message }}</p>
                                    <span class="text-[10px] text-gray-500">
                                        {{ $this->nomEtudiant($message->codeUser) }} - {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @elseif ($this->isProf($message->codeUser))
                            <div class="flex justify-start">
                                <div class="bg-gray-200 dark:bg-yellow-700 p-3 rounded-lg max-w-xs">
                                    <p class="text-sm">{{ $message->message }}</p>
                                    <span class="text-[10px] text-gray-50">
                                        {{ $this->nomProf($message->codeUser) }} - {{ $message->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @endif
                        

                    @endif

                @endforeach
            @endif




            @if (session('user_type')=='professeur')
                @foreach ($this->MessageGroupProf as $message)

                    @if ($message->codeUser == session('user_code'))

                        <!-- SENT -->
                        <div class="flex justify-end">
                            <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <span class="text-[10px] text-blue-100">
                                    Moi - {{ $message->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                    @else

                        <!-- RECEIVED -->
                        <div class="flex justify-start">
                            <div class="bg-gray-200 dark:bg-gray-700 p-3 rounded-lg max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <span class="text-[10px] text-gray-500">
                                    {{ $message->codeUser }} - {{ $message->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                    @endif

                @endforeach
            @endif

        </div>

        <!-- INPUT -->
        @if (session('user_type')=="etudiant")
            <form wire:submit="save"
                class="p-3 absolute w-full bottom-0 left-0 bg-white dark:bg-gray-800 border-t dark:border-gray-700 flex gap-2">

                <input wire:model.live="message"
                    type="text"
                    placeholder="Écrire un message..."
                    class="flex-1 p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">

                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Envoyer
                </button>

            </form>
        @endif



        @if (session('user_type')=="professeur")
            <form wire:submit="saveMessageProf"
                class="p-3 absolute w-full bottom-0 left-0 bg-white dark:bg-gray-800 border-t dark:border-gray-700 flex gap-2">

                <input wire:model.live="message"
                    type="text"
                    placeholder="Écrire un message..."
                    class="flex-1 p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">

                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Envoyer
                </button>

            </form>
        @endif
        

    </div>
    

</div>