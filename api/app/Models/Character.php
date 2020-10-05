<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['comic_id','story_id','event_id','series_id','name','description','urls','thumbnail->path', 'thumbnail->extension'];

    public function comics()
    {
        return $this->belongsToMany(Comic::class);
    }

    public function stories()
    {
        return $this->belongsToMany(Story::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function series()
    {
        return $this->belongsToMany(Series::class);
    }

}
