<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='tool_type';

    protected $fillable = [
      'name','cat_id','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function toolcategory()
{
    return $this->belongsTo('App\ToolCategory','cat_id');
}
public function tool()
{
return $this->hasmany('App\Tool','tool_type');
}
}
