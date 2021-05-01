<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/', 'Backend\DashboardController@index')->name('dashboard');
/* All Authenticated routes here */
Auth::routes();
Route::group(array('middleware' => 'auth'), function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/all-user', 'Backend\UsersController@getIndex')->name('logged_in.user.view');
        Route::get('/create', 'Backend\UsersController@getCreate')->name('admin.user.create');
        Route::post('/store', 'Backend\UsersController@postStore')->name('logged_in.user.store');
        Route::get('/edit/{id}', 'Backend\UsersController@getEdit')->name('logged_in.user.edit');
        Route::post('/update/{id}', 'Backend\UsersController@postUpdate')->name('logged_in.user.update');
        Route::post('/delete/{id}', 'Backend\UsersController@postDelete')->name('logged_in.user.delete');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/view', 'Backend\ProfileController@getIndex')->name('logged_in.user.profile.view');
        Route::get('/edit/{id}', 'Backend\ProfileController@getEdit')->name('logged_in.user.profile.edit');
        Route::post('/update/{id}', 'Backend\ProfileController@postUpdate')->name('logged_in.user.profile.update');
        Route::get('/password/view', 'Backend\ProfileController@getPasswordView')->name('logged_in.user.profile.password_view');
        Route::post('/password/update', 'Backend\ProfileController@postPasswordUpdate')->name('logged_in.user.profile.password_update');
    });
    Route::group(['prefix' => 'suppliers'], function () {
        Route::get('/view', 'Backend\SuppliersController@getIndex')->name('admin.suppliers.view');
        Route::get('/create', 'Backend\SuppliersController@getCreate')->name('admin.supplier.create');
        Route::post('/store', 'Backend\SuppliersController@postStore')->name('admin.supplier.store');
        Route::get('/edit/{id}', 'Backend\SuppliersController@getEdit')->name('admin.supplier.edit');
        Route::post('/update/{id}', 'Backend\SuppliersController@postUpdate')->name('admin.supplier.update');
        Route::post('/delete/{id}', 'Backend\SuppliersController@postDelete')->name('admin.supplier.delete');
    });
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/view', 'Backend\CustomersController@getIndex')->name('admin.customers.view');
        Route::get('/create', 'Backend\CustomersController@getCreate')->name('admin.customers.create');
        Route::post('/store', 'Backend\CustomersController@postStore')->name('admin.customers.store');
        Route::get('/edit/{id}', 'Backend\CustomersController@getEdit')->name('admin.customers.edit');
        Route::post('/update/{id}', 'Backend\CustomersController@postUpdate')->name('admin.customers.update');
        Route::post('/delete/{id}', 'Backend\CustomersController@postDelete')->name('admin.customers.delete');
    });
});
Route::group(['prefix' => 'units'], function () {
    Route::get('/view', 'Backend\UnitsController@getIndex')->name('admin.units.view');
    Route::get('/create', 'Backend\UnitsController@getCreate')->name('admin.units.create');
    Route::post('/store', 'Backend\UnitsController@postStore')->name('admin.units.store');
    Route::get('/edit/{id}', 'Backend\UnitsController@getEdit')->name('admin.units.edit');
    Route::post('/update/{id}', 'Backend\UnitsController@postUpdate')->name('admin.units.update');
    Route::post('/delete/{id}', 'Backend\UnitsController@postDelete')->name('admin.units.delete');
});
Route::group(['prefix' => 'products'], function () {
    Route::get('/index', 'Backend\ProductsController@getIndex')->name('admin.products.view');
    Route::get('/create', 'Backend\ProductsController@getCreate')->name('admin.products.create');
    Route::post('/store', 'Backend\ProductsController@postStore')->name('admin.products.store');
    Route::get('/edit/{id}', 'Backend\ProductsController@getEdit')->name('admin.products.edit');
    Route::post('/update/{id}', 'Backend\ProductsController@postUpdate')->name('admin.products.update');
    Route::post('/delete/{id}', 'Backend\ProductsController@postDelete')->name('admin.products.delete');
});
Route::group(['prefix' => 'category'], function () {
    Route::get('/view', 'Backend\CategoryController@getIndex')->name('admin.category.view');
    Route::get('/create', 'Backend\CategoryController@getCreate')->name('admin.category.create');
    Route::post('/store', 'Backend\CategoryController@postStore')->name('admin.category.store');
    Route::get('/edit/{id}', 'Backend\CategoryController@getEdit')->name('admin.category.edit');
    Route::post('/update/{id}', 'Backend\CategoryController@postUpdate')->name('admin.category.update');
    Route::post('/delete/{id}', 'Backend\CategoryController@postDelete')->name('admin.category.delete');
});
Route::group(['prefix' => 'inventory'], function () {
    Route::get('/index', 'Backend\PurchaseController@getIndex')->name('admin.purchase.view');
    Route::get('/create', 'Backend\PurchaseController@getCreate')->name('admin.purchase.create');
    Route::post('/store', 'Backend\PurchaseController@postStore')->name('admin.purchase.store');
    Route::get('/pending', 'Backend\PurchaseController@pendingList')->name('purchase.pending.list');
    Route::post('/approve/{id}', 'Backend\PurchaseController@purchaseApprove')->name('purchase.approve');
    Route::post('/delete/{id}', 'Backend\PurchaseController@postDelete')->name('admin.purchase.delete');
});
Route::group(['prefix' => 'invoice'], function () {
    Route::get('/list', 'Backend\InvoiceController@getIndex')->name('invoice.view');
    Route::get('/create', 'Backend\InvoiceController@getCreate')->name('invoice.create');
    Route::post('/store', 'Backend\InvoiceController@postStore')->name('invoice.store');
    Route::get('/pending', 'Backend\InvoiceController@pendingList')->name('invoice.pending.list');
    Route::get('/approve/{id}', 'Backend\InvoiceController@approve')->name('invoice.approve');
    Route::post('/approve/store/{id}', 'Backend\InvoiceController@appprovalStore')->name('approval.store');
    Route::post('/delete/{id}', 'Backend\InvoiceController@postDelete')->name('invoice.delete');
    Route::get('/print', 'Backend\InvoiceController@invoicePrintList')->name('invoice.print.list');
    Route::get('/print/{id}', 'Backend\InvoiceController@invoicePrint')->name('invoice.print');
    Route::get('/view/{id}', 'Backend\InvoiceController@invoiceWeb')->name('invoice.web');
    Route::get('/date-wise/search', 'Backend\InvoiceController@dailyInvoiceSearch')->name('invoice.daily.search');
    Route::get('/date-wise/search/list', 'Backend\InvoiceController@dailyInvoiceReport')->name('invoice.daily.report');
});
Route::group(['prefix' => 'stock'], function () {
    Route::get('/report', 'Backend\StockController@stockReport')->name('stock.report');
    Route::get('/report/pdf', 'Backend\StockController@stockReportPdf')->name('stock.report.pdf');
    Route::get('/select/supplier', 'Backend\StockController@stockSupplierWise')->name('select.supplier');
    Route::get('/report/supplier/wise', 'Backend\StockController@stockReportSupplierWise')->name('report.supplier.wise');
    Route::get('/supplier/wise/print', 'Backend\StockController@supplierWiseStockPrint')->name('supplier.wise.stock.print');
});
//DefaultController for Ajax
Route::get('/get-supplier', 'Backend\DefaultController@getSupplier')->name('get-supplier');
Route::get('/category-for-invoice', 'Backend\DefaultController@categoryForInvoice')->name('category-for-invoice');
Route::get('/get-product', 'Backend\DefaultController@getProduct')->name('get-product');
Route::get('/get-unit', 'Backend\DefaultController@getUnits')->name('get-unit');
Route::get('/check-product-stock', 'Backend\DefaultController@getStock')->name('check-product-stock');
Route::get('/product-unit-price', 'Backend\DefaultController@get_unit_price')->name('product-unit-price');
Route::get('/unit-selling-price', 'Backend\DefaultController@unit_selling_price')->name('unit-selling-price');
Route::get('/get-product-by-id', 'Backend\DefaultController@getProductById')->name('get-product-by-id');
//to clear all cache
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });
