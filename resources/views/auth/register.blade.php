<x-guest-layout>
    @section('title', 'Register | ' . config('app.name'))
    {{--  <div class="flex items-center justify-center min-h-screen px-4 bg-gray-100">  --}}
        <div class="relative z-10 w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-2xl fade-in">
            <div class="flex-2"> <!-- Video area is larger -->
                <video autoplay loop muted class="w-full h-full object-cover z-[-1]">
                    <source src="{{ asset('videos/background-video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-800" style="color: #fff !important">Create a new role based account</h2>

            <!-- Session Status -->
            @if (session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif
            @if (session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" placeholder="Your Name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" placeholder="username@erp.com" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" placeholder="**********" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" placeholder="**********" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Role Selection -->
                <div class="mb-4">
                    <x-input-label for="role" :value="__('Role')" />
                    <select id="role" name="role" required class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option disabled selected value="">-- Select Role --</option>
                        <option value="admin">Admin</option>
                        <option value="program-manager">Program Manager</option>
                        <option value="care-support">Care Support</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-gray-100 hover:underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="w-full text-center ms-4 btn-btn-primary">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    {{--  </div>  --}}
</x-guest-layout>
