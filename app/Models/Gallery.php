<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['travel_packages_id', 'image'];

    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class, 'travel_packages_id', 'id');
    }
}
