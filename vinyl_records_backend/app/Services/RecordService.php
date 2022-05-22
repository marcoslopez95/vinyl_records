<?php

namespace App\Services;

use App\Repositories\RecordRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RecordService extends BaseService
{

    public function __construct(RecordRepository $repository)
    {
        parent::__construct($repository);
    }

    public function _store(array $data)
    {
        $img = $data['cover_photo_'];
        $now = Carbon::now()->format('Y-m-d');
        $pos = strpos($img, ';');
        $type = explode(':', substr($img, 0, $pos))[1];
        $ext = preg_split("[/]", $type);
        $img = str_replace('data:image/' . $ext[1] . ';base64,', '', $img);
        $img_ = base64_decode($img);
        $var_for = uniqid() . '-' . $now . '.' . $ext[1];
        $success = Storage::put('public/' . $var_for, $img_);
        $data['cover_photo'] = '/storage/' . $var_for;
        unset($data['cover_photo_']);

        $record = parent::_store($data);
        $record->genres()->attach($data['genres']);
        return $record;
    }

    public function _update(int $id, array $data)
    {
        $record = $this->_show($id);
        if ($data['cover_photo_'] != $record->cover_photo) {
            $img = $data['cover_photo_'];
            $now = Carbon::now()->format('Y-m-d');
            $pos = strpos($img, ';');
            $type = explode(':', substr($img, 0, $pos))[1];
            $ext = preg_split("[/]", $type);
            $img = str_replace('data:image/' . $ext[1] . ';base64,', '', $img);
            $img_ = base64_decode($img);
            $var_for = uniqid() . '-' . $now . '.' . $ext[1];
            $success = Storage::put('public/' . $var_for, $img_);
            $data['cover_photo'] = '/storage/' . $var_for;
            unset($data['cover_photo_']);
        }
        $record->genres()->sync($data['genres']);
        parent::_update($id, $data);
    }

    public function _show(int $id)
    {
        $record = parent::_show($id);
        $record['cover_photo'] = $record['cover_photo'] != '' ?
            env('APP_URL') . $record->cover_photo : null;

        $genres = $record->genres->modelKeys();
        unset($record['genres']);
        $record['genres'] = $genres;
        return $record;
    }
}
