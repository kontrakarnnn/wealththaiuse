<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner_structure extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='partner_structure';

    protected $fillable = [
      'name','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function partner_block()
{
    return $this->hasMany('App\Partner_block','structure_id');
}

public function partner_auth()
{
return $this->hasmany('App\Partner_auth','structure_id');
}

public function match_view_partner()
{
return $this->hasmany('App\match_view_partner','structure_id');
}

}
