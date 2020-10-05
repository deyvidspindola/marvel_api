<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = ['creator_id','digitalId','title','issueNumber','variantDescription','description','isbn','upc','diamondCode','ean','issn','format','pageCount','prices','thumbnail','images','urls'];

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

    public function series()
    {
        return $this->belongsToMany(Series::class);
    }

}
