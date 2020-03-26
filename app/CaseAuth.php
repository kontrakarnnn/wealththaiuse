<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseAuth extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_auth';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    public static function arraycolumn() {
   //คอลัมน์ในนี้จะต้อง -1 ไปจาก column ใน database
   $cl0 = 'id'; /*0*/ $cl1 = 'case_id'; /*1*/ $cl2 = 'public_id'; /*2*/ $cl3 = 'block_partner'; /*3*/ $cl4 = 'block_user'; /*4*/ $cl5 = 'guild_member'; /*5*/ $cl6 = 'group_member'; /*6*/
   $cl7 = 'group_pid'; /*7*/ $cl8 = 'group_partner';$cl9 = 'description';
   $data =[$cl0,$cl1,$cl2,$cl3,$cl4,$cl5,$cl6,$cl7,$cl8,$cl9];
  return $data;


   }
    protected $guarded = [];

public function cases()
{
return $this->belongsTo('App\Cases','case_id');
}
public function match_id()
{
return $this->belongsTo('App\match_id','public_id');
}
public function block()
{
return $this->belongsTo('App\Block','block_user');
}
public function partner_block()
{
return $this->belongsTo('App\Partner_block','block_partner');
}
public function family()
{
return $this->belongsTo('App\Family','guild_member');
}
public function member_group()
{
return $this->belongsTo('App\Member_group','group_member');
}
public function pid_group()
{
return $this->belongsTo('App\Pid_group','group_pid');
}

public function partner_group()
{
return $this->belongsTo('App\Partner_group','group_partner');
}




}
