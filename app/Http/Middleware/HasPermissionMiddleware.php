<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\MenuActivity;
use App\Models\UserPermission;

class HasPermissionMiddleware
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
        $request_route = \Request::route()->getName();
        if(auth()->user()->role == 'admin' || $request_route == 'admin.profile') {
            return $next($request);
        } else {
            $activity = MenuActivity::where('route_name',$request_route)->first();
            $activity_id = $activity->id;
                $condition = [
                'user_id' => auth()->user()->id,
                'activity_id' => $activity_id
            ];
            if(UserPermission::where($condition)->exists()) {
                return $next($request);
            } else {
                return redirect()->route('admin.profile')->with(dangerMessage('You have no permission to access this activity!'));
            }
        }
    }
}
