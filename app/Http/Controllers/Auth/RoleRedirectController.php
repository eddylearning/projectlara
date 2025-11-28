<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RoleRedirectController extends Controller
{
    public function __invoke()
    {
        $role = Auth::user()->role;

        // Redirect based on user role
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'employee' => redirect()->route('employee.dashboard'),
            'user' => redirect()->route('user.dashboard'),
            default => abort(403, 'Unauthorized role'),
        };
    }
}
