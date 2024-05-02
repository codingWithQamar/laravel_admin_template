<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;
	protected $table = 'property_images';
    // protected $fillable = [
        // 'name',
        // 'latitude',
        // 'longitude',
    // ];
    public function property() {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
