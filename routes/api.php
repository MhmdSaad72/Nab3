<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// companies
Route::post('/companies' , 'API\\CompanyController@allCompanies');
Route::post('/company' , 'API\\CompanyController@company');
Route::post('/company/create' , 'API\\CompanyController@createCompany');
Route::post('/companies/search' , 'API\\CompanyController@search');
Route::post('/companies/latest-search' , 'API\\CompanyController@latestSearch');
Route::post('/companies/advanced-search' , 'API\\CompanyController@advanced_search');
Route::post('/companies/featured' , 'API\\CompanyController@featuredCompanies');

// contact us
Route::post('/contact-us' , 'API\\ContactController@contact_us');

//mistake reports
Route::post('/mistake-report' , 'API\\MistakeReportController@mistake_report');

// countries
Route::post('/countries' , 'API\\CountryController@allCountries');

// categories
Route::post('categories' , 'API\\CategoryController@allCategories');
