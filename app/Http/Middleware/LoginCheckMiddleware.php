<?php

namespace App\Http\Middleware;

use App\Token;
use Closure;

class LoginCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $postToken = $request->token;
        $tokenInstance = Token::where('token', '=', $postToken)->where('expiredTime','>=',\Carbon\Carbon::now())->where('isValid', '=', true)->first();
        if (!$tokenInstance) {
            return response()->json([
                'status' => 'NOT_LOGGED_IN',
                'content' => ''
            ]);
        }
        else {
            $tokenInstance->expiredTime = date("Y-m-d H:i:s", strtotime("+30 day"));
            $request->administrator_id = $tokenInstance->administrator_id;
        }
        return $next($request);
    }
}

