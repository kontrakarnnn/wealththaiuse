<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='stage';

    protected $fillable = [
      'name','end_stage_flag','process_id','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function process()
{
    return $this->belongsTo('App\Process','process_id');
}
}
