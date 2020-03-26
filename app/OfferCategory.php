<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='offer_category';

  /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


}
