<x-guest-layout>

    @section('title', 'Forgot Password | ' . setting('general.site_name'))

    <!-- Main Content Area -->
    <div class="relative flex items-center justify-center bg-white rounded-2xl">

        <!-- Forgot Password Form Container -->
        <div class="relative w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-2xl fade-in-pop-up">

            <!-- Video Background -->
            <video autoplay loop muted class="absolute inset-0 z-0 object-cover w-full rounded-2xl h-full">
                <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Form Content -->
            <div class="relative z-20">

                <h2 class="feature-card text-2xl font-bold text-center text-white">RESET YOUR PASSWORD</h2>
                <p class="text-center text-sm text-gray-300 mb-4">Enter your email to receive a reset link</p>

                @if (session('status'))
                    <div class="feature-card p-3 text-sm text-green-500 bg-green-100 border border-green-200 rounded-md">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div class="feature-card">
                        <x-input-label for="email" :value="__('Email')" style="color: #fff !important" />
                        <x-text-input id="email" placeholder="you@example.com" class="block w-full mt-1"
                            type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end feature-card">
                        <x-primary-button class="justify-center w-full">
                            {{ __('Send Password Reset Link') }}
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
