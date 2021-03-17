<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin  extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    # Define table
    protected $table = "admin";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'first_name',
                            'last_name',
                            'contact_number',
                            'email',
                            'profile_pic',
                            'password',
                            'status',
                            'added_by',
    ];    
}
