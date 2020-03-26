<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner_block extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='partner_block';

    protected $fillable = [
      'name','structure_id','under_block','contact_name','contact_tel','contact_email','status','default_pid'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public static function querydata() {
   //  $perm = CaseCategory::where('user_id', $id)->where(Permission::$colName, 1)->first();
   $id = 'id'; //0
   $name = 'name'; //1
   $structure_id = 'structure_id'; //2
   $under_block = 'under_block'; //3
   $contact_name = 'contact_name'; //4
   $contact_tel = 'contact_tel'; //5
   $contact_email = 'contact_email'; //6
   $status = 'status'; //7
   $default_pid = 'default_pid'; //8
   //join
   $block_name = 'block_name'; //9
   //join
   $data =[$id,$name,$structure_id,$under_block,$contact_name,$contact_tel,$contact_email,$status,$default_pid,$block_name];
   /*$data = Partner_block::with(['Partner_block','Partner_structure'])
   ->leftJoin('partner_block as pb', 'pb.'.$under_block, '=', 'partner_block.id')
    ->select('partner_block.*', 'pb.name as '.$block_name,);*/

  return $data;


   }
    public function partner_structure()
{
    return $this->belongsTo('App\Partner_structure','structure_id');
}
public function partner_auth()
{
return $this->hasmany('App\Partner_auth','block_id');
}

public function partner_block()
{
return $this->hasmany('App\Partner_block','under_block');
}

public function match_view_partner()
{
return $this->hasmany('App\match_view_partner','block_id','block_td','block_btu');
}

public function match_view_partner_td()
{
return $this->hasmany('App\match_view_partner','block_td');
}

public function match_view_partner_btu()
{
return $this->hasmany('App\match_view_partner','block_btu');
}

public function casetype()
{
return $this->belongsTo('App\CaseType','default_partner_block_id');
}

}
