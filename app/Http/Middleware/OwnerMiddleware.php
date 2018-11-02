<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $user = User::find($request->id);

        if ($request->id != Auth::user()->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
