<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class match_partner_group extends Model
{
      protected $table = 'match_partner_group';
      protected $guarded = [];
      protected $fillable = [
        'partner_id','partner_group_id'];
        public function partner()
        {
        return $this->belongsTo('App\Partner','partner_id');
        }
        public function partner_group()
        {
        return $this->belongsTo('App\Partner_group','partner_group_id');
        }
}
