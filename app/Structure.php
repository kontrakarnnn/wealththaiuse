<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'structure';

    public function division()
    {
      return $this->hasMany(Block::class);
    }
    public function block()
    {
      return $this->hasMany('App\Block','structure_id');
    }
    public function user()
    {
      return $this->hasMany(User::class);
    }
    public function users()
    {
      return $this->belongsToMany('App\User','user_auths','structure_id','user_id');
    }

    public function portfolio()
    {
    return $this->hasMany('App\Portfolio','structure_id');
    }

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
