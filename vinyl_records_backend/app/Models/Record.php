<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'album_id',
        'cover_photo',
        'artist_id',
        'year'
    ];

    /**
     * The genres that belong to the Record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Get the artist that owns the Record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the album that owns the Record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function scopeFiltro($query, $request){
        return $query->when($request->artist,function($q,$artist){
            $q->whereHas('artist',function(Builder $q2) use ($artist){
                $q2->where('name','like',"%$artist%");
            })
            ;
        })
        ->when($request->album,function($q,$album){
            $q->whereHas('album',function(Builder $q2) use ($album){
                $q2->where('name','like',"%$album%");
            })
            ;
        })
        ->when($request->year,function($q,$year){
            $q->when('year',$year);
        })
        ->when($request->name,function($q,$name){
            $q->where('name','like',"%$name%");
        })
        ->when($request->deleted,function($q,$deleted){
            $deleted = Carbon::parse($deleted)->format('Y-m-d');
            $q->onlyTrashed()
                ->whereDate('deleted_at', $deleted);
        })
        ;
    }
}
