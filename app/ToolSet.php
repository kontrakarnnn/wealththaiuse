<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolSet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='tool_set';

    protected $fillable = [
      'contract_period','tool_id','name','limit_number_port','default_tool_status','term_of_payment','valid_period','initial_free','period_fee','exit_fee'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function tool()
{
    return $this->belongsTo('App\Tool','tool_id');
}
public function term_of_payment()
{
return $this->belongsTo('App\Term_Of_Payment','term_of_payment');
}

public function member_tool_status()
{
return $this->belongsTo('App\Member_Tool_Status','default_tool_status');
}
public function tool_package_to_set()
{
return $this->hasMany('App\Tool_Package_To_Set','tool_set');
}

public function Tool_Order()
{
return $this->hasMany('App\Tool_Order','tool_set_id');
}
}
