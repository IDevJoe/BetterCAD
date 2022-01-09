<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterEditRequest extends FormRequest
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
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'dob' => 'required|date',
            'hair_color' => 'required|string|between:3,3',
            'eye_color' => 'required|string|between:3,3',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:1',
            'race' => 'required|string|max:1',
            'height' => 'required|integer',
            'weight' => 'required|integer'
        ];
    }
}
