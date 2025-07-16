
@section('title', 'Privacy Policy | ' . setting('general.site_name'))

<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}">
                    <div class="logo-circle">ERP</div>
                </a>
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $policy !!}
            </div>
        </div>
    </div>
</x-guest-layout>
