<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class authRequest extends FormRequest
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
        $pattern_email = '/^[\w]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/';

        return [
            'email' => ['required', 'email', "regex:$pattern_email"],
            'password' => ['required', 'min:3'],

        ];
    }

    public function messages()
    {
        return    [
            'email.required' => 'please enter your email',
            'email.regex' => 'please enter valid email',
            'password.required' => 'please enter your password',

        ];
    }
}
