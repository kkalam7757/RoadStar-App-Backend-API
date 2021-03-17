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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
######## Master data #######
# service type
Route::get('service-type', 'Api\MasterController@serviceType');

# service type
Route::post('service-medium', 'Api\MasterController@serviceMedium'); 

# provider type
Route::get('provider-type', 'Api\MasterController@providerType'); 

# provider type
Route::get('load-size', 'Api\MasterController@sizeOfLoad');  

# company mandatory document
Route::get('company-mandatory-document', 'Api\MasterController@mandatoryDocumentForCompany'); 

# driver mandatory document
Route::get('driver-mandatory-document', 'Api\MasterController@mandatoryDocumentForDriver'); 

# individual mandatory document
Route::get('individual-mandatory-document', 'Api\MasterController@mandatoryDocumentForIndividual'); 

# country state city
Route::get('all-countries', 'Api\MasterController@allCountries');
Route::post('all-states', 'Api\MasterController@allStates');
Route::post('all-cities', 'Api\MasterController@allCities'); 

############################
# send provider otp
Route::post('provide-otp', 'Api\Provider\ProviderController@otpGenerate');

# provider otp verification
Route::post('provide-otp-verification', 'Api\Provider\ProviderController@providerOtpVerify');

# company registraion
Route::post('add-company', 'Api\Provider\ProviderController@storeCompany');

# driver registraion
Route::post('add-driver', 'Api\Provider\ProviderController@storeDriver');

# individual registration
Route::post('add-individual', 'Api\Provider\ProviderController@storeTraveler');

# forgot password otp generate
Route::post('provider-forgot-password-otp', 'Api\Provider\ProviderLoginController@forgotPasswordOtp');

# provider login
Route::post('verify-provider-forgot-password-otp', 'Api\Provider\ProviderLoginController@verifyForgotPasswordOtp');

# change password
Route::post('update-provider-password', 'Api\Provider\ProviderLoginController@updatePassword');

# provider login
Route::post('provider-login', 'Api\Provider\ProviderLoginController@providerLogin');

# Provider Authenticate routes
Route::group(['prefix' => 'provider', 'middleware' => ['provider']], function () {

});

# user routes
include('user.php');

//Clear Route cache:
Route::get('/clear', function() {
     Artisan::call('config:clear');
     Artisan::call('cache:clear');
     Artisan::call('view:clear');
     Artisan::call('route:clear');
    return '<h1>All Cleared</h1>';
});
