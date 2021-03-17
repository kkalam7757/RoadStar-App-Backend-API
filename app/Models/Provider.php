<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "providers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'provider_type_id',
                            'provider_unique_id',
                            'registration_no',
                            'no_of_vehicle',
                            'name',
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
    ];

    /**
     * Model has Many documents
     * 
     * @return relation
     */
    public function documents()
    {
        return $this->hasMany('App\Models\ProviderDocument', 'provider_id', 'id');
    }


    /**
     * relation with city
     * @param
     * @return
     */
    public function cityData()
    {
      return $this->belongsTo('App\Models\City', 'city', 'id');
    }

     /**
     * relation with state
     * @param
     * @return
     */
    public function stateData()
    {
      return $this->belongsTo('App\Models\State', 'state', 'id');
    }

    /**
     * relation with country
     * @param
     * @return
     */
    public function countryData()
    {
      return $this->belongsTo('App\Models\Country', 'country', 'id');
    }

       /**
     * Attribuite for the relation city
     * @param
     * @return
     */
    public function getcityNameAttribute()
    {
      if ($this->cityData != '') {
        return $this->cityData->name;
       } else {
        return '';
       }
    }

   /**
     * Attribuite for the relation country
     * @param
     * @return
     */
     public function getcountryNameAttribute()
    {
      if ($this->countryData != "") {
        return $this->countryData->name;
       } else {
        return '';
       }
    }


    /**
     * Attribuite for the relation state
     * @param
     * @return
     */
     public function getstateNameAttribute()
    {
      if ($this->stateData != "") {
        return $this->stateData->name;
       } else {
        return '';
       }
    }


}
