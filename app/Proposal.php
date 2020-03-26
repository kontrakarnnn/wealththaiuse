<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='proposal';


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
    public function match_id()
{
    return $this->belongsTo('App\match_id','created_by');
}
public function partner_block()
{
return $this->belongsTo('App\Partner_block','partner_block');
}
public function block()
{
return $this->belongsTo('App\Block','user_block');
}
public function person()
{
return $this->belongsTo('App\Person','member_id');
}
public function offer()
{
return $this->hasmany('App\Offer','proposal_id');
}
}
