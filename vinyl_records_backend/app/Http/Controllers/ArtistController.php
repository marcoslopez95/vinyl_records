<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudApiInterfaz;
use App\Services\ArtistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtistController extends BaseController implements CrudApiInterfaz
{
    public function __construct(ArtistService $service)
    {
        parent::__construct($service);
    }

    public function index(Request $request){
        return parent::_index($request);
    }

    public function store(Request $request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3'
            ],
            [
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

    public function show(int $artist){
        return parent::_show($artist);
    }

    public function update(int $artist, Request $request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3'
            ],
            [
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
        return parent::_update($artist, $request->all());
    }

    public function destroy($artist){
        return parent::_delete($artist);
    }

}
