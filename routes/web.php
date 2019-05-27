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

Auth::routes();

// Company
//
Route::resource('companies', 'Company\CompanyController');

// Contacts
//
Route::resource('contacts',     'Contacts\ContactController');
Route::get('leads',             'Contacts\ContactController@leads')->name('contacts.leads');
Route::get('opportunities',     'Contacts\ContactController@opportunities')->name('contacts.opportunities');
Route::get('customers',         'Contacts\ContactController@customers')->name('contacts.customers');
Route::get('archived_contacts', 'Contacts\ContactController@archived_contacts')->name('contacts.archived');
Route::post('contacts/assign',  'Contacts\ContactController@assign')->name('contacts.assign');
Route::post('contacts/search',  'Contacts\ContactController@search')->name('contacts.search');

// Dashboard
//
Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

// Users
//
Route::resource('users', 'Users\UserController');
Route::get('users/{user}/profile/', 'Users\UserController@profile')->name('users.profile');
Route::get('users/{user}/settings', 'Users\UserController@settings')->name('users.settings');
Route::post('users/search',  'Users\UserController@search')->name('users.search');

// Testing React
Route::get('home', 'HomeController@index');
