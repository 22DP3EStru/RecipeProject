<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", function () {
    return view("home");
})->name('homepage');

Route::get("/MYlogin", function () {
    return view("MYlogin");
})->name('MYlogin');

Route::get("/MYregister", function () {
    return view("MYregister");
})->name('MYregister');

require DIR.'/auth.php';