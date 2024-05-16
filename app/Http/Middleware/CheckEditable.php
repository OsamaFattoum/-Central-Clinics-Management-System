<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEditable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $typeRequest = ''): Response
    {
        $model = empty($typeRequest) ? abort(403) : $request->route($typeRequest);
    
        // Check if model was created more than 5 minutes ago
        if (Carbon::parse($model->created_at)->addMinutes(5)->isPast()) {
            abort(403);
        }

        return $next($request);
    }
}
