<?php

namespace App\Http\Controllers\AdminController;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class LoginController extends Controller
{
  # use MessageAndStatus Trait.
  use MessageStatusTrait;

  /**
   * login page
   * @param Illuminate\Http\Request;
   * @return Illuminate\Http\Response;
   */
  public function index(Request $request)
  {
  	# return to login page
  	return view('admin.layouts.login');
  }

  /**
   * login
   * @param Illuminate\Http\Request;
   * @return Illuminate\Http\Response;
   */
  public function login(Request $request)
  {
   # Validate request param      
   $v = Validator::make($request->all(), [
       'email'    => 'required',
       'password' => 'required',
   ]);
   
   # if failed
   if ($v->fails()) {  
     $output = ['error' => 100, 'message' => 'Please fill email and password both.'];
     return $output;
   }
   # otherwise
   $credentials = $request->only('email', 'password');

   # Attempt login
   if (!Auth::guard('admin')->attempt($credentials)) {	
   	$output = ['error' => 100, 'message' => 'Wrong email or password'];
   } else {
     # if login
     $user = Auth::guard('admin')->user();
     
     # if status is active and exist then return succes 
     if ($user->status == '1' && $user->deleted_at == Null) {
      $output = ['success' => 200, 'message' => 'Login Success'];
     } else {
      $output = ['error' => 100, 'message' => 'Something Went Wrong'];
     }
   }
   return $output;  
  } 


 /**
  * destroy session
  * @param
  * @return \Illuminate\Http\Response
  */
 public function logout()
 {
 	# logout web gaurd
    Auth::guard('admin')->logout();
    
    # return oytput
    return redirect('/');    
 }
}
