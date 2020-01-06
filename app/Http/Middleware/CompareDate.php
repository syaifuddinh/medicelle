<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class CompareDate
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
        if(!isset($request->date_end)) {
            $request->date_end = '2090-01-01';
        }            

        if(!isset($request->date_start)) {
            $request->date_start = '1945-01-01';
        }            

        if(isset($request->date_start) AND isset($request->date_end)) {
            $start = Carbon::parse($request->date_start);
            $end = Carbon::parse($request->date_end);

            if($start->gt($end)) {
                $request->date_start = $end->format('Y-m-d');
                $request->date_end = $start->format('Y-m-d');
            }
            else {
                return $next($request);
            }
        }
        
        return $next($request);
    }
}
