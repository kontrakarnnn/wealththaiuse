<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool_Order_Status extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='tool_order_status';

    protected $fillable = [
      'name','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    /*public function tooltype()
{
    return $this->hasMany('App\ToolType','cat_id');
}*/
public function Tool_Order()
{
return $this->hasMany('App\Tool_Order','order_status');
}
}
