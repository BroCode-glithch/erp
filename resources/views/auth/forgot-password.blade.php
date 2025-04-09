<x-guest-layout>

    <!-- Main Content Area -->
    {{--  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">  --}}
        <!-- Form Container -->
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg space-y-6 relative z-10 fade-in">
            <!-- Background Video -->
            <div class="absolute inset-0 overflow-hidden">
                <video autoplay loop muted class="w-full h-full object-cover z-[-1]">
                    <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6" style="color: #fff !important;">Forgot Your Password?</h2>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" style="color: #fff !important">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    {{--  </div>  --}}
</x-guest-layout>
