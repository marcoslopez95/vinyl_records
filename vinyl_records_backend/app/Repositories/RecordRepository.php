<?php

namespace App\Repositories;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Record;

class RecordRepository extends BaseRepository{

    public function __construct(Record $model)
    {
        parent::__construct($model);
    }

    public function _index($data)
    {
        $records = $this->model::addSelect([
            'artist_name' => Artist::select('name')->whereColumn('artists.id','records.artist_id'),
            'album_name'  => Album::select('name')->whereColumn('albums.id','records.album_id')
        ])->Filtro($data)->get();

        return $records;
    }

    public function _show(int $id)
    {
        $record = parent::_show($id);
        $record->load('genres');
        return $record;
    }

    public function _delete(int $id)
    {
        $record = $this->_show($id);
        // if ($record->trashed()) {
        //     return $record->forceDelete();
        // }
        return parent::_delete($id);
    }
}
