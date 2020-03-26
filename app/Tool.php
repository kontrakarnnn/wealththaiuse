<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='tool';

    protected $fillable = [
    'broker_id','limit_assign','match_broker','star','promote','top_hit','tool_type','attachment','name','created_by','tool_ref_product_id','tool_info_link','last_version','published_date','update_date','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function tooltype()
{
    return $this->belongsTo('App\ToolType','tool_type');
}
public function user()
{
return $this->belongsTo('App\User','created_by');
}

public function membertool()
{
return $this->hasMany('App\MemberTool','tool_id');
}

public function online_tool()
{
return $this->hasMany('App\Online_tool','tool_id');
}
	
	public function online_tool_log()
{
return $this->hasMany('App\Online_tool_log','tool_id');
}

}
