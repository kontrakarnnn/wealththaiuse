<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool_Package_To_Set extends Model
{
    protected $table = 'tool_package_to_set';
    protected $fillable = [
      'tool_set','tool_package','description'];

      public function user()
   {
       return $this->belongsToMany('App\User');
   }

   public function ToolSet()
{
    return $this->belongsTo('App\ToolSet','tool_set');
}
public function ToolPackage()
{
 return $this->belongsTo('App\ToolPackage','tool_package');
}
}
