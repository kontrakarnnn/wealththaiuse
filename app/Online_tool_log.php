<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online_tool_log extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='online_tool_log';

    protected $fillable = [
    'tool_id','portfolio_id','last_logout','last_login','flag_status','description','acname','acbroke','acserver','version'];
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
public function Portfolio()
{
return $this->belongsTo('App\Portfolio','portfolio_id');
}

public function membertool()
{
return $this->hasMany('App\MemberTool','tool_id');
}
}
