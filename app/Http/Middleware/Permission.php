<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use Auth;

class Permission
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
    	$user = Auth::user();
		$user_type = $user->user_type;

		if($user_type == 'customer'){
			return back();
		}
		
		if($user_type == 'user'){
			$route_name = \Request::route()->getName();

			/** If User Type = Staff **/
			if( $route_name != '' && $user_type == 'user'){
				
				if(explode(".",$route_name)[1] == "update"){
					$route_name = explode(".",$route_name)[0].".edit";
				}else if(explode(".",$route_name)[1] == "store"){
					$route_name = explode(".",$route_name)[0].".create";
				}
				if( ! has_permission($route_name)){
					if( ! $request->ajax()){
					   return back()->with('error',_lang('Permission denied !'));
					}else{
					   return new Response('<h4 class="text-center red">'._lang('Permission denied !').'</h4>');
					}
				}
			}

		}
			
        return $next($request);
    }
}
