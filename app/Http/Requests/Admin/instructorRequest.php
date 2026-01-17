<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class instructorRequest extends FormRequest
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
            'national_id' => ['required', 'regex:/^[0-9]{14}$/', 'unique:instructors,national_id,' . $id . ',national_id'],
            'email' => ['required', 'email', 'unique:instructors,email,' . $id . ',national_id'],
            'fname' => ['required', 'min:3'],
            'lname' => ['required', 'min:3'],
            'phone' => ['required', 'regex:/^(010|011|012|015)[0-9]{8}$/'],
            'job_tittle' => ['required'],
            'img_name' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'password' => $isUpdate ? ['nullable', 'min:6'] : ['required', 'min:6']
        ];
    }
}
