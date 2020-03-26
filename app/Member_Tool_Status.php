<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member_Tool_Status extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='member_tool_status';

    protected $fillable = [
      'name','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function tooltype()
{
    return $this->hasMany('App\ToolType','cat_id');
}

public function toolset()
{
return $this->hasMany('App\ToolSet','default_tool_status');
}
public function toolpackage()
{
return $this->hasMany('App\ToolPackage','default_tool_status');
}

public function membertool()
{
return $this->hasMany('App\MemberTool','member_tool_status');
}
}
