<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='offer_type';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function offercategory()
{
    return $this->belongsTo('App\OfferCategory','offer_category');
}
public function assettype()
{
return $this->belongsTo('App\Asset_type','asset_type');
}
}
