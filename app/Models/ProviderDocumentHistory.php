<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Interfaces\DocumentStatusInterface;

class ProviderDocumentHistory extends Model implements DocumentStatusInterface
{
    use SoftDeletes;

    # Define table
    protected $table = "provider_document_history";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'provider_document_id',
                            'document_id',
                            'document_status_id',
                            'reason',
                            'status',
                            'added_by',
                            'updated_by',
                            'deleted_by',
    ];

    /**
     * Attribute to Send Status of Provider Document
     * @param 
     * @return Status
     */
    public function getStatusAttribute()
    {
        # fetch the Current status 
        $status = $this->document_status_id;

        # initialize retiurn Status
        $statusString = '';

        # verify the Status
        if($status == DocumentStatusInterface::ACCEPTED) {
            $statusString = 'Accepted';
        } elseif ($status == DocumentStatusInterface::REJECTED) {
            $statusString = 'Rejected';
        }

        # return Status String
        return $statusString;
    }

    /**
     * Attribute check status is Approve
     * @param 
     * @return Status
     */
    public function getStatusApproveAttribute()
    {
        # fetch the Current status 
        $status = $this->document_status_id;

        # verify the Status
        if($status == DocumentStatusInterface::ACCEPTED) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Attribute check status is Reject
     * @param 
     * @return Status
     */
    public function getStatusRejectAttribute()
    {
        # fetch the Current status 
        $status = $this->document_status_id;

        # verify the Status
        if($status == DocumentStatusInterface::REJECTED) {
            return true;
        } else {
            return false;
        }
    }

  /**
   * Model has providerDocumentName
   * 
   * @return relation
   */
  public function providerDocumentName()
  {
    return $this->belongsTo(\App\Models\ProviderMandatoryDocument::class, 'provider_document_id', 'id');
  }
}
