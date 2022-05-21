<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CrudApiInterfaz {
    public function index(Request $request);
    public function store(Request $request);
    public function show(int $id);
    public function update(int $id, Request $data);
    public function destroy(int $id);
}
