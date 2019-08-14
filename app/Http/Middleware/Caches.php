<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cache;
use Closure;

class Caches
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
        $res = $code1 = cache::get('user');
        if (empty($res)) {
            echo '<script>alert("请先登录");window.location.href="/user/login";</script>';
            exit;
        }
        return $next($request);
    }
}
