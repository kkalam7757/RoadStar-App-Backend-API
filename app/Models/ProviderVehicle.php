<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderVehicle extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "provider_vehicle";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'provider_id',
                            'service_id',
                            'service_medium_id',
                            'vehicle_company_name',
                            'vehicle_image',
                            'vehicle_number',
                            'description',
                            'status',
                            'added_by',
                            'updated_by',
                            'deleted_by',
    ];
}
