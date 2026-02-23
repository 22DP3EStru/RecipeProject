<?php // PHP atvēršanas tags

namespace Database\Seeders; // Namespace seederiem (Laravel standarts)

use Illuminate\Database\Seeder; // Seeder bāzes klase
use App\Models\User; // User modelis
use App\Models\Recipe; // Recipe modelis
use App\Models\Category; // Category modelis
use App\Models\Comment; // Comment modelis

class RecipeSeeder extends Seeder // Seederis recepšu datu ģenerēšanai
{
    public function run(): void // Seeder izpildes metode
    {
        // Make sure we have categories // Pārliecināmies, ka eksistē kategorijas
        if (Category::count() === 0) { // Ja DB nav nevienas kategorijas
            $categories = collect(['Zupas', 'Pamatēdieni', 'Deserti', 'Uzkodas', 'Dzērieni']) // Izlabots UTF-8 (Pamatēdieni, Dzērieni)
                ->map(function ($name) { // Katram nosaukumam izveido kategoriju
                    return Category::create(['name' => $name]); // Izveido ierakstu DB un atgriež modeli
                }); // Aizver map()
        } else { // Ja kategorijas jau ir
            $categories = Category::all(); // Ielādē visas kategorijas
        } // Aizver if/else kategorijām

        // Make sure we have users // Pārliecināmies, ka eksistē lietotāji
        if (User::count() === 0) { // Ja DB nav neviena lietotāja
            User::factory()->create([ // Izveido adminu ar fiksētām vērtībām
                'name' => 'Admin', // Admin vārds
                'email' => 'admin@example.com', // Admin e-pasts
                'is_admin' => true, // Admin atzīme (pieņemot, ka kolonna eksistē)
            ]); // Aizver create()

            User::factory(3)->create(); // Izveido vēl 3 lietotājus (kopā 4)
        } // Aizver if lietotājiem

        $users = User::all(); // Ielādē visus lietotājus kolekcijā

        // Create example recipes // Definē piemēra receptes
        $exampleRecipes = [ // Masīvs ar recepšu datiem
            [ // 1. recepte
                'title' => 'Kartupeļu pankūkas', // Izlabota diakritika
                'description' => 'Tradicionālās latviešu kartupeļu pankūkas ar skābo krējumu. Vienkārša un garda recepte visai ģimenei!', // Izlabota diakritika
                'ingredients' => "1 kg kartupeļu\n2 olas\n2 sīpoli\n3 ēd.k. kviešu milti\nSāls un pipari pēc garšas\nAugu eļļa cepšanai\n200g skābais krējums pasniegšanai", // Izlabota diakritika
                'instructions' => "1. Nomizo un sarīvē kartupeļus, nospiež lieko šķidrumu.\n2. Nomizo un smalki sarīvē sīpolus.\n3. Lielā bļodā sajauc kartupeļus, sīpolus, olas, miltus, sāli un piparus.\n4. Uzkarsē pannu ar eļļu un ar karoti liek kartupeļu masu, izveido pankūkas.\n5. Cep uz vidējas uguns 3–4 minūtes no katras puses līdz zeltaini brūnas.\n6. Pasniedz ar skābo krējumu un zaļumiem.", // Izlabota diakritika un domuzīmes
                'category_name' => 'Pamatēdieni', // Izlabota diakritika (jāsakrīt ar kategorijas nosaukumu DB)
                'created_at' => now()->subDays(1), // Izveides laiks (pirms 1 dienas)
            ], // Aizver 1. recepti
            [ // 2. recepte
                'title' => 'Rabarberu krēma kūka', // Izlabota diakritika
                'description' => 'Garda rabarberu kūka ar krēma pildījumu un kraukšķīgo virskārtu. Ideāla svētku galdam vai ikdienas našķim.', // Izlabota diakritika
                'ingredients' => "Mīklai:\n200g sviesta (istabas temperatūrā)\n150g cukura\n1 ola\n300g kviešu miltu\n1 tējk. cepamā pulvera\nŠķipsniņa sāls\n\nPildījumam:\n500g rabarberu\n100g cukura\n2 ēd.k. kartupeļu cietes\n200ml saldā krējuma\n2 ēd.k. vaniļas cukura", // Izlabota diakritika
                'instructions' => "1. Mīklai sajauc sviestu ar cukuru, pievieno olu un samaisa.\n2. Pievieno miltus ar cepamo pulveri un sāli, samīca viendabīgu mīklu.\n3. 2/3 mīklas izklāj cepamajā formā, pārējo mīklu noliec ledusskapī.\n4. Rabarberus notīra, sagriež gabaliņos un sajauc ar cukuru un kartupeļu cieti.\n5. Rabarberu maisījumu izklāj uz mīklas pamatnes.\n6. Pārējo mīklu sarīvē vai sadrupina pa virsu.\n7. Cep 180°C krāsnī 40–45 minūtes līdz zeltaini brūna.\n8. Atdzesē un pasniedz ar putukrējumu vai vaniļas saldējumu.", // “180Ā°C” izlabots uz “180°C”
                'category_name' => 'Deserti', // Kategorija
                'created_at' => now()->subDays(2), // Izveides laiks (pirms 2 dienām)
            ], // Aizver 2. recepti
            [ // 3. recepte
                'title' => 'Tradicionālā biešu aukstā zupa', // Izlabota diakritika
                'description' => 'Atsvaidzinoša vasaras biešu zupa ar gurķiem, olām un dillēm. Iecienīts vasaras ēdiens karstām dienām.', // Izlabota diakritika
                'ingredients' => "500g vārītas bietes\n2 gurķi\n3 cieti vārītas olas\n100g redīsu\n3 loki\nSauja diļļu\n1l kefīra\n200ml skābā krējuma\nSāls pēc garšas\nCitrona sula pēc garšas", // Izlabota diakritika
                'instructions' => "1. Vārītās bietes nomizo un sarīvē vai sagriež mazos kubiņos.\n2. Gurķus un redīsus sagriež mazos kubiņos.\n3. Olas nomizo un sagriež mazos gabaliņos.\n4. Lokus un dilles smalki sagriež.\n5. Lielā traukā sajauc bietes, gurķus, redīsus un zaļumus.\n6. Pievieno kefīru un skābo krējumu, samaisa.\n7. Pēc garšas pievieno sāli un citrona sulu.\n8. Zupu atdzesē ledusskapī vismaz 1 stundu.\n9. Pasniedz ar vārītiem kartupeļiem un papildu skābo krējumu.", // Izlabota diakritika
                'category_name' => 'Zupas', // Kategorija
                'created_at' => now()->subDays(3), // Izveides laiks (pirms 3 dienām)
            ], // Aizver 3. recepti
            [ // 4. recepte (īsa, bez ingredients/instructions)
                'title' => 'Cēzara salāti', // Izlabota diakritika
                'description' => 'Klasiskā Cēzara salāti ar vistas fileju, Parmezāna sieru un grauzdiņiem. Vienkārši pagatavojami, bet eleganti.', // Izlabota diakritika un gramatiski pielabots “Klasiskie”->“Klasiskā” (ja gribi daudzskaitli, var atstāt “Klasiskie”)
                'category_name' => 'Uzkodas', // Kategorija
                'created_at' => now()->subDays(4), // Izveides laiks (pirms 4 dienām)
            ], // Aizver 4. recepti
            [ // 5. recepte (īsa, bez ingredients/instructions)
                'title' => 'Mājas limonāde', // Izlabota diakritika
                'description' => 'Atsvaidzinoša mājas limonāde ar citroniem, liepziediem un medu.', // Izlabota diakritika un typo “liepziedieem”->“liepziediem”
                'category_name' => 'Dzērieni', // Izlabota diakritika
                'created_at' => now()->subHours(12), // Izveides laiks (pirms 12h)
            ], // Aizver 5. recepti
            [ // 6. recepte (īsa, bez ingredients/instructions)
                'title' => 'Jāņu siers', // Izlabota diakritika
                'description' => 'Tradicionāla latviešu Jāņu siera recepte ar ķimenēm un sviestu.', // Izlabota diakritika
                'category_name' => 'Uzkodas', // Kategorija
                'created_at' => now()->subHours(6), // Izveides laiks (pirms 6h)
            ], // Aizver 6. recepti
        ]; // Aizver $exampleRecipes

        foreach ($exampleRecipes as $recipeData) { // Iziet cauri katrai receptei
            $category = $categories->firstWhere('name', $recipeData['category_name']); // Atrod kategoriju pēc nosaukuma

            if (!$category) { // Ja kategorija netika atrasta (drošības fallback)
                $category = $categories->first(); // Paņem pirmo pieejamo kategoriju
            } // Aizver fallback

            $user = $users->random(); // Izvēlas random autoru

            $recipeAttrs = [ // Sagatavo laukus Recipe::create()
                'title' => $recipeData['title'], // Nosaukums
                'description' => $recipeData['description'], // Apraksts
                'user_id' => $user->id, // Autora ID
                'category_id' => $category->id, // Kategorijas ID
                'created_at' => $recipeData['created_at'], // Izveides laiks
                'updated_at' => $recipeData['created_at'], // Update laiks (vienāds ar izveides laiku)
            ]; // Aizver $recipeAttrs masīvu

            if (isset($recipeData['ingredients']) && isset($recipeData['instructions'])) { // Ja ir pilnā recepte
                $recipeAttrs['ingredients'] = $recipeData['ingredients']; // Pievieno sastāvdaļas
                $recipeAttrs['instructions'] = $recipeData['instructions']; // Pievieno instrukcijas
            } // Aizver if pilnajiem laukiem

            $recipe = Recipe::create($recipeAttrs); // Izveido recepti DB

            // Add a comment to each recipe // Pievieno 1 komentāru katrai receptei
            Comment::create([ // Izveido komentāru
                'body' => 'Ļoti garšīga recepte! Noteikti izmēģināšu.', // Izlabota diakritika
                'user_id' => $users->where('id', '!=', $user->id)->random()->id, // Izvēlas citu lietotāju (ne autoru), lai komentētu
                'recipe_id' => $recipe->id, // Piesaista komentāru receptei
                'created_at' => $recipeData['created_at']->copy()->addHours(random_int(1, 8)), // Izveides laiks pēc receptes izveides; copy(), lai nemutē original created_at
                'updated_at' => $recipeData['created_at']->copy()->addHours(random_int(1, 8)), // Updated time konsekventi
            ]); // Aizver Comment::create()
        } // Aizver foreach
    } // Aizver run()
} // Aizver klasi
