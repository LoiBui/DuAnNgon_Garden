<?php

namespace App\Http\Middleware;

use Closure;

class CheckQuyenNhaBep
{
    public function handle($request, Closure $next, $guard = 'web')
    {
        $admin = Auth()->guard($guard)->user();
        if($admin->quyen == QUYEN_NHA_BEP || $admin->quyen == QUYEN_ADMIN)
        {
            return $next($request);
        }
        $request->session()->flash('thongbao', __('Bạn Không có quyền vào chức năng đó.'));
        return redirect('dashboard');
    }
}
