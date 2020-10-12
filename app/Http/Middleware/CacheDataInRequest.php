<?php

namespace App\Http\Middleware;

use App\PrinterPhotoRole;
use Closure;
use Illuminate\Http\Request;

class CacheDataInRequest
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
        $request->merge([
            'printerphotoroles' => PrinterPhotoRole::all()->keyBy('name')
        ]);
        return $next($request);
    }
}
