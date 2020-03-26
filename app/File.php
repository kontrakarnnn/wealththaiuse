<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function filecat()
    {
    return $this->belongsTo('App\FileCat','file_cat_id');
    }
}
