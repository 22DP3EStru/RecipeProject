<?php // PHP atvēršanas tags; šis fails ir Laravel seederis

namespace Database\Seeders; // Nosaka seederu namespace (Laravel standarts)

use Illuminate\Database\Seeder; // Importē Seeder bāzes klasi
use App\Models\User; // Importē User modeli
use App\Models\Recipe; // Importē Recipe modeli
use App\Models\Category; // Importē Category modeli
use App\Models\Comment; // Importē Comment modeli
use App\Models\Rating; // Importē Rating modeli
use Illuminate\Support\Str; // Importē Str helperi (šeit gan netiek lietots)

class DatabaseSeeder extends Seeder // Galvenais seederis, ko palaiž ar php artisan db:seed
{
    public function run(): void // Seeder izpildes metode
    {
        // Admin user // Izveido admin lietotāju ar fiksētām vērtībām
        User::factory()->create([ // Izmanto User factory, lai izveidotu 1 ierakstu
            'name' => 'Admin', // Admin vārds
            'email' => 'admin@example.com', // Admin e-pasts
            'is_admin' => true, // Admin atzīme (pieņemot, ka kolonna eksistē)
        ]); // Aizver create()

        // Citas kategorijas // Izveido kategoriju sarakstu
        $categories = collect(['Zupas', 'Pamatēdieni', 'Deserti', 'Uzkodas', 'Dzērieni']) // Kategoriju nosaukumi (izlabota UTF-8 latviešu diakritika)
            ->map(function ($name) { // Katram nosaukumam izpilda funkciju
                return Category::create(['name' => $name]); // Izveido kategoriju DB un atgriež modeli
            }); // Aizver map()

        // 4 lietotāji // Papildus adminam izveido vēl 4 lietotājus (kopā būs 5)
        User::factory(4)->create(); // Izveido 4 random lietotājus

        $users = User::all(); // Ielādē visus lietotājus kolekcijā (admin + pārējie)

        // Example recipes with detailed content // Piemēra receptes ar pilniem laukiem
        $exampleRecipes = [ // Masīvs ar recepšu datiem
            [ // 1. recepte
                'title' => 'Kartupeļu pankūkas', // Receptes nosaukums (izlabota diakritika)
                'description' => 'Tradicionālās latviešu kartupeļu pankūkas ar skābo krējumu. Vienkārša un garda recepte visai ģimenei!', // Apraksts (izlabota diakritika)
                'ingredients' => "1 kg kartupeļu\n2 olas\n2 sīpoli\n3 ēd.k. kviešu milti\nSāls un pipari pēc garšas\nAugu eļļa cepšanai\n200g skābais krējums pasniegšanai", // Sastāvdaļas (izlabota diakritika)
                'instructions' => "1. Nomizo un sarīvē kartupeļus, nospiež lieko šķidrumu.\n2. Nomizo un smalki sarīvē sīpolus.\n3. Lielā bļodā sajauc kartupeļus, sīpolus, olas, miltus, sāli un piparus.\n4. Uzkarsē pannu ar eļļu un ar karoti liek kartupeļu masu, izveido pankūkas.\n5. Cep uz vidējas uguns 3–4 minūtes no katras puses līdz zeltaini brūnas.\n6. Pasniedz ar skābo krējumu un zaļumiem.", // Pagatavošana (izlabota diakritika)
                'category' => 'Pamatēdieni', // Kategorijas nosaukums (jāsakrīt ar $categories)
            ], // Aizver 1. receptes masīvu
            [ // 2. recepte
                'title' => 'Rabarberu krēma kūka', // Nosaukums (izlabota diakritika)
                'description' => 'Garda rabarberu kūka ar krēma pildījumu un kraukšķīgo virskārtu. Ideāla svētku galdam vai ikdienas našķim.', // Apraksts (izlabota diakritika)
                'ingredients' => "Mīklai:\n200g sviesta (istabas temperatūrā)\n150g cukura\n1 ola\n300g kviešu miltu\n1 tējk. cepamā pulvera\nŠķipsniņa sāls\n\nPildījumam:\n500g rabarberu\n100g cukura\n2 ēd.k. kartupeļu cietes\n200ml saldā krējuma\n2 ēd.k. vaniļas cukura", // Sastāvdaļas (izlabota diakritika)
                'instructions' => "1. Mīklai sajauc sviestu ar cukuru, pievieno olu un samaisa.\n2. Pievieno miltus ar cepamo pulveri un sāli, samīca viendabīgu mīklu.\n3. 2/3 mīklas izklāj cepamajā formā, pārējo mīklu noliec ledusskapī.\n4. Rabarberus notīra, sagriež gabaliņos un sajauc ar cukuru un kartupeļu cieti.\n5. Rabarberu maisījumu izklāj uz mīklas pamatnes.\n6. Pārējo mīklu sarīvē vai sadrupina pa virsu.\n7. Cep 180°C krāsnī 40–45 minūtes līdz zeltaini brūna.\n8. Atdzesē un pasniedz ar putukrējumu vai vaniļas saldējumu.", // Pagatavošana (izlabota diakritika; arī “180Ā°C” izlabots uz “180°C”)
                'category' => 'Deserti', // Kategorija
            ], // Aizver 2. receptes masīvu
            [ // 3. recepte
                'title' => 'Tradicionālā biešu aukstā zupa', // Nosaukums (izlabota diakritika)
                'description' => 'Atsvaidzinoša vasaras biešu zupa ar gurķiem, olām un dillēm. Iecienīts vasaras ēdiens karstām dienām.', // Apraksts (izlabota diakritika)
                'ingredients' => "500g vārītas bietes\n2 gurķi\n3 cieti vārītas olas\n100g redīsu\n3 loki\nSauja diļļu\n1l kefīra\n200ml skābā krējuma\nSāls pēc garšas\nCitrona sula pēc garšas", // Sastāvdaļas (izlabota diakritika)
                'instructions' => "1. Vārītās bietes nomizo un sarīvē vai sagriež mazos kubiņos.\n2. Gurķus un redīsus sagriež mazos kubiņos.\n3. Olas nomizo un sagriež mazos gabaliņos.\n4. Lokus un dilles smalki sagriež.\n5. Lielā traukā sajauc bietes, gurķus, redīsus un zaļumus.\n6. Pievieno kefīru un skābo krējumu, samaisa.\n7. Pēc garšas pievieno sāli un citrona sulu.\n8. Zupu atdzesē ledusskapī vismaz 1 stundu.\n9. Pasniedz ar vārītiem kartupeļiem un papildu skābo krējumu.", // Pagatavošana (izlabota diakritika)
                'category' => 'Zupas', // Kategorija
            ], // Aizver 3. receptes masīvu
        ]; // Aizver $exampleRecipes masīvu

        foreach ($exampleRecipes as $recipeData) { // Iziet cauri katrai piemēra receptei
            $category = $categories->firstWhere('name', $recipeData['category']); // Atrod kategoriju pēc nosaukuma
            Recipe::create([ // Izveido recepti DB
                'title' => $recipeData['title'], // Saglabā title
                'description' => $recipeData['description'], // Saglabā description
                'ingredients' => $recipeData['ingredients'], // Saglabā ingredients (teksts ar jaunām rindām)
                'instructions' => $recipeData['instructions'], // Saglabā instructions (teksts ar jaunām rindām)
                'category_id' => $category->id, // Piesaista kategoriju (pieņemot, ka atrada)
                'user_id' => $users->first()->id, // Piesaista autoru (pirmais lietotājs kolekcijā; bieži tas būs Admin)
                'created_at' => now()->subHours(rand(1, 48)), // Iestata izveides laiku pēdējo 48h robežās
                'updated_at' => now(), // Iestata update laiku uz “tagad”
            ]); // Aizver Recipe::create()
        } // Aizver foreach

        // Additional recipes // Papildus ģenerē receptes ar factory
        Recipe::factory(12)->create()->each(function ($recipe) use ($users, $categories) { // Izveido 12 receptes un katrai izpilda callback
            $recipe->update([ // Atjaunina tikko izveidoto recepti ar random saistībām
                'category_id' => $categories->random()->id, // Piešķir random kategoriju
                'user_id' => $users->random()->id, // Piešķir random autoru
            ]); // Aizver update()

            // Katrai receptei 1-3 komentāri // Izveido 1 līdz 3 komentārus pie receptes
            Comment::factory(rand(1, 3))->create([ // Izveido vairākus komentārus ar vienādiem FK
                'recipe_id' => $recipe->id, // Piesaista recepti
                'user_id' => $users->random()->id, // Piesaista random komentētāju
            ]); // Aizver Comment::factory()->create()

            // Katrai receptei 1 vērtējums no random user // Izveido vienu vērtējumu
            Rating::create([ // Izveido Rating ierakstu (pieņemot, ka modelis atļauj mass-assignment)
                'recipe_id' => $recipe->id, // Piesaista recepti
                'user_id' => $users->random()->id, // Piesaista random vērtētāju
                'rating' => rand(3, 5), // Uzliek vērtējumu 3..5
            ]); // Aizver Rating::create()
        }); // Aizver each() callback un visa factory ķēde
    } // Aizver run()
} // Aizver klasi
