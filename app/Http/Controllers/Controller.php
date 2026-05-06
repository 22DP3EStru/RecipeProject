<?php

/**
 * Controller klase ir galvenā bāzes klase visiem sistēmas kontrolieriem.
 *
 * Šī klase nodrošina kopīgu funkcionalitāti, kuru var izmantot citi
 * kontrolieri recepšu tīmekļa vietnē.
 *
 * Klase atbild par:
 * - autorizācijas funkcionalitātes pieejamību;
 * - validācijas funkcionalitātes pieejamību;
 * - kopīgas Laravel kontrolieru struktūras nodrošināšanu.
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Tiek pievienotas Laravel nodrošinātās autorizācijas
     * un validācijas iespējas.
     *
     * AuthorizesRequests ļauj pārbaudīt lietotāja tiesības,
     * savukārt ValidatesRequests nodrošina pieprasījumu datu validāciju.
     */
    use AuthorizesRequests, ValidatesRequests;
}