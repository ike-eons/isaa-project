<?php

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        // Route::get('/', function () {
        //     return view('admin.dashboard.index');
        // })->name('admin.dashboard.index');
        Route::get('/dashboard','Admin\DashboardController@index')->name('admin.dashboard.index');

        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');

        Route::get('/', 'Admin\CustomerController@index')->name('admin.customers.index');

        Route::group(['prefix'  =>   'brands'], function() {

            Route::get('/', 'Admin\BrandController@index')->name('admin.brands.index');
            Route::get('/create', 'Admin\BrandController@create')->name('admin.brands.create');
            Route::post('/store', 'Admin\BrandController@store')->name('admin.brands.store');
            Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brands.edit');
            Route::post('/{id}/update', 'Admin\BrandController@update')->name('admin.brands.update');
            Route::get('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brands.delete');
  
        });

        //categories route

        Route::group(['prefix'  =>   'categories'], function() {

            Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
            Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
            Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
            Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
            Route::post('/{id}/update', 'Admin\CategoryController@update')->name('admin.categories.update');
            Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');
  
        });

        //products routes

        Route::group(['prefix'  =>   'products'], function() {

            Route::get('/', 'Admin\ProductController@index')->name('admin.products.index');
            Route::get('/loadproducts', 'Admin\ProductController@loadproducts');
            Route::get('/create', 'Admin\ProductController@create')->name('admin.products.create');
            Route::post('/store', 'Admin\ProductController@store')->name('admin.products.store');
            Route::get('/{id}/edit', 'Admin\ProductController@edit')->name('admin.products.edit');
            Route::post('/{id}/update', 'Admin\ProductController@update')->name('admin.products.update');
            Route::get('/{id}/delete', 'Admin\ProductController@delete')->name('admin.products.delete');
            Route::get('/search','Admin\ProductController@search')->name('admin.products.search');
            Route::get('/loadproducts','Admin\ProductController@loadproducts');
        });
        
         //categories route

         Route::group(['prefix'  =>   'customers'], function() {

            Route::get('/', 'Admin\CustomerController@index')->name('admin.customers.index');
            Route::get('/create', 'Admin\CustomerController@create')->name('admin.customers.create');
            Route::post('/store', 'Admin\CustomerController@store')->name('admin.customers.store');
            Route::get('/{id}/edit', 'Admin\CustomerController@edit')->name('admin.customers.edit');
            Route::get('/{id}/show', 'Admin\CustomerController@show')->name('admin.customers.show');
            Route::post('/{id}/update', 'Admin\CustomerController@update')->name('admin.customers.update');
            Route::get('/{id}/delete', 'Admin\CustomerController@delete')->name('admin.customers.delete');
            Route::get('/search', 'Admin\CustomerController@search');
            Route::get('/loadcustomers','Admin\CustomerController@loadcustomers');
  
        });

        Route::group(['prefix' => 'distributors'], function(){
            Route::get('/','Admin\DistributorController@index')->name('admin.distributors.index');
            Route::get('/create','Admin\DistributorController@create')->name('admin.distributors.create');
            Route::post('/store', 'Admin\DistributorController@store')->name('admin.distributors.store');
            Route::get('/{id}/edit', 'Admin\DistributorController@edit')->name('admin.distributors.edit');
            Route::get('/{id}/show', 'Admin\DistributorController@show')->name('admin.distributors.show');
            Route::post('/{id}/update', 'Admin\DistributorController@update')->name('admin.distributors.update');
            Route::get('/{id}/delete', 'Admin\DistributorController@delete')->name('admin.distributors.delete');
            Route::get('/loaddistributors','Admin\DistributorController@loaddistributors');
        });

        //stocks
        Route::group(['prefix' => 'stocks'], function(){
            Route::get('/','Admin\StockController@index')->name('admin.stocks.index');
            Route::get('/create','Admin\StockController@create')->name('admin.stocks.create');
            Route::post('/store','Admin\StockController@store')->name('admin.stocks.store');
            Route::get('/{id}/show','Admin\StockController@show')->name('admin.stocks.show');
            Route::get('/loadStock','Admin\InvoiceController@loadStock');
            Route::get('/loadstockform','Admin\StockController@loadStockForm');
            
        });

        //invoice
        Route::group(['prefix'=>'invoices'], function(){
            Route::get('/','Admin\InvoiceController@index')->name('admin.invoices.index');
            Route::get('/create','Admin\InvoiceController@create')->name('admin.invoices.create');
            Route::post('/store','Admin\InvoiceController@store')->name('admin.invoices.store');
            Route::get('/{id}/show','Admin\InvoiceController@show')->name('admin.invoices.show');
            Route::get('/loadInvoice','Admin\InvoiceController@loadInvoice');
            Route::get('/loadinvoiceform','Admin\InvoiceController@loadInvoiceForm');
        });

        //inventory
        Route::group(['prefix'=>'inventories'], function(){
            Route::get('/','Admin\InventoryController@index')->name('admin.inventories.index');
            Route::get('/totalinventory','Admin\InventoryController@currentInventoryTotal')
                    ->name('admin.inventories.totalinventory');
        });

        //Transactions
        Route::group(['prefix'=>'inventory'], function(){
            Route::get('/','Admin\TransactionController@index')->name('admin.transactions.index');
        });

    });
});
