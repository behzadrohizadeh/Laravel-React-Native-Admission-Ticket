<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use View;
use Closure;
class Role
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
    
            $user_key=$request->session()->get('lg_key');
            if (empty( $user_key)) {
               return redirect()->to('/login');
            }

            $user = DB::table('users')
            ->leftJoin("roles","roles.id_role","users.id_role")
            ->select("roles.caps as caps","roles.id_role","users.avatar","users.id","users.name")
            ->where('active_key', $user_key)
            ->get();

            if (count($user)!=1) {
               return redirect()->to('/login');
            }
             if (!empty($user)) {
                if ( $user[0]->id_role!=1) {
                $roles= config('constants.caps');
                $caps= $user[0]->caps; 
                $action = $request->route()->getAction();
                $controller = class_basename($action['controller']);
                $class= explode('@', $controller);
                 if (!in_array($class[0], explode(',', $caps))) {
                    return redirect()->to('/permission');
                 }
             }
            }
              View::share('userdata',$user[0]);

  
        return $next($request);
    }
}
