<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Periksa apakah pengguna memiliki setidaknya satu dari dua peran yang diizinkan
        $allowedRoles = array_slice($roles, 0, 2); // Mengambil 2 peran pertama
        $hasAllowedRole = false;
        foreach ($allowedRoles as $allowedRole) {
            if ($user->hasRole($allowedRole)) {
                $hasAllowedRole = true;
                break;
            }
        }

        if (!$hasAllowedRole) {
            abort(403, 'Unauthorized action.');
        }


        return $next($request);
    }
}
