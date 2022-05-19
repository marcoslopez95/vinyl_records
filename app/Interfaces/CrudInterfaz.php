<?php

namespace App\Interfaces;

interface CrudInterfaz {
    public function _index(array $data);
    public function _store(array $data);
    public function _show(int $id);
    public function _update(int $id, array $data);
    public function _delete(int $id);
}
