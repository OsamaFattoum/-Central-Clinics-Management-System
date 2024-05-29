<?php

namespace App\Http\Middleware;

use App\Models\Case\CaseType;
use App\Models\Department\Department;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHasDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $departmentExist = Department::count();

        if (!$departmentExist) {
            session()->flash('no-department');
            return redirect()->route('departments.index');
        }

        return $next($request);
    }
}
