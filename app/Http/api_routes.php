<?php

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
    Route::get('quote', 'QuoteController@getQuote');
    Route::get('occurrences/{occurrence}/offer', 'OccurrenceController@toggleOffer');
    Route::get('occurrences/{occurrence}/payment', 'OccurrenceController@togglePayment');
    Route::get('occurrences/{occurrence}/receipt', 'OccurrenceController@toggleReceipt');
});