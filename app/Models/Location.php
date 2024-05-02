<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Location extends Model
{
    use HasFactory;
	use HasSlug;

    protected $fillable = [
        'title',
        'user_id',
        'coordinates',
    ];
	
	public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
        // Location.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



