<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try{
            $validate = Validator::make(
                $request->all(),
                [
                    'email'         => 'required|string|email|max:255|unique:users',
                    'password'      => 'required|min:8|confirmed',
                    'first_name'    => 'required|string',
                    'last_name'     => 'required|string',
                    'phone'         => 'required|string',
                    'avatar'        => 'required|string',
                ],
                [
                    'required'  => 'El :attribute es requerido',
                    'string'    => 'El :attribute debe ser texto',
                    'email'     => 'No es un correo valido',
                    'unique'    => 'El correo ya está registrado',
                    'min'       => 'La contraseña debe ser de al menos 8 caracteres',
                    'confirmed' => 'Las contraseñas no coinciden'
                ]
                );

                if($validate->fails()){
                    $first_error = $validate->getMessageBag()->first();
                    return custom_response(false, 'Error de validación',$first_error);
                }

            $request['password'] = Hash::make($request->password);
            $request['confirmation_code'] = Str::random(255);
            $user = User::create($request->all());

           // event(new Registered($user));
            $token = $user->createToken('API Token')->plainTextToken;
            $token = explode('|',$token);
            $message= [
                'expired' => Carbon::now()->addDay(),
                'token'   => $token[1],
                'type'    => 'Bearer'
            ];

            Mail::send('emails.confirmation_code', $request->all(), function($message) use ($request) {
                $message->to($request['email'], $request['first_name'])->subject('Por favor confirma tu correo');
            });

            return custom_response(true,'Registrado',$message);
        }catch(\Exception $e){
            return custom_error($e);
        }
    }
}
