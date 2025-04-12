<x-guest-layout>
    @section('title', 'Forgot Password | ' . config('app.name'))

    <div class="relative z-10 w-full max-w-md p-8 space-y-6 border shadow-lg bg-white/10 backdrop-blur-md rounded-2xl fade-in border-white/30">
        <video autoplay loop muted class="absolute w-full h-full object-cover rounded-2xl z-[-1] opacity-20">
            <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
        </video>

        <h2 class="text-2xl font-bold text-center text-white">Reset your password</h2>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-primary-button class="justify-center w-full">
                    Send Password Reset Link
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
