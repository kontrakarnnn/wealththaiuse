<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Attacht extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'case_attachment';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
