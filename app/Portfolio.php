<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portfolio';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function structure(){
      return $this->belongsTo('App\Structure','structure_id');
    }
    public function block(){
      return $this->belongsTo('App\Block','block_id');
    }
    public function person(){
      return $this->belongsTo('App\Person','member_id');
    }

    public function port_type(){
      return $this->belongsTo('App\Port_type','port_id');
    }

    public function membertool()
    {
    return $this->hasMany('App\MemberAssignTool','port_id');
    }

    public function online_tool()
    {
    return $this->hasMany('App\Online_tool','portfolio_id');
    }
	
	    public function online_tool_log()
    {
    return $this->hasMany('App\Online_tool_log','portfolio_id');
    }

}
