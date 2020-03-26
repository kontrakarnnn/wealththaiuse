<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_report';

  /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

}
