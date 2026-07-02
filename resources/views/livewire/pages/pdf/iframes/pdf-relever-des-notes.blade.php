<div x-data="{ loading: true }" x-init="
    setTimeout(() => loading = false, 2000)
" class="relative w-full h-full pt-10">

    <!-- Loader -->
    <div 
        x-show="loading"
        x-transition
        class="absolute inset-0 flex flex-col items-center justify-center bg-white dark:bg-gray-800 z-10"
    >
        <div class="w-10 h-10 border-4 border-gray-300 border-t-blue-600 rounded-full animate-spin"></div>
        <span class="mt-3 text-gray-600 dark:text-gray-300">
            Chargement du PDF...
        </span>
    </div>

    <!-- PDF -->
    @if ($fileName !="")
        <iframe 
            src="{{ Storage::url('pdf/'.$fileName) }}"
            width="100%" 
            height="100%"
            @load="setTimeout(() => loading = false, 1500)"
        ></iframe>
    @endif
    

</div>