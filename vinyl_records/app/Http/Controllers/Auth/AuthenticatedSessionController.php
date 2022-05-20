<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        try{
            $credentials = $request->only(['email','password']);
            if (!Auth::attempt($credentials)){
                return custom_response(false,'Contraseña incorrecta',[],425);
            }

            $user = Auth::user();
            $tokenResult = $user->createToken('Personal Access Token');

            $token = $tokenResult->plainTextToken;
            $token = explode('|',$token);
            $response = [
                'token' => $token[1],
                'type' => 'Bearer',
                'first_name' => $user->first_name,
                'rol' => $user->rol->name,
                'expired' => Carbon::now()->addDay()
            ];

            return custom_response(true,'Login',$response );
        }catch(\Exception $e){
            return custom_error($e);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
