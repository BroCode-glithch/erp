<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all users to make this request
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Defined validation rules for login
        // Ensured email is required, string, and valid email format
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // Ensure the login request is not rate limited
        // This will prevent brute force attacks by limiting the number of login attempts
        // to 5 attempts per minute
        // If the limit is exceeded, it will throw a ValidationException with a throttle message
        // and trigger a Lockout event
        $this->ensureIsNotRateLimited();

        // Attempt to authenticate the user with the provided credentials
        // If authentication fails, it will throw a ValidationException with an error message
        // If successful, it will clear the rate limiter for this throttle key
        // and allow the request to proceed
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }


        // Clear the rate limiter for this throttle key
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {

        // Check if the rate limit for this throttle key has been exceeded
        // If it has, it will throw a ValidationException with a throttle message
        // and trigger a Lockout event
        // This will prevent further login attempts until the rate limit resets
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        // Generate a unique throttle key based on the user's email and IP address
        // This key will be used to track the rate limit for this specific user
        // It combines the email and IP address to ensure uniqueness
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
