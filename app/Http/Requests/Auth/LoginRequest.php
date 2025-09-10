<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
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
            'reference_number' => ['required', 'string'],
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
        // $ref = ReferenceNumber::where('reference_number', $this->input('reference_number'))->first();
        $user = User::whereHas('reference_numbers', function ($query) {
            $query->where('reference_number', $this->input('reference_number'));
        })->first();

        // if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
        // if (! $ref || ! $ref->user || ! Hash::check($this->input('password'), $ref->user->password)) {
        if (! $user) {
            throw ValidationException::withMessages([
                'reference_number' => trans('auth.failed'),
        ]);
    }
        if (! Auth::attempt([
            'email' => $user->email,
            'password' => $this->input('password'),
        ], $this->boolean('remember'))){
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'reference_number' => trans('auth.failed'),
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
            'reference_number' => trans('auth.throttle', [
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
        return $this->string('reference_number')
            ->lower()
            ->append('|'.$this->ip())
            ->transliterate()
            ->value();
    }
}
