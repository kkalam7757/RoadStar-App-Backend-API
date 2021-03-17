<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndividualJournyDetail extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "individual_journy_detail";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'provider_id',
                            'departure_date',
                            'arrival_date',
                            'return_departure_date',
                            'return_arrival_date',
                            'departure_from',
                            'arrival_to',
                            'journy_medium',
                            'size_of_load',
                            'practical_detail',
                            'description',
                            'status',
                            'added_by',
                            'updated_by',
                            'deleted_by'
    ];
}
