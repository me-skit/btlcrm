<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusRequest extends FormRequest
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
        return [
            'name' => 'required',
            'village_id' => 'required',
            'address' => 'nullable',
            'phone_number' => 'nullable',
            'location' => 'nullable'
        ];
    }
}
