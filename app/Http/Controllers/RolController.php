<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudApiInterfaz;
use App\Services\RolService;
use Illuminate\Http\Request;

class RolController extends BaseController implements CrudApiInterfaz
{
    public function __construct(RolService $service)
    {
        parent::__construct($service);
    }

    public function index(Request $request){
        return parent::_index($request->all());
    }

    public function store(Request $request){
        return parent::_store($request->all());
    }

    public function show(int $rol){
        return parent::_show($rol);
    }

    public function update(int $rol, Request $request){
        return parent::_update($rol, $request->all());
    }

    public function destroy($rol){
        return parent::_delete($rol);
    }

}
