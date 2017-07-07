<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class BuyerOrBoth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {

        if ($this->auth->guest()) {
            return $next($request);
        }

        if (\Auth::user()->getAttributeValue('role') == 'buyer' || \Auth::user()->getAttributeValue('role') == 'both') {
            dd("balta");
            return $next($request);
        } else {
            if ($request->ajax()) {
                return response('Unauthorized . ', 401);
            } else {
                //                return redirect('/dashboard');
                return redirect()->back();
            }
        }


    }
}
