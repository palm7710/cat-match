<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;


class ProfileRequest extends FormRequest
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
        $myEmail = Auth::user()->email;

        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 
                        'string', 
                        'email', 
                        'max:255', 
                        Rule::unique('users', 'email')->whereNot('email', $myEmail)],
            ];
    }
}
