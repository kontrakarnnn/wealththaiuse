<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'block';

    public function person()
    {
      return $this->hasMany('App\Person');
    }
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function portfolio()
    {
    return $this->hasmany('App\Portfolio','block_id');
    }
  public function department(){
    return $this->belongsTo(Structure::class);
  }


  public function immediateChildAccounts()
{
    return $this->hasMany('App\Block', 'under_division', 'id');
}

public function parentAccount()
{
    return $this->belongsTo('App\Block', 'under_division', 'id');
}

 public function users()
 {
   return $this->belongsToMany('App\User','user_auths','block_id','user_id');
 }

 public function casetype()
 {
 return $this->hasMany('App\CaseType','default_user_block_id');
 }
 public function structure()
 {
     return $this->belongsTo('App\Structure', 'structure_id');
 }
 public function belongtoblock()
 {
     return $this->belongsTo('App\Block', 'under_block');
 }
 public function cases()
 {
 return $this->hasMany('App\Cases','service_user_block_id');
 }
 public function childs() {
         return $this->hasMany('App\Block','under_block','id') ;
 }
}
