<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition_type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='condition_type';

    protected $fillable = [
      'name','description'];
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
