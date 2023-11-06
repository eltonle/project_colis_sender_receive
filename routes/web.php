<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\ColisController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DropdownController;
use App\Http\Controllers\Backend\EntrepotController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\VehiculeController;

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
    // ESSAI CHARJS DATA
   Route::get('/home/{year}', [App\Http\Controllers\HomeController::class, 'getDatajs']);


    // Route::get('dropdown',[DropdownController::class,'index'])->name('countries.index');
    Route::post('api/fetch-states',[DropdownController::class,'fetchStates'])->name('');
    Route::post('api/fetch-cities',[DropdownController::class,'fetchCity'])->name('cities.index');
    Route::post('api/fetch-states_r',[DropdownController::class,'fetchStates_r'])->name('states.index_r');
    Route::post('api/fetch-cities_r',[DropdownController::class,'fetchCity_r'])->name('cities.index_r');

    // route ajax country
    Route::get('/get-states',[DropdownController::class,'getStates'])->name('get-states');
    Route::get('/get-states-receive',[DropdownController::class,'getStatesReceive'])->name('get-states-receive');
    
    Route::prefix('vehicule')->group(function(){
        Route::get('/index',[VehiculeController::class,'index'])->name('vehicule.index');
        Route::post('/add_vehicule',[VehiculeController::class,'store'])->name('vehicule.index.store');
        Route::post('index/update_vehicule',[VehiculeController::class,'update_vehicule'])->name('vehicule.update');
        Route::post('/update_affection',[VehiculeController::class,'updateAffectation'])->name('affectation.update');
        Route::delete('/delete_vehicule/{id}',[VehiculeController::class,'delete'])->name('vehicule.delete');
        Route::get('/index_afect',[VehiculeController::class,'index_affectation'])->name('vehicule.affectation');
        Route::post('/add_afect',[VehiculeController::class,'add_affectation'])->name('add_affectation');
        Route::delete('/delete_affection/{id}',[VehiculeController::class,'deleteAffectation'])->name('delete_affection');
        Route::post('/add_chauffeur',[VehiculeController::class,'chauffeur'])->name('vehicule.chauffeur');

        
    });

    Route::prefix('entrepots')->group(function(){
        Route::get('/Listes-entrepots',[EntrepotController::class,'index'])->name('entrepots.index');
        Route::get('/Creer-entrepot',[EntrepotController::class,'create'])->name('entrepots.create');
        Route::post('/store-entrepot',[EntrepotController::class,'store'])->name('entrepots.store');
        Route::post('/update-entrepot/{id}',[EntrepotController::class,'update'])->name('entrepots.update');
        Route::get('/store-entrepot/{id}',[EntrepotController::class,'edit'])->name('entrepots.edit');
        Route::get('/voir_entrepot/{entrepot}',[EntrepotController::class,'showEntrepot'])->name('entrepots.show');
        Route::get('/voir_entrepot_colis_decharge/{entrepot}',[EntrepotController::class,'showEntrepotDecharge'])->name('entrepots.show.decharge');
        Route::delete('/delete-entrepot/{id}',[EntrepotController::class,'delete'])->name('entrepots.delete');
        Route::post('/entrepots/livraison/{id}',[EntrepotController::class,'livraison'])->name('entrepot.livraison');

        Route::get('/entrepots/listes_colis/{entrepot}/pdf',[EntrepotController::class,'entrepotlistesColisPdf'])->name('entrepotListes.pdf');
        Route::get('/entrepots/listes_colis_decharges/{entrepot}/pdf',[EntrepotController::class,'entrepotlistesColisDechargesPdf'])->name('entrepotListesDecharges.pdf');
    });
    
    Route::prefix('conteneurs')->group(function(){
        Route::get('/Listes-conteneurs',[UnitController::class,'index'])->name('units.index');
        Route::get('/ajouter_conteneur',[UnitController::class,'create'])->name('units.create');
        Route::get('/conteneur/{id}/colis',[UnitController::class,'showColiste'])->name('units.showColis');
        Route::get('/chargement_conteneur/{unit}',[UnitController::class,'voirConteneur'])->name('units.show');
        Route::get('/chargement_conteneur_scan/{unit}',[UnitController::class,'voirConteneurScan'])->name('units.showScan');
        Route::get('/chargement',[UnitController::class,'chargementMix'])->name('units.chargementMix');
        Route::post('/chargementSubmit',[UnitController::class,'chargementMixSubmit'])->name('units.chargementMixSubmit');
        Route::get('/dechargement',[UnitController::class,'dechargement'])->name('units.dechargement');
        Route::post('/dechargementSubmit',[UnitController::class,'dechargementSubmit'])->name('units.dechargementSubmit');
        Route::get('/dechargement_conteneur/{id}',[UnitController::class,'voirConteneurDecharge'])->name('units.showDecharge');
        Route::get('/dechargement_conteneur_scan/{id}',[UnitController::class,'voirConteneurDechargeScan'])->name('units.showDechargeScan');
        Route::post('/conteneur/{id}/colis',[UnitController::class,'chargementConteneur'])->name('unitsColis.update');
        Route::post('/conteneur_dechargement/{id}/colis',[UnitController::class,'dechargementConteneur'])->name('unitsColisDecharge.update');

        Route::post('/vehicule-scanner/{id}/colis',[UnitController::class,'chargementScannerConteneur'])->name('unitsColisScanner.update');
        Route::post('/conteneur-scanner-decharge/{id}/colis',[UnitController::class,'dechargementScannerConteneur'])->name('unitsColisScannerDecharge.update');
        // Route::post('/conteneurs/{conteneur}/chargement', [ChargementController::class, 'enregistrerChargement'])->name('conteneurs.chargement');

        // Route::get('/', function () {return view('front.units.chargement');})->name('');
        Route::post('/update-unit-status', [UnitController::class, 'updateUnitStatus'])->name('units.updateUnitStatus'); // a supprime

        Route::post('/vehicules/{id}/colis', [VehiculeController::class, 'ajouterColis'])->name('vehicules.colis.ajouter');

        Route::post('/store_unit',[UnitController::class,'store'])->name('units.store');
        Route::get('/edit_conteneur/{id}',[UnitController::class,'edit'])->name('units.edit');
        Route::post('/update_unit/{id}',[UnitController::class,'update'])->name('units.update');
        Route::delete('/delete_unit/{id}',[UnitController::class,'delete'])->name('units.delete');

        // AJAX changer-statut-conteneur
        // Route::post('/changer-statut-conteneur', [UnitController::class,'changerStatutConteneur'])->name('changer_statut_conteneur');
        // Route::post('/conteneurs/{id}/changerStatut',  [UnitController::class,'changerStatutConteneur'])->name('conteneurs.changerStatut');
        // Route::post('/conteneurs/{id}/modifier-statut', [UnitController::class,'changerStatutConteneur'])->name('conteneurs.modifierStatut');
        Route::post('/conteneurs/{id}/modifier-statut', [UnitController::class,'changerStatutConteneur'])->name('conteneurs.modifierStatut');

        // TELECHARGER FICHIER TEXT CODE-BARE
        Route::post('/upload',[UnitController::class,'uploadFile'])->name('upload.file');

    });

    Route::prefix('colis')->group(function(){
        Route::get('/Listes_des_colis',[ColisController::class,'index'])->name("colis.index");
        Route::get('/Listes_des_colis/livrés',[ColisController::class,'indexLivre'])->name("colis.index.livre");
        Route::get('/Details_colis/{id}',[ColisController::class,'detailsColis'])->name("colis.details");
        Route::get('/print_colis/{id}',[ColisController::class,'printColis'])->name('colis.print');
        // Route::get('/historique-colis/{colis}', [ColisController::class,'historiqueColis'])->name('colis.historique');

        Route::get('/mouvements_colis/{colis_id}', [ColisController::class,'mouvementColis'])->name('colis.mouvements');




        Route::get('/Listes_colis_standard',[ColisController::class,'listeColisStandard'])->name('colis.listes');
        Route::get('/editer_colis_standard/{id}',[ColisController::class,'editerColisStandard'])->name('colis.editStandard');
        Route::get('/editer_colis_standard_voiture/{id}',[ColisController::class,'editerColisStandardVoiture'])->name('colis.editStandardVoiture');
        Route::get('/editer_colis_standard_camion/{id}',[ColisController::class,'editerColisStandardCamion'])->name('colis.editStandardCamion');

        Route::post('/update_colis_standard/{id}',[ColisController::class,'updateColisStandard'])->name('colis.updateStandard');
        Route::post('/update_colis_standardVoiture/{id}',[ColisController::class,'updateColisStandardVoiture'])->name('colis.updateStandardVoiture');
        Route::post('/update_colis_standardCamioon/{id}',[ColisController::class,'updateColisStandardCamion'])->name('colis.updateStandardCamion');

        Route::get('/creer_colis_standard/type_normal',[ColisController::class,'createColisStandard'])->name('colis.createStandard');
        Route::get('/creer_colis_standard/type_voiture',[ColisController::class,'createColisStandardVoiture'])->name('colis.createStandardVoiture');
        Route::get('/creer_colis_standard/type_camion',[ColisController::class,'createColisStandardCamion'])->name('colis.createStandardCamion');
        Route::post('/store_colis_standard',[ColisController::class,'storeColisStandard'])->name('colis.storeStandard'); 
        Route::post('/store_colis_standard_voiture',[ColisController::class,'storeColisStandardVoiture'])->name('colis.storeStandardVoiture');
        Route::post('/store_colis_standard_camion',[ColisController::class,'storeColisStandardCamion'])->name('colis.storeStandardCamion');
        
        Route::delete('/delete_colisStandard/{id}',[ColisController::class,'deleteColisStandard'])->name('colis.deleteStandard');
        

    });
 
    Route::prefix('clients')->group(function(){
        Route::get('/Listes-clients',[CustomerController::class,'index'])->name('customers.index');
        Route::get('/ajouter_client',[CustomerController::class,'create'])->name('customers.create');
        Route::post('/store_client',[CustomerController::class,'store'])->name('customers.store');
        Route::post('/store_clientExp',[CustomerController::class,'storeExp'])->name('customers.storeExp');
        Route::post('/store_clientDex',[CustomerController::class,'storeDex'])->name('customers.storeDex');
        Route::get('/edit_client/{id}',[CustomerController::class,'edit'])->name('customers.edit');
        Route::post('/update_client/{id}',[CustomerController::class,'update'])->name('customers.update');
        Route::delete('/delete_client/{id}',[CustomerController::class,'delete'])->name('customers.delete');
        // Route::get('/credit/client',[CustomerController::class,'creditCustomer'])->name('customers.credit');
        Route::get('/credit/client/pdf',[CustomerController::class,'creditCustomerPdf'])->name('customers.credit.pdf');
        Route::get('/facture/edit/{invoice_id}',[CustomerController::class,'editInvoice'])->name('customers.edit.invoice');
        // Route::post('facture/update/{invoice_id}',[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
        Route::post('facture/update',[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
        Route::get('facture/details/pdf/{invoice_id}',[CustomerController::class,'invoiceDetailsPdf'])->name('invoices.details.pdf');
       
        // Route::get('/payement/client',[CustomerController::class,'paidCustomer'])->name('customers.paid');
        // Show modal
        Route::get('/showpayement/client/{invoice_id}',[CustomerController::class,'paidCustomerModal'])->name('customers.paid_modal');
        Route::get('/payement/client/pdf',[CustomerController::class,'paidCustomerPdf'])->name('customers.paid.pdf');
        // Route::get('/rapport/client/',[CustomerController::class,'customerWiseReport'])->name('customers.wise.report');
        Route::get('/rapport/client/credit/rapport',[CustomerController::class,'customerWiseCredit'])->name('customers.wise.credit.report');
        Route::get('/rapport/client/payement/rapport',[CustomerController::class,'customerWisePaid'])->name('customers.wise.paid.report');
       
    });

    Route::prefix('finances')->group(function(){
       
        Route::get('/credit/client',[CustomerController::class,'creditCustomer'])->name('finances.credit');
         Route::get('/payement/client',[CustomerController::class,'paidCustomer'])->name('finances.paid');
        
        Route::get('/rapport/client/',[CustomerController::class,'customerWiseReport'])->name('finances.wise.report');
        
    });

  
   

    Route::prefix('expeditions')->group(function(){
        Route::put('/modifier_status/{id}',[InvoiceController::class,'updateStatus'])->name('invoices.updateStatus');
        Route::get('/ajouter_une_expedition',[InvoiceController::class,'create'])->name('invoices.create');
        Route::post('/store_facture',[InvoiceController::class,'store'])->name('invoices.store');

        Route::post('/update_facture/{id}',[InvoiceController::class,'storeUpdate'])->name('invoices.storeUpdate');
        Route::post('/update_facture1/{id}',[InvoiceController::class,'storeUpdate1'])->name('invoices.storeUpdate1');

        Route::get('/voir_les_expeditions',[InvoiceController::class,'pendingList'])->name('invoices.pending.list');
        Route::get('/details/{id}',[InvoiceController::class,'approve'])->name('invoices.approve');
        
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
        Route::get('/getdata/colis_dimensions_edit',[InvoiceController::class,'geteDataColisDimEdit'])->name('getDataDimEdit');//AJOUTER
        Route::post('/delet/{id}',[InvoiceController::class,'deleteDataColisDim']);

        //getDataPrix Route pour colis Prix
        Route::post('/colis_prix',[InvoiceController::class, 'colisPrixStore'])->name('colisPrix.store');
        Route::get('/getdata/colis_prix',[InvoiceController::class, 'getDataColisPrix'])->name('getDataPrix');
        // Route::post('/deletPrix/{id}',[InvoiceController::class,'deleteDataColisPrix']);

        //Route ajax colis Standard 
        Route::post('/colis_standard',[InvoiceController::class, 'colisStandardStore'])->name('colisStand.store');
        Route::get('/colis_standard',[InvoiceController::class, 'getDatacolisStandard'])->name('getDataStand');
        Route::get('/storeStand/{id}',[InvoiceController::class,'colisStandColisDim']);
         
        // Route pour la somme 
        Route::get('/get_somme',[InvoiceController::class,'getSomme'])->name('sommeTotal');
        Route::get('/get_somme_edit',[InvoiceController::class,'getSommeEdit'])->name('sommeTotalEdit');
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