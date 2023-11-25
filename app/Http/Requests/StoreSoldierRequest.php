<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoldierRequest extends FormRequest
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
            'name'=>['required', 'string', 'max:255'],
            'rank' => ['required'],
            'position' =>['required'],
            'date_of_birth'=>['required'],
            'matricular'=>['required'],
            
            'specialization'=>['required'],
            'bloodGroup'=>['required'],
            'gender'=>['required'],
            'nationality'=>['required'],
            'regionOfBirth'=>['required'],
            'marialStatus'=>['required'],
            'photo'=>['sometimes'],
        ];

    }
}
