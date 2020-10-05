<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;

    protected $fillable = ['name','role'];

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
