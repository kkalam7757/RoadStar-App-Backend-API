<?php 

# send user otp
Route::post('user-otp', 'Api\User\UserController@otpGenerate');

# user otp verification
Route::post('user-otp-verification', 'Api\User\UserController@userOtpVerify');

# user registraion
Route::post('add-user', 'Api\User\UserController@registerUser');

# forgot password otp generate
Route::post('user-forgot-password-otp', 'Api\User\UserLoginController@forgotPasswordOtp');

# user login
Route::post('verify-user-forgot-password-otp', 'Api\User\UserLoginController@verifyForgotPasswordOtp');

# change password
Route::post('change-user-password', 'Api\User\UserLoginController@changePassword');

# user login
Route::post('user-login', 'Api\User\UserLoginController@userLogin');