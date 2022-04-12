<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class LastSeen
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
        if (JWTAuth::check()) {
            $expireTime = Carbon::now()->addMinute(1); // keep online for 1 min
            Cache::put('is_online'.JWTAuth::user()->id, true, $expireTime);

            //Last Seen
            User::where('id', JWTAuth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        return $next($request);
    }
}
