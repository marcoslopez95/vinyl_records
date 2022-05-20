<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudApiInterfaz;
use App\Services\RecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecordController extends BaseController implements CrudApiInterfaz
{
    public function __construct(RecordService $service)
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
                'name'          => 'required|string|min:2',
                'album_id'      => 'required|numeric|exists:albums,id',
                'cover_photo'   => 'required|string',
                'artist_id'     => 'required|exists:artists,id',
                'year'          => 'required|string|size:4',
                'genres'        => 'required|array',
                'genres.*'      => 'numeric|exists:genres,id'
            ],
            [
                'required'      => 'El campo :attribute es requerido',
                'string'        => 'El campo :attribute debe ser un texto',
                'min'           => 'El campo :attribute debe tener mínimo 3 caracteres',

                'numeric'       => 'El campo :attribute debe ser un número',
                'exists'        => 'El campo :attribute no existe en la base de datos',
                'size'          => 'El campo :attribute debe ser de :value caracteres',
                'array'         => 'El campo :attribute debe ser un arreglo',
            ],
        );

        if($validate->fails()){
            $first_error = $validate->getMessageBag()->first();
            return custom_response(false, 'Error de validación',$first_error);
        }
        return parent::_store($request->all());
    }

    public function show(int $record){
        return parent::_show($record);
    }

    public function update(int $record, Request $request){
        $validate = Validator::make(
            $request->all(),
            [
                'name'          => 'required|string|min:2',
                'album_id'      => 'required|numeric|exists:albums,id',
                'cover_photo'   => 'required|string',
                'artist_id'     => 'required|exists:artists,id',
                'year'          => 'required|string|size:4',
                'genres'        => 'required|array|min:1',
                'genres.*'      => 'numeric|exists:genres,id'
            ],
            [
                'required'      => 'El campo :attribute es requerido',
                'string'        => 'El campo :attribute debe ser un texto',
                'min'           => 'El campo :attribute debe tener mínimo 3 caracteres',
                'numeric'       => 'El campo :attribute debe ser un número',
                'exists'        => 'El campo :attribute no existe en la base de datos',
                'size'          => 'El campo :attribute debe ser de :value caracteres',
                'array'         => 'El campo :attribute debe ser un arreglo',
            ],
        );

        if($validate->fails()){
            $first_error = $validate->getMessageBag()->first();
            return custom_response(false, 'Error de validación',$first_error);
        }
        return parent::_update($record, $request->all());
    }

    public function destroy($record){
        return parent::_delete($record);
    }

}
