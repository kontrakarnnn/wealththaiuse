<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool_Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='tool_order';

    protected $fillable = [
      'modified_by','member_id','order_create_date','invoice_number','tool_set_id','tool_package_id','initial_fee','period_fee','exit_fee','initial_deal_date','next_period_deal_date','order_status','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function person(){
      return $this->belongsTo('App\Person','member_id');
    }
    public function toolset(){
      return $this->belongsTo('App\ToolSet','tool_set_id');
    }
    public function ToolPackage(){
      return $this->belongsTo('App\ToolPackage','tool_package_id');
    }
    public function Tool_Order_Status(){
      return $this->belongsTo('App\Tool_Order_Status','order_status');
    }
	    public function user(){
      return $this->belongsTo('App\User','modified_by');
    }
    /*public function tooltype()
{
    return $this->hasMany('App\ToolType','cat_id');
}*/
}
