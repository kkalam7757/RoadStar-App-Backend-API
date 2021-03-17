<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
  
  # define table
  protected $table ='states';
  
  # define fillable fields
  protected $fillable = [
  		'country_id',
  	    'name',
  ];

  /**
     * Get the cities associated with the State Model.
     *
     * @return relation
     */
    public function cities()
    {
        return $this->hasMany('App\Models\City', 'state_id', 'id');
    }
}
