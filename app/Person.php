<?php

namespace App;
use App\Person;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PersonResetPasswordNotification;
class Person extends Authenticatable
{
    use Notifiable;
    protected $guard ='person';
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $fillable = [
      'name','email','password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'persons';
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
  {
      $this->notify(new PersonResetPasswordNotification($token));
  }

  public function partner()
  {
  return $this->hasMany('App\Person','member_id');
  }
  public function offer()
  {
  return $this->hasMany('App\Offer','ref_member_id');
  }
  public function proposal()
{
    return $this->hasMany('App\Proposal', 'member_id');
}
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
public function subdistrict2()
{
    return $this->belongsTo('App\Subdistrict', 'add2_subdistrict');
}
public function district2()
{
    return $this->belongsTo('App\District', 'add2_district');
}
public function city2()
{
    return $this->belongsTo('App\Province', 'add2_city');
}
public function country2()
{
    return $this->belongsTo('App\Country', 'add2_country');
}
public function refmemberpid()
{
    return $this->belongsTo('App\match_id', 'ref_member_pid');
}
}
