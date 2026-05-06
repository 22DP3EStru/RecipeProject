<?php

/**
 * Laravel aplikācijas galvenais sākuma fails (front controller).
 *
 * Šis fails ir pirmais, kas tiek izpildīts pēc HTTP pieprasījuma saņemšanas.
 * Tas inicializē Laravel vidi, ielādē nepieciešamās bibliotēkas,
 * pārbauda uzturēšanas režīmu un nodod pieprasījumu Laravel sistēmai
 * turpmākai apstrādei.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Tiek definēts Laravel aplikācijas palaišanas sākuma laiks.
 * Šī vērtība var tikt izmantota veiktspējas mērīšanai un diagnostikai.
 */
define('LARAVEL_START', microtime(true));

/**
 * Tiek pārbaudīts, vai aplikācija atrodas uzturēšanas režīmā.
 * Ja uzturēšanas fails eksistē, tas tiek ielādēts pirms pārējās aplikācijas palaišanas.
 */
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/**
 * Tiek ielādēts Composer autoloaderis.
 * Tas nodrošina automātisku PHP klašu ielādi no vendor mapes.
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * Tiek inicializēta Laravel aplikācija.
 * Bootstrap fails sagatavo aplikācijas vidi un atgriež Application instanci.
 *
 * @var Application $app
 */
$app = require_once __DIR__.'/../bootstrap/app.php';

/**
 * Tiek iegūts pašreizējais HTTP pieprasījums un nodots Laravel apstrādei.
 * Šajā brīdī sākas maršrutēšana, middleware izpilde un atbildes ģenerēšana.
 */
$app->handleRequest(Request::capture());