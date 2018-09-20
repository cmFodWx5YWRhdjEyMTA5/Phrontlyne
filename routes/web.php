<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::group(['middleware' => ['XSS']], function () {

Route::get('/',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin',  
	 ]);

Route::get('/auth/login',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@getSignin',
	 'as' => '/auth/login',  
	 ]);

Route::get('/login',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@getSignin',
	 'as' => 'login',  
	 ]);

Route::get('/reset-password-notice',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@resetnotice',
	 'as' => 'reset-password-notice', ]);


Route::get('/dashboard',
	['uses' => '\Phrontlyne\Http\Controllers\HomeController@index',
	 'as' => 'dashboard',
	  ]);

Route::get('/business.summary',
	['uses' => '\Phrontlyne\Http\Controllers\HomeController@getTotals',
	 'as' => 'business.summary',
	  ]);

Route::get('/get-insurance-expiry-date',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getEndDate',
	 'as' => 'get-insurance-expiry-date',
	  ]);



Route::get('/reinsurance-arrangement/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@processestreaty_fac',
	 'as' => 'reinsurance-arrangement',
	  ]);

Route::get('password/reset/{token}', '\McPersona\Http\Controllers\PasswordController@getReset');



Route::post('/uploadfiles', 
	['uses' =>'\Phrontlyne\Http\Controllers\ImageController@postUpload',
	'as' => 'upload-files',
 ]);

Route::post('/upload-document', 
	['uses' =>'\Phrontlyne\Http\Controllers\ImageController@postUploadDocuments',
	'as' => 'upload-document',
 ]);

Route::post('/update-user',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@resetPassword',]);


Route::get('/edit-user/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@getUserEdit',
	 'as' => 'edit-user', ]);





//Authentication
Route::get('/signup',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@getSignup',
	 'as' => 'auth.signup', ]);

Route::get('/manage-users',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@getUsers',
	 'as' => 'manage-users', ]);

Route::get('/delete-user',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@deleteUser',
	 'as' => 'delete-user', ]);

Route::post('/signup',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@postSignup',]);

Route::get('/signin',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin', ]);

Route::post('/signin',
	['uses' => '\Phrontlyne\Http\Controllers\AuthController@postSignin',
	
	 ]);

Route::get('auth/logout', '\Phrontlyne\Http\Controllers\AuthController@getSignOut');


Route::get('/signout', function(){
  Auth::logout(); //logout the current user
  Session::flush(); //delete the session
  return Redirect::to('login'); //redirect to login page
});

//Client Registration and Management routes

Route::get('/find-customer', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@getSearchResults', 
	'as' => 'find-customer', ]);

Route::get('/find-customer-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@findToCreatePolicy', 
	'as' => 'find-customer-policy', ]);



Route::get('/print-renewal-bulk', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getBulkRenewals', 
	'as' => 'print-renewal-bulk', ]);


Route::get('/get-whatsapp-bulk', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getWhatsappMessagestoSend', 
	'as' => 'get-whatsapp-bulk', ]);

Route::get('/update-whatsapp-status', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@updateWhatsAppStatus', 
	'as' => 'update-whatsapp-status', ]);


Route::get('/find-renewal', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@findExpiredVehicle', 
	'as' => 'find-renewal', ]);




Route::get('/find-renewal-date', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@findExpiredVehiclebyDate', 
	'as' => 'find-renewal-date', ]);

Route::get('/active-customer',
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@activeCustomer',
	 'as' => 'active-customer', ]);

Route::get('/inactive-customer',
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@inactiveCustomer',
	 'as' => 'inactive-customer', ]);

Route::get('/load-customer-details', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@loadCustomer',
	'as' => 'load-customer-details',]);


Route::get('/customer-profile/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@getProfile',
	'as' => 'customer-profile',]);

Route::post('/create-customer',
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@postNewCustomer',]);

Route::get('/edit-customer', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@editCustomer',
	'as' => 'edit-patient',]);

Route::get('/get-customer', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@getCustomer',
	'as' => 'get-customer',]);

Route::post('/update-customer', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@updateCustomer',
	'as' => 'update-customer',]);

Route::get('/activate-customer', array(
	'uses' => '\Phrontlyne\Http\Controllers\KYCController@activateCustomer',
	'as' => 'activate-customer',
	));

Route::get('/deactivate-customer', array(
	'uses' => '\Phrontlyne\Http\Controllers\KYCController@deactivateCustomer',
	'as' => 'deactivate-customer',
	));

Route::get('/delete-customer', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@deleteCustomer',
	'as' => 'delete-customer',]);


//policy Creation

Route::get('/online-policies',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@index',
	 'as' => 'online-policies', ]);

Route::get('/endorsement-policies',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@endorsePolicy',
	 'as' => 'endorsement-policies', ]);

Route::get('/query-policies',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@queryPolicy',
	 'as' => 'query-policies', ]);


Route::post('/bulk-renew-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@doMotorFleetRenewal',
	'as' => 'bulk-renew-policy',]);



Route::get('/generate-policynumber-new',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@generatePolicyNumber',
	 'as' => 'generate-policynumber-new', ]);


Route::get('/generate-claimnumber-new',
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@generateClaimNumber',
	 'as' => 'generate-claimnumber-new', ]);



Route::get('/generate-endorsement-new',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@generateEndorsementNumber',
	 'as' => 'generate-endorsement-new', ]);


Route::get('/start-policy',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@startnewpolicy',
	 'as' => 'start-policy', ]);

Route::get('/start-claim',
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@startnewclaim',
	 'as' => 'start-claim', ]);


Route::get('/add-property-risk',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addProperty',
	 'as' => 'add-property-risk', ]);

Route::get('/get-fire-property',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getProperty',
	 'as' => 'get-fire-property', ]);

Route::get('/delete-fire-property',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deleteProperty',
	 'as' => 'delete-fire-property', ]);


Route::get('/add-property-risk-item',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addPropertyItem',
	 'as' => 'add-property-risk-item', ]);

Route::get('/get-fire-property-item',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getPropertyItem',
	 'as' => 'get-fire-property-item', ]);

Route::get('/delete-fire-property-item',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deletePropertyItem',
	 'as' => 'delete-fire_property', ]);




Route::get('/add-fire-peril-applied',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addFireLoadings',
	 'as' => 'add-fire-peril-applied', ]);

Route::get('/get-fire-peril-applied',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getFirePeril',
	 'as' => 'get-fire-peril-applied', ]);

Route::get('/delete-fire-peril',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deleteFirePeril',
	 'as' => 'delete-fire-peril', ]);


Route::get('/get-commission-non-motor',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getNonMotorCommission',
	 'as' => 'get-commission-non-motor', ]);


Route::get('/add-bond-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addBondDetails',
	 'as' => 'add-bond-schedule', ]);


Route::get('/get-bond-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getBondSchedule',
	 'as' => 'get-bond-schedule', ]);

Route::get('/add-marine-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addMarineDetails',
	 'as' => 'add-marine-schedule', ]);

Route::get('/get-marine-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getMarineSchedule',
	 'as' => 'get-marine-schedule', ]);

Route::get('/delete-bond-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deleteBondSchedule',
	 'as' => 'delete-bond-schedule', ]);

Route::get('/delete-marine-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deleteMarineSchedule',
	 'as' => 'delete-marine-schedule', ]);

Route::get('/add-engineering-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addEngineeringDetails',
	 'as' => 'add-engineering-schedule', ]);

Route::get('/get-engineering-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getEngineeringSchedule',
	 'as' => 'get-engineering-schedule', ]);

Route::get('/delete-engineering-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deleteEngineeringSchedule',
	 'as' => 'delete-engineering-schedule', ]);


Route::get('/add-accident-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addAccidentDetails',
	 'as' => 'add-accident-schedule', ]);

Route::get('/get-accident-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getAccidentSchedule',
	 'as' => 'get-accident-schedule', ]);

Route::get('/delete-accident-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deleteAccidentSchedule',
	 'as' => 'delete-accident-schedule', ]);


//liability
Route::get('/add-liability-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addLiabilityDetails',
	 'as' => 'add-liability-schedule', ]);

Route::get('/get-liability-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getLiabilitySchedule',
	 'as' => 'get-liability-schedule', ]);

Route::get('/delete-liability-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@deleteLiabilitySchedule',
	 'as' => 'delete-liability-schedule', ]);




Route::get('/add-motor-schedule',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addMotorSchedule',
	 'as' => 'add-motor-schedule', ]);

Route::get('/add-motor-schedule-fleet',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@addMotorScheduleFleet',
	 'as' => 'add-motor-schedule-fleet', ]);


Route::get('/add-non-motor-policy',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@saveNonMotorPolicy',
	 'as' => 'add-non-motor-policy', ]);


Route::get('/bond-test/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@bondtest', 
	'as' => 'bond-test', ]);

Route::get('/bond-custom-template/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@cbtemplates', 
	'as' => 'bond-custom-template', ]);



Route::get('/expired-policies',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@expired',
	 'as' => 'expired-policies', ]);

Route::get('/online-policies/new/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@newpolicywithcustomer',
	 'as' => 'online-policies/new', ]);

// Route::get('/online-policies/new',
// 	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@newpolicy',
// 	 'as' => 'online-policies/new', ]);

Route::get('/find-policy-detail', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getSearchResults', 
	'as' => 'find-policy-detail', ]);

Route::post('/create-policy',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@createPolicy',]);

Route::post('/update-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@updatePolicy',
	'as' => 'update-policy',]);

Route::post('/renew-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@renewPolicy',
	'as' => 'update-policy',]);

Route::get('/compute-motor',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@computeMotorPremium',
	'as' => 'compute-motor', ]);

Route::get('/recompute-motor',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@reComputeMotorPremium',
	'as' => 'recompute-motor', ]);



Route::get('/get-fire-premium',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getFirePremium',
	'as' => 'get-fire-premium', ]);


Route::get('/compute-renewal-premium',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@computeRenewalPremium',
	'as' => 'compute-renewal-premium', ]);

Route::get('/view-policy/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@viewPolicy',
	'as' => 'view-policy',]);

Route::get('/view-policy-main/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@claimViewPolicy',
	'as' => 'view-policy-main',]);

Route::get('/edit-policy/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@editPolicy',
	'as' => 'edit-policy',]);

Route::get('/append-policy/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@appendPolicy',
	'as' => 'append-policy',]);


Route::get('/query-policy/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@doqueryPolicy',
	'as' => 'query-policy',]);


Route::get('/renew-policy/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@Renew',
	'as' => 'renew-policy',]);


Route::get('/print-slip',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@printslip',
	 'as' => '/print-slip', ]);




Route::get('/print-policy/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@printPolicy',
	 'as' => '/print-policy', ]);

Route::get('/print-schedule/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@printSchedules',
	 'as' => '/print-schedule', ]);

Route::get('/print-notice/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@printRenewalNotices',
	 'as' => '/print-notice', ]);

Route::get('/download-schedule/{type}',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@downloadschedule',
	 'as' => '/download-schedule', ]);

Route::get('/delete-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@excludePolicy',
	'as' => 'delete-policy',]);

Route::get('/lock-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@lockPolicy',
	'as' => 'lock-policy',]);

Route::get('/approve-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@approvePolicy',
	'as' => 'approve-policy',]);

Route::get('/suspend-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@suspendPolicy',
	'as' => 'suspend-policy',]);

Route::get('/cancel-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@cancelPolicy',
	'as' => 'cancel-policy',]);


Route::get('/get-vehicle-availability', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getVehicleCount',
	'as' => 'get-vehicle-availability',]);


Route::get('/get-sticker-availability', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@getStickerCount',
	'as' => 'get-sticker-availability',]);



Route::get('/load-ncd-rate', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@loadncd',
	'as' => 'load-ncd-rate',]);

Route::get('/load-risk', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@loadrisk',
	'as' => 'load-risk',]);

Route::get('/load-intermediary', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@loadIntermediary',
	'as' => 'load-intermediary',]);


Route::get('/load-risk-number', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@loadRiskNumber',
	'as' => 'load-risk-number',]);

Route::get('/load-vehicle-model', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@loadvehiclemodels',
	'as' => 'load-vehicle-model',]);

Route::get('/load-insurer', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@loadinsurer',
	'as' => 'load-insurer',]);

Route::get('/load-product', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@loadproduct',
	'as' => 'load-product',]);

Route::post('/add-bond-template', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@saveBondTemplate',
	'as' => 'add-bond-template',]);




//Quotation
Route::get('/online-quotation/new',
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@newquotation',
	 'as' => '/online-quotation/new', ]);

//Motor



//Invoicing
Route::get('/invoice',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getInvoices',
	 'as' => 'invoice', ]);

Route::get('/payment-logs',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getInvoicesProcessed',
	 'as' => 'payment-logs', ]);


Route::get('/invoice-processed',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getProcessedInvoices',
	 'as' => 'invoice-processed', ]);


Route::get('/billing-invoice/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@makePayment',
	 'as' => 'billing-invoice', ]);



Route::get('/find-invoice', 
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@searchInvoice', 
	'as' => 'find-invoice', ]);

Route::get('/get-invoice-info',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@fetchInvoiceDetails',
	 'as' => '/get-invoice-info', ]);

Route::post('/do-payment',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@doPayment',
	 'as' => '/do-payment', ]);

Route::post('/do-proforma',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@createProforma',
	 'as' => '/do-proforma', ]);


Route::get('/print-invoice/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@printInvoice',
	 'as' => '/print-invoice', ]);


Route::get('/print-receipt/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@printReceipt',
	 'as' => '/print-receipt', ]);




Route::get('/print-pro-invoice/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@printProforma',
	 'as' => '/print-pro-invoice', ]);

Route::get('/print-invoice-pdf/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@printtoPDF',
	 'as' => '/print-invoice-pdf', ]);


Route::get('/commission',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getCommissions',
	 'as' => '/commission', ]);


Route::get('/process-commission/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@processCommssion',
	 'as' => '/process-commission', ]);

Route::post('/process-commission-bulk',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@processCommissionBulk',
	 'as' => '/process-commission-bulk', ]);


Route::post('/process-commission-bulk-master',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@processCommissionBulkMaster',
	 'as' => '/process-commission-bulk', ]);


Route::get('/processed-commissions',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getProcessedCommssions',
	 'as' => '/processed-commissions', ]);


Route::get('/commission-advice/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@printCommissionAdvice',
	 'as' => '/commission-advice', ]);



Route::get('/find-commission', 
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@searchCommission', 
	'as' => 'find-commission', ]);

Route::get('/find-receipt', 
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@searchPayment', 
	'as' => 'find-receipt', ]);

//Invoicing
Route::get('/debt-management',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getdebts',
	 'as' => '/debt-management', ]);

//Invoicing
Route::get('/insurer-reporting',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getinsurerreports',
	 'as' => '/insurer-reporting', ]);

Route::get('/payments',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@getpayments',
	 'as' => '/payments', ]);

Route::get('/send-invoice',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@dosendInvoices',
	 'as' => '/send-invoice', ]);

Route::get('/quick-invoices',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@loadProformaInvoices',
	 'as' => '/quick-invoices', ]);

Route::get('/process-commission',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@doCommissionPaid',
	 'as' => '/process-commission', ]);



//Claims

Route::get('/claims',
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@index',
	 'as' => 'claims', ]);


Route::get('/online-claims/new/{id}',
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@createClaim',
	 'as' => 'online-claims/new/{id}', ]);

Route::get('/edit-claim/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@editClaim',
	'as' => 'edit-claim',]);

Route::post('/save-claim',
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@addClaim',
	 'as' => '/save-claim', ]);

Route::get('/update-new-claim',
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@updateClaimDetails',
	 'as' => 'update-new-claim', ]);


Route::get('/add-new-claim',
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@addClaimDetails',
	 'as' => 'add-new-claim', ]);

Route::get('/claim-profile/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@claimprofile',
	'as' => 'claim-profile',]);

Route::post('/update-claim', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@updateClaim',
	'as' => 'update-claim',]);

Route::get('/find-claim', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@getSearchResults', 
	'as' => 'find-claim', ]);

Route::get('/find-claim-policy', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@getSearchResultsPolicy', 
	'as' => 'find-claim-policy', ]);

Route::get('/add-loss-adjustment', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@addAdjustments', 
	'as' => 'add-loss-adjustment', ]);

Route::get('/get-loss-adjustments', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@getAdjustments', 
	'as' => 'get-loss-adjustments', ]);

Route::get('/add-loss-driver', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@addDriver', 
	'as' => 'add-loss-driver', ]);

Route::get('/get-named-drivers', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@getDrivers', 
	'as' => 'get-named-drivers', ]);


Route::get('/add-new-claimant', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@addClaimant', 
	'as' => 'add-new-claimant', ]);


Route::get('/get-claimant', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@getClaimant', 
	'as' => 'get-claimant', ]);


Route::get('/delete-claimant', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@deleteClaimant', 
	'as' => 'delete-claimant', ]);


Route::get('/delete-payment-voucher', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@deletePV', 
	'as' => 'delete-payment-voucher', ]);


Route::post('/add-liability-report', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@saveLiabilityReport', 
	'as' => 'add-liability-report', ]);

Route::post('/add-liability-memo', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@saveLiabilityMemo', 
	'as' => 'add-liability-memo', ]);

Route::get('/discharge-voucher/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@printDischarge', 
	'as' => 'discharge-voucher', ]);

Route::get('/settlement-letter/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@printSettlement', 
	'as' => 'settlement-letter', ]);

Route::get('/settlement-letter/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@printSettlement', 
	'as' => 'settlement-letter', ]);

Route::get('/acknowledgement-letter/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@printAcknowledgement', 
	'as' => 'acknowledgement-letter', ]);





Route::get('/delete-claim-driver', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@deleteDriver', 
	'as' => 'delete-claim-driver', ]);


Route::get('/delete-claim', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@deleteClaim', 
	'as' => 'delete-claim', ]);

Route::get('/delete-adjustments', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@deleteAdjustments', 
	'as' => 'delete-adjustments', ]);

Route::get('/delete-image', 
	['uses' => '\Phrontlyne\Http\Controllers\ImageController@deleteImage', 
	'as' => 'delete-image', ]);

Route::post('/upload-claims-files', 
	['uses' =>'\Phrontlyne\Http\Controllers\ImageController@claimsUpload',
	'as' => 'upload-claims-files',
 ]);


Route::get('/add-new-voucher', 
	['uses' =>'\Phrontlyne\Http\Controllers\ClaimsController@addPaymentVoucher',
	'as' => 'add-new-voucher',
 ]);

Route::get('/load-pv-claimant', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@loadPVClaimant',
	'as' => 'load-pv-claimant',]);

Route::get('/get-payment-voucher', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@loadPaymentVoucher',
	'as' => 'get-payment-voucher',]);


Route::get('/load-claimant-info', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@getClaimantDetails',
	'as' => 'load-claimant-info',]);



Route::get('/load-pv-detail', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@getPaymentVoucher',
	'as' => 'load-pv-detail',]);


Route::get('/load-requisition-detail', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@getRequisitionDetails',
	'as' => 'load-requisition-detail',]);




Route::get('/facing-sheet/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@facingSheet',
	'as' => 'facing-sheet',]);

Route::get('/print-voucher-slip/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@printVoucherSlip',
	'as' => 'print-voucher-slip',]);

Route::post('/make-claim-payment', 
	['uses' =>'\Phrontlyne\Http\Controllers\ClaimsController@makePayment',
	'as' => 'make-claim-payment',
 ]);

Route::post('/make-requisition-payment', 
	['uses' =>'\Phrontlyne\Http\Controllers\ReinsuranceController@makePayment',
	'as' => 'make-requisition-payment',
 ]);

Route::get('/set-pv-reprint-counter', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@reprintCounterPV',
	'as' => 'set-pv-reprint-counter',]);



//Reports
Route::get('/report-stats',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@statsreports',
	 'as' => '/reports-stats', ]);

Route::get('/report-list',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@reportsmain',
	 'as' => '/report-list', ]);


Route::get('/policy-ending',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@endingPolicy',
	 'as' => '/policy-ending', ]);

Route::get('/policy-cancelled',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@cancelledPolicy',
	 'as' => '/policy-cancelled', ]);

Route::get('/policy-installment',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@installmentPolicy',
	 'as' => '/policy-installment', ]);

Route::get('/policy-renewal',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@renewalPolicy',
	 'as' => '/policy-renewal', ]);

Route::get('/policy-active',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@activePolicy',
	 'as' => '/policy-active', ]);

Route::get('/policy-registered',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@registeredPolicy',
	 'as' => '/policy-registered', ]);

Route::get('/sales-summary',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@salesSummary',
	 'as' => '/sales-summary', ]);


Route::get('/sales-main',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@salesMain',
	 'as' => '/sales-main', ]);


Route::get('/sales-commission',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@salesCommission',
	 'as' => '/sales-commission', ]);


Route::get('/sales-money-flow',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@salesMoneyflow',
	 'as' => '/sales-money-flow', ]);


Route::get('/invoices-generated',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@generatedInvoices',
	 'as' => '/invoices-generated', ]);

Route::get('/unpaid-installments',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@installmentsUnpaid',
	 'as' => '/unpaid-installments', ]);

Route::get('/overpaid-invoices',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@overPaid',
	 'as' => '/overpaid-invoices', ]);

Route::get('/paid-invoices',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@customerPayments',
	 'as' => '/paid-invoices', ]);

Route::get('/receivables-summary',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@receivableSummary',
	 'as' => '/receivables-summary', ]);

Route::get('/receivables-details',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@receivableDetails',
	 'as' => '/receivables-details', ]);

Route::get('/unpaid-invoices',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@customersUnpaid',
	 'as' => '/unpaid-invoices', ]);


//Accounting

Route::get('/company-assets',
	['uses' => '\Phrontlyne\Http\Controllers\CompanyAssetsController@index',
	 'as' => '/company-assets', ]);

Route::get('/account-transactions',
	['uses' => '\Phrontlyne\Http\Controllers\CompanyAssetsController@transactionmanager',
	 'as' => '/account-transactions', ]);

Route::get('/account-reports',
	['uses' => '\Phrontlyne\Http\Controllers\CompanyAssetsController@index',
	 'as' => '/account-reports', ]);



//Print reports
Route::get('/print-sales-commission',
	['uses' => '\Phrontlyne\Http\Controllers\ReportController@printsalesCommission',
	 'as' => '/print-sales-commission', ]);


//Events

Route::get('/event-list',
	['uses' => '\Phrontlyne\Http\Controllers\EventController@index',
	 'as' => 'event-list', ]);

Route::get('/event-calendar',
	['uses' => '\Phrontlyne\Http\Controllers\EventController@calendar',
	 'as' => 'event-calendar', ]);

Route::post('/create-event',
	['uses' => '\Phrontlyne\Http\Controllers\EventController@store',]);


Route::get('/event/api', function () {
	$events = DB::table('appointments')->select('id', 'name', 'title', 'start_time as start', 'end_time as end')->get();
	foreach($events as $event)
	{
		$event->title = $event->title . ' - ' .$event->name;
		$event->url = url('events/' . $event->id);
	}
	return $events;
});

Route::get('/delete-appointment', 
	['uses' => '\Phrontlyne\Http\Controllers\EventController@deleteappointmentfromevent',
	'as' => 'delete-appointment',]);


//banking
Route::get('/banking.banks',
	['uses' => '\Phrontlyne\Http\Controllers\BankController@getbanks',
	 'as' => 'banking.banks', ]);



Route::get('/sticker-returns',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@returnStickers',
	 'as' => 'sticker-returns', ]);

Route::get('/sticker-issued',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@issuedStickers',
	 'as' => 'sticker-issued', ]);

Route::post('/sticker-generated',
	['uses' => '\Phrontlyne\Http\Controllers\InvoiceController@createSticker',
	 'as' => 'sticker-generated', ]);




//Setting up
Route::get('/setup',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@index',
	 'as' => 'setup', ]);

//branch setup
Route::get('/branch-list',
	['uses' => '\Phrontlyne\Http\Controllers\CompanyController@index',
	 'as' => 'branch-list', ]);


Route::post('/add-vehicle-make',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewMake',]);

Route::post('/add-vehicle-model',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewModel',]);

Route::post('/add-insurer',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewInsurer',]);

Route::post('/add-currency',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewCurrency',]);

Route::post('/add-property',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewPropertype',]);

Route::post('/add-policy-product',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewProduct',]);

Route::post('/add-mortgage',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewMortgageCompany',]);

Route::post('/add-beneficiary',
	['uses' => '\Phrontlyne\Http\Controllers\SetupController@addNewBeneficiary',]);


Route::get('/banking.accounts',
	['uses' => '\Phrontlyne\Http\Controllers\BankController@getBankAccount',
	 'as' => 'banking.accounts', ]);

Route::get('/banking.payments',
	['uses' => '\Phrontlyne\Http\Controllers\BankController@getPayments',
	 'as' => 'banking.payments', ]);

Route::get('/banking.deposites',
	['uses' => '\Phrontlyne\Http\Controllers\BankController@getDeposites',
	 'as' => 'banking.deposites', ]);

Route::get('/banking.transfers',
	['uses' => '\Phrontlyne\Http\Controllers\BankController@getTransfers',
	 'as' => 'banking.transfers', ]);

Route::post('/banking.create-bank',
	['uses' => '\Phrontlyne\Http\Controllers\BankController@createBank',
	
	]);
Route::get('/billing.profile/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\BankController@showProfile',
	'as' => 'billing.profile',]);

Route::post('/banking.create-bank-account',
	['uses' => '\Phrontlyne\Http\Controllers\BankController@createAccount',
	
	]);

//agents
Route::get('/agent-list-all', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@index',
	'as' => 'agent-list-all',]);

Route::get('/agent-list-agent', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@getAgents',
	'as' => 'agent-list-agent',]);

Route::get('/agent-list-broker', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@getBrokers',
	'as' => 'agent-list-broker',]);

Route::get('/agent-list-bank', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@getBanks',
	'as' => 'agent-list-bank',]);

Route::get('/load-agent-details', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@loadAgent',
	'as' => 'load-agent-details',]);

Route::get('/get-agent', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@getAgency',
	'as' => 'get-agent',]);

Route::get('/find-agent', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@searchagent',
	'as' => 'find-agent',]);

Route::get('/edit-agent', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@fetchAgent',
	'as' => 'edit-agent',]);

Route::get('/delete-agent', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@deleteAgent',
	'as' => 'delete-agent',]);


Route::post('/create-agent', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@createAgent',
	'as' => 'create-agent',]);

Route::post('/update-agent', 
	['uses' => '\Phrontlyne\Http\Controllers\AgentController@updateAgent',
	'as' => 'update-agent',]);




Route::get('/agency-profile/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\KYCController@getAgencyPolicies',
	'as' => 'agency-profile',]);



//Reinsurance


Route::get('/find-reinsurance', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@getSearchResults', 
	'as' => 'find-reinsurance', ]);

Route::get('/find-reinsurance-treaty', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@getSearchResultsTreaty', 
	'as' => 'find-reinsurance-treaty', ]);

Route::get('/do-arrangement/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@processestreaty_fac', 
	'as' => 'do-arrangement', ]);


Route::get('/load-pv-reinsurer', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@getPVReinsurer', 
	'as' => 'load-pv-reinsurer', ]);


Route::post('/update-arrangement', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@updateArrangement', 
	'as' => 'update-arrangement', ]);


Route::get('/do-arrangement-bulk', 
	['uses' => '\Phrontlyne\Http\Controllers\PolicyController@processestreaty_facbulk', 
	'as' => 'do-arrangement-bulk', ]);


Route::get('/reinsurance-businesses', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@index',
	'as' => 'reinsurance-businesses',]);

Route::get('/reinsurance-ceded-businesses', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@cededbusiness',
	'as' => 'reinsurance-ceded-businesses',]);

Route::get('/treaty-businesses', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@treatybusinesses',
	'as' => 'treaty-businesses',]);



Route::get('/reinsurance-pending', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@pending',
	'as' => 'reinsurance-pending',]);

Route::get('/reinsurance-disposed', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@disposed',
	'as' => 'reinsurance-disposed',]);

Route::get('/dispose-reinsured-business', array(
	'uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@dispose',
	'as' => 'dispose-reinsured-business',
	));

Route::get('/view-cession/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@viewcession',
	'as' => 'view-cession',]);

Route::get('/view-cession-treaty/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@viewcessiontreaty',
	'as' => 'view-cession-treaty',]);

Route::get('/delete-payment-voucher-reinsurer', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@deleteRequisition', 
	'as' => 'delete-payment-voucher-reinsurer', ]);

Route::get('/arrangement-slip/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@printarrangement',
	'as' => 'arrangement-slip',]);

Route::get('/final-cover-slip/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@printfaccover',
	'as' => 'fac-cover-slip',]);

Route::get('/fac-slip/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@printfacslip',
	'as' => 'fac-slip',]);

Route::get('/exclude-from-treaty', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@excludePolicy',
	'as' => 'exclude-from-treaty',]);


Route::get('/print-requisition-slip/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@printRequisition',
	'as' => 'print-requisition-slip',]);

Route::get('/print-requisition-receipt/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@printReceipts',
	'as' => 'print-requisition-receipt',]);


Route::get('/print-fac-payment-slip/{id}', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@printpaymentslip',
	'as' => 'print-fac-payment-slip',]);

Route::get('/add-apportionment', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@doapportionment',
	'as' => 'add-apportionment',]);

Route::get('/add-fac-payment', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@dopayments',
	'as' => 'add-fac-payment',]);


Route::get('/get-apportionment', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@getapportionment',
	'as' => 'get-apportionment',]);

Route::get('/load-reinsurer-premium', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@getReinsurerPremium',
	'as' => 'load-reinsurer-premium',]);


Route::get('/get-fac-payments', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@getPayments',
	'as' => 'get-fac-payments',]);


Route::get('/delete-apportionment', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@deleteApportionment',
	'as' => 'delete-apportionment',]);


Route::get('/delete-fac-payment', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@deletePayment',
	'as' => 'delete-fac-payment',]);

Route::get('/send-requisition-request', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@sendApprovalRequest',
	'as' => 'send-requisition-request',]);

Route::get('/approve-requisition-request', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@approveRequisition',
	'as' => 'approve-requisition-request',]);

Route::get('/approve-requisition-request-finance', 
	['uses' => '\Phrontlyne\Http\Controllers\ReinsuranceController@approveRequisitionFinance',
	'as' => 'approve-requisition-request-finance',]);


Route::get('/send-requisition-request-claim', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@sendApprovalRequest',
	'as' => 'send-requisition-request-claim',]);

Route::get('/approve-requisition-request-claim', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@approveRequisition',
	'as' => 'approve-requisition-request-claim',]);

Route::get('/approve-requisition-request-finance-claim', 
	['uses' => '\Phrontlyne\Http\Controllers\ClaimsController@approveRequisitionFinance',
	'as' => 'approve-requisition-request-finance-claim',]);



// Notifications
Route::get('/do-renewal-notiy', 
	['uses' => '\Phrontlyne\Http\Controllers\NotificationController@renewalNotice',
	'as' => 'do-renewal-notiy',]);

Route::get('/policy-documents', 
	['uses' => '\Phrontlyne\Http\Controllers\CompanyController@getDocuments',
	'as' => 'policy-documents',]);

Route::get('/policy-templates', 
	['uses' => '\Phrontlyne\Http\Controllers\NoteController@documents',
	'as' => 'policy-templates',]);

Route::get('/new-templates', 
	['uses' => '\Phrontlyne\Http\Controllers\NoteController@new',
	'as' => 'new-templates',]);

Route::post('/add-new-document', 
	['uses' => '\Phrontlyne\Http\Controllers\NoteController@savedocument',
	'as' => 'add-new-document',]);





//Whatsapp routes
Route::get('/do-registration', 
	['uses' => '\Phrontlyne\Http\Controllers\WhatsappController@register',
	'as' => 'do-registration',]);

Route::get('/do-confirm', 
	['uses' => '\Phrontlyne\Http\Controllers\WhatsappController@confirmation',
	'as' => 'do-confirm',]);

Route::get('/send-message', 
	['uses' => '\Phrontlyne\Http\Controllers\WhatsappController@sendMessage',
	'as' => 'send-message',]);


//route group end
//});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
