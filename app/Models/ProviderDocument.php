<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderDocument extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "provider_document";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'provider_id',
                            'document_id',
                            'document_image_name',
                            'document_image_path',
                            'document_status_id',
    ];

    /**
     * Model has Many document history
     * 
     * @return relation
     */
    public function histories()
    {
        return $this->hasMany('App\Models\ProviderDocumentHistory', 'provider_document_id', 'id');
    }

    /**
     * Model has Many document name
     * 
     * @return relation
     */
    public function documentName()
    {
        return $this->belongsTo('App\Models\ProviderMandatoryDocument', 'document_id', 'id');
    }

    /**
     * Model has Provider
     * 
     * @return relation
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider', 'provider_id', 'id');
    }

    /**
     * Model has Many document name
     * 
     * @return relation
     */
    public function documentStatus()
    {
        return $this->belongsTo('App\Models\ProviderDocumentHistory', 'id', 'provider_document_id');
    }
}
