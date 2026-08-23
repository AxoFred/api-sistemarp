<?php

use Illuminate\Support\Facades\Route;

Route::get('../routes/web.php', function () {
    return view('welcome');
});
