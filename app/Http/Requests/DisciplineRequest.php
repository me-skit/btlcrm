<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplineRequest extends FormRequest
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
            'discipline_type' =>'required',
            'act_number' => 'required',
            'start_date' => ['required', 'date'],
            'end_date' => ['date', 'nullable']
        ];

        if ($this->isMethod('POST')) {
            $rules = ['person_id' => 'required'] + $rules;        
        }

        if ($this->isMethod('PATCH')) {
            $rules = ['end_date' => ['required', 'date']];
        }

        return $rules;
    }
}
