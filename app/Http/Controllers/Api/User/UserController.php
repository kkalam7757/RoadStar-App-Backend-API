<?php

namespace App\Http\Controllers\Api\User;

use Validator;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\UserMobileOtp;
use App\Http\Traits\StatusTrait;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  use StatusTrait;

  # Bind users mobile otp protected
  protected $userMobileOtp;

  # bind protected user
  protected $user;  

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
                       User $user, 
                       City $cities,
                       State $states,
                       Country $countries,
                       UserMobileOtp $userMobileOtp
                      )
  {
    $this->userMobileOtp  = $userMobileOtp;
    $this->countries      = $countries;
    $this->cities         = $cities;
    $this->states         = $states;
    $this->user           = $user;
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

    # fetch user of this mobile number
    $user = $this->user
                 ->where('mobile', $request->get('mobile'))
                 ->where('country_phone_code', $request->get('country_phone_code'))
                 ->first();

    $country = $this->countries
                    ->where('sort_name', $request->get('country_code'))
                    ->first();

    if($user == null){
    
      # create otp
      $otpCreate = $this->userMobileOtp->create($arrayData);

      $userData = [
                    'mobile'             => $request->get('mobile'),
                    'country_phone_code' => $request->get('country_phone_code'),
                    'country_name'       => $request->get('country_name'),
                    'country_code'       => $request->get('country_code'),
                    'country'            => $country->id,
                    'mobile_otp'         => $otpCreate->otp,
      ];

      $generateIdForUser = $this->user->create($userData);

      # generate unique user id
      $userUniqueId = '#'.$generateIdForUser->id.date('ymdhis');            

      $this->user
           ->where('id', $generateIdForUser->id)
           ->update(['user_unique_id' => $userUniqueId]);
      
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
    } elseif ($user->is_registerd == 0) {

      # create otp
      $otpCreate = $this->userMobileOtp->create($arrayData);
      
      # update user otp
      $updateUserOtp = $this->user
                            ->where('mobile', $request->get('mobile'))
                            ->where('country_phone_code', $request->get('country_phone_code'))
                            ->update(['mobile_otp' => $otpCreate->otp]);
      
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
    } elseif ($user->is_registerd == 1) {

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
  public function userOtpVerify(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'mobile'              => 'required|numeric',
        'otp'                 => 'required|numeric',
        'country_phone_code'  => 'required'
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors()], 401);            
    } 

    # fetch user of this mobile number
    $user = $this->user
                 ->where('mobile', $request->get('mobile'))
                 ->where('country_phone_code', $request->get('country_phone_code'))
                 ->first(); 

    if ($user->mobile_otp == $request->get('otp')) {
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
   * register User
   * @param register pairameter
   * @return json response
   */
  public function registerUser(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'first_name'           => 'required|string',
        'last_name'            => 'required|string',
        'mobile'               => 'required|string',
        'country_phone_code'   => 'required|string',
        'address'              => 'required|string',
        'state_id'             => 'required|numeric',
        'city_id'              => 'required|numeric',
        'email'                => 'required|email',
        'password'             => 'required|string',
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors(), 'code' => $this->failedStatus]);            
    }
    
    # company user requested data
    $userData = [
                   'first_name'         => $request->get('first_name') ?? null,
                   'last_name'          => $request->get('last_name') ?? null,
                   'address'            => $request->get('address') ?? null,
                   'email'              => $request->get('email') ?? null,
                   'state'              => $request->get('state_id') ?? 0,
                   'city'               => $request->get('city_id') ?? 0,
                   'password'           => Hash::make($request->get('password')) ?? null,
                   'is_registerd'       => '1',
    ];

    # check email existance
    $countEmail =  $this->user->where('email', $request->get('email'))->count();
    
    if ($countEmail != 0) {
        return response()->json([
                                 'message'=> 'Email already exist',
                                 'code'   => $this->failedStatus
        ]);      
    } else {
      # update company user data
      $registerUser = $this->user
                           ->where('mobile', $request->get('mobile'))
                           ->where('country_phone_code', $request->get('country_phone_code'))
                           ->update($userData);
    
      if ($registerUser) {

        $user = $this->user
                     ->where('mobile', $request->get('mobile'))
                     ->where('country_phone_code', $request->get('country_phone_code'))
                     ->first();
        
        return response()->json([
                                 'message'=> 'User registered successfully',
                                 'code'   => $this->successStatus,
                                 'data'   => [
                                              'provider_id' => (string)$user->id ?? '',
                                              'mobile'      => (string)$user->mobile ?? '',
                                              'email'       => (string)$user->email ?? '',
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
