<?php

namespace App\Http\Middleware;

use Closure;

class Token
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

        
        $all_hrader= $request->headers->all(); 

        if (!in_array( 'application/json',$all_hrader['accept']))
        {

            $response["status"]=500;
            $response["error"]="Accept Parameter Must Be Application/json";
             return response()->json($response);

        }
        if (!isset($all_hrader['api-token'])) {
             $response["status"]=500;
             $response["error"]="Api Token Not Send";
           //  var_dump($all_hrader['api_token']);
             return response()->json($response);
        }


        if (trim($all_hrader['api-token'][0]) !=config('constants.token')) {
             $response["status"]=501;
             $response["error"]="Api Token Not Avalable";
           //  var_dump($all_hrader['api_token']);
             return response()->json($response);
        }
       


        

        return $next($request);
    }
}
