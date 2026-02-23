<?php // Norāda, ka šis ir PHP fails

namespace App\View\Components; // Definē nosaukumvietu (namespace), kurā atrodas šis View komponents

use Illuminate\View\Component; // Iekļauj bāzes Component klasi Laravel View komponentiem
use Illuminate\View\View; // Iekļauj View klasi, kas reprezentē Blade skatu

class GuestLayout extends Component // Definē GuestLayout komponenti, kas paplašina Component klasi
{
    /**
     * Get the view / contents that represents the component. // Dokumentācijas komentārs par metodes nozīmi
     */
    public function render(): View // Metode, kas nosaka, kuru Blade skatu atgriezt
    {
        return view('layouts.guest'); // Atgriež Blade skatu no resources/views/layouts/guest.blade.php
    }
}

