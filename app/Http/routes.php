<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('layouts.app');
    });

    Route::group(['middleware' => ['web'], 'as' => 'api.', 'prefix' => 'api', 'namespace' => 'Api'], function () {

        //Route::get('getContacts', [
        //    'as' => 'getContacts', 'uses' => 'ContactController@getContacts'
        // ]);

        Route::group(['as' => 'contact.', 'prefix' => 'crm'], function () {

            Route::get('/detail/id/{id}', [
                'as' => 'getContactDetails', 'uses' => 'ContactController@getContactDetails'
            ]);

        });

        Route::get('getContacts', function() {
            return App\Models\Contact::with('billing', 'type')->get();
        });

        Route::get('getContactTypes', function() {
            return App\Models\ContactType::all();
        });

        Route::post('saveContact', [
            'as' => 'saveContact', 'uses' => 'ContactController@saveContact'
        ]);

    });

});