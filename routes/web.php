<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DropdownController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\ReceiveController;

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

Route::get('/', function () {
    return view('welcome');
});
 
Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/chart/payementgraph', [App\Http\Controllers\HomeController::class, 'chartjs'])->name('charts');

    // Route::get('dropdown',[DropdownController::class,'index'])->name('countries.index');
    Route::post('api/fetch-states',[DropdownController::class,'fetchStates'])->name('states.index');
    Route::post('api/fetch-cities',[DropdownController::class,'fetchCity'])->name('cities.index');
    Route::post('api/fetch-states_r',[DropdownController::class,'fetchStates_r'])->name('states.index_r');
    Route::post('api/fetch-cities_r',[DropdownController::class,'fetchCity_r'])->name('cities.index_r');

    Route::prefix('clients')->group(function(){
        Route::get('/Listes_clients',[ClientController::class,'index'])->name('clients.index');
        Route::get('/add_client',[ClientController::class,'create'])->name('clients.create');
        Route::post('/store_client',[ClientController::class,'store'])->name('clients.store');
        Route::get('/show_client/{id}',[ClientController::class,'show'])->name('clients.show');
        Route::get('/edit_client/{id}',[ClientController::class,'edit'])->name('clients.edit');
        Route::post('/update_client/{id}',[ClientController::class,'update'])->name('clients.update');
        Route::delete('/delete_client/{id}',[ClientController::class,'delete'])->name('clients.delete');
        Route::get('/print/list',[ClientController::class,'printList'])->name('clients.printList');
        Route::get('/print/client/{id}',[ClientController::class,'printIn'])->name('clients.print');

    });
    Route::prefix('units')->group(function(){
        Route::get('/Listes-units',[UnitController::class,'index'])->name('units.index');
        Route::get('/add_unit',[UnitController::class,'create'])->name('units.create');
        Route::post('/store_unit',[UnitController::class,'store'])->name('units.store');
        Route::get('/edit_unit/{id}',[UnitController::class,'edit'])->name('units.edit');
        Route::post('/update_unit/{id}',[UnitController::class,'update'])->name('units.update');
        Route::delete('/delete_unit/{id}',[UnitController::class,'delete'])->name('units.delete');

    });
 
    Route::prefix('customers')->group(function(){
        Route::get('/Listes-clients',[CustomerController::class,'index'])->name('customers.index');
        Route::get('/add_client',[CustomerController::class,'create'])->name('customers.create');
        Route::post('/store_client',[CustomerController::class,'store'])->name('customers.store');
        Route::get('/edit_client/{id}',[CustomerController::class,'edit'])->name('customers.edit');
        Route::post('/update_client/{id}',[CustomerController::class,'update'])->name('customers.update');
        Route::delete('/delete_client/{id}',[CustomerController::class,'delete'])->name('customers.delete');
        Route::get('/credit/client',[CustomerController::class,'creditCustomer'])->name('customers.credit');
        Route::get('/credit/client/pdf',[CustomerController::class,'creditCustomerPdf'])->name('customers.credit.pdf');
        Route::get('/facture/edit/{invoice_id}',[CustomerController::class,'editInvoice'])->name('customers.edit.invoice');
        Route::post('facturer/update/{invoice_id}',[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
        Route::get('facturer/details/pdf/{invoice_id}',[CustomerController::class,'invoiceDetailsPdf'])->name('invoices.details.pdf');
       
        Route::get('/payement/client',[CustomerController::class,'paidCustomer'])->name('customers.paid');
        Route::get('/payement/client/pdf',[CustomerController::class,'paidCustomerPdf'])->name('customers.paid.pdf');
        Route::get('/rapport/client/',[CustomerController::class,'customerWiseReport'])->name('customers.wise.report');
        Route::get('/rapport/client/credit/rapport',[CustomerController::class,'customerWiseCredit'])->name('customers.wise.credit.report');
        Route::get('/rapport/client/payement/rapport',[CustomerController::class,'customerWisePaid'])->name('customers.wise.paid.report');
       
    });

    Route::prefix('receives')->group(function(){
        Route::get('/Listes-des-recepteurs',[ReceiveController::class,'index'])->name('receives.index');
        Route::get('/ajouter-un-recepteur',[ReceiveController::class,'create'])->name('receives.create');
        Route::post('/store-recepteur',[ReceiveController::class,'store'])->name('receives.store');
        Route::get('/edit-recepteur/{id}',[ReceiveController::class,'edit'])->name('receives.edit');
        Route::post('/update_recepteur/{id}',[ReceiveController::class,'update'])->name('receives.update');
        Route::delete('/delete_recepteur/{id}',[ReceiveController::class,'delete'])->name('receives.delete');
    });
    Route::prefix('invoices')->group(function(){
        Route::get('/voir_facture',[InvoiceController::class,'index'])->name('invoices.index');
        Route::get('/add_facture',[InvoiceController::class,'create'])->name('invoices.create');
        Route::post('/store_facture',[InvoiceController::class,'store'])->name('invoices.store');
        Route::get('/en_attente',[InvoiceController::class,'pendingList'])->name('invoices.pending.list');
        Route::get('/approve/{id}',[InvoiceController::class,'approve'])->name('invoices.approve');
        Route::delete('/delete/{id}',[InvoiceController::class,'delete'])->name('invoices.delete');
        Route::post('/approve/store/{id}',[InvoiceController::class,'approvalStore'])->name('invoices.approval.store');
        Route::get('/print/facture',[InvoiceController::class,'printInvoiceList'])->name('invoices.print.list');
        Route::get('/print/{id}',[InvoiceController::class,'printInvoice'])->name('invoices.print');
        Route::get('/rapport/quotidien',[InvoiceController::class,'dailyReport'])->name('invoices.daily.report');
        Route::get('/rapport/quotidien/pdf',[InvoiceController::class,'dailyReportPdf'])->name('invoices.daily.report.pdf');
        
        
    });
    Route::prefix('categories')->group(function(){
        Route::get('/Listes-categories',[CategoryController::class,'index'])->name('categories.index');
        Route::get('/add_category',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/store_category',[CategorytController::class,'store'])->name('categories.store');
        Route::get('/edit_category/{id}',[CategoryController::class,'edit'])->name('categories.edit');
        Route::post('/update_category/{id}',[CategoryController::class,'update'])->name('categories.update');
        Route::delete('/delete_category/{id}',[CategoryController::class,'delete'])->name('categories.delete');

    });
    Route::prefix('articles')->group(function(){
        Route::get('/Listes-articles',[ArticleController::class,'index'])->name('articles.index');
        Route::get('/add_article',[ArticleController::class,'create'])->name('articles.create');
        Route::post('/store_article',[ArticletController::class,'store'])->name('articles.store');
        Route::get('/edit_article/{id}',[ArticleController::class,'edit'])->name('articles.edit');
        Route::post('/update_article/{id}',[ArticleController::class,'update'])->name('articles.update');
        Route::delete('/delete_article/{id}',[ArticleController::class,'delete'])->name('articles.delete');

    });

}) ;