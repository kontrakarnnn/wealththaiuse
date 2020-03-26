<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner_auth extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='partner_auths';

    protected $fillable = [
      'structure_id','block_id','partner_id','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */

    protected $guarded = [];
    public function partner_structure()
{
    return $this->belongsTo('App\Partner_structure','structure_id');
}
  public function partner_block()
{
    return $this->belongsTo('App\Partner_block','block_id');
}

public function partner()
{
  return $this->belongsTo('App\Partner','partner_id');
}

}
