<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Comment;

/**
 * Seederis recepšu testa datu izveidei.
 *
 * Šis seederis nodrošina, ka datubāzē ir nepieciešamās kategorijas
 * un lietotāji, kā arī izveido vairākas piemēra receptes ar komentāriem.
 */
class RecipeSeeder extends Seeder
{
    /**
     * Izpilda recepšu, kategoriju, lietotāju un komentāru sākotnējo izveidi.
     */
    public function run(): void
    {
        /**
         * Tiek pārbaudīts, vai datubāzē jau eksistē kategorijas.
         * Ja kategoriju nav, tiek izveidotas noklusējuma kategorijas.
         */
        if (Category::count() === 0) {
            $categories = collect(['Zupas', 'Pamatēdieni', 'Deserti', 'Uzkodas', 'Dzērieni'])
                ->map(function ($name) {
                    return Category::create(['name' => $name]);
                });
        } else {
            $categories = Category::all();
        }

        /**
         * Tiek pārbaudīts, vai datubāzē jau eksistē lietotāji.
         * Ja lietotāju nav, tiek izveidots administrators un papildu lietotāji.
         */
        if (User::count() === 0) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'is_admin' => true,
            ]);

            User::factory(3)->create();
        }

        /**
         * Tiek iegūti visi lietotāji, lai tos varētu piesaistīt receptēm
         * un komentāriem kā autorus.
         */
        $users = User::all();

        /**
         * Masīvā tiek definētas piemēra receptes, kas tiks saglabātas datubāzē.
         * Daļai recepšu ir norādītas arī sastāvdaļas un pagatavošanas instrukcijas.
         */
        $exampleRecipes = [
            [
                'title' => 'Kartupeļu pankūkas',
                'description' => 'Tradicionālās latviešu kartupeļu pankūkas ar skābo krējumu. Vienkārša un garda recepte visai ģimenei!',
                'ingredients' => "1 kg kartupeļu\n2 olas\n2 sīpoli\n3 ēd.k. kviešu milti\nSāls un pipari pēc garšas\nAugu eļļa cepšanai\n200g skābais krējums pasniegšanai",
                'instructions' => "1. Nomizo un sarīvē kartupeļus, nospiež lieko šķidrumu.\n2. Nomizo un smalki sarīvē sīpolus.\n3. Lielā bļodā sajauc kartupeļus, sīpolus, olas, miltus, sāli un piparus.\n4. Uzkarsē pannu ar eļļu un ar karoti liek kartupeļu masu, izveido pankūkas.\n5. Cep uz vidējas uguns 3–4 minūtes no katras puses līdz zeltaini brūnas.\n6. Pasniedz ar skābo krējumu un zaļumiem.",
                'category_name' => 'Pamatēdieni',
                'created_at' => now()->subDays(1),
            ],
            [
                'title' => 'Rabarberu krēma kūka',
                'description' => 'Garda rabarberu kūka ar krēma pildījumu un kraukšķīgo virskārtu. Ideāla svētku galdam vai ikdienas našķim.',
                'ingredients' => "Mīklai:\n200g sviesta (istabas temperatūrā)\n150g cukura\n1 ola\n300g kviešu miltu\n1 tējk. cepamā pulvera\nŠķipsniņa sāls\n\nPildījumam:\n500g rabarberu\n100g cukura\n2 ēd.k. kartupeļu cietes\n200ml saldā krējuma\n2 ēd.k. vaniļas cukura",
                'instructions' => "1. Mīklai sajauc sviestu ar cukuru, pievieno olu un samaisa.\n2. Pievieno miltus ar cepamo pulveri un sāli, samīca viendabīgu mīklu.\n3. 2/3 mīklas izklāj cepamajā formā, pārējo mīklu noliec ledusskapī.\n4. Rabarberus notīra, sagriež gabaliņos un sajauc ar cukuru un kartupeļu cieti.\n5. Rabarberu maisījumu izklāj uz mīklas pamatnes.\n6. Pārējo mīklu sarīvē vai sadrupina pa virsu.\n7. Cep 180°C krāsnī 40–45 minūtes līdz zeltaini brūna.\n8. Atdzesē un pasniedz ar putukrējumu vai vaniļas saldējumu.",
                'category_name' => 'Deserti',
                'created_at' => now()->subDays(2),
            ],
            [
                'title' => 'Tradicionālā biešu aukstā zupa',
                'description' => 'Atsvaidzinoša vasaras biešu zupa ar gurķiem, olām un dillēm. Iecienīts vasaras ēdiens karstām dienām.',
                'ingredients' => "500g vārītas bietes\n2 gurķi\n3 cieti vārītas olas\n100g redīsu\n3 loki\nSauja diļļu\n1l kefīra\n200ml skābā krējuma\nSāls pēc garšas\nCitrona sula pēc garšas",
                'instructions' => "1. Vārītās bietes nomizo un sarīvē vai sagriež mazos kubiņos.\n2. Gurķus un redīsus sagriež mazos kubiņos.\n3. Olas nomizo un sagriež mazos gabaliņos.\n4. Lokus un dilles smalki sagriež.\n5. Lielā traukā sajauc bietes, gurķus, redīsus un zaļumus.\n6. Pievieno kefīru un skābo krējumu, samaisa.\n7. Pēc garšas pievieno sāli un citrona sulu.\n8. Zupu atdzesē ledusskapī vismaz 1 stundu.\n9. Pasniedz ar vārītiem kartupeļiem un papildu skābo krējumu.",
                'category_name' => 'Zupas',
                'created_at' => now()->subDays(3),
            ],
            [
                'title' => 'Cēzara salāti',
                'description' => 'Klasiskie Cēzara salāti ar vistas fileju, Parmezāna sieru un grauzdiņiem. Vienkārši pagatavojami, bet eleganti.',
                'category_name' => 'Uzkodas',
                'created_at' => now()->subDays(4),
            ],
            [
                'title' => 'Mājas limonāde',
                'description' => 'Atsvaidzinoša mājas limonāde ar citroniem, liepziediem un medu.',
                'category_name' => 'Dzērieni',
                'created_at' => now()->subHours(12),
            ],
            [
                'title' => 'Jāņu siers',
                'description' => 'Tradicionāla latviešu Jāņu siera recepte ar ķimenēm un sviestu.',
                'category_name' => 'Uzkodas',
                'created_at' => now()->subHours(6),
            ],
        ];

        /**
         * Katra definētā recepte tiek apstrādāta atsevišķi.
         * Receptei tiek atrasta kategorija, izvēlēts nejaušs autors
         * un pēc tam recepte tiek saglabāta datubāzē.
         */
        foreach ($exampleRecipes as $recipeData) {
            $category = $categories->firstWhere('name', $recipeData['category_name']);

            /**
             * Ja norādītā kategorija netiek atrasta, recepte tiek piesaistīta
             * pirmajai pieejamajai kategorijai, lai izvairītos no kļūdas.
             */
            if (!$category) {
                $category = $categories->first();
            }

            /**
             * Receptei tiek izvēlēts nejaušs lietotājs, kurš būs receptes autors.
             */
            $user = $users->random();

            /**
             * Tiek sagatavoti galvenie receptes dati, kas nepieciešami ieraksta
             * izveidei recepšu tabulā.
             */
            $recipeAttrs = [
                'title' => $recipeData['title'],
                'description' => $recipeData['description'],
                'user_id' => $user->id,
                'category_id' => $category->id,
                'created_at' => $recipeData['created_at'],
                'updated_at' => $recipeData['created_at'],
            ];

            /**
             * Ja receptei ir norādītas sastāvdaļas un pagatavošanas instrukcijas,
             * tās tiek pievienotas saglabājamajiem receptes datiem.
             */
            if (isset($recipeData['ingredients']) && isset($recipeData['instructions'])) {
                $recipeAttrs['ingredients'] = $recipeData['ingredients'];
                $recipeAttrs['instructions'] = $recipeData['instructions'];
            }

            /**
             * Recepte tiek izveidota datubāzē, izmantojot iepriekš sagatavotos datus.
             */
            $recipe = Recipe::create($recipeAttrs);

            /**
             * Katrai receptei tiek pievienots viens komentārs.
             * Komentāra autors tiek izvēlēts no lietotājiem, kas nav receptes autors.
             */
            Comment::create([
                'body' => 'Ļoti garšīga recepte! Noteikti izmēģināšu.',
                'user_id' => $users->where('id', '!=', $user->id)->random()->id,
                'recipe_id' => $recipe->id,
                'created_at' => $recipeData['created_at']->copy()->addHours(random_int(1, 8)),
                'updated_at' => $recipeData['created_at']->copy()->addHours(random_int(1, 8)),
            ]);
        }
    }
}