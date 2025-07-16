<x-guest-layout>

    @section('title', 'Reset Password | ' . setting('general.site_name'))

    <!-- Main Content Area -->
    <div class="relative flex items-center justify-center bg-white rounded-2xl">

        <!-- Reset Password Form Container -->
        <div class="relative w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-2xl fade-in-pop-up">

            <!-- Video Background -->
            <video autoplay loop muted class="absolute inset-0 z-0 object-cover w-full h-full rounded-2xl">
                <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Form Content -->
            <div class="relative z-20">

                <h2 class="feature-card text-2xl font-bold text-center text-white">SET A NEW PASSWORD</h2>
                <p class="text-center text-sm text-gray-300 mb-4">Enter your new password to reset your account</p>

                @if (session('status'))
                    <div class="feature-card p-3 text-sm text-green-500 bg-green-100 border border-green-200 rounded-md">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="feature-card">
                        <x-input-label for="email" :value="__('Email')" style="color: #fff !important" />
                        <x-text-input id="email" placeholder="you@example.com" class="block w-full mt-1"
                            type="email" name="email" :value="old('email', $request->email)" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="feature-card">
                        <x-input-label for="password" :value="__('New Password')" style="color: #fff !important" />
                        <x-text-input id="password" class="block w-full mt-1"
                            type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="feature-card">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" style="color: #fff !important" />
                        <x-text-input id="password_confirmation" class="block w-full mt-1"
                            type="password" name="password_confirmation" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end feature-card">
                        <x-primary-button class="justify-center w-full">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="pt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:underline">
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
