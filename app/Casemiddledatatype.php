<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casemiddledatatype extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'case_middle_data_type';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function casecategory()
    {
    return $this->belongsTo('App\casecategory','case_category');
    }
}
