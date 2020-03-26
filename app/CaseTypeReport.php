<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseTypeReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_type_report';

  /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
public function casetype()
{
return $this->belongsTo('App\CaseType','case_type_id');
}
public function casereport()
{
return $this->belongsTo('App\CaseReport','case_report_id');
}
}
