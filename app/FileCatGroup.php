<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileCatGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file_cat_group';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
