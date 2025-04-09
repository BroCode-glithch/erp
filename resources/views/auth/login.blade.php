<x-guest-layout>
    <!-- Main Content Area -->
    {{--  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">  --}}
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg space-y-6 fade-in relative z-10">
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
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="username@erp.com"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="**********"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-300 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="w-full justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    {{--  </div>  --}}
</x-guest-layout>
