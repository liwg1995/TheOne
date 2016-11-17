<?php

namespace App\Http\Middleware;

use App\StudentToken;
use App\Token;
use Closure;
use Illuminate\Routing\Route;

class StudentLoginCheckMiddleware
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
        $tokenInstance = StudentToken::where('token', '=', $postToken)->where('expiredTime','>=',\Carbon\Carbon::now())->where('isValid', '=', true)->first();
        if (!$tokenInstance) {
            $a = StudentToken::where('token', '=', $postToken)->where('isValid', '=', true)->first();
            $a ->isValid = false;
            $a ->save();
            return view('notLogin');
        }
        else {
            $tokenInstance->expiredTime = date("Y-m-d H:i:s", strtotime("+1 day"));
            $request->student_id = $tokenInstance->student_id;
        }
        return $next($request);

    }
}

