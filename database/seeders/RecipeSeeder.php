<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Comment;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure we have categories
        if (Category::count() === 0) {
            $categories = collect(['Zupas', 'PamatÄ“dieni', 'Deserti', 'Uzkodas', 'DzÄ“rieni'])->map(function ($name) {
                return Category::create(['name' => $name]);
            });
        } else {
            $categories = Category::all();
        }

        // Make sure we have users
        if (User::count() === 0) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'is_admin' => true,
            ]);
            
            User::factory(3)->create();
        }
        
        $users = User::all();        // Create example recipes
        $exampleRecipes = [
            [
                'title' => 'KartupeÄ¼u pankÅ«kas',
                'description' => 'TradicionÄlÄs latvieÅu kartupeÄ¼u pankÅ«kas ar skÄbo krÄ“jumu. VienkÄrÅa un garda recepte visai Ä£imenei!',
                'ingredients' => "1 kg kartupeÄ¼u\n2 olas\n2 sÄ«poli\n3 Ä“d.k. kvieÅu milti\nSÄls un pipari pÄ“c garÅas\nAugu eÄ¼Ä¼a cepÅanai\n200g skÄbais krÄ“jums pasniegÅanai",
                'instructions' => "1. Nomizo un sarÄ«vÄ“ kartupeÄ¼us, nospieÅ¾ lieko ÅÄ·idrumu.\n2. Nomizo un smalki sarÄ«vÄ“ sÄ«polus.\n3. LielÄ bÄ¼odÄ sajauc kartupeÄ¼us, sÄ«polus, olas, miltus, sÄli un piparus.\n4. UzkarsÄ“ pannu ar eÄ¼Ä¼u un ar karoti liek kartupeÄ¼u masu, izveido pankÅ«kas.\n5. Cep uz vidÄ“jas uguns 3-4 minÅ«tes no katras puses lÄ«dz zeltaini brÅ«nas.\n6. Pasniedz ar skÄbo krÄ“jumu un zaÄ¼umiem.",
                'category_name' => 'PamatÄ“dieni',
                'created_at' => now()->subDays(1),
            ],
            [
                'title' => 'Rabarberu krÄ“ma kÅ«ka',
                'description' => 'Garda rabarberu kÅ«ka ar krÄ“ma pildÄ«jumu un kraukÅÄ·Ä«go virskÄrtu. IdeÄla svÄ“tku galdam vai ikdienas naÅÄ·im.',
                'ingredients' => "MÄ«klai:\n200g sviesta (istabas temperatÅ«rÄ)\n150g cukura\n1 ola\n300g kvieÅu miltu\n1 tÄ“jk. cepamÄ pulvera\nÅ Ä·ipsniÅ†a sÄls\n\nPildÄ«jumam:\n500g rabarberu\n100g cukura\n2 Ä“d.k. kartupeÄ¼u cietes\n200ml saldÄ krÄ“juma\n2 Ä“d.k. vaniÄ¼as cukura",
                'instructions' => "1. MÄ«klai sajauc sviestu ar cukuru, pievieno olu un samaisa.\n2. Pievieno miltus ar cepamo pulveri un sÄli, samÄ«ca viendabÄ«gu mÄ«klu.\n3. 2/3 mÄ«klas izklÄj cepamajÄ formÄ, pÄrÄ“jo mÄ«klu noliec ledusskapÄ«.\n4. Rabarberus notÄ«ra, sagrieÅ¾ gabaliÅ†os un sajauc ar cukuru un kartupeÄ¼u cieti.\n5. Rabarberu maisÄ«jumu izklÄj uz mÄ«klas pamatnes.\n6. PÄrÄ“jo mÄ«klu sarÄ«vÄ“ vai sadrupina pa virsu.\n7. Cep 180Ā°C krÄsnÄ« 40-45 minÅ«tes lÄ«dz zeltaini brÅ«na.\n8. AtdzesÄ“ un pasniedz ar putukrÄ“jumu vai vaniÄ¼as saldÄ“jumu.",
                'category_name' => 'Deserti',
                'created_at' => now()->subDays(2),
            ],
            [
                'title' => 'TradicionÄlÄ bieÅu aukstÄ zupa',
                'description' => 'AtsvaidzinoÅa vasaras bieÅu zupa ar gurÄ·iem, olÄm un dillÄ“m. IecienÄ«ts vasaras Ä“diens karstÄm dienÄm.',
                'ingredients' => "500g vÄrÄ«tas bietes\n2 gurÄ·i\n3 cieti vÄrÄ«tas olas\n100g redÄ«su\n3 loki\nSauja diÄ¼Ä¼u\n1l kefÄ«ra\n200ml skÄbÄ krÄ“juma\nSÄls pÄ“c garÅas\nCitrona sula pÄ“c garÅas",
                'instructions' => "1. VÄrÄ«tÄs bietes nomizo un sarÄ«vÄ“ vai sagrieÅ¾ mazos kubiÅ†os.\n2. GurÄ·us un redÄ«sus sagrieÅ¾ mazos kubiÅ†os.\n3. Olas nomizo un sagrieÅ¾ mazos gabaliÅ†os.\n4. Lokus un dilles smalki sagrieÅ¾.\n5. LielÄ traukÄ sajauc bietes, gurÄ·us, redÄ«sus un zaÄ¼umus.\n6. Pievieno kefÄ«ru un skÄbo krÄ“jumu, samaisa.\n7. PÄ“c garÅas pievieno sÄli un citrona sulu.\n8. Zupu atdzesÄ“ ledusskapÄ« vismaz 1 stundu.\n9. Pasniedz ar vÄrÄ«tiem kartupeÄ¼iem un papildu skÄbo krÄ“jumu.",
                'category_name' => 'Zupas',
                'created_at' => now()->subDays(3),
            ],
            [
                'title' => 'CÄ“zara salÄti',
                'description' => 'KlasiskÄ CÄ“zara salÄti ar vistas fileju, ParmezÄna sieru un grauzdiÅ†iem. VienkÄrÅi pagatavojami, bet eleganti.',
                'category_name' => 'Uzkodas',
                'created_at' => now()->subDays(4),
            ],
            [
                'title' => 'MÄjas limonÄde',
                'description' => 'AtsvaidzinoÅa mÄjas limonÄde ar citroniem, liepziedieem un medu.',
                'category_name' => 'DzÄ“rieni',
                'created_at' => now()->subHours(12),
            ],
            [
                'title' => 'JÄÅ†u siers',
                'description' => 'TradicionÄla latvieÅu JÄÅ†u siera recepte ar Ä·imenÄ“m un sviestu.',
                'category_name' => 'Uzkodas',
                'created_at' => now()->subHours(6),
            ],
        ];

        foreach ($exampleRecipes as $recipeData) {
            $category = $categories->firstWhere('name', $recipeData['category_name']);
            
            if (!$category) {
                $category = $categories->first();
            }
            
            $user = $users->random();
              $recipeAttrs = [
                'title' => $recipeData['title'],
                'description' => $recipeData['description'],
                'user_id' => $user->id,
                'category_id' => $category->id,
                'created_at' => $recipeData['created_at'],
                'updated_at' => $recipeData['created_at'],
            ];
            
            if (isset($recipeData['ingredients']) && isset($recipeData['instructions'])) {
                $recipeAttrs['ingredients'] = $recipeData['ingredients'];
                $recipeAttrs['instructions'] = $recipeData['instructions'];
            }
            
            $recipe = Recipe::create($recipeAttrs);
            
            // Add a comment to each recipe
            Comment::create([
                'body' => 'Ä»oti garÅÄ«ga recepte! Noteikti izmÄ“Ä£inÄÅu.',
                'user_id' => $users->where('id', '!=', $user->id)->random()->id,
                'recipe_id' => $recipe->id,
                'created_at' => $recipeData['created_at']->addHours(random_int(1, 8)),
            ]);
        }
    }
}

