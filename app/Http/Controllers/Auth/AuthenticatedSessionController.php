<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Intentar autenticar al usuario
        $request->authenticate();

        // Regenera la sesión para proteger contra ataques de fijación de sesión.
        $request->session()->regenerate();

        // Obtén el usuario autenticado
        $user = auth()->user();

        // Verificar si el usuario está activo
        if ($user->activo != 1) {
            // Cerrar sesión si no está activo
            Auth::logout();
            
            // Redirigir al login con un mensaje de error
            return redirect()->route('login')->withErrors(['error' => 'Ya no tienes acceso al sistema.']);
        }

        // Redirige según el rol del usuario
        if ($user->es_administrador) {
            return redirect()->route('admin.dashboard'); // Redirigir al dashboard del administrador
        } elseif ($user->es_revisor) {
            return redirect()->route('revisor.dashboard'); // Redirigir al dashboard del revisor
        } else {
            return redirect()->route('docente.dashboard'); // Redirigir al dashboard del docente
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
