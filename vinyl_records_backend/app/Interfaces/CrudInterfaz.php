<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CrudInterfaz {
    public function _index(Request $data);
    public function _store(array $data);
    public function _show(int $id);
    public function _update(int $id, array $data);
    public function _delete(int $id);
}
