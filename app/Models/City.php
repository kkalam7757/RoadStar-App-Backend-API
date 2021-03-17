<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    

     /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table 	= 	'cities';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable 	= 	[
							    	'name',
							    	'state_id',
					      		];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
    ];

    /**
     * Get the state associated with the City Model.
     *
     * @return relation
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }
}
