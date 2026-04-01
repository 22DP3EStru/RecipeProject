<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
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

            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_profile_photo' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Get the custom validation messages for the request.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Vārds ir obligāts.',
            'name.string' => 'Vārdam jābūt teksta formātā.',
            'name.max' => 'Vārds nedrīkst būt garāks par 255 simboliem.',

            'email.required' => 'E-pasta adrese ir obligāta.',
            'email.email' => 'E-pasta adresei jābūt derīgā formātā.',
            'email.unique' => 'Šī e-pasta adrese jau ir reģistrēta.',

            'profile_photo.image' => 'Profila bildei jābūt attēla formātā.',
            'profile_photo.mimes' => 'Profila bildei jābūt JPG, JPEG, PNG vai WEBP formātā.',
            'profile_photo.max' => 'Profila bilde nedrīkst būt lielāka par 2 MB.',
        ];
    }
}