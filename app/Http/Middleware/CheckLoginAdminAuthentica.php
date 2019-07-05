<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdminAuthentica
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
        if (Auth::guard($guard)->check()) {
            $request->session()->flash('thongbao', __('Bạn Phải Đăng Xuất Trước Đã.'));
            return redirect('dashboard/');
        }

        return $next($request);
    }
}
