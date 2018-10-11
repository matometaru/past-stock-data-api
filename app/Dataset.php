<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'date', 'total', 'open', 'high', 'low', 'close', 'volume', 'close_adj',
    ];
}
