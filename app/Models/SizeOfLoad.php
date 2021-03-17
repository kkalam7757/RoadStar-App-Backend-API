<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SizeOfLoad extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "size_of_load";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'name',
                            'min_weight',
                            'max_weight',
                            'description',
                            'status',
                            'added_by',
                            'updated_by',
                            'deleted_by',
    ];
}
