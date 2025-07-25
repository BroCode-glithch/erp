@extends('layouts.admin')

@section('title', 'General Settings | Admin | ' . setting('general.site_name'))

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl mx-auto">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800 dark:text-gray-100">General Settings</h2>

    <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Site Name -->
        <div>
            <label for="site_name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Site Name
            </label>
            <input type="text" name="site_name" id="site_name"
                   value="{{ old('site_name', $settings['site_name']) }}"
                   class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                   required>
        </div>

        <!-- System Email -->
        <div>
            <label for="admin_email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                System Email
            </label>
            <input type="email" name="system_email" id="system_email"
                   value="{{ old('system_email', $settings['system_email']) }}"
                   class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                   required>
        </div>

        <!-- Contact Phone -->
        <div>
            <label for="contact_phone" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Contact Phone
            </label>
            <input type="text" name="contact_phone" id="contact_phone"
                   value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                   class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
        </div>

        <!-- Contact Address -->
        <div>
            <label for="contact_address" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Contact Address
            </label>
            <input type="text" name="contact_address" id="contact_address"
                   value="{{ old('contact_address', $settings['contact_address']) }}"
                   class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                   required>
        </div>

        <!-- Timezone -->
        <div>
            <label for="timezone" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Timezone
            </label>
            <select name="timezone" id="timezone"
                    class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                @foreach(timezone_identifiers_list() as $tz)
                    <option value="{{ $tz }}" {{ $settings['timezone'] === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                @endforeach
            </select>
        </div>

        <!-- Date Format -->
        <div>
            <label for="date_format" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Date Format
            </label>
            <input type="text" name="date_format" id="date_format"
                   value="{{ old('date_format', $settings['date_format'] ?? 'Y-m-d') }}"
                   class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                   placeholder="e.g., Y-m-d, d/m/Y">
        </div>

        <!-- Time Format -->
        <div>
            <label for="time_format" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Time Format
            </label>
            <input type="text" name="time_format" id="time_format"
                   value="{{ old('time_format', $settings['time_format'] ?? 'H:i:s') }}"
                   class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"
                   placeholder="e.g., H:i:s, h:i A">
        </div>

        <!-- Currency -->
        <div>
            <label for="currency_symbol" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Currency
            </label>
            <select name="currency_symbol" id="currency_symbol"
                class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                @php
                    $currencies = [
                        'USD' => 'US Dollar ($)',
                        'EUR' => 'Euro (€)',
                        'GBP' => 'British Pound (£)',
                        'JPY' => 'Japanese Yen (¥)',
                        'CNY' => 'Chinese Yuan (¥)',
                        'NGN' => 'Nigerian Naira (₦)',
                        'INR' => 'Indian Rupee (₹)',
                        'BRL' => 'Brazilian Real (R$)',
                        'CAD' => 'Canadian Dollar (C$)',
                        'AUD' => 'Australian Dollar (A$)',
                        'ZAR' => 'South African Rand (R)',
                        'KES' => 'Kenyan Shilling (KSh)',
                        'GHS' => 'Ghanaian Cedi (₵)',
                        'AED' => 'UAE Dirham (د.إ)',
                    ]; // wOULD ADD MORE CURRENCIES AS SYSTEM DEVELOPS
                @endphp

                @foreach($currencies as $code => $label)
                    <option value="{{ $code }}" {{ $code == $settings['currency_symbol'] ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Logo Upload -->
        <div>
            <label for="site_logo" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Site Logo (optional)
            </label>
            <input type="file" name="site_logo" id="site_logo"
                   class="block w-full text-sm text-gray-700 dark:text-white file:border file:rounded file:px-4 file:py-2 file:text-sm file:bg-blue-50 dark:file:bg-blue-900 dark:file:text-white dark:file:border-gray-700" />
            @if(!empty($settings['site_logo']))
                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Current Logo:</p>
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Site Logo" class="h-16 mt-1">
                </div>
            @endif
        </div>

        <!-- Favicon Upload -->
        <div>
            <label for="favicon" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Favicon (optional)
            </label>
            <input type="file" name="favicon" id="favicon"
                   class="block w-full text-sm text-gray-700 dark:text-white file:border file:rounded file:px-4 file:py-2 file:text-sm file:bg-blue-50 dark:file:bg-blue-900 dark:file:text-white dark:file:border-gray-700" />
            @if(!empty($settings['favicon']))
                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Current Favicon:</p>
                    <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" class="h-16 mt-1">
                </div>
            @endif
        </div>

        <!-- Logo Upload -->
        <div>
            <label for="site_logo" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Site Logo (optional)
            </label>
            <input type="file" name="site_logo" id="site_logo"
                   class="block w-full text-sm text-gray-700 dark:text-white file:border file:rounded file:px-4 file:py-2 file:text-sm file:bg-blue-50 dark:file:bg-blue-900 dark:file:text-white dark:file:border-gray-700" />
            @if(!empty($settings['site_logo']))
                <div class="mb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Current Logo:</p>
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Site Logo" class="h-16 mt-1">
                </div>
            @endif
        </div>

        <!-- Maintenance Mode -->
        <div class="flex items-center">
            <input type="checkbox" name="maintenance_mode" id="maintenance_mode"
                   {{ !empty($settings['maintenance_mode']) && $settings['maintenance_mode'] ? 'checked' : '' }}
                   class="w-5 h-5 text-blue-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
            <label for="maintenance_mode" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Enable Maintenance Mode</label>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
