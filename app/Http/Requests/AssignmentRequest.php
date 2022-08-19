<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'privilege_id' => 'required',
            'privilege_role_id' => 'nullable',
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date']
        ];

        if ($this->isMethod('POST')) {
            $rules = ['person_id' => 'required'] + $rules;        
        }

        return $rules;
    }
}
