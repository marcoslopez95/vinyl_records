<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudApiInterfaz;
use App\Services\RecordService;
use Illuminate\Http\Request;

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
        return parent::_store($request->all());
    }

    public function show(int $record){
        return parent::_show($record);
    }

    public function update(int $record, Request $request){
        return parent::_update($record, $request->all());
    }

    public function destroy($record){
        return parent::_delete($record);
    }

}
