<?php // Norāda, ka šis ir PHP konfigurācijas fails

use Illuminate\Foundation\Application; // Iekļauj Laravel Application klasi
use Illuminate\Foundation\Configuration\Exceptions; // Iekļauj Exceptions konfigurācijas klasi
use Illuminate\Foundation\Configuration\Middleware; // Iekļauj Middleware konfigurācijas klasi

return Application::configure(basePath: dirname(__DIR__)) // Inicializē aplikāciju ar bāzes ceļu (projekta saknes direktoriju)
    ->withRouting( // Konfigurē maršrutēšanu (routing)
        web: __DIR__.'/../routes/web.php', // Norāda web maršrutu faila atrašanās vietu
        api: __DIR__.'/../routes/api.php', // Norāda API maršrutu faila atrašanās vietu
        commands: __DIR__.'/../routes/console.php', // Norāda console (Artisan) komandu maršrutu failu
        health: '/up', // Definē veselības pārbaudes (health check) URL
    )
    ->withMiddleware(function (Middleware $middleware) { // Definē papildu middleware konfigurāciju
        $middleware->alias([ // Izveido middleware aliasus (īsos nosaukumus)
            'admin' => \App\Http\Middleware\AdminMiddleware::class, // Reģistrē 'admin' middleware aliasu
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) { // Definē izņēmumu (exception) apstrādes konfigurāciju
        // // Šeit var pievienot pielāgotu izņēmumu apstrādi
    })->create(); // Izveido un atgriež konfigurēto aplikācijas instanci
