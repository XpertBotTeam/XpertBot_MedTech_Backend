<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicationRequest extends FormRequest
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
            'dose' => 'required|string|max:255',
            'frequency' => 'required|int',
            'time' => 'required|string',
            'prescription' => 'required|string|max:255',
            'user-id'=>'required|exists:users,id',
            'patient-id'=>'required|exists:patients,id',
            'medicine-id'=>'required|exists:medicines,id'
        ];
    }
}
