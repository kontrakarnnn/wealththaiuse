<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Port_Asset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'port_asset_type';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
