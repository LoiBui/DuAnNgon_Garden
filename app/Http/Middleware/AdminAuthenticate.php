<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        $segments = $request->segments();
        $currentURL= implode('/', $segments);
        if(Auth::guard($guard)->guest())
        {
            $request->session()->flash('thongbao', __('Truy cập bị chặn, Bạn phải đăng nhập trước.'));
            return redirect('dangnhap');
        }
        return $next($request);
    }
}
