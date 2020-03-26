<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casemiddledata extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'case_middle_data';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function casemiddledatatype()
    {
    return $this->belongsTo('App\Casemiddledatatype','middle_data_type');
    }
    public function cases()
    {
    return $this->belongsTo('App\Cases','case_id');
    }
    public function offer()
    {
    return $this->belongsTo('App\Offer','offer_id');
    }
    public function portfolio()
    {
    return $this->belongsTo('App\Portfolio','port_id');
    }
    public function asset()
    {
    return $this->belongsTo('App\Asset','asset_id');
    }
    public function file()
    {
    return $this->belongsTo('App\File','file_id');
    }
}
