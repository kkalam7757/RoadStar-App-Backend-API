<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'user_unique_id',
                            'first_name',
                            'last_name',
                            'mobile',
                            'country_phone_code',
                            'email',
                            'password',
                            'token',
                            'mobile_otp',
                            'email_otp',
                            'lat',
                            'long',
                            'country',
                            'country_name',
                            'country_code',
                            'state',
                            'city',
                            'zip_code',
                            'address',
                            'is_registerd',
                            'status',
                            'description',
                            'profile_pic'
    ];
}
