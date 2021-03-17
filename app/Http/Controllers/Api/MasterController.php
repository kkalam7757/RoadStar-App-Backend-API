<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Service;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\SizeOfLoad;
use Illuminate\Http\Request;
use App\Models\ProviderType;
use App\Models\ServiceMedium;
use App\Http\Traits\StatusTrait;
use App\Http\Controllers\Controller;
use App\Models\ProviderMandatoryDocument;

class MasterController extends Controller
{
  use StatusTrait;

  /**
   * fetch service type
   * @param Illuminate\Http\Request;
   * @return json response;
   */
  public function serviceType(Request $request)
  {
  	$serviceTypes = Service::where('status', '1')->get();
   
  	  foreach ($serviceTypes as $serviceType) {
  	  	
  	  	$data[] = [
  	  		         'id'   => (String)$serviceType->id ?? '',
                     'name' => (String)$serviceType->name ?? '',
  	  	];
  	  }
      
      if (isset($data)) {
       # return 
       return response()->json([
                                'message' => 'Service Type',
                                'code'    => $this->successStatus,
                                'data'    => $data
       ]);      	
      } else {
       return response()->json([
                               'message'=> 'No Data found',
                               'code'   => $this->failedStatus   
      ]);      	
      }
  }

  /**
   * fetch service medium
   * @param Illuminate\Http\Request;
   * @return json response;
   */
  public function serviceMedium(Request $request)
  {
    # Validate request data
    $validator = Validator::make($request->all(), [ 
        'service_id' => 'required|numeric'
    ]);

    # If validator fails return response
    if ($validator->fails()) { 
        return response()->json(['message'=> $validator->errors()], $this->failedStatus);            
    }

  	$serviceMediums = ServiceMedium::where('service_id', $request->get('service_id'))->where('status', '1')->get();
   
  	  foreach ($serviceMediums as $serviceMedium) {
  	  	
  	  	$data[] = [
  	  		         'id'         => (String)$serviceMedium->id ?? '',
                     'service_id' => (String)$serviceMedium->service_id ?? '',
                     'name'       => (String)$serviceMedium->name ?? '',
  	  	];
  	  }
      
      if (isset($data)) {
       # return 
       return response()->json([
                                'message' => 'Service Medium',
                                'code'    => $this->successStatus,
                                'data'    => $data
       ]);      	
      } else {
       return response()->json([
                               'message'=> 'No Data found',
                               'code'   => $this->failedStatus   
       ]);      	
      }
  }

  /**
   * fetch provider type
   * @param Illuminate\Http\Request;
   * @return json response;
   */
  public function providerType(Request $request)
  {
  	$providerTypes = ProviderType::where('status', '1')->get();
   
  	  foreach ($providerTypes as $providerType) {
  	  	
  	  	$data[] = [
  	  		         'id'   => (String)$providerType->id ?? '',
                     'name' => (String)$providerType->name ?? '',
  	  	];
  	  }
      
      if (isset($data)) {
       # return 
       return response()->json([
                                'message' => 'Provider Type',
                                'code'    => $this->successStatus,
                                'data'    => $data
       ]);      	
      } else {
       return response()->json([
                               'message'=> 'No Data found',
                               'code'   => $this->failedStatus   
      ]);      	
      }
  }

  /**
   * fetch size of load
   * @param Illuminate\Http\Request;
   * @return json response;
   */
  public function sizeOfLoad(Request $request)
  {
  	$sizeOfLoads = SizeOfLoad::where('status', '1')->get();
   
  	  foreach ($sizeOfLoads as $sizeOfLoad) {
  	  	
  	  	$data[] = [
  	  		         'id'   => (String)$sizeOfLoad->id ?? '',
                     'name' => (String)$sizeOfLoad->name ?? '',
  	  	];
  	  }
      
      if (isset($data)) {
       # return 
       return response()->json([
                                'message' => 'Size of load',
                                'code'    => $this->successStatus,
                                'data'    => $data
       ]);      	
      } else {
       return response()->json([
                               'message'=> 'No Data found',
                               'code'   => $this->failedStatus   
      ]);      	
      }
  }

  /**
   * fetch company mandatory  doc
   * @param Illuminate\Http\Request;
   * @return json response;
   */
  public function mandatoryDocumentForCompany(Request $request)
  {
    # fetch company mandatory  doc
    $providerMandatoryDocuments = ProviderMandatoryDocument::where('provider_type_id', '1')
                                                           ->where('status', '1')
                                                           ->get();
   
      foreach ($providerMandatoryDocuments as $providerMandatoryDocument) {
        
        $data[] = [
                   'id'               => (String)$providerMandatoryDocument->id ?? '',
                   'name'             => (String)$providerMandatoryDocument->name ?? '',
        ];
      }
      
      if (isset($data)) {
       # return 
       return response()->json([
                                'message' => "Company's Mandatory Documents",
                                'code'    => $this->successStatus,
                                'data'    => $data
       ]);        
      } else {
       return response()->json([
                               'message'=> 'No Data found',
                               'code'   => $this->failedStatus   
       ]);        
      }
  }

  /**
   * fetch driver mandatory  doc
   * @param Illuminate\Http\Request;
   * @return json response;
   */
  public function mandatoryDocumentForDriver(Request $request)
  {
    # fetch driver mandatory  doc
    $providerMandatoryDocuments = ProviderMandatoryDocument::where('provider_type_id', '2')
                                                           ->where('status', '1')
                                                           ->get();
   
      foreach ($providerMandatoryDocuments as $providerMandatoryDocument) {
        
        $data[] = [
                   'id'               => (String)$providerMandatoryDocument->id ?? '',
                   'name'             => (String)$providerMandatoryDocument->name ?? '',
        ];
      }
      
      if (isset($data)) {
       # return 
       return response()->json([
                                'message' => "Driver's Mandatory Documents",
                                'code'    => $this->successStatus,
                                'data'    => $data
       ]);        
      } else {
       return response()->json([
                               'message'=> 'No Data found',
                               'code'   => $this->failedStatus   
       ]);        
      }
  }

  /** 
   * fetch individual mandatory  doc
   * @param Illuminate\Http\Request;
   * @return json response;
   */
  public function mandatoryDocumentForIndividual(Request $request)
  {
    # fetch individual mandatory  doc
    $providerMandatoryDocuments = ProviderMandatoryDocument::where('provider_type_id', '3')
                                                           ->where('status', '1')
                                                           ->get();
   
      foreach ($providerMandatoryDocuments as $providerMandatoryDocument) {
        
        $data[] = [
                   'id'               => (String)$providerMandatoryDocument->id ?? '',
                   'name'             => (String)$providerMandatoryDocument->name ?? '',
        ];
      }
      
      if (isset($data)) {
       # return 
       return response()->json([
                                'message' => "Individual's Mandatory Documents",
                                'code'    => $this->successStatus,
                                'data'    => $data
       ]);        
      } else {
       return response()->json([
                               'message'=> 'No Data found',
                               'code'   => $this->failedStatus   
       ]);        
      }
  }




    /**
     * Get All countries
     * 
     * @param
     */
    public function allCountries()
    { 
        # fetch countries.
        $countriesDB  =  Country::all();

        if ($countriesDB->isNotEmpty()) {
            foreach ($countriesDB as $countriesDBValue) {
                $countries[]    =   [
                                        'country_id'  =>  (String)$countriesDBValue->id ?? '',
                                        'name'        =>  (String)$countriesDBValue->name ?? '',
                                    ];
            }
        } else {
                $countries  =  [];
        }

        # return success message.
        return response()->json([
                                    'message' => "country list",
                                    'code'    => $this->successStatus,
                                    'data'    => $countries
                                ]); 
    }

     /**
     * Get All states
     * 
     * @param
     */
    public function allStates(Request $request)
    { 
        //dd($request->country_id);
        # fetch states.     
        $statesDB  =  State::where('country_id', $request->country_id)->get();    

        if ($statesDB->isNotEmpty()) {
            foreach ($statesDB as $statesDBValue) {
                $states[]    =   [
                                        'country_id'  =>  (String)$statesDBValue->country_id ?? '',
                                        'state_id'    =>  (String)$statesDBValue->id ?? '',
                                        'name'        =>  (String)$statesDBValue->name ?? '',
                                    ];
            }
        } else {
               $states  =  [];
        }

        # return success message.
        return response()->json([
                                    'message' => "state list",
                                    'code'    => $this->successStatus,
                                    'data'    => $states
                                ]); 
    }

        /**
     * Get All citites
     * 
     * @param
     */
    public function allCities(Request $request)
    {
        # fetch cities.
        //$citiesDB  =  $this->cities->all();
        $query = new City;
        if($request->state_id != ''){
           $query = $query->where('state_id', $request->state_id); 
        }
        
        $citiesDB  = $query->get();

        if ($citiesDB->isNotEmpty()) {
            foreach ($citiesDB as $citiesValue) {
                $cities[]    =      [
                                        'state_id'      =>  (String)$citiesValue->state_id ?? '',
                                        'city_id'       =>  (String)$citiesValue->id ?? '',
                                        'name'          =>  (String)$citiesValue->name ?? '',
                                    ];
            }
        } else {
                $cities  =  [];
        }

        # return success message.
        return response()->json([
                                'message' => "city list",
                                'code'    => $this->successStatus,
                                'data'    => $cities
                                ]); 
    }





///////////////////////////////////////////////////////  
  
}
