<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Interfaces\CrudApiInterfaz;
use App\Services\GenreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GenreController extends BaseController implements CrudApiInterfaz
{
    public function __construct(GenreService $service)
    {
        parent::__construct($service);
    }

    public function index(Request $request){
        return parent::_index($request->all());
    }

    public function store(Request $request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'unique:genres|required|string|min:3'
            ],
            [
                'unique'    => 'Ya existe un género músical con ese nombre',
                'required'  => 'El :attribute es requerido',
                'string'    => 'El :attribute debe ser un string',
                'min'       => 'El :attribute debe ser mínimo de 3 caractéres'
            ],
            [
                'name' => 'nombre'
            ]
            );
        if($validate->fails()){
            $first_error = $validate->getMessageBag()->first();
            return custom_response(false, 'Error de validación',$first_error);
        }
        return parent::_store($request->all());
    }

    public function show(int $genre){
        return parent::_show($genre);
    }

    public function update(int $genre, Request $request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => [Rule::unique('genres')->ignore($genre),'required','string','min:3']
            ],
            [
                'unique'    => 'Ya existe un género músical con ese nombre',
                'required'  => 'El :attribute es requerido',
                'string'    => 'El :attribute debe ser un string',
                'min'       => 'El :attribute debe ser mínimo de 3 caractéres'
            ],
            [
                'name' => 'nombre'
            ]
            );
        if($validate->fails()){
            $first_error = $validate->getMessageBag()->first();
            return custom_response(false, 'Error de validación',$first_error);
        }
        return parent::_update($genre, $request->all());
    }

    public function destroy($genre){
        return parent::_delete($genre);
    }

}
