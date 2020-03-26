<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Path_condition extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='path_condition';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function path()
{
    return $this->belongsTo('App\Path','path_id');
}
public function path_condition_detail_name1()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail1');
}

public function path_condition_detail_name2()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail2');
}
public function path_condition_detail_name3()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail3');
}
public function path_condition_detail_name4()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail4');
}
public function path_condition_detail_name5()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail5');
}
public function path_condition_detail_name6()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail6');
}
public function path_condition_detail_name7()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail7');
}
public function path_condition_detail_name8()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail8');
}
public function path_condition_detail_name9()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail9');
}
public function path_condition_detail_name10()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail10');
}

}
