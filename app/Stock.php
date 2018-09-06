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
}
