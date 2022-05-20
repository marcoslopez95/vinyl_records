<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    protected $fillable= [
        'name'
    ];

    /**
     * The users that belong to the Genre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The records that belong to the Genre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function records()
    {
        return $this->belongsToMany(Record::class);
    }
}
