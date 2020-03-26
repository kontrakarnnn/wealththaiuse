<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='process';

    protected $fillable = [
      'name','start_stage','description'];
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
}
