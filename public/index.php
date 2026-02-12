<?php // PHP atvēršanas tags (front controller fails: public/index.php)

use Illuminate\Foundation\Application; // Importē Laravel Application klasi (tipam/IDE palīdzībai)
use Illuminate\Http\Request; // Importē HTTP Request klasi (lai noķertu ienākošo pieprasījumu)

define('LARAVEL_START', microtime(true)); // Definē starta timestamp (profilēšanai/diagnostikai)

 // Determine if the application is in maintenance mode... // Pārbauda, vai aplikācija ir maintenance režīmā
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) { // Ja eksistē maintenance fails (un saglabā ceļu mainīgajā)
    require $maintenance; // Ielādē maintenance skriptu (parasti parāda "down for maintenance" atbildi)
} // Aizver maintenance pārbaudi

// Register the Composer autoloader... // Ielādē Composer autoloader, lai strādātu klases/autoload
require __DIR__.'/../vendor/autoload.php'; // Iekļauj vendor/autoload.php (Composer)

 // Bootstrap Laravel and handle the request... // Inicializē Laravel un apstrādā HTTP pieprasījumu
/** @var Application $app */ // PHPDoc anotācija: $app ir Application instance (IDE/typehint)
$app = require_once __DIR__.'/../bootstrap/app.php'; // Ielādē bootstrap/app.php un iegūst $app instance

$app->handleRequest(Request::capture()); // Noķer pašreizējo HTTP pieprasījumu un nodod Laravel apstrādei


