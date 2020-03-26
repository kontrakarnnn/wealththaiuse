<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MemberTool extends Authenticatable
{
    use Notifiable;
    protected $table ='member_tool';
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'end_contract','member_id','tool_id','member_tool_status','limit_number_of_port','register_key','valid_from','valid_to','description'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     public function person()
 {
     return $this->belongsTo('App\Person','member_id');
 }

 public function member_tool_status()
{
 return $this->belongsTo('App\Member_Tool_Status','member_tool_status');
}

public function tool()
{
return $this->belongsTo('App\Tool','tool_id');
}

public function membertool()
{
return $this->hasMany('App\MemberAssignTool','member_tool_id');
}

}
