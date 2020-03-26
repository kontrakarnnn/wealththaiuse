<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberAssignTool extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='member_assign_tool_to_port';

    protected $fillable = [
      'member_tool_id','port_id'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function portfolio()
{
    return $this->belongsTo('App\Portfolio','port_id');
}
public function membertool()
{
return $this->belongsTo('App\MemberTool','member_tool_id');
}
}
