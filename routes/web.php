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


// Главная страница с демо, банерами и т.д.
Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => ['web','auth'], 'prefix' => 'graphics'], function () {

    // Страница создания графика
    Route::get('create', 'GraphicsController@getPageCreater')->name('route_graphics_create');

    // Страница изменения графика
    Route::get('create/{alias}', 'GraphicsController@getPageUpdata')->name('route_graphics_update');

    // Страница графика - отображает график
    Route::get('{alias}', 'GraphicsController@showGraphic')->name('route_graphic_show');

    // Страница со списком графиков
    Route::get('/', 'GraphicsController@index')->name('route_graphics');

});


// Создать роут панели отображения
Route::group(['middleware' => ['web','auth']], function () {

    Route::get('home', 'HomeController@home')->name('route_home');

    Route::get('data', 'TypesDataController@showTypesData')->name('route_data_all');

    Route::get('data/{alias_type}', 'TypesDataController@showAllTypeData')->name('route_data_type');

    Route::get('types/create', 'TypesDataController@getPageCreater')->name('route_types_create');

    Route::get('types/create/{alias}', 'TypesDataController@getPageUpdate')->name('route_types_update');

});

Route::group(['middleware' => ['web','auth'], 'prefix' => 'devices'], function () {

    // Страница создания устройства
    Route::get('create', 'DevicesController@getPageCreater')->name('route_devices_create');

    Route::get('create/{id_device}', 'DevicesController@getPageUpdate')->name('route_devices_update');

//    Route::get('/{alias_devices}', 'DevicesController@showDevice')->name('route_device_show');

    // Страница списка устройств
    Route::get('/', 'DevicesController@index')->name('route_devices');

//    Route::group(['middleware' => ['web','auth'], 'prefix' => '/{id_device}'], function () {

        // Страница создания типа данных
//        Route::get('create', 'TypesDataController@getPageCreater')->name('route_types_create');

        // Страница изменения типа данных
//        Route::get('create/{alias_type}', 'TypesDataController@getPageUpdate')->name('route_types_update');

        // Страница отображающая данные конкретного типа данных
        Route::get('{id_device}/{alias_type}', 'TypesDataController@showTypeData')->name('route_type_data_show');

        // Страница списка типов данных этого устройства
        Route::get('{id_device}', 'TypesDataController@index')->name('route_types');

//    });

});

//
Route::group(['middleware' => ['web','auth'], 'prefix' => 'service'], function () {

    /**
     * delete
     */
    Route::resource('/', 'ServiceController');
    /**
     * services.fires.index
     * services.show
     * services.store
     * route(.services.index.)
     */

    Route::get('/', 'ServiceController@index');

    Route::post('/', 'ServiceController@store')->name('route_service_data');

    Route::put('/', 'ServiceController@update');

    Route::delete('/', 'ServiceController@destroy');

});

Route::namespace('API')->group(function () {

    Route::group(['prefix' => 'api'], function () {

        Route::group(['prefix' => 'data'], function () {

            Route::get('/', 'DataController@index');

            Route::post('/', 'DataController@store')->name('route_api_data');

            Route::put('/', 'DataController@update');

            Route::delete('/', 'DataController@destroy');

        });

    });

});
