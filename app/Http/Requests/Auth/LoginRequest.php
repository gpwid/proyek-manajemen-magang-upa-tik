<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * @method \Illuminate\Session\Store session()
 */
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identifier' => ['required', 'string'],
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
        $this->ensureIsNotRateLimited();

        $identifier = $this->input('identifier');
        $password = $this->input('password');

        // Tentukan tipe kredensial: apakah email atau bukan?
        $credentialType = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'unique_id';

        // Siapkan kredensial berdasarkan tipenya
        $credentials = [
            'password' => $password,
        ];

        if ($credentialType === 'email') {
            $credentials['email'] = $identifier;
        } else {
            // Jika bukan email, coba login dengan nip ATAU nisnim
            // Ini adalah cara yang lebih fleksibel
            $loginSuccess = Auth::attempt(['nip' => $identifier, 'password' => $password], $this->boolean('remember'))
                || Auth::attempt(['nisnim' => $identifier, 'password' => $password], $this->boolean('remember'));
        }

        // Jika tipe kredensial adalah email, coba login dengan email
        if ($credentialType === 'email') {
            $loginSuccess = Auth::attempt($credentials, $this->boolean('remember'));
        }

        // Jika login gagal (baik via unique_id maupun email)
        if (! isset($loginSuccess) || ! $loginSuccess) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'identifier' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
