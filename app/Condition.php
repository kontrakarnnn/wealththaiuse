<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='conditions';

    protected $fillable = [
      'name','type_id','con_para_name1','con_para_name2','con_para_name3','con_para_name4','con_para_name5','con_para_name6'
      ,'con_para_name7','con_para_name8','con_para_name9','con_para_name10','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function stage()
{
    return $this->belongsTo('App\Stage','start_stage');
}
public function condition_type()
{
return $this->belongsTo('App\Condition_type','type_id');
}
}
