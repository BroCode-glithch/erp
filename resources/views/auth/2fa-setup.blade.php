<!-- resources/views/auth/2fa-setup.blade.php -->

@extends('layouts.guest')

@section('content')
    <div class="container">
        <h2>2FA Setup</h2>
        
        <p>To set up Two-Factor Authentication (2FA), scan the QR code below with your Google Authenticator app:</p>

        <!-- Display QR code -->
        <div>
            <img src="{{ $qrCode }}" alt="QR Code">
        </div>

        <p>Or manually enter this secret key in your authenticator app:</p>
        <p><strong>{{ session('2fa_secret') }}</strong></p>

        <form method="POST" action="{{ route('verify2fa') }}">
            @csrf
            <div class="form-group">
                <label for="code">Enter the code from your authenticator app:</label>
                <input type="text" id="code" name="code" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Verify</button>
        </form>
    </div>
@endsection
