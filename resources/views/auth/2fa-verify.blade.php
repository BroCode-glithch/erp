<x-guest-layout>
    <x-auth-card>
        <h2 class="text-lg font-bold text-center">Enter 2FA Code</h2>

        @if ($errors->any())
            <div class="text-red-600">
                {{ $errors->first('code') }}
            </div>
        @endif

        <form method="POST" action="{{ route('2fa.verify.code') }}">
            @csrf
            <div class="mt-4">
                <x-label for="code" value="Authentication Code" />
                <x-input id="code" class="block w-full mt-1" type="text" name="code" required autofocus />
            </div>

            <div class="mt-4">
                <x-button class="w-full">
                    Verify
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
