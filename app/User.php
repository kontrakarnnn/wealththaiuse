<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    public function roles()
    {
      return $this->belongsToMany('App\role','user_role','user_id','role_id');
    }
    public function hasAnyRole($roles)
    {
      if(is_array($roles)){
            foreach($roles as $role){
                if ($this->hasRole($role)){
                  return true;
                }
            }
      } else {
        if($this->hasRole($role)){
          return true;
      }
    }
    return false;
    }
    public function hasRole($role)
    {
      if($this->roles()->where('name',$role)->first()){
        return true;
      }
      return false;
    }

    protected $table = 'users';
    protected $guarded = ['remember_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];





    public function us()
    {
      return $this->belongsToMany('App\Block','user_auths','user_id','block_id');
    }
    public function users()
    {
      return $this->belongsToMany('App\Block','user_auths','user_id','structure_id');
    }

    public function user_auths() {
            return $this->hasMany('App\User_auth') ;
    }
	    public function Tool_Order()
    {
    return $this->hasMany('App\Tool_Order','modified_by');
    }

}
