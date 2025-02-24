<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", function () {
    return view("home");
})->name('homepage');

Route::get("/Mylogin", function () {
    return view("Mylogin");
})->name('Mylogin');

Route::get("/Myregister", function () {
    return view("Myregister");
})->name('Myregister');

require DIR.'/auth.php';