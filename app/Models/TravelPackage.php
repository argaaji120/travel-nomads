<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'location', 'about', 'featured_event',
        'language', 'foods', 'departure_date', 'duration', 'type', 'price'
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'travel_packages_id', 'id');
    }
}
