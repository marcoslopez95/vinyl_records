<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        DB::beginTransaction();
        try{
            if(Auth::user() && Auth::user()->rol->id != 1){
                throw new \Exception("No tiene permisos para registrar usuarios");
            }
            $validate = Validator::make(
                $request->all(),
                [
                    'email'         => 'required|string|email|max:255|unique:users',
                    'password'      => 'required|min:8|confirmed',
                    'first_name'    => 'required|string',
                    'last_name'     => 'required|string',
                    'phone'         => 'required|string',
                    'avatar_'        => 'required|string',
                    'tastes'        => 'required|array',
                    'tastes.*'      => 'exists:genres,id'
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
            // $request['avatar'] = create_image($request->avatar_);
            $img = $request->avatar_;
            $now = Carbon::now()->format('Y-m-d');
            $pos = strpos($img, ';');
            $type = explode(':', substr($img, 0, $pos))[1];
            $ext = preg_split("[/]", $type);
            $img = str_replace('data:image/'.$ext[1].';base64,', '', $img);
            $img_ = base64_decode($img);
            $var_for = uniqid().'-'.$now. '.'.$ext[1];
            $success = Storage::put('public/'.$var_for, $img_);
            $request['avatar'] = '/storage/'.$var_for;
            //
            $data = $request->all();
            if(Auth::user() && $request->rol_id == 1){
                unset(
                    $data['tastes']
                );
            }else{
                unset(
                    $data['rol_id']
                );
            }

            $user = User::create($data);
            if((Auth::user() && $request->rol_id == 2) || Auth::guest()){
                $user->tastes()->attach($request->tastes);
            }
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
            DB::commit();
            return custom_response(true,'Registrado',$message);
        }catch(\Exception $e){
            DB::rollback();
            return custom_error($e);
        }
    }
}
