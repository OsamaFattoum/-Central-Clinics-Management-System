<?php

namespace App\Http\Middleware;

use App\Models\Case\CaseType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHasCaseType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $caseTypeExist = CaseType::where('department_id',$request->department->id)->count();

        if (!$caseTypeExist) {
            session()->flash('no-case_type');
            return redirect()->route('patients.show',['patient'=>$request->patient->id]);
        }

        return $next($request);
    }
}
