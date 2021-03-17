<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderType extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "provider_type";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'name',
                            'image_path',
                            'image_name',
                            'description',
                            'status',
                            'added_by',
                            'updated_by',
                            'deleted_by',
    ];
}
