<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Viewpartner extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     public function users()
     {
       return $this->belongsToMany('App\Viewper','match_views_mem','view_id');
     }
    protected $table = 'views_partner';

    public function Viewpartner() {
      //sidebar
            return $this->hasMany('App\Viewpartner','belong_to','id') ;
    }


    public function childs() {
      //sidebar
            return $this->hasMany('App\Viewpartner','belong_to','id') ;
    }

    public function match_view_partner() {
            return $this->hasMany('App\match_view_partner','view_id') ;
    }
    /*public function division()
    {
      return $this->hasMany(Block::class);
    }
    public function portfolio()
    {
      return $this->hasMany(Portfolio::class);
    }
    public function user()
    {
      return $this->hasMany(User::class);
    }
    public function users()
    {
      return $this->belongsToMany('App\User','user_auths','structure_id','user_id');
    }*/
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
