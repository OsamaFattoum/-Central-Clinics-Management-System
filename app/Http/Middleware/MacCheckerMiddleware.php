<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MacCheckerMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {

        $macAddresses = json_decode(env('MAC_AVAILABLE'), true);

        if (!session()->has('macAddress')) {
            $clientMacAddress = $this->getMacAddress();
        
            if (in_array($clientMacAddress, $macAddresses)) {
                session()->put('macAddress', $clientMacAddress);
                return $next($request);
            }
        } else {
            $sessionMacAddress = session('macAddress');
        
            if (in_array($sessionMacAddress, $macAddresses)) {
                return $next($request);
            }
        }
        
        return response()->view('errors.404');
        
        
    }//end of handle

    private function getMacAddress()
    {
        $macAddr = exec('getmac');

        $hyphenPos = strpos($macAddr, '-');

        return substr($macAddr, $hyphenPos - 2, 17);
    }//end of getMacAddress
}
