<?php

// app/Http/Middleware/CheckPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, string $permission)
    {
        if (!Auth::check() || !Auth::user()->hasPermission($permission)) {
            session()->flash('permission_denied', true);
            return redirect()->back(); // Redirect instead of abort
        }

        return $next($request);
    }

}

