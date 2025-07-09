<x-guest-layout>
    <x-auth-card>
        <h2 class="mb-4 text-lg font-bold text-center">Set up Two-Factor Authentication</h2>

        <p class="text-sm text-gray-600">Scan this QR code with your Google Authenticator app:</p>

        <div class="flex justify-center my-4">
            <img src="{{ $qrCode }}" alt="QR Code">
        </div>

        <p class="text-sm text-gray-600">Or enter this code manually:</p>
        <p class="mb-4 font-mono text-center text-blue-600">{{ session('2fa_secret') }}</p>

        <form method="POST" action="{{ route('verify2fa') }}">
            @csrf
            <div class="mb-4">
                <x-label for="code" value="Enter the 6-digit code from your app" />
                <x-input id="code" name="code" type="text" class="block w-full mt-1" required autofocus />
                @error('code') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <x-button class="w-full">
                Verify and Enable 2FA
            </x-button>
        </form>
    </x-auth-card>
</x-guest-layout>
