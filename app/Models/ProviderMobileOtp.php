<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderMobileOtp extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "provider_mobile_otp";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'mobile',
                            'otp',
                            'used',
    ];
}
