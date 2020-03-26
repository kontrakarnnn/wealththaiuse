<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedures_To_Process extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='procedures_to_process';

    protected $fillable = [
      'name','process_id','next_procedure_to_process','procedure_id','start_process_flag','end_process_flag','description'];
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

public function procedures()
{
return $this->belongsTo('App\Procedures','procedure_id');
}

public function Procedures_to_process()
{
return $this->belongsTo('App\Procedures_To_Process','next_procedure_to_process');
}
}
