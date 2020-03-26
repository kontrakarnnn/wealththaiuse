<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset_status extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asset_status';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
