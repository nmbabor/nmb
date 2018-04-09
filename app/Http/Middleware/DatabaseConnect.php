<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class DatabaseConnect
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
        $customer='eshops';
        if($customer)
        {
            $dbname='ebusiness';
             $res = DB::select("show databases like '{$dbname}'");
             //return $res;
            if (count($res) == 0) {
                \App::abort(404);
            }
            \Config::set('database.connections.subdomain.database',$dbname);
            \Config::set('database.connections.subdomain.username','root');
            \Config::set('database.connections.subdomain.password','');
            DB::setDefaultConnection('subdomain');
        }
            
        return $next($request);
        }
}
