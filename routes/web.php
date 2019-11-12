<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front End Website Routes
//
Route::get('/', function () {
   return view('welcome');
});

// Backend Application Routes
//

// Authentication
//
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// Activity Logs
//
Route::post('activity/contact', 'Activity\ActivityLogController@log_contact_activity')->name('activity.contact');

// Company
//
Route::resource('companies', 'Company\CompanyController');

// Contacts
//
Route::name('contacts.')->group(function() {
    Route::namespace('Contacts')->group(function() {
        Route::post('contacts/assign',        'ContactController@assign')->name('assign');
        Route::post('contacts/search',        'ContactController@search')->name('search');
        Route::get('contacts',                'ContactController@index')->name('index');
        Route::get('contacts/create',         'ContactController@create')->name('create')->middleware('tenant', 'roles:9');
        Route::post('contacts',               'ContactController@store')->name('store')->middleware('tenant', 'roles:9');
        Route::get('contacts/{contact}',      'ContactController@show')->name('show')->middleware('tenant', 'roles:11');
        Route::get('contacts/{contact}/edit', 'ContactController@edit')->name('edit')->middleware('tenant', 'roles:12');
        Route::put('contacts/{contact}',      'ContactController@update')->name('update')->middleware('tenant', 'roles:12');
        Route::delete('contacts/{contact}',   'ContactController@destroy')->name('destroy')->middleware('tenant', 'roles:14');
        Route::get('mycontacts',              'ContactController@mycontacts')->name('mycontacts');
        Route::post('filtercontacts',         'ContactController@filtercontacts')->name('filtercontacts');
        Route::get('leads',                   'ContactController@leads')->name('leads')->middleware('tenant', 'roles:11');
        Route::get('opportunities',           'ContactController@opportunities')->name('opportunities')->middleware('tenant', 'roles:11');
        Route::get('customers',               'ContactController@customers')->name('customers')->middleware('tenant', 'roles:11');
        Route::get('archived_contacts',       'ContactController@archived_contacts')->name('archived')->middleware('tenant', 'roles:14');
    });
});

// Dashboard
//
Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

// Notes
//
Route::resource('notes', 'Notes\NotesController');

// Notifications
//
Route::resource('notifications', 'Notifications\NotificationController');
Route::post('notifications/find_users', 'Notifications\NotificationController@find_users')->name('notifications.find_users');
Route::post('notifications/send/{notification_type}', 'Notifications\NotificationController@send')->name('notifications.send');

// Users
//
Route::name('users.')->group(function() {
    Route::namespace('Users')->group(function() {
        Route::get('users/current_user',    'UserController@current_user')->name('current_user');
        Route::post('users/search',         'UserController@search')->name('search')->middleware('tenant', 'roles:18');
        Route::get('users',                 'UserController@index')->name('index')->middleware('tenant', 'roles:18');
        Route::get('users/create',          'UserController@create')->name('create')->middleware('tenant', 'roles:16');
        Route::post('users',                'UserController@store')->name('store')->middleware('tenant', 'roles:16');
        Route::get('users/{user}',          'UserController@show')->name('show')->middleware('tenant', 'roles:18');
        Route::get('users/{user}/edit',     'UserController@edit')->name('edit')->middleware('tenant', 'roles:19');
        Route::put('users/{user}',          'UserController@update')->name('update')->middleware('tenant', 'roles:19');
        Route::delete('users/{user}',       'UserController@destroy')->name('destroy')->middleware('tenant', 'roles:21');
        Route::get('users/{user}/profile/', 'UserController@profile')->name('profile');
        Route::get('users/{user}/settings', 'UserController@settings')->name('settings');
    });
});
