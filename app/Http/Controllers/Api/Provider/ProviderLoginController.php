<?php

namespace App\Http\Controllers\Api\Provider;

use Validator;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Traits\StatusTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProviderLoginController extends Controller
{
  use StatusTrait;
  
  # bind Provider
  protected $provider;

  #Bind Api Token
  private $apiToken;

  /**
   * default constructor
   * @param models
   * @return data
   */
  function __construct(Provider $provider)
  {
  	$this->provider = $provider;
    $this->apiToken = uniqid(base64_encode(str_random(60)));
  }

  /**
   * provider login
   * @param email password
   * @return login json response
   */
  public function providerLogin(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'email'     => 'required|email',
        'password'  => 'required|string'
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors(), 'code' => $this->failedStatus]);            
    } 
    
    # check email from provider
    $provider = $this->provider->where('email', $request->email)->where('is_registerd', '1')->first();

    if (isset($provider)) {
      if (Hash::check($request->password,$provider->password)) {
        # set token
        $provider->update(['token' => $this->apiToken]);

        # success return 
        return response()->json([
                                 'message' => 'Login Success',
                                 'code'    => $this->successStatus,
                                 'data'    => [
                                               'id'            => (string)$provider->id ?? '',
                                               'provider_type' => (string)$provider->provider_type_id ?? '',
                                               'token'         => (string)$provider->token ?? '',
                                              ]
        ]);
      } else {
        return response()->json([
                                 'message'=> 'Incorrect Password',
                                 'code'   => $this->failedStatus   
        ]);         
      }
    } else {
      return response()->json([
                               'message'=> 'This email is not registerd',
                               'code'   => $this->failedStatus   
      ]); 
    }
  }

  /**
   * forgot password
   * @param email
   * @return otp
   */
  public function forgotPasswordOtp(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'email'     => 'required|email',
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors(), 'code' => $this->failedStatus]);            
    } 

    # generate otp
    $otp = mt_rand('1000','9999');
    
    $providerQuery = $this->provider->where('email', $request->email)->where('is_registerd', '1');

    if ($providerQuery->count() == 0) {
      # error message
      return response()->json([
                               'message'=> 'This email is not registerd',
                               'code'   => $this->failedStatus   
      ]);      
    } else {
      # provider data
      $provider = $providerQuery->first();

      $provider->update(['mobile_otp' => $otp]);

      # success return 
      return response()->json([
                               'message' => 'Otp send to your registerd mobile no',
                               'code'    => $this->successStatus,
                               'data'    => [
                                             'mobile'              => (string)$provider->mobile ?? '',
                                             'country_mobile_code' => (string)$provider->country_phone_code ?? '',
                                             'otp'                 => (string)$otp ?? '',
                                            ]  
                              ]);
    }
  }

  /**
   * verify forgot password otp
   * @param mobile no
   * @return otp
   */
  public function verifyForgotPasswordOtp(Request $request)
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

    # fetch provider of this mobile number
    $provider = $this->provider
                     ->where('mobile', $request->get('mobile'))
                     ->where('country_phone_code', $request->get('country_phone_code'))
                     ->first(); 

    if ($provider->mobile_otp == $request->get('otp')) {
      # verify success
      return response()->json([
                               'message'=> 'OTP verification success',
                               'code'   => $this->successStatus,
                               'data'   => [
                                            'mobile'              => (string)$request->get('mobile'),
                                            'country_mobile_code' => (string)$request->get('country_phone_code'),
                               ]
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
   * set new password
   * @param password , mobile no
   * @return update password
   */
  public function updatePassword(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'mobile'              => 'required|numeric',
        'country_phone_code'  => 'required',
        'password'            => 'required',
        'confirm_password'    => 'required'
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors()], 401);            
    }

    if ($request->get('password') == $request->get('confirm_password')) {
      # update password
      $this->provider->where('mobile', $request->get('mobile'))->update(['password' => Hash::make($request->get('password'))]);

      # verify success
      return response()->json([
                               'message'=> 'Password Changed Successfully',
                               'code'   => $this->successStatus,
                               'data'   => [
                                            'country_phone_code' => $request->get('country_phone_code'),
                                            'mobile'             => $request->get('mobile')
                               ]
                              ]);
    } else {
      return response()->json([
                               'message'=> 'Password and Confirm password are different',
                               'code'   => $this->failedStatus 
      ]);      
    }
  }
}
