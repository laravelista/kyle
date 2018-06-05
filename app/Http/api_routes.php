<?php

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {

    Route::post('categories', 'CategoryController@store');

    Route::post('clients', 'ClientController@store');

    Route::get('occurrences/{occurrence}/offer', 'OccurrenceController@toggleOffer');
    Route::get('occurrences/{occurrence}/payment', 'OccurrenceController@togglePayment');
    Route::get('occurrences/{occurrence}/receipt', 'OccurrenceController@toggleReceipt');
});