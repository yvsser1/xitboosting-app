<?php

Route::get('/', 'indexController@index')->name('/');

Route::get('active/{id}', 'indexController@index')->name('active');

Route::post('contact', 'adminInboxController@store')->name('contact');

Route::post('changePassword', 'changePasswordController@update')->name('changePassword');

Route::post('resetMail', 'ResetPasswordController@resetMail')->name('resetMail');

Route::post('paypal', 'PaymentController@payWithpaypal');

Route::get('/p', 'PaymentController@index');

Route::get('/getOrders', 'OrdersController@index');

Route::post('/getPrice', 'getPrice@index')->name('getPrice');

Route::post('/division', 'divisionController@index')->name('division-get');

Route::get('status', 'PaymentController@getPaymentStatus')->name('status');

Route::get('refresh-csrf', function(){
    return csrf_token();
});

// Route::post('new_register', 'Auth\RegisterController@register')->name('new_register');

Auth::routes();
// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');

// // Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');



Route::group(['middleware' => 'admin'], function() {

    //Route::get('/admin', 'adminIndexController@index')->name('admin');

    // Order

    Route::get('/admin', 'adminIndexController@index')->name('admin');

    Route::get('/admin/order/load-data', 'adminIndexController@loadTable')->name('order-load-data');

    Route::get('/admin/order/edit', 'adminIndexController@edit')->name('order-edit');

    Route::post('/admin/order/update', 'adminIndexController@update')->name('order-update');

    Route::post('/admin/order/delete', 'adminIndexController@delete')->name('order-delete');

    // Users

    Route::get('/admin/users', 'adminUsersController@index')->name('users');

    Route::get('/admin/users/load-data', 'adminUsersController@loadTable')->name('users-load-data');

    Route::get('/admin/users/edit', 'adminUsersController@edit')->name('edit');

    Route::post('/admin/users/store', 'adminUsersController@store')->name('store');

    Route::post('/admin/users/update', 'adminUsersController@update')->name('update');

    Route::post('/admin/users/delete', 'adminUsersController@delete')->name('delete');

    // Start Service Components

    // Leagues

    Route::get('/admin/leagues', 'adminLeaguesController@index')->name('leagues');

    Route::get('/admin/leagues/load-data', 'adminLeaguesController@loadTable')->name('leagues-load-data');

    Route::get('/admin/leagues/edit', 'adminLeaguesController@edit')->name('leagues-edit');

    Route::post('/admin/leagues/store', 'adminLeaguesController@store')->name('leagues-store');

    Route::post('/admin/leagues/update', 'adminLeaguesController@update')->name('leagues-update');

    Route::post('/admin/leagues/delete', 'adminLeaguesController@delete')->name('leagues-delete');

    // Divisions

    Route::get('/admin/divisions', 'adminDivisionController@index')->name('divisions');

    Route::get('/admin/divisions/load-data', 'adminDivisionController@loadTable')->name('divisions-load-data');

    Route::get('/admin/divisions/edit', 'adminDivisionController@edit')->name('divisions-edit');

    Route::post('/admin/divisions/store', 'adminDivisionController@store')->name('divisions-store');

    Route::post('/admin/divisions/update', 'adminDivisionController@update')->name('divisions-update');

    Route::post('/admin/divisions/delete', 'adminDivisionController@delete')->name('divisions-delete');

    // Servers

    Route::get('/admin/servers', 'adminServersController@index')->name('servers');

    Route::get('/admin/servers/load-data', 'adminServersController@loadTable')->name('servers-load-data');

    Route::get('/admin/servers/edit', 'adminServersController@edit')->name('servers-edit');

    Route::post('/admin/servers/store', 'adminServersController@store')->name('servers-store');

    Route::post('/admin/servers/update', 'adminServersController@update')->name('servers-update');

    Route::post('/admin/servers/delete', 'adminServersController@delete')->name('servers-delete');

    // Queues

    Route::get('/admin/queues', 'adminQueuesController@index')->name('queues');

    Route::get('/admin/queues/load-data', 'adminQueuesController@loadTable')->name('queues-load-data');

    Route::get('/admin/queues/edit', 'adminQueuesController@edit')->name('queues-edit');

    Route::post('/admin/queues/store', 'adminQueuesController@store')->name('queues-store');

    Route::post('/admin/queues/update', 'adminQueuesController@update')->name('queues-update');

    Route::post('/admin/queues/delete', 'adminQueuesController@delete')->name('queues-delete');

    // Coaching Price

    Route::get('/admin/coaching_price', 'CoachingPriceController@index')->name('coaching_price');

    Route::get('/admin/coaching_price/load-data', 'CoachingPriceController@loadTable')->name('coaching_price-load-data');

    Route::get('/admin/coaching_price/edit', 'CoachingPriceController@edit')->name('coaching_price-edit');

    Route::post('/admin/coaching_price/store', 'CoachingPriceController@store')->name('coaching_price-store');

    Route::post('/admin/coaching_price/update', 'CoachingPriceController@update')->name('coaching_price-update');

    Route::post('/admin/coaching_price/delete', 'CoachingPriceController@delete')->name('coaching_price-delete');

    // Solo Price

    Route::get('/admin/solo_price', 'SoloPriceController@index')->name('solo_price');

    Route::get('/admin/solo_price/load-data', 'SoloPriceController@loadTable')->name('solo_price-load-data');

    Route::get('/admin/solo_price/edit', 'SoloPriceController@edit')->name('solo_price-edit');

    Route::post('/admin/solo_price/store', 'SoloPriceController@store')->name('solo_price-store');

    Route::post('/admin/solo_price/update', 'SoloPriceController@update')->name('solo_price-update');

    Route::post('/admin/solo_price/delete', 'SoloPriceController@delete')->name('solo_price-delete');

    // Duo Price

    Route::get('/admin/duo_price', 'DuoPriceController@index')->name('duo_price');

    Route::get('/admin/duo_price/load-data', 'DuoPriceController@loadTable')->name('duo_price-load-data');

    Route::get('/admin/duo_price/edit', 'DuoPriceController@edit')->name('duo_price-edit');

    Route::post('/admin/duo_price/store', 'DuoPriceController@store')->name('duo_price-store');

    Route::post('/admin/duo_price/update', 'DuoPriceController@update')->name('duo_price-update');

    Route::post('/admin/duo_price/delete', 'DuoPriceController@delete')->name('duo_price-delete');

    // Win Price

    Route::get('/admin/win_price', 'WinPriceController@index')->name('win_price');

    Route::get('/admin/win_price/load-data', 'WinPriceController@loadTable')->name('win_price-load-data');

    Route::get('/admin/win_price/edit', 'WinPriceController@edit')->name('win_price-edit');

    Route::post('/admin/win_price/store', 'WinPriceController@store')->name('win_price-store');

    Route::post('/admin/win_price/update', 'WinPriceController@update')->name('win_price-update');

    Route::post('/admin/win_price/delete', 'WinPriceController@delete')->name('win_price-delete');

    // Regular - Premium Price

    Route::get('/admin/service_price', 'ServicePriceController@index')->name('service_price');

    Route::get('/admin/service_price/load-data', 'ServicePriceController@loadTable')->name('service_price-load-data');

    Route::get('/admin/service_price/edit', 'ServicePriceController@edit')->name('service_price-edit');

    Route::post('/admin/service_price/store', 'ServicePriceController@store')->name('service_price-store');

    Route::post('/admin/service_price/update', 'ServicePriceController@update')->name('service_price-update');

    Route::post('/admin/service_price/delete', 'ServicePriceController@delete')->name('service_price-delete');

    // End Service Components

    // Gallery

    Route::get('/admin/gallery', 'adminGalleryController@index')->name('gallery');

    Route::get('/admin/gallery/load-data', 'adminGalleryController@loadTable')->name('gallery-load-data');

    Route::get('/admin/gallery/edit', 'adminGalleryController@edit')->name('gallery-edit');

    Route::post('/admin/gallery/store', 'adminGalleryController@store')->name('gallery-store');

    Route::post('/admin/gallery/update', 'adminGalleryController@update')->name('gallery-update');

    Route::post('/admin/gallery/delete', 'adminGalleryController@delete')->name('gallery-delete');

    // Faq

    Route::get('/admin/faq', 'adminFaqController@index')->name('faq');

    Route::get('/admin/faq/load-data', 'adminFaqController@loadTable')->name('faq-load-data');

    Route::get('/admin/faq/edit', 'adminFaqController@edit')->name('faq-edit');

    Route::post('/admin/faq/store', 'adminFaqController@store')->name('faq-store');

    Route::post('/admin/faq/update', 'adminFaqController@update')->name('faq-update');

    Route::post('/admin/faq/delete', 'adminFaqController@delete')->name('faq-delete');

    // Inbox

    Route::get('/admin/inbox', 'adminInboxController@index')->name('inbox');

    Route::get('/admin/inbox/load-data', 'adminInboxController@loadTable')->name('inbox-load-data');

    Route::get('/admin/inbox/edit', 'adminInboxController@edit')->name('inbox-edit');

    Route::post('/admin/inbox/delete', 'adminInboxController@delete')->name('inbox-delete');

    // About

    Route::get('/admin/about', 'AboutController@index')->name('about');

    Route::get('/admin/about/load-data', 'AboutController@loadTable')->name('about-load-data');

    Route::post('/admin/about/store', 'AboutController@store')->name('about-store');

    Route::post('/admin/about/update', 'AboutController@update')->name('about-update');

    Route::get('/admin/about/edit', 'AboutController@edit')->name('about-edit');

    Route::post('/admin/about/delete', 'AboutController@delete')->name('about-delete');

});
