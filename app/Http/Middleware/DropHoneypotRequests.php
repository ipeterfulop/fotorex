<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DropHoneypotRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->get('h_email_h') != null)  {
            if ($request->isXmlHttpRequest()) {
                abort(200);
            }
            return redirect()->back()->withInput();
        }
        return $next($request);
    }
}
