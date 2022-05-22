<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudApiInterfaz;
use App\Services\AlbumService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlbumController extends BaseController implements CrudApiInterfaz
{
    public function __construct(AlbumService $service)
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

    public function show(int $album){
        return parent::_show($album);
    }

    public function update(int $album, Request $request){
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
        return parent::_update($album, $request->all());
    }

    public function destroy($album){
        return parent::_delete($album);
    }

}
