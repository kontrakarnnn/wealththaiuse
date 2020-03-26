<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='offer';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function offertype()
{
    return $this->belongsTo('App\OfferType','type_id');
}
public function proposal()
{
return $this->belongsTo('App\Proposal','proposal_id');
}

public function match_id()
{
return $this->belongsTo('App\match_id','ref_pid');
}
public function person()
{
return $this->belongsTo('App\Person','ref_member_id');
}

public function branch()
{
return $this->belongsTo('App\Branch','ref_branch_id');
}
public function campaign()
{
return $this->belongsTo('App\Campaign','campaign_id');
}
public function promotion()
{
return $this->belongsTo('App\Promotion','promotion_id');
}

}
