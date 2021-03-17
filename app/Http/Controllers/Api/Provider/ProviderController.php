<?php

namespace App\Http\Controllers\Api\Provider;

use Validator;
use App\Models\Provider;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\ProviderVehicle;
use App\Http\Traits\StatusTrait;
use App\Models\ProviderDocument;
use App\Models\ProviderMobileOtp;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\IndividualJournyDetail;

class ProviderController extends Controller
{
  use StatusTrait;

  # Bind providers mobile otp protected
  protected $providerMobileOtp;

  # bind protected provider
  protected $provider; 

  # bind protected ProviderVehicle
  protected $providerVehicle;

  # bind protected providerDocument
  protected $providerDocument; 

  # bind protected IndividualJournyDetail
  protected $individualJournyDetail; 

 # Bind the Country Model.
  protected $countries;

  # Bind the City Model.
  protected $cities;

  # Bind the State Model.
  protected $states;

  /**
   * constructor
   * @param
   * @return
   */
  function __construct(
                       City $cities,
                       State $states,
                       Country $countries,
                       Provider $provider, 
                       ProviderVehicle $providerVehicle,
                       ProviderDocument $providerDocument,
                       ProviderMobileOtp $providerMobileOtp,
                       IndividualJournyDetail $individualJournyDetail
                      )
  {
    $this->cities                 =  $cities;
    $this->states                 =  $states;
    $this->provider               =  $provider;
    $this->countries              =  $countries;
    $this->providerVehicle        =  $providerVehicle;
    $this->providerDocument       =  $providerDocument;
    $this->providerMobileOtp      =  $providerMobileOtp;
    $this->individualJournyDetail =  $individualJournyDetail;
  }

  /**
   * otp generate for mmobile number
   * @param mobile number
   * @return otp
   */  
  public function otpGenerate(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'mobile'               => 'required|numeric',
        'country_phone_code'   => 'required|string',
        'country_name'         => 'required|string',
        'country_code'         => 'required|string',
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors()], 401);            
    }
    
    # generate otp
    $otp = mt_rand('1000','9999');

    # requested data
    $arrayData = [
                  'mobile'             => $request->get('mobile'),                  
                  'otp'                => $otp,
    ];

    # fetch provider of this mobile number
    $provider = $this->provider
                     ->where('mobile', $request->get('mobile'))
                     ->where('country_phone_code', $request->get('country_phone_code'))
                     ->first();
    $country = $this->countries
                     ->where('sort_name', $request->get('country_code'))
                     ->first();                 

    if($provider == null){
    
      # create otp
      $otpCreate = $this->providerMobileOtp->create($arrayData);

      $providerData = [
                       'mobile'             => $request->get('mobile'),
                       'country_phone_code' => $request->get('country_phone_code'),
                       'country_name'       => $request->get('country_name'),
                       'country_code'       => $request->get('country_code'),
                       'country'            => $country->id,
                       'mobile_otp'         => $otpCreate->otp,
      ];

      $generateIdForProvider = $this->provider->create($providerData);

      # generate unique provider id
      $providerUniqueId = '#'.$generateIdForProvider->id.date('ymdhis');

      $this->provider
           ->where('id', $generateIdForProvider->id)
           ->update(['provider_unique_id' => $providerUniqueId]);
      
      # return 
      return response()->json([
                               'message' => 'Otp generation success',
                               'code'    => $this->successStatus,
                               'data'    => [
                                             'mobile'            => (string)$otpCreate->mobile ?? '',
                                             'country_phone_code'=> (string)$request->get('country_phone_code') ?? '',
                                             'country_id'        => (string)$country->id ?? '',
                                             'otp'               => (string)$otp ?? '',
                                            ]
      ]);
    } elseif ($provider->is_registerd == 0) {

      # create otp
      $otpCreate = $this->providerMobileOtp->create($arrayData);
      
      # update provider otp
      $updateProviderOtp = $this->provider
                                ->where('mobile', $request->get('mobile'))
                                ->where('country_phone_code', $request->get('country_phone_code'))
                                ->update(['mobile_otp' => $otpCreate->otp]);
      
      # return 
      return response()->json([
                               'message' => 'Otp generation success',
                               'code'    => $this->successStatus,
                               'data'            => [
                                                     'mobile'            => (string)$otpCreate->mobile ?? '',
                                                     'country_phone_code'=> (string)$request->get('country_phone_code') ?? '',
                                                     'country_id'        => (string)$country->id ?? '',
                                                     'otp'               => (string)$otp ?? '',
                                                    ]
      ]);
    } elseif ($provider->is_registerd == 1) {

      return response()->json([
                               'message'=> 'This mobile no already registered',
                                'code'   => $this->failedStatus   
      ]); 
    }
  }
      
  /**
   * otp verification
   * @param mobile no, otp
   * @return verification of mobile no
   */
  public function providerOtpVerify(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'mobile'              => 'required|numeric',
        'otp'                 => 'required|numeric',
        'country_phone_code'  => 'required'
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors()], $this->failedStatus);            
    } 

    # fetch provider of this mobile number
    $provider = $this->provider
                     ->where('mobile', $request->get('mobile'))
                     ->where('country_phone_code', $request->get('country_phone_code'))
                     ->first(); 

    if ($provider->mobile_otp == $request->get('otp')) {
      # verify success
      return response()->json([
                               'message'=> 'OTP verification success',
                               'code'   => $this->successStatus 
      ]);     
    } else {
      # verify error
      return response()->json([
                               'message'=> 'Wrong OTP',
                               'code'   => $this->failedStatus 
      ]);     
    }
  } 

  /**
   * register company
   * @param register pairameter
   * @return json response
   */
  public function storeCompany(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'registration_no'      => 'required|string',
        'name'                 => 'required|string',
        'address'              => 'required|string',
        'mobile'               => 'required|string',
        'country_phone_code'   => 'required|string',
        'no_of_vehicle'        => 'required|numeric',
        'state_id'             => 'required|numeric',
        'city_id'              => 'required|numeric',
        'email'                => 'required|string',
        'password'             => 'required|string',
        'documents'            => 'required',
        'doc_ids'              => 'required',
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors(), 'code' => $this->failedStatus]);            
    }
    
    # company provider requested data
    $providerData = [
                      'provider_type_id'   => '1',
                      'registration_no'    => $request->get('registration_no') ?? null,
                      'name'               => $request->get('name') ?? null,
                      'address'            => $request->get('address') ?? null,
                      'email'              => $request->get('email') ?? null,
                      'state'              => $request->get('state_id') ?? 0,
                      'city'               => $request->get('city_id') ?? 0,
                      'no_of_vehicle'      => $request->get('no_of_vehicle') ?? null,
                      'password'           => Hash::make($request->get('password')) ?? null,
                      'is_registerd'       => '1',
    ];

    # check email existance
    $countEmail =  $this->provider->where('email', $request->get('email'))->count();
    
    if ($countEmail != 0) {
        return response()->json([
                                 'message'=> 'Email already exist',
                                 'code'   => $this->failedStatus
        ]);      
    } else {
      # update company provider data
      $registerProvider = $this->provider
                               ->where('mobile', $request->get('mobile'))
                               ->where('country_phone_code', $request->get('country_phone_code'))
                               ->update($providerData);
    
      if ($registerProvider) {

        $provider = $this->provider
                         ->where('mobile', $request->get('mobile'))
                         ->where('country_phone_code', $request->get('country_phone_code'))
                         ->first();
        
        $documents = [];

        # if company provider created add document
        $docIds = explode(',', $request->get('doc_ids'));
        $docImages = $request->file('documents');
  
        # Set the Document Data
        foreach ($docIds as $key => $docId) {
            $documents[$docId] = $docImages[$key];
        }

        #check has image or not
        if ($request->hasFile('documents')) {
         foreach ($documents as $key => $document) {
           # get document
           $name = $document->getClientOriginalName(); // getting image name
           $date = date('y-m-d');              
           $randNumber = rand(0000,9999);              
           $newFile =$date.'_'.$randNumber.'_'.$name;
           $filename = str_replace(' ', '',$newFile); 
           $document->move('api/providers/company_doc/', $filename);
           $documentPath ='api/providers/company_doc/'.$filename;
          
           $this->providerDocument->create([
                                            'provider_id'         => $provider->id ?? 0,
                                            'document_id'         => $key ?? 0,
                                            'document_image_name' => $name ?? null,
                                            'document_image_path' => $documentPath ?? null,
           ]);
         }
        }

        return response()->json([
                                 'message'=> 'Company registered successfully',
                                 'code'   => $this->successStatus,
                                 'data'   => [
                                              'provider_id' => (string)$provider->id ?? '',
                                              'mobile'      => (string)$provider->mobile ?? '',
                                              'email'       => (string)$provider->email ?? '',
                                 ]
        ]);
      } else {
        return response()->json([
                                 'message'=> 'Something went wrong',
                                 'code'   => $this->failedStatus
        ]);
      } 
    }
  } 

  /**
   * register driver
   * @param register pairameter
   * @return json response
   */
  public function storeDriver(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'first_name'           => 'required|string',
        'last_name'            => 'required|string',
        'address'              => 'required|string',
        'mobile'               => 'required|string',
        'country_phone_code'   => 'required|string',
        'email'                => 'required|string',
        'password'             => 'required|string',
        'state_id'             => 'required|numeric',
        'city_id'              => 'required|numeric',
        'documents'            => 'required',
        'doc_ids'              => 'required',
        'transport_id'         => 'required',
        'vehicle_id'           => 'required',
        //'vehicle_image'        => 'required'
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors(), 'code' => $this->failedStatus]);            
    }
    
    # driver provider requested data
    $providerData = [
                      'provider_type_id'   => '2',
                      'name'               => $request->get('first_name') ?? ''.' '.$request->get('last_name') ?? '',
                      'address'            => $request->get('address') ?? null,
                      'email'              => $request->get('email') ?? null,
                      'state'              => $request->get('state_id') ?? 0,
                      'city'               => $request->get('city_id') ?? 0,
                      'password'           => Hash::make($request->get('password')) ?? null,
                      'is_registerd'       => '1',
    ];

    # check email existance
    $countEmail =  $this->provider->where('email', $request->get('email'))->count();
    
    if ($countEmail != 0) {
        return response()->json([
                                 'message'=> 'Email already exist',
                                 'code'   => $this->failedStatus
        ]);      
    } else {

      # update driver provider data
      $registerProvider = $this->provider
                               ->where('mobile', $request->get('mobile'))
                               ->where('country_phone_code', $request->get('country_phone_code'))
                               ->update($providerData);
      
      if ($registerProvider) {

        $provider = $this->provider
                         ->where('mobile', $request->get('mobile'))
                         ->where('country_phone_code', $request->get('country_phone_code'))
                         ->first();
        
        $documents = [];

        # if driver provider created add document
        $docIds = explode(',', $request->get('doc_ids'));
        $docImages = $request->file('documents');

        # Set the Document Data
        foreach ($docIds as $key => $docId) { 
            $documents[$docId] = $docImages[$key];
        }

        #check has image or not
        if ($request->hasFile('documents')) {
         foreach ($documents as $key => $document) {
           # get document
           $name = $document->getClientOriginalName(); // getting image name
           $date = date('y-m-d');              
           $randNumber = rand(0000,9999);              
           $newFile =$date.'_'.$randNumber.'_'.$name;
           $filename = str_replace(' ', '',$newFile); 
           $document->move('api/providers/company_doc/', $filename);
           $documentPath ='api/providers/company_doc/'.$filename;
          
           $this->providerDocument->create([
                                            'provider_id'         => $provider->id ?? 0,
                                            'document_id'         => $key ?? 0,
                                            'document_image_name' => $name ?? null,
                                            'document_image_path' => $documentPath ?? null,
           ]);
         }
        }

        // # upload avtar
        // if($request->hasfile('vehicle_image')) {
        //  $file = $request->file('vehicle_image');
        //  $name = $file->getClientOriginalName(); // getting image name
        //  $date = date('y-m-d');              
        //  $randNumber = rand(0000,9999);              
        //  $newFile =$date.'_'.$randNumber.'_'.$name;
        //  $filename = str_replace(' ', '',$newFile); 
        //  $file->move('api/providers/driver/driver_vehicle_image/', $filename);
        //  $vehicleImage ='api/providers/driver/driver_vehicle_image/'.$filename;
        // } else {
        //  $vehicleImage  = null;  
        //  $name = null;
        // }
        # add vehicle 
        $vehicleData = [
                        'provider_id'       => $provider->id ?? 0,
                        'service_id'        => $request->transport_id ?? 0,
                        'service_medium_id' => $request->vehicle_id ?? 0,
                        //'vehicle_image'     => $vehicleImage ?? null,
        ];

        # create vehicle
        $this->providerVehicle->create($vehicleData); 

        return response()->json([
                                 'message'=> 'Driver registered successfully',
                                 'code'   => $this->successStatus,
                                 'data'   => [
                                              'provider_id' => (string)$provider->id ?? '',
                                              'mobile'      => (string)$provider->mobile ?? '',
                                              'email'       => (string)$provider->email ?? '',
                                 ]
        ]);
      } else {
        return response()->json([
                                 'message'=> 'Something went wrong',
                                 'code'   => $this->failedStatus
        ]);
      }
    } 
  }  

  /**
   * register traveler
   * @param register pairameter
   * @return json response
   */
  public function storeTraveler(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'first_name'           => 'required',
        'last_name'            => 'required',
        'address'              => 'required',
        'mobile'               => 'required',
        'country_phone_code'   => 'required',
        'email'                => 'required',
        'password'             => 'required',
        'state_id'             => 'required|numeric',
        'city_id'              => 'required|numeric',
        'documents'            => 'required',
        'doc_ids'              => 'required',
        'journy_medium'        => 'required',
        'practical_detail'     => 'required',
        'size_of_load'         => 'required',   
        'departure_from'       => 'required',
        'arrival_to'           => 'required',
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors(), 'code' => $this->failedStatus]);            
    }
    
    # driver provider requested data
    $providerData = [
                      'provider_type_id'   => '3',
                      'name'               => $request->get('first_name') ?? ''.' '.$request->get('last_name') ?? '',
                      'address'            => $request->get('address') ?? null,
                      'email'              => $request->get('email') ?? null,
                      'state'              => $request->get('state_id') ?? 0,
                      'city'               => $request->get('city_id') ?? 0,
                      'password'           => Hash::make($request->get('password')) ?? null,
                      'is_registerd'       => '1',
    ];

    # check email existance
    $countEmail =  $this->provider->where('email', $request->get('email'))->count();
    
    if ($countEmail != 0) {
        return response()->json([
                                 'message'=> 'Email already exist',
                                 'code'   => $this->failedStatus
        ]);      
    } else {

      # update driver provider data
      $registerProvider = $this->provider
                               ->where('mobile', $request->get('mobile'))
                               ->where('country_phone_code', $request->get('country_phone_code'))
                               ->update($providerData);
      
      if ($registerProvider) {

        $provider = $this->provider
                         ->where('mobile', $request->get('mobile'))
                         ->where('country_phone_code', $request->get('country_phone_code'))
                         ->first();
        
        $documents = [];

        # if driver provider created add document
        $docIds = explode(',', $request->get('doc_ids'));
        $docImages = $request->file('documents');

        # Set the Document Data
        foreach ($docIds as $key => $docId) { 
            $documents[$docId] = $docImages[$key];
        }

        #check has image or not
        if ($request->hasFile('documents')) {
         foreach ($documents as $key => $document) {
           # get document
           $name = $document->getClientOriginalName(); // getting image name
           $date = date('y-m-d');              
           $randNumber = rand(0000,9999);              
           $newFile =$date.'_'.$randNumber.'_'.$name;
           $filename = str_replace(' ', '',$newFile); 
           $document->move('api/providers/company_doc/', $filename);
           $documentPath ='api/providers/company_doc/'.$filename;
          
           $this->providerDocument->create([
                                            'provider_id'         => $provider->id ?? 0,
                                            'document_id'         => $key ?? 0,
                                            'document_image_name' => $name ?? null,
                                            'document_image_path' => $documentPath ?? null,
           ]);
         }
        }
        
        # journy detail
        $taravellerData = [
                            'provider_id'      => $provider->id ?? 0,
                            'journy_medium'    => $request->get('journy_medium') ?? null,
                            'practical_detail' => $request->get('practical_detail') ?? null,
                            'size_of_load'     => $request->get('size_of_load') ?? null,
                            'departure_from'   => $request->get('departure_from') ?? null,
                            'arrival_to'       => $request->get('arrival_to') ?? null,
        ];

        # create journy detail of traveller
        $this->individualJournyDetail->create($taravellerData);

        return response()->json([
                                 'message'=> 'Individual registered successfully',
                                 'code'   => $this->successStatus,
                                 'data'   => [
                                              'provider_id' => (string)$provider->id ?? '',
                                              'mobile'      => (string)$provider->mobile ?? '',
                                              'email'       => (string)$provider->email ?? '',
                                 ]
        ]);
      } else {
        return response()->json([
                                 'message'=> 'Something went wrong',
                                 'code'   => $this->failedStatus
        ]);
      }
    } 
  }            
}
