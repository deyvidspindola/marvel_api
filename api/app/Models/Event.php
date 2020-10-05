<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['creator_id','title','description','urls','start','end','thumbnail'];

    public function comics()
    {
        return $this->belongsToMany(Comic::class);
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class, 'creator_event');
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function stories()
    {
        return $this->belongsToMany(Story::class);
    }

    public function series()
    {
        return $this->belongsToMany(Series::class);
    }

}
