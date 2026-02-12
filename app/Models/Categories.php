<?php // Sākas PHP kods

namespace App\Models; // Modelis atrodas Models mapē

use Illuminate\Database\Eloquent\Factories\HasFactory; 
// Ļauj izmantot factory (testēšanai / datu ģenerēšanai)

use Illuminate\Database\Eloquent\Model; 
// Pamata Eloquent modelis (darbs ar datubāzi)

class Category extends Model // Category modelis (kategoriju tabula)
{
    use HasFactory; // Iespēja izmantot factory šim modelim

    protected $fillable = ['name', 'slug']; 
    // Šie lauki drīkst tikt masveidā aizpildīti (piem., create() vai update())
    // name = kategorijas nosaukums
    // slug = URL draudzīgais nosaukums

    public function recipes() 
    // Attiecība: viena kategorija var saturēt vairākas receptes
    {
        return $this->hasMany(Recipe::class); 
        // 1 kategorija → daudzas receptes (one-to-many relationship)
    }
}
