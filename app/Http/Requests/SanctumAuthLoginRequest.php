<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanctumAuthLoginRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'device' => 'required|string|max:100',
        ];
    }
}
