<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'VÄrds ir obligÄts.',
            'name.string' => 'VÄrdam jÄbÅ«t teksta formÄtÄ.',
            'name.max' => 'VÄrds nedrÄ«kst bÅ«t garÄks par 255 simboliem.',
            'email.required' => 'E-pasta adrese ir obligÄta.',
            'email.email' => 'E-pasta adresei jÄbÅ«t derÄ«gÄ formÄtÄ.',
            'email.unique' => 'Å Ä« e-pasta adrese jau ir reÄ£istrÄ“ta.',
        ];
    }
}

