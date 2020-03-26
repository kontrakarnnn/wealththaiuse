<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_proposal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_to_proposal_offer';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function cases()
{
    return $this->belongsTo('App\Cases','case_id');
}
public function proposal()
{
return $this->belongsTo('App\Proposal','proposal_id');
}
public function offer()
{
return $this->belongsTo('App\Offer','offer_id');
}
public function asset()
{
return $this->belongsTo('App\Asset','asset_id');
}
}
