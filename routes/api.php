<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/home', function () {
    return require(dirname(__DIR__) . "/resources/sanctuary-project.php");
});
