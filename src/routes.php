<?php

Route::group(["prefix" => "exists-email", 'namespace' => 'Megaads\RealEmail\Controllers'], function () {

    Route::get('/', function () {
        return "Welcome! Plugin check an email is exists";
    });

    Route::get("/unsubscribe-fake-email", "EmailController@unsubscribeFakeEmail");
});
