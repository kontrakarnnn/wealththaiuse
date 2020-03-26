<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='tool_status';

    protected $fillable = [
    'name','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
  
public function membertool()
{
return $this->hasMany('App\MemberTool','tool_id');
}
}
