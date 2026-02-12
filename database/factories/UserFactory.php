<?php // Norāda, ka šis ir PHP fails

namespace Database\Factories; // Definē nosaukumvietu (namespace) fabriku klasēm

use Illuminate\Database\Eloquent\Factories\Factory; // Iekļauj bāzes Factory klasi
use Illuminate\Support\Str; // Iekļauj Str klasi darbam ar string funkcijām
use Illuminate\Support\Facades\Hash; // Iekļauj Hash fasādi paroles šifrēšanai

class UserFactory extends Factory // Definē UserFactory klasi, kas paplašina Factory
{
    public function definition(): array // Metode, kas nosaka noklusējuma datu struktūru lietotāja ģenerēšanai
    {
        return [
            'name' => $this->faker->name(), // Ģenerē nejaušu lietotāja vārdu
            'email' => $this->faker->unique()->safeEmail(), // Ģenerē unikālu un drošu e-pasta adresi
            'email_verified_at' => now(), // Iestata e-pasta apstiprināšanas laiku uz pašreizējo brīdi
            'password' => Hash::make('password'), // Šifrē noklusējuma paroli "password"
            'remember_token' => Str::random(10), // Ģenerē nejaušu 10 simbolu atcerēšanās tokenu
        ];
    }
}

