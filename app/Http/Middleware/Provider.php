<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Provider;

class Provider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
        # fetch The Provider Id
        $providerId = $request->header('id');
        
        # get the user Token
        $apiToken = Provider::where('id', $providerId)->pluck('token')->first();

        # get Request Token
        $authorizationToken = $request->header('Authorization');

        if($apiToken == '' OR $authorizationToken == '') {
            return response()->json([
            'message' => 'Unauthenticated User.',
            'code'    => '401',
            ]);
        }
        
        # Chek Api Token for vallidation
        if($apiToken == $authorizationToken){
          return $next($request);
        }

        return response()->json([
            'message' => 'Unauthenticated User.',
            'code'    => '401',
        ]);
        return $next($request);
    }
}
