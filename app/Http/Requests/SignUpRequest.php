<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:3|max:100',
            'email' => 'bail|required|email|max:255|unique:users,email',
            'password' => 'bail|required|string|min:6|max:18|confirmed',
            'user_type' => 'nullable|in:admin,customer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'email.unique' => 'email already exists',
            'password.required' => 'password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must not exceed 18 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ];
    }
}
