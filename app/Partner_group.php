<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Partner_group extends Model
{


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'partner_group';
    protected $guarded = [];
    protected $fillable = [
      'name','description'];


      public function match_partner_group()
      {
      return $this->hasMany('App\match_partner_group','partner_group_id');
      }
      public function match_view_partner()
      {
      return $this->hasMany('App\match_view_partner','partner_group_id');
      }

}
