<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset_type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asset_type';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
