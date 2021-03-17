<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderMandatoryDocument extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "provider_mandatory_document";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'provider_type_id',
                            'name',
                            'status',
                            'added_by',
                            'updated_by',
                            'deleted_by',
    ];
}
