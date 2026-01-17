<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class adminRequest extends FormRequest
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
        $id = $this->route('id');
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        
        return [
            'fname'     => ['required', 'min:3'],
            'lname'     => ['required', 'min:3'],
            'email'     => ['required', 'email', 'unique:admins,email,' . $id],
            'phone'     => ['nullable', 'regex:/^(010|011|012|015)[0-9]{8}$/'],
            'img_admin' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'password'  => $isUpdate ? ['nullable', 'min:6'] : ['required', 'min:6'],
            'is_supper' => ['nullable', 'in:0,1'],
            'joined_at' => ['nullable', 'date'],
            'id'        => ['required', 'digits:14'],
        ];
    }
}
