<?php

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
    Route::get('quote', 'QuoteController@getQuote');
});