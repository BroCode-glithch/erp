<x-guest-layout>
    @section('title', 'Register | ' . config('app.name'))

    <!-- Main Content Area -->
    <div class="relative flex items-center justify-center bg-black rounded-2xl">

        <!-- Register Form Container with Animation -->
        <div class="relative w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-2xl fade-in-pop-up">

            <!-- Video Background Inside the Form Container -->
            <video autoplay loop muted class="absolute inset-0 z-0 object-cover w-full rounded-2xl h-full">
                <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Form Content (In Front of the Video) -->
            <div class="relative z-20">
                <h2 class="feature-card text-2xl font-bold text-center text-white">CREATE YOUR ROLE BASED ACCOUNT</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div class="feature-card">
                        <x-input-label for="name" :value="__('Name')" style="color: #fff !important" />
                        <x-text-input id="name" placeholder="James Doe" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="feature-card">
                        <x-input-label for="emai :value="__('Email')" style="color: #fff !important" />
                        <x-text-input id="email"  placeholder="user@erp.com" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Role Selection -->
                    <div class="feature-card">
                        <x-input-label for="role" :value="__('Select Role')" style="color: #fff !important" />
                        <select id="role" name="role" required class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Choose a Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="program-manager" {{ old('role') == 'program-manager' ? 'selected' : '' }}>Program Manager</option>
                            <option value="care-support" {{ old('role') == 'care-support' ? 'selected' : '' }}>Care Support</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="feature-card">
                        <x-input-label for="password" :value="__('Password')" style="color: #fff !important" />
                        <x-text-input id="password"  placeholder="**********" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="feature-card">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" style="color: #fff !important" />
                        <x-text-input id="password_confirmation"  placeholder="**********" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex justify-between items-center">
                        <a class="underline text-sm text-blue-800 hover:text-gray-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ms-4 feature-card">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
