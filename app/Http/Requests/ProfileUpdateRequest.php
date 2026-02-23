<?php // Sākas PHP kods

namespace App\Http\Requests; // Šī klase atrodas Requests mapē (speciāla validācijas klase)

use App\Models\User; // User modelis (users tabula)
use Illuminate\Foundation\Http\FormRequest; // Laravel forma ar iebūvētu validāciju
use Illuminate\Validation\Rule; // Papildu validācijas noteikumi (piemēram, unique ar ignore)

class ProfileUpdateRequest extends FormRequest // Speciāls request profila atjaunināšanai
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array // Validācijas noteikumi profila formai
    {
        return [
            'name' => ['required', 'string', 'max:255'], 
            // Vārds obligāts, teksts, max 255 simboli

            'email' => [
                'required', // E-pasts obligāts
                'string', // Teksts
                'lowercase', // Tiek pārveidots uz mazajiem burtiem
                'email', // Jābūt pareizā e-pasta formātā
                'max:255', // Max 255 simboli
                Rule::unique(User::class)->ignore($this->user()->id),
                // E-pastam jābūt unikālam users tabulā,
                // bet ignorē pašreizējā lietotāja ID (lai var atstāt savu e-pastu nemainītu)
            ],
        ];
    }

    /**
     * Get the custom validation messages for the request.
     */
    public function messages(): array // Pielāgotie kļūdu ziņojumi
    {
        return [
            'name.required' => 'Vārds ir obligāts.',
            'name.string' => 'Vārdam jābūt teksta formātā.',
            'name.max' => 'Vārds nedrīkst būt garāks par 255 simboliem.',
            'email.required' => 'E-pasta adrese ir obligāta.',
            'email.email' => 'E-pasta adresei jābūt derīgā formātā.',
            'email.unique' => 'Šī e-pasta adrese jau ir reģistrēta.',
        ];
    }
}
