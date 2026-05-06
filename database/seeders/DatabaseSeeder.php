<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rating;

/**
 * Galvenais datubāzes seederis.
 *
 * Šis seederis tiek izmantots sākotnējo testa datu ievietošanai datubāzē.
 * Tas izveido administratora lietotāju, recepšu kategorijas, lietotājus,
 * piemēra receptes, komentārus un vērtējumus.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Izpilda datubāzes aizpildīšanu ar sākotnējiem datiem.
     */
    public function run(): void
    {
        /**
         * Tiek izveidots administratora lietotājs ar fiksētiem datiem.
         */
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        /**
         * Tiek izveidotas pamata recepšu kategorijas.
         */
        $categories = collect(['Zupas', 'Pamatēdieni', 'Deserti', 'Uzkodas', 'Dzērieni'])
            ->map(function ($name) {
                return Category::create(['name' => $name]);
            });

        /**
         * Tiek izveidoti papildu lietotāji, lai sistēmā būtu vairāki recepšu autori.
         */
        User::factory(4)->create();

        /**
         * Tiek iegūti visi izveidotie lietotāji, lai tos varētu piesaistīt receptēm,
         * komentāriem un vērtējumiem.
         */
        $users = User::all();

        /**
         * Manuāli definētas piemēra receptes ar pilnu aprakstu, sastāvdaļām,
         * pagatavošanas instrukcijām un piesaistīto kategoriju.
         */
        $exampleRecipes = [
            [
                'title' => 'Kartupeļu pankūkas',
                'description' => 'Tradicionālās latviešu kartupeļu pankūkas ar skābo krējumu. Vienkārša un garda recepte visai ģimenei!',
                'ingredients' => "1 kg kartupeļu\n2 olas\n2 sīpoli\n3 ēd.k. kviešu milti\nSāls un pipari pēc garšas\nAugu eļļa cepšanai\n200g skābais krējums pasniegšanai",
                'instructions' => "1. Nomizo un sarīvē kartupeļus, nospiež lieko šķidrumu.\n2. Nomizo un smalki sarīvē sīpolus.\n3. Lielā bļodā sajauc kartupeļus, sīpolus, olas, miltus, sāli un piparus.\n4. Uzkarsē pannu ar eļļu un ar karoti liek kartupeļu masu, izveido pankūkas.\n5. Cep uz vidējas uguns 3–4 minūtes no katras puses līdz zeltaini brūnas.\n6. Pasniedz ar skābo krējumu un zaļumiem.",
                'category' => 'Pamatēdieni',
            ],
            [
                'title' => 'Rabarberu krēma kūka',
                'description' => 'Garda rabarberu kūka ar krēma pildījumu un kraukšķīgo virskārtu. Ideāla svētku galdam vai ikdienas našķim.',
                'ingredients' => "Mīklai:\n200g sviesta (istabas temperatūrā)\n150g cukura\n1 ola\n300g kviešu miltu\n1 tējk. cepamā pulvera\nŠķipsniņa sāls\n\nPildījumam:\n500g rabarberu\n100g cukura\n2 ēd.k. kartupeļu cietes\n200ml saldā krējuma\n2 ēd.k. vaniļas cukura",
                'instructions' => "1. Mīklai sajauc sviestu ar cukuru, pievieno olu un samaisa.\n2. Pievieno miltus ar cepamo pulveri un sāli, samīca viendabīgu mīklu.\n3. 2/3 mīklas izklāj cepamajā formā, pārējo mīklu noliec ledusskapī.\n4. Rabarberus notīra, sagriež gabaliņos un sajauc ar cukuru un kartupeļu cieti.\n5. Rabarberu maisījumu izklāj uz mīklas pamatnes.\n6. Pārējo mīklu sarīvē vai sadrupina pa virsu.\n7. Cep 180°C krāsnī 40–45 minūtes līdz zeltaini brūna.\n8. Atdzesē un pasniedz ar putukrējumu vai vaniļas saldējumu.",
                'category' => 'Deserti',
            ],
            [
                'title' => 'Tradicionālā biešu aukstā zupa',
                'description' => 'Atsvaidzinoša vasaras biešu zupa ar gurķiem, olām un dillēm. Iecienīts vasaras ēdiens karstām dienām.',
                'ingredients' => "500g vārītas bietes\n2 gurķi\n3 cieti vārītas olas\n100g redīsu\n3 loki\nSauja diļļu\n1l kefīra\n200ml skābā krējuma\nSāls pēc garšas\nCitrona sula pēc garšas",
                'instructions' => "1. Vārītās bietes nomizo un sarīvē vai sagriež mazos kubiņos.\n2. Gurķus un redīsus sagriež mazos kubiņos.\n3. Olas nomizo un sagriež mazos gabaliņos.\n4. Lokus un dilles smalki sagriež.\n5. Lielā traukā sajauc bietes, gurķus, redīsus un zaļumus.\n6. Pievieno kefīru un skābo krējumu, samaisa.\n7. Pēc garšas pievieno sāli un citrona sulu.\n8. Zupu atdzesē ledusskapī vismaz 1 stundu.\n9. Pasniedz ar vārītiem kartupeļiem un papildu skābo krējumu.",
                'category' => 'Zupas',
            ],
        ];

        /**
         * Katra manuāli definētā recepte tiek saglabāta datubāzē
         * un piesaistīta atbilstošajai kategorijai un lietotājam.
         */
        foreach ($exampleRecipes as $recipeData) {
            $category = $categories->firstWhere('name', $recipeData['category']);

            Recipe::create([
                'title' => $recipeData['title'],
                'description' => $recipeData['description'],
                'ingredients' => $recipeData['ingredients'],
                'instructions' => $recipeData['instructions'],
                'category_id' => $category->id,
                'user_id' => $users->first()->id,
                'created_at' => now()->subHours(rand(1, 48)),
                'updated_at' => now(),
            ]);
        }

        /**
         * Papildus tiek ģenerētas receptes ar factory palīdzību.
         * Katrai receptei tiek piešķirta nejauša kategorija un autors.
         */
        Recipe::factory(12)->create()->each(function ($recipe) use ($users, $categories) {
            $recipe->update([
                'category_id' => $categories->random()->id,
                'user_id' => $users->random()->id,
            ]);

            /**
             * Katrai receptei tiek izveidoti 1 līdz 3 komentāri.
             */
            Comment::factory(rand(1, 3))->create([
                'recipe_id' => $recipe->id,
                'user_id' => $users->random()->id,
            ]);

            /**
             * Katrai receptei tiek izveidots viens vērtējums.
             */
            Rating::create([
                'recipe_id' => $recipe->id,
                'user_id' => $users->random()->id,
                'rating' => rand(3, 5),
            ]);
        });
    }
}