<x-guest-layout>
    @section('title', 'Reset Password | ' . config('app.name'))

    <div class="relative z-10 w-full max-w-md p-8 space-y-6 border shadow-lg bg-white/10 backdrop-blur-md rounded-2xl fade-in border-white/30">
        <video autoplay loop muted class="absolute w-full h-full object-cover rounded-2xl z-[-1] opacity-20">
            <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
        </video>

        <h2 class="text-2xl font-bold text-center text-white">Set a new password</h2>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div>
                <x-primary-button class="justify-center w-full">
                    Reset Password
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
