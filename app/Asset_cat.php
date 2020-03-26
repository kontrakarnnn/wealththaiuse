<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset_cat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asset_cat';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
