<x-guest-layout>
    <!-- Background Video -->
    <div class="absolute inset-0 overflow-hidden">
        <video autoplay loop muted class="w-full h-full object-cover z-[-1]">
            <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Main Content Area -->
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <!-- Form Container -->
        <div class="flex w-full max-w-4xl bg-white p-8 rounded-2xl shadow-lg space-x-8 relative z-10">
            <!-- Left Side (Video Side) -->
            <div class="flex-1">
                <!-- You can add any content here, or leave it empty if you want just the video -->
            </div>

            <!-- Right Side (Form Side) -->
            <div class="flex-1 w-full max-w-md">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Reset Your Password</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
