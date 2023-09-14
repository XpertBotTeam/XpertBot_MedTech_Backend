<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
             'name'=>'required|string|max:255',
            'email'=>'required|email|string|max:255',
            'password'=>'required|string|min:6|max:255',
            'age'=>'required|integer|max:255',
            'weight'=>'required|integer|max:255',
            'health'=>'required|string|max:255',
        ];
    }
}

