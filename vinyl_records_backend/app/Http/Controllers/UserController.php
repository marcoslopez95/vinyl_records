<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Interfaces\CrudApiInterfaz;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    public function __construct(userService $service)
    {

        parent::__construct($service);
    }
    public function index(Request $request){
        if(Auth::user()->rol->id != 1){
            return custom_response(false,'unauthorized');
        }
        return parent::_index($request->all());
    }

    public function show(int $user){
        if(Auth::user()->rol->id != 1){
            return custom_response(false,'unauthorized');
        }
        return parent::_show($user);
    }

    public function update(int $user, Request $request){
        if(Auth::user()->rol->id != 1 && Auth::user()->id != $user){
            return custom_response(false,'No tiene permisos para editar este usuario');
        }
        $validate = Validator::make(
            $request->all(),
            [
                'email'         => ['required','string','email','max:255',Rule::unique('users')->ignore($user)],
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

        $data = (Auth::user()->rol->id != 1) ? $request->except('rol_id')
                    : $request->all();

        return parent::_update($user, $data);
    }

    public function destroy($user){
        if(Auth::user()->rol->id != 1){
            return custom_response(false,'unauthorized');
        }
        return parent::_delete($user);
    }

}
