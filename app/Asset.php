<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asset';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio', 'port_id');
    }
    public function assettype()
    {
        return $this->belongsTo('App\Asset_type', 'la_nla_type');
    }
}
