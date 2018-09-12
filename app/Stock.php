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
        'code', 'name', 'color', 'url', 'market_id', 'category_id', 'listing_date', 'delisting_date',
    ];

    public function category()
    {
        $cat = $this->belongsTo('App\Category');
        return $cat;
    }

    public function categoryName()
    {
        return $this->code;
    }

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public function marketName()
    {
        return $this->code;
    }
}
