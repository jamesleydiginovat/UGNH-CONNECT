<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-200 via-indigo-600 to-purple-700 px-4">

    <div class="w-full max-w-md bg-white/90 backdrop-blur-lg rounded-2xl shadow-2xl p-8">

        <!-- TITRE -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Mot de passe oublié
        </h2>

        <!-- PROGRESSION -->
        <div class="flex justify-between mb-8 text-xs text-gray-500">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center 
                    {{ $step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
                    1
                </div>
                <span class="mt-1">Code</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center 
                    {{ $step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
                    2
                </div>
                <span class="mt-1">Email</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center 
                    {{ $step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
                    3
                </div>
                <span class="mt-1">OTP</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center 
                    {{ $step >= 4 ? 'bg-green-600 text-white' : 'bg-gray-200' }}">
                    4
                </div>
                <span class="mt-1">Reset</span>
            </div>
        </div>

        <!-- STEP 1 -->
        @if($step == 1)
            <label class="text-sm text-gray-600">Code personnel</label>
            <input type="text" wire:model="code_personnel"
                   class="w-full mt-2 border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                   placeholder="Ex: EMP-001">

            @error('code_personnel')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button wire:click="checkCode"
                    class="w-full mt-5 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition">
                Suivant
            </button>
        @endif

        <!-- STEP 2 -->
        @if($step == 2)
            <label class="text-sm text-gray-600">Email</label>
            <input type="email" wire:model="email"
                   class="w-full mt-2 border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                   placeholder="exemple@gmail.com">

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button wire:click="checkEmail"
                    class="w-full mt-5 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition">
                Envoyer code
            </button>
        @endif

        <!-- STEP 3 -->
        @if($step == 3)
            <label class="text-sm text-gray-600">Code OTP</label>
            <input type="text" wire:model="otp"
                   class="w-full mt-2 border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                   placeholder="6 chiffres">

            @error('otp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button wire:click="verifyOtp"
                    class="w-full mt-5 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition">
                Vérifier
            </button>
        @endif

        <!-- STEP 4 -->
        @if($step == 4)
            <label class="text-sm text-gray-600">Nouveau mot de passe</label>
            <input type="password" wire:model="password"
                   class="w-full mt-2 border rounded-lg p-3 focus:ring-2 focus:ring-green-500 outline-none"
                   placeholder="Nouveau mot de passe">

            <input type="password" wire:model="password_confirmation"
                   class="w-full mt-3 border rounded-lg p-3 focus:ring-2 focus:ring-green-500 outline-none"
                   placeholder="Confirmer mot de passe">

            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button wire:click="resetPassword"
                    class="w-full mt-5 bg-green-600 hover:bg-green-700 text-white p-3 rounded-lg transition">
                Modifier mot de passe
            </button>
        @endif

    </div>
</div>