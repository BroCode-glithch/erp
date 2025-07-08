<x-guest-layout>
    @section('title', 'Login | ' . config('app.name'))

    <!-- Main Content Area -->
    <div class="relative flex items-center justify-center bg-white rounded-2xl">

        <!-- Login Form Container with Animation -->
        <div class="relative w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-2xl fade-in-pop-up">

            <!-- Video Background Inside the Form Container -->
            <video autoplay loop muted class="absolute inset-0 z-0 object-cover w-full rounded-2xl h-full">
                <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Form Content (In Front of the Video) -->
            <div class="relative z-20">
                <h2 class="feature-card text-2xl font-bold text-center text-white">LOGIN TO YOUR ACCOUNT...</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div class="feature-card">
                        <x-input-label for="email" :value="__('Email')" style="color: #fff !important" />
                        <x-text-input id="email" placeholder="username@erp.com" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="feature-card">
                        <x-input-label for="password" :value="__('Password')" style="color: #fff !important" />
                        <x-text-input id="password" placeholder="**********" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="text-sm text-gray-300 ms-2">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-300 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex justify-end feature-card">
                        <x-primary-button class="justify-center w-full">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
