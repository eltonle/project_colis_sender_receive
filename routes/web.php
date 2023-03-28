<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DropdownController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\ReceiveController;
use App\Http\Controllers\Backend\StateController;

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
    Route::post('api/fetch-states',[DropdownController::class,'fetchStates'])->name('');
    Route::post('api/fetch-cities',[DropdownController::class,'fetchCity'])->name('cities.index');
    Route::post('api/fetch-states_r',[DropdownController::class,'fetchStates_r'])->name('states.index_r');
    Route::post('api/fetch-cities_r',[DropdownController::class,'fetchCity_r'])->name('cities.index_r');

    // route ajax country
    Route::get('/get-states',[DropdownController::class,'getStates'])->name('get-states');
    Route::get('/get-states-receive',[DropdownController::class,'getStatesReceive'])->name('get-states-receive');


    
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
        Route::post('/store_clientExp',[CustomerController::class,'storeExp'])->name('customers.storeExp');
        Route::post('/store_clientDex',[CustomerController::class,'storeDex'])->name('customers.storeDex');
        Route::get('/edit_client/{id}',[CustomerController::class,'edit'])->name('customers.edit');
        Route::post('/update_client/{id}',[CustomerController::class,'update'])->name('customers.update');
        Route::delete('/delete_client/{id}',[CustomerController::class,'delete'])->name('customers.delete');
        // Route::get('/credit/client',[CustomerController::class,'creditCustomer'])->name('customers.credit');
        Route::get('/credit/client/pdf',[CustomerController::class,'creditCustomerPdf'])->name('customers.credit.pdf');
        Route::get('/facture/edit/{invoice_id}',[CustomerController::class,'editInvoice'])->name('customers.edit.invoice');
        // Route::post('facturer/update/{invoice_id}',[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
        Route::post('facturer/update',[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
        Route::get('facturer/details/pdf/{invoice_id}',[CustomerController::class,'invoiceDetailsPdf'])->name('invoices.details.pdf');
       
        // Route::get('/payement/client',[CustomerController::class,'paidCustomer'])->name('customers.paid');
        // Show modal
        Route::get('/showpayement/client/{invoice_id}',[CustomerController::class,'paidCustomerModal'])->name('customers.paid_modal');
        Route::get('/payement/client/pdf',[CustomerController::class,'paidCustomerPdf'])->name('customers.paid.pdf');
        Route::get('/rapport/client/',[CustomerController::class,'customerWiseReport'])->name('customers.wise.report');
        Route::get('/rapport/client/credit/rapport',[CustomerController::class,'customerWiseCredit'])->name('customers.wise.credit.report');
        Route::get('/rapport/client/payement/rapport',[CustomerController::class,'customerWisePaid'])->name('customers.wise.paid.report');
       
    });
    Route::prefix('finances')->group(function(){
       
        Route::get('/credit/client',[CustomerController::class,'creditCustomer'])->name('finances.credit');
         Route::get('/payement/client',[CustomerController::class,'paidCustomer'])->name('finances.paid');
        // Route::get('/credit/client/pdf',[CustomerController::class,'creditCustomerPdf'])->name('customers.credit.pdf');
        // Route::get('/facture/edit/{invoice_id}',[CustomerController::class,'editInvoice'])->name('customers.edit.invoice');
        // Route::post('facturer/update/{invoice_id}',[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
        // Route::post('facturer/update',[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
        // Route::get('facturer/details/pdf/{invoice_id}',[CustomerController::class,'invoiceDetailsPdf'])->name('invoices.details.pdf');
       
        // Route::get('/payement/client',[CustomerController::class,'paidCustomer'])->name('customers.paid');
        // Show modal
        // Route::get('/showpayement/client/{invoice_id}',[CustomerController::class,'paidCustomerModal'])->name('customers.paid_modal');
        // Route::get('/payement/client/pdf',[CustomerController::class,'paidCustomerPdf'])->name('customers.paid.pdf');
        // Route::get('/rapport/client/',[CustomerController::class,'customerWiseReport'])->name('customers.wise.report');
        // Route::get('/rapport/client/credit/rapport',[CustomerController::class,'customerWiseCredit'])->name('customers.wise.credit.report');
        // Route::get('/rapport/client/payement/rapport',[CustomerController::class,'customerWisePaid'])->name('customers.wise.paid.report');
       
    });

  
    Route::prefix('invoices')->group(function(){
        Route::put('/modifier_status/{id}',[InvoiceController::class,'updateStatus'])->name('invoices.updateStatus');
        Route::get('/ajouter_une_expedition',[InvoiceController::class,'create'])->name('invoices.create');
        Route::post('/store_facture',[InvoiceController::class,'store'])->name('invoices.store');

        Route::post('/update_facture/{id}',[InvoiceController::class,'storeUpdate'])->name('invoices.storeUpdate');
        Route::post('/update_facture1/{id}',[InvoiceController::class,'storeUpdate1'])->name('invoices.storeUpdate1');

        Route::get('/voir_les_expeditions',[InvoiceController::class,'pendingList'])->name('invoices.pending.list');
        Route::get('/approve/{id}',[InvoiceController::class,'approve'])->name('invoices.approve');
        
        Route::get('/edit_invoice/{id}',[InvoiceController::class,'edit_invoice'])->name('invoices.edit_invoice');
        Route::post('/update_invoice',[InvoiceController::class,'update_invoice'])->name('invoices.update_invoice');

        Route::delete('/delete/{id}',[InvoiceController::class,'delete'])->name('invoices.delete');
        Route::post('/approve/store/{id}',[InvoiceController::class,'approvalStore'])->name('invoices.approval.store');
        Route::get('/print/facture',[InvoiceController::class,'printInvoiceList'])->name('invoices.print.list');
        Route::get('/print/{id}',[InvoiceController::class,'printInvoice'])->name('invoices.print');
        Route::get('/print__etiquette/{id}',[InvoiceController::class,'printInvoiceEtiquette'])->name('invoices.etiquette');
        Route::get('/rapport/quotidien',[InvoiceController::class,'dailyReport'])->name('invoices.daily.report');
        Route::get('/rapport/quotidien/pdf',[InvoiceController::class,'dailyReportPdf'])->name('invoices.daily.report.pdf');
        
        // Route pour colis DImensionne
        Route::post('/colis_dimensions',[InvoiceController::class,'colisDimStore'])->name('colisDim.store');
        Route::get('/getdata/colis_dimensions',[InvoiceController::class,'geteDataColisDim'])->name('getDataDim');
        Route::post('/delet/{id}',[InvoiceController::class,'deleteDataColisDim']);

        // Route pour colis Prix
        Route::post('/colis_prix',[InvoiceController::class, 'colisPrixStore'])->name('colisPrix.store');
        // Route::get('/getdata/colis_prix',[InvoiceController::class, 'getDataColisPrix'])->name('getDataPrix');
        // Route::post('/deletPrix/{id}',[InvoiceController::class,'deleteDataColisPrix']);

        //Route colis Standard
        Route::post('/colis_standard',[InvoiceController::class, 'colisStandardStore'])->name('colisStand.store');
        Route::get('/colis_standard',[InvoiceController::class, 'getDatacolisStandard'])->name('getDataStand');
        Route::get('/storeStand/{id}',[InvoiceController::class,'colisStandColisDim']);
         
        // Route pour la somme 
        Route::get('/get_somme',[InvoiceController::class,'getSomme'])->name('sommeTotal');
    });
    Route::prefix('countries')->group(function(){
        Route::get('/Listes_des_pays',[CountryController::class,'index'])->name('countries.index');
        Route::get('/ajouter_pays',[CountryController::class,'create'])->name('countries.create');
        Route::post('/store_country',[CountryController::class,'store'])->name('countries.store');
        Route::get('/edit_country/{id}',[CountryController::class,'edit'])->name('countries.edit');
        Route::post('/update_country/{id}',[CountryController::class,'update'])->name('countries.update');
        Route::delete('/delete_country/{id}',[CountryController::class,'delete'])->name('countries.delete');

    });
    Route::prefix('states')->group(function(){
        Route::get('/Listes_des_viles',[StateController::class,'index'])->name('states.index');
        Route::get('/ajouter_ville',[StateController::class,'create'])->name('states.create');
        Route::post('/store_state',[StateController::class,'store'])->name('states.store');
        Route::get('/edit_state/{id}',[StateController::class,'edit'])->name('states.edit');
        Route::post('/update_state/{id}',[StateController::class,'update'])->name('states.update');
        Route::delete('/delete_state/{id}',[StateController::class,'delete'])->name('states.delete');

    });
}) ;