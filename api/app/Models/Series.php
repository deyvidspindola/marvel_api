<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['creator_id','title','description','urls','startYear','endYear','rating','type','thumbnail'];

    public function comics()
    {
        return $this->belongsToMany(Comic::class);
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function stories()
    {
        return $this->belongsToMany(Story::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

}
