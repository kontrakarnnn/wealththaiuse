<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PersonResetPasswordNotification;
class Partner extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
      use Notifiable;

     protected $guard ='partner';
     protected $table ='partner';
     protected $hidden = [
         'password', 'remember_token',
     ];
    protected $fillable = [
    'name','lastname','email','password','citizen_id','member_id','verify_by','status'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    public function member()
{
    return $this->belongsTo('App\Person','member_id');
}
public function user()
{
return $this->belongsTo('App\User','verify_by');
}

public function partner()
{
return $this->hasMany('App\Partner','partner_id');
}
public function match_view_partner()
{
return $this->hasMany('App\match_view_partner','partner_id');
}

public function match_partner_group()
{
return $this->hasMany('App\match_partner_group','partner_id');
}

public function partner_auth()
{
return $this->hasmany('App\Partner_auth','partner_id');
}

}
