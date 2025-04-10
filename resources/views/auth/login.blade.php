<x-guest-layout>
    @section('title', 'Login | ' . config('app.name'))
    <!-- Main Content Area -->
    {{--  <div class="flex items-center justify-center min-h-screen px-4 bg-gray-100">  --}}
        <div class="relative z-10 w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-2xl fade-in">
            <div class="flex-2"> <!-- Video area is larger -->
                <video autoplay loop muted class="w-full h-full object-cover z-[-1]">
                    <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-800" style="color: #fff !important">Login to your account</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" placeholder="username@erp.com"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" placeholder="**********"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="text-sm text-gray-300 ms-2">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-300 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="justify-center w-full">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    {{--  </div>  --}}
</x-guest-layout>
