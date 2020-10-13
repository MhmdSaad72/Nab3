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

Route::group(['middleware' => ['auth']], function () {
  Route::get('/', 'HomeController@index')->name('home');
  Route::resource('admin/company', 'Admin\\CompanyController');
  Route::patch('admin/company/approved/{id}' , 'Admin\\CompanyController@approved')->name('company.approved');
  Route::resource('admin/country', 'Admin\\CountryController');
  Route::resource('admin/category', 'Admin\\CategoryController');
  Route::resource('admin/degree', 'Admin\\DegreeController');
  Route::get('admin/contacts' , 'Admin\\ContactController@index')->name('contact.index');
  Route::get('admin/contact/{id}' , 'Admin\\ContactController@show')->name('contact.show');
  Route::delete('admin/contact/{id}' , 'Admin\\ContactController@destroy')->name('contact.destroy');
  Route::get('admin/mistakes' , 'Admin\\MistakeReportController@index')->name('mistake.index');
  Route::patch('admin/mistakes/approved/{id}' , 'Admin\\MistakeReportController@approved')->name('mistake.approved');
  // Route::delete('admin/mistake/{id}' , 'Admin\\MistakeReportController@destroy')->name('mistake.destroy');
  Route::get('admin/mistake/{id}' , 'Admin\\MistakeReportController@show')->name('mistake.show');
  Route::patch('admin/mistake/cancel/{id}' , 'Admin\\MistakeReportController@cancel')->name('mistake.cancel');
});

Auth::routes();
