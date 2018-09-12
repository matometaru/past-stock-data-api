<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'color', 'url', 'market', 'category', 'listing_date', 'delisting_date',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function market()
    {
        return $this->belongsTo('App\Market');
    }
}
