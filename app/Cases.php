<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='cases';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    public static function arraycolumn() {
   //  $perm = CaseCategory::where('user_id', $cl)->where(Permission::$colName, 1)->first();

   //คอลัมน์ในนี้จะต้อง +1 ไปจาก column ใน database
   $cl0 = 'id'; /*0*/ $cl1 = 'name'; /*1*/ $cl2 = 'type_id'; /*2*/ $cl3 = 'sub_type_id'; /*3*/ $cl4 = 'created_by_pid'; /*4*/ $cl5 = 'procedure_id'; /*5*/ $cl6 = 'stage'; /*6*/
   $cl7 = 'require_value1'; /*7*/ $cl8 = 'require_value2'; /*8*/ $cl9 = 'require_value3'; /*9*/ $cl10 = 'require_value4'; /*10*/ $cl11 = 'require_value5'; /*11*/ $cl12 = 'require_value6'; /*12*/ $cl13 = 'require_value7'; /*13*/
   $cl14 = 'require_value8'; /*14*/ $cl15 = 'require_value9'; /*15*/ $cl16 = 'require_value10'; /*16*/ $cl17 = 'require_value11'; /*17*/ $cl18 = 'require_value12'; /*18*/ $cl19 = 'require_value13'; /*19*/ $cl20 = 'require_value14'; /*20*/
   $cl21 = 'require_value15'; /*21*/ $cl22 = 'require_value16'; /*22*/ $cl23 = 'require_value17'; /*23*/ $cl24 = 'require_value18'; /*24*/ $cl25 = 'require_value19'; /*25*/ $cl26 = 'require_value20'; /*26*/ $cl27 = 'var_value1'; /*27*/
   $cl28 = 'var_value2'; /*28*/ $cl29 = 'var_value3'; /*29*/ $cl30 = 'var_value4'; /*30*/ $cl31 = 'var_value5'; /*31*/ $cl32 = 'var_value6'; /*32*/ $cl33 = 'var_value7'; /*33*/ $cl34 = 'var_value8'; /*34*/
   $cl35 = 'var_value9'; /*35*/ $cl36 = 'var_value10'; /*36*/ $cl37 = 'var_value11'; /*37*/ $cl38 = 'var_value12'; /*38*/ $cl39 = 'var_value13'; /*39*/ $cl40 = 'var_value14'; /*40*/ $cl41 = 'var_value15'; /*41*/
   $cl42 = 'var_value16'; /*42*/ $cl43 = 'var_value17'; /*43*/ $cl44 = 'var_value18'; /*44*/ $cl45 = 'var_value19'; /*45*/ $cl46 = 'var_value20'; /*46*/ $cl47 = 'var_value21'; /*47*/ $cl48 = 'var_value22'; /*48*/
   $cl49 = 'var_value23'; /*49*/ $cl50 = 'var_value24'; /*50*/ $cl51 = 'var_value25'; /*51*/ $cl52 = 'var_value26'; /*52*/ $cl53 = 'var_value27'; /*53*/ $cl54 = 'var_value28'; /*54*/ $cl55 = 'var_value29'; /*55*/
   $cl56 = 'var_value30'; /*56*/ $cl57 = 'var_value31'; /*57*/ $cl58 = 'var_value32'; /*58*/ $cl59 = 'var_value33'; /*59*/ $cl60 = 'var_value34'; /*60*/ $cl61 = 'var_value35'; /*61*/ $cl62 = 'var_value36'; /*62*/
   $cl63 = 'var_value37'; /*63*/ $cl64 = 'var_value38'; /*64*/ $cl65 = 'var_value39'; /*65*/ $cl66 = 'var_value40'; /*66*/ $cl67 = 'var_value41'; /*67*/ $cl68 = 'var_value42'; /*68*/ $cl69 = 'var_value43'; /*69*/
   $cl70 = 'var_value44'; /*70*/ $cl71 = 'var_value45'; /*71*/ $cl72 = 'var_value46'; /*72*/ $cl73 = 'var_value47'; /*73*/ $cl74 = 'var_value48'; /*74*/ $cl75 = 'var_value49'; /*75*/ $cl76 = 'var_value50'; /*76*/
   $cl77 = 'var_value51'; /*77*/ $cl78 = 'var_value52'; /*78*/ $cl79 = 'var_value53'; /*79*/ $cl80 = 'var_value54'; /*80*/ $cl81 = 'var_value55'; /*81*/ $cl82 = 'var_value56'; /*82*/ $cl83 = 'var_value57'; /*83*/
   $cl84 = 'var_value58'; /*84*/ $cl85 = 'var_value59'; /*85*/ $cl86 = 'var_value60'; /*86*/ $cl87 = 'created_at'; /*87*/ $cl88 = 'updated_at';/*88*/
   $cl89 = 'referal_asset';$cl90 = 'ref_previous_case';$cl91 = 'case_channel';$cl92 = 'consult_partner_block_id';$cl93 = 'service_user_block_id';$cl94 = 'coordinate_user_block_id';$cl95 = 'case_created_date';$cl96 = 'last_updated_date';$cl97 = 'auto_renew_date';
   $cl98 = 'next_notify_date';$cl99 = 'note_from_previous_case';$cl100 = 'note_to_copy_to_renew_case';$cl101 = 'note_from_member';$cl102 = 'note_from_partner';$cl103 = 'note_from_user';$cl104 = 'member_case_owner';
   //join
   $data =[$cl0,$cl1,$cl2,$cl3,$cl4,$cl5,$cl6,$cl7,$cl8,$cl9,$cl10,$cl11,$cl12,$cl13,$cl14,$cl15,$cl16,$cl17,$cl18,$cl19,$cl20,$cl21,$cl22,$cl23,$cl24,$cl25,$cl26,$cl27,$cl28,$cl29,$cl30,$cl31,$cl32,
   $cl33,$cl34,$cl35,$cl36,$cl37,$cl38,$cl39,$cl40,$cl41,$cl42,$cl43,$cl44,$cl45,$cl46,$cl47,$cl48,$cl49,$cl50,$cl51,$cl52,$cl53,$cl54,$cl55,$cl56,$cl57,$cl58,$cl59,$cl60,$cl61,$cl62,$cl63,$cl64,$cl65,$cl66,
   $cl67,$cl68,$cl69,$cl70,$cl71,$cl72,$cl73,$cl74,$cl75,$cl76,$cl77,$cl78,$cl79,$cl80,$cl81,$cl82,$cl83,$cl84,$cl85,$cl86,$cl87,$cl88,$cl89,$cl90,$cl91,$cl92,$cl93,$cl94,$cl95,$cl96,$cl97,$cl98,$cl99
   ,$cl100,$cl101,$cl102,$cl103,$cl104];

   /*$data = Partner_block::with(['Partner_block','Partner_structure'])
   ->leftJoin('partner_block as pb', 'pb.'.$under_block, '=', 'partner_block.id')
    ->select('partner_block.*', 'pb.name as '.$block_name,);*/

  return $data;


   }
    protected $guarded = [];
    public function casecategory()
{
    return $this->belongsTo('App\CaseCategory','case_cat_id');
}

public function block()
{
return $this->belongsTo('App\Block','service_user_block_id');
}
public function coordiantor()
{
return $this->belongsTo('App\User','coordinate_user_block_id');
}
public function partner_block()
{
return $this->belongsTo('App\Partner_block','consult_partner_block_id');
}
public function casesubtype()
{
return $this->belongsTo('App\CaseSubType','sub_type_id');
}
public function casetype()
{
return $this->belongsTo('App\CaseType','type_id');
}

public function asset()
{
return $this->belongsTo('App\Asset','referal_asset');
}

public function match_id()
{
return $this->belongsTo('App\match_id','created_by_pid');
}
public function cases()
{
return $this->belongsTo('App\Cases','ref_previous_case');
}
public function renewcases()
{
return $this->belongsTo('App\Cases','renew_case_id');
}
public function procedures()
{
return $this->belongsTo('App\Procedures','procedure_id');
}
public function stage()
{
return $this->belongsTo('App\Stage','stage');
}
public function person()
{
return $this->belongsTo('App\Person','member_case_owner');
}

public function casestatus()
{
return $this->belongsTo('App\CaseStatus','case_status');
}
public function casechannel()
{
return $this->belongsTo('App\CaseChannel','case_channel');
}
public function caselog()
{
return $this->hasOne('App\Case_log','case_id')->where('move_to_stage',31);
}
}
