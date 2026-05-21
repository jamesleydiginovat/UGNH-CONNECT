
<div x-data="{ open: false }" class="relative">

<!-- CLOCHE -->
<!-- CLOCHE -->
<div @click="open = !open"
    class="cursor-pointer p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition relative">

    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6 text-gray-400 dark:text-gray-300">

        <path stroke-linecap="round" stroke-linejoin="round"
            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
    </svg>

    <!-- 🔴 BADGE COMPTEUR -->
    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs 
                font-bold px-1.5 py-0.5 rounded-full min-w-3 text-center">
        {{ $this->CountNotification }}
    </span>

</div>

    <!-- PANEL NOTIFICATIONS -->
    <div x-show="open"
        x-transition
        @click.outside="open = false"
        class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-900 
                border dark:border-gray-700 rounded-lg shadow-lg p-4 z-50">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-3">

            <h2 class="font-bold text-gray-800 dark:text-white">
                Notifications
            </h2>

            <button @click="open = false"
                    class="text-gray-500 hover:text-red-500">
                ✕
            </button>

        </div>

        <!-- CONTENT -->
        <div class="space-y-2 max-h-100 overflow-y-auto no-scrollbar">

            @if( $this->CountNotification > 1)
                <button wire:click="markAllAsSeen"
                        class="text-xs px-3 py-1 rounded-md 
                            bg-blue-500 hover:bg-blue-600 
                            text-white transition">

                    Marquer tout comme lu

                </button>
            @endif

            @foreach ($this->Notification as $notification)
                <div class="p-3 rounded-lg border border-gray-200 dark:border-gray-700 
                            hover:bg-gray-100 dark:hover:bg-gray-800 
                            transition flex items-start justify-between gap-3">

                    <!-- CONTENT -->
                    <div class="flex items-start gap-3 flex-1">

                        <!-- ICON -->
                        <div class="text-lg mt-1">
                            🔔
                        </div>

                        <div>

                            <!-- NOM + TIME -->
                            <div class="flex items-center gap-2">

                                <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                    {{ $this->NomPersonnel($notification->notification_id)->nom ?? "" }}
                                    {{ $this->NomPersonnel($notification->notification_id)->prenom ?? "" }}
                                </p>

                                

                            </div>

                            <!-- MESSAGE -->
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ $notification->message }}
                            </p>


                            <!-- ⏱ TIME -->
                            <span wire:poll.60s class="text-[10px] text-gray-400 dark:text-gray-500">
                                • {{ $notification->created_at->diffForHumans() }}
                            </span>

                        </div>

                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="flex items-center gap-2">

                        <!-- VIEWED -->
                        <button wire:click="markAsSeen({{ $notification->notification_id }})"
                                class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                            👁️
                        </button>

                        <!-- DETAILS -->
                        <button wire:click="showDetail({{ $notification->id }})"
                                class="px-2 py-1 text-xs bg-blue-500 hover:bg-blue-600 text-white rounded transition">
                            Voir
                        </button>

                    </div>


                    

                </div>
            @endforeach
        </div>

       @if($this->Notification->isEmpty())

            <div class="flex flex-col items-center justify-center py-10 text-center">

                <!-- ICON -->
                <div class="text-4xl mb-2">
                    🔔
                </div>

                <!-- TEXT -->
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Aucune notification
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Vous serez notifié lorsque quelque chose arrivera.
                </p>

            </div>

        @endif

        
</div>

</div>
