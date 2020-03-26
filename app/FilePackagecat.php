<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilePackagecat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file_package_cat';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
