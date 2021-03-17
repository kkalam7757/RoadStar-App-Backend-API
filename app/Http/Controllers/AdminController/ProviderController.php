<?php

namespace App\Http\Controllers\AdminController;
use App\Models\Provider;
use App\Models\ProviderDocumentHistory;
use App\Models\ProviderDocument;
use App\Models\ProviderMandatoryDocument;
use App\Http\Interfaces\DocumentStatusHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;
use DB;

class ProviderController extends Controller implements DocumentStatusHistoryInterface
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'Provider';

 # Bind location
 protected $view = 'admin.provider.';

 # Bind providerDocument
 protected $providerDocument;

 # Bind Mandatory Documents For Provider
 protected $mandatoryDocumentsForProvider;

 # Variable to Bind Model providerNotification
 protected $providerNotification;

 /**
  * default constructor
  * @param
  * @return
  */
 function __construct(
                      Provider $Provider,
                      ProviderDocument $providerDocument,
                      ProviderMandatoryDocument $mandatoryDocumentsForProvider
                    )
 {
    $this->provider                           = $Provider;
    $this->providerDocument                   = $providerDocument;
    $this->mandatoryDocumentsForProvider      = $mandatoryDocumentsForProvider;
  }
 


 /**
  * index page of company
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function company(Request $request)
 { 
    $query = $this->provider->where('provider_type_id', '1')->orderBy('id');

    if ($request->name != '') {
       # code...
       $query = $query->where('name', $request->name)
                ->orWhere('email', '=', $request->name);
     }

     if ($request->status != '') {
       # code...
       $query = $query->where('status', $request->status);
     }
     
     $providers = $query->get();
     
   	 return view($this->view.'company')->with([
                                          'providers' => $providers, 
                                          'name'      => $request->name??'',
                                          'status'    => $request->status??''
                                      ]);
 }

 /**
  * index page of driver
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function driver(Request $request)
 { 
    $query = $this->provider->where('provider_type_id', '2')->orderBy('id');

    if ($request->name != '') {
       # code...
       $query = $query->where('name', $request->name)
                ->orWhere('email', '=', $request->name);
     }

     if ($request->status != '') {
       # code...
       $query = $query->where('status', $request->status);
     }
     
     $providers = $query->get();
     
     return view($this->view.'driver')->with([
                                          'providers' => $providers, 
                                          'name'      => $request->name??'',
                                          'status'    => $request->status??''
                                      ]);    
 }

 /**
  * index page of individual
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function individual(Request $request)
 { 
    $query = $this->provider->where('provider_type_id', '3')->orderBy('id');

    if ($request->name != '') {
       # code...
       $query = $query->where('name', $request->name)
                ->orWhere('email', '=', $request->name);
     }

     if ($request->status != '') {
       # code...
       $query = $query->where('status', $request->status);
     }
     
     $providers = $query->get();
     
     return view($this->view.'individual')->with([
                                                    'providers' => $providers, 
                                                    'name'      => $request->name??'',
                                                    'status'    => $request->status??''
                                                  ]);      
 }
 

/**
  * view provider profile and order history details  page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
*/
public function view($id)
{
  #Set the Relations on provider
  $relations = ['documents.histories'];

  # fetch Provider
  $provider =  $this->provider
                    ->with($relations)
                    ->where('id', $id)
                    ->first();
  
  # fetch the bank Details of Provider
  //$providerAccount =  $this->bankdetil->where('provider_id', $id)->first();
  
  // $AwardAndCertificate =  $this->AwardAndCertificate->where('provider_id', $id)->get();
    //$work_photos =  $this->WorkPhotos->where('provider_id', $id)->get();
  $providerDocuments = $provider->documents;
  //$providerServiceHistories = $this->order->where('provider_id', $id)->get();
//dd($AwardAndCertificate);
  return view($this->view.'history')->with([
                                            'provider'          =>  $provider,
                                            'providerAccount'   =>  1,
                                            'providerDocuments' =>  $providerDocuments,
                                            'AwardAndCertificate'   => 1,
                                            'providerServiceHistories' => 1,
                                            'work_photos' =>  1,

                                          ]);
  }


 /**
  * Slide butoon on/off page of provider
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */


 public function status(Request $request)
 {
   # initiate constructor

 // dd($id);
   $query =  $this->provider;

   # get the status 
   $status =  $query->where('id', $request->id)->first()->status;

   # check status, if active
   if ($status == '1') {
     # message
     $message = $this->inActiveMessage($this->type);

     # deactive( update status to zero)
     $statusCode = '0';
   } else {
     # message
     $message = $this->activeMessage($this->type);

     # active( update status to one)
     $statusCode = '1';
   }
   
   # update status code
   $query->where('id', $request->id)->update(['status' => $statusCode]);

   # return success
   return  [$this->successKey  =>  $this->successStatus,  $this->messageKey  => $message];
 }

 /**
  * delete provider
  * @param $id
  * @return \Illuminate\Http\Response
  */
 public function delete($id)
 {
   $query = $this->provider;

   # current provider
   $provider = Auth::guard('admin')->provider();

   #update deleted by
  // $query->where('id', $id)->update(['deleted_by' => $provider->id]);

   # delete provider by id
   $query->where('id', $id)->delete();
   
   # return success
   return  [$this->successKey  =>  $this->successStatus,  $this->messageKey  => $this->deleteMessage($this->type)];
 }

 /**
  * approve page
  * @param
  * @return
  */
 public function approvePage($id)
 {
   # code...
  return view($this->view.'status.approved')->with([
                                                    'id'          => $id,
                                                    //'provider_id' => $provider
                                                  ]);
 }

 /**
  * reject page
  * @param
  * @return
  */
 public function rejectPage($id)
 {
   # code...
  return view($this->view.'status.reject')->with([
                                                    'id'          => $id,
                                                    //'provider_id' => $provider
                                                  ]);
 }

 /**
  * post document status
  * @param
  * @return
  */
 public function postStatus(Request $request, $id, $status)
 {
    #fetch the ProviderDocument
    $providerDocument = $this->providerDocument
                             ->with(['provider.documents.histories'])
                             ->find($id);
    
    # Fetch Provider
    $provider = $providerDocument->provider;
   #dd($providerDocument); 
    # array data 
    $arrayData = [
                  'provider_document_id'  => $id ?? null,
                  'reason'                => $request->reason ?? null,
                  'document_status_id'    => $status ?? null,
                  'document_id'           => $providerDocument->document_id,
    ];

    DB::beginTransaction();

    # approve or reject with reason
    $create = ProviderDocumentHistory::create($arrayData);

    $docId = $create->document_id;
    # push notification
    
    # get the doc name
    $docName = $this->mandatoryDocumentsForProvider->where('id', $docId)->first()->name ?? '';

    # get the status
    if ($status == 2) {
      $statusName = 'Approved';
    } elseif($status == 3) {
      $statusName = 'Rejected';
    }

    # Fetch User
    $providerId = $providerDocument->provider_id;

    $provider = $this->provider->where('id', $providerId)->first();

    // # Notify provider for Order Successfully
    // $NotifyProvider = new NotifyProvider();

    // # Set Title message
    // $title = 'Mesee Document Notification';

    // # Set Message
    // $message = 'Your '. $docName. ' is ' .$statusName;


    // # Notify User
    // $NotifyProvider->notify($provider, $title, $message);
    
    // # Save Send Notification 
    // $data = [
    //     'provider_id'   => $providerId,
    //     'notification'  => $message,
    // ];

    // # Creta UserNotification
    // $this->providerNotification->create($data);

    #fetch the ProviderDocument
    $providerDocument = $this->providerDocument
                             ->with(['provider.documents.histories'])
                             ->find($id);

    # Fetch Provider
    $provider = $providerDocument->provider;

    # fetch All the mandatory Documents
    $mandatoryDocuments     = $this->mandatoryDocumentsForProvider->where('provider_type_id', $provider->provider_type_id)->get();

    # Fetch all the Mandatoru Document Ids
    $mandatoryDocumentsCount  = $mandatoryDocuments->count();

    # fetch allt he Uploaded Document sof Provider
    $allUplodedDocuments = $provider->documents;

    $acceptedDocumentCount = 0;
    foreach ($mandatoryDocuments as $key => $mandatoryDocument) {
      # fetch all the Document on mandatory document Id
      $documentOnMandatoryDocumentId = $allUplodedDocuments->where('document_id', $mandatoryDocument->id);

      if($documentOnMandatoryDocumentId->isNotEmpty()) {
        foreach ($documentOnMandatoryDocumentId as $key => $document) {
          $documentStatusHistory = $document->histories;
          if($documentStatusHistory->isNotEmpty()) {
            foreach ($documentStatusHistory as $key => $status) {
              if($status->document_status_id == DocumentStatusHistoryInterface::ACCEPT) {
                $acceptedDocumentCount = $acceptedDocumentCount + 1;
              }
            }
          }
        }
      }
    }
    if($mandatoryDocumentsCount == $acceptedDocumentCount) {
      $provider->update(['status' => true]);
    } else {
      $provider->update(['status' => false]);
    }

    DB::commit();

    if ($create) {
      # code...
      $output = ['success' => 200, 'message' => 'Success'];
      return redirect()->back();
    } else {
      $output = ['error' => 100, 'message' => 'Failed'];
    }
    // return $output;
  }
  /******** End Class ******************/
}