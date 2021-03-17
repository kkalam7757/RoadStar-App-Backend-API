<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderDocumentHistoryStatus extends Model
{
    use SoftDeletes;

    # Define table
    protected $table = "provider_document_history_status";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'name',
    ];
}
