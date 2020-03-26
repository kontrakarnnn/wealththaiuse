<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class match_view_partner extends Model
{
      protected $table = 'match_views_partner';
      protected $guarded = [];

      //public function noti() {
  //  return $this->belongsToMany(Noti::class, 'sender_id', 'recieve_id', 'proficiency_id');
  public function partner()
  {
  return $this->belongsTo('App\Partner','partner_id');
  }

  public function pid_group()
  {
  return $this->belongsTo('App\Pid_group','pid_group_id');
  }

  public function partner_group()
  {
  return $this->belongsTo('App\Partner_group','partner_group_id');
  }

  public function viewpartner()
  {
  return $this->belongsTo('App\Viewpartner','view_id');
  }

  public function partner_structure()
  {
  return $this->belongsTo('App\Partner_structure','structure_id');
  }

  public function partner_block()
  {
  return $this->belongsTo('App\Partner_block','block_id');
  }
  public function partner_block_td()
  {
  return $this->belongsTo('App\Partner_block','block_td');
  }
  public function partner_block_btu()
  {
  return $this->belongsTo('App\Partner_block','block_btu');
  }

}
