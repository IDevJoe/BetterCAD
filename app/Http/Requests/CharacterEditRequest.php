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
            'weight' => 'required|integer',
            'dl_type' => 'nullable|string|max:3',
            'dl_status' => 'nullable|string|max:3',
            'dl_expiry' => 'nullable|date',
            'wl_status' => 'nullable|string|max:3',
            'wl_expiry' => 'nullable|date',
            'bl_status' => 'nullable|string|max:3',
            'bl_expiry' => 'nullable|date',
            'pl_type' => 'nullable|string|max:3',
            'pl_status' => 'nullable|string|max:3',
            'pl_expiry' => 'nullable|date',
            'dead' => 'nullable|bool'
        ];
    }
}
