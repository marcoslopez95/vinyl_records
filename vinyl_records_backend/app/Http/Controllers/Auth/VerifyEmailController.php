<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke($code)
    {
        $user = User::where('confirmation_code',$code)->first();

        if($user){
            return 'Correo validado, por favor inicia sesión';
        }

        return 'Código invalido';
    }
}
