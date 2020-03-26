<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseTypeConfig extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_type_config';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];



}
