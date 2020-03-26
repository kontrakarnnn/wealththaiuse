<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'branch';

    public function subdistrict()
    {
        return $this->belongsTo('App\Subdistrict', 'add_subdistrict');
    }
    public function district()
    {
        return $this->belongsTo('App\District', 'add_district');
    }
    public function city()
    {
        return $this->belongsTo('App\Province', 'add_city');
    }
    public function country()
    {
        return $this->belongsTo('App\Country', 'add_country');
    }
}
