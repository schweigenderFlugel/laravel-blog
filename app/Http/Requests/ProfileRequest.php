<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => 'required', 
            'email' => 'required', 
            'photo' => 'nullable|mimes:jpeg,jpg,png', 
            'profession' => 'nullable|max:60', 
            'about' => 'nullable|max:200', 
            'twitter' => 'nullable|url', 
            'linkedin' => 'nullable|url', 
            'facebook' => 'nullable|url'

        ];
    }
}
