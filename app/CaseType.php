<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_type';



    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    public static function arraycolumn() {
   //  $perm = CaseCategory::where('user_id', $cl)->where(Permission::$colName, 1)->first();

   //คอลัมน์ในนี้จะต้อง -1 ไปจาก column ใน database
   $cl0 = 'id'; /*0*/ $cl1 = 'case_cat_id'; /*1*/ $cl2 = 'name'; /*2*/ $cl3 = 'default_partner_block_id'; /*3*/ $cl4 = 'default_user_block_id'; /*4*/ $cl5 = 'default_procedure_id'; /*5*/ $cl6 = 'description'; /*6*/
   $cl7 = 'requirename_var1'; /*7*/ $cl8 = 'requirename_var2'; /*8*/ $cl9 = 'requirename_var3'; /*9*/ $cl10 = 'requirename_var4'; /*10*/ $cl11 = 'requirename_var5'; /*11*/ $cl12 = 'requirename_var6'; /*12*/ $cl13 = 'requirename_var7'; /*13*/
   $cl14 = 'requirename_var8'; /*14*/ $cl15 = 'requirename_var9'; /*15*/ $cl16 = 'requirename_var10'; /*16*/ $cl17 = 'requirename_var11'; /*17*/ $cl18 = 'requirename_var12'; /*18*/ $cl19 = 'requirename_var13'; /*19*/ $cl20 = 'requirename_var14'; /*20*/
   $cl21 = 'requirename_var15'; /*21*/ $cl22 = 'requirename_var16'; /*22*/ $cl23 = 'requirename_var17'; /*23*/ $cl24 = 'requirename_var18'; /*24*/ $cl25 = 'requirename_var19'; /*25*/ $cl26 = 'requirename_var20'; /*26*/ $cl27 = 'var_name1'; /*27*/
   $cl28 = 'var_name2'; /*28*/ $cl29 = 'var_name3'; /*29*/ $cl30 = 'var_name4'; /*30*/ $cl31 = 'var_name5'; /*31*/ $cl32 = 'var_name6'; /*32*/ $cl33 = 'var_name7'; /*33*/ $cl34 = 'var_name8'; /*34*/
   $cl35 = 'var_name9'; /*35*/ $cl36 = 'var_name10'; /*36*/ $cl37 = 'var_name11'; /*37*/ $cl38 = 'var_name12'; /*38*/ $cl39 = 'var_name13'; /*39*/ $cl40 = 'var_name14'; /*40*/ $cl41 = 'var_name15'; /*41*/
   $cl42 = 'var_name16'; /*42*/ $cl43 = 'var_name17'; /*43*/ $cl44 = 'var_name18'; /*44*/ $cl45 = 'var_name19'; /*45*/ $cl46 = 'var_name20'; /*46*/ $cl47 = 'var_name21'; /*47*/ $cl48 = 'var_name22'; /*48*/
   $cl49 = 'var_name23'; /*49*/ $cl50 = 'var_name24'; /*50*/ $cl51 = 'var_name25'; /*51*/ $cl52 = 'var_name26'; /*52*/ $cl53 = 'var_name27'; /*53*/ $cl54 = 'var_name28'; /*54*/ $cl55 = 'var_name29'; /*55*/
   $cl56 = 'var_name30'; /*56*/ $cl57 = 'var_name31'; /*57*/ $cl58 = 'var_name32'; /*58*/ $cl59 = 'var_name33'; /*59*/ $cl60 = 'var_name34'; /*60*/ $cl61 = 'var_name35'; /*61*/ $cl62 = 'var_name36'; /*62*/
   $cl63 = 'var_name37'; /*63*/ $cl64 = 'var_name38'; /*64*/ $cl65 = 'var_name39'; /*65*/ $cl66 = 'var_name40'; /*66*/ $cl67 = 'var_name41'; /*67*/ $cl68 = 'var_name42'; /*68*/ $cl69 = 'var_name43'; /*69*/
   $cl70 = 'var_name44'; /*70*/ $cl71 = 'var_name45'; /*71*/ $cl72 = 'var_name46'; /*72*/ $cl73 = 'var_name47'; /*73*/ $cl74 = 'var_name48'; /*74*/ $cl75 = 'var_name49'; /*75*/ $cl76 = 'var_name50'; /*76*/
   $cl77 = 'var_name51'; /*77*/ $cl78 = 'var_name52'; /*78*/ $cl79 = 'var_name53'; /*79*/ $cl80 = 'var_name54'; /*80*/ $cl81 = 'var_name55'; /*81*/ $cl82 = 'var_name56'; /*82*/ $cl83 = 'var_name57';
   $cl84 = 'var_name58'; /*84*/ $cl85 = 'var_name59'; /*85*/ $cl86 = 'var_name60'; /*86*/ $cl87 = 'created_at'; /*87*/ $cl88 = 'updated_at';/*88*/;$cl89 = 'default_partner_group';$cl90 = 'case_type_config';
   //join
   $data =[$cl0,$cl1,$cl2,$cl3,$cl4,$cl5,$cl6,$cl7,$cl8,$cl9,$cl10,$cl11,$cl12,$cl13,$cl14,$cl15,$cl16,$cl17,$cl18,$cl19,$cl20,$cl21,$cl22,$cl23,$cl24,$cl25,$cl26,$cl27,$cl28,$cl29,$cl30,$cl31,$cl32,
   $cl33,$cl34,$cl35,$cl36,$cl37,$cl38,$cl39,$cl40,$cl41,$cl42,$cl43,$cl44,$cl45,$cl46,$cl47,$cl48,$cl49,$cl50,$cl51,$cl52,$cl53,$cl54,$cl55,$cl56,$cl57,$cl58,$cl59,$cl60,$cl61,$cl62,$cl63,$cl64,$cl65,$cl66,
   $cl67,$cl68,$cl69,$cl70,$cl71,$cl72,$cl73,$cl74,$cl75,$cl76,$cl77,$cl78,$cl79,$cl80,$cl81,$cl82,$cl83,$cl84,$cl85,$cl86,$cl87,$cl88,$cl89,$cl90];
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
return $this->belongsTo('App\Block','default_user_block_id');
}
public function partner_block()
{
return $this->belongsTo('App\Partner_block','default_partner_block_id');
}
public function casesubtype()
{
return $this->hasmany('App\casesubtype','case_type');
}

public function cases()
{
return $this->hasmany('App\Case','type_id');
}
public function Partner_group()
{
return $this->belongsTo('App\Partner_group','default_partner_group');
}
public function casetypeconfig()
{
return $this->belongsTo('App\CaseTypeConfig','case_type_config');
}
public function procedures()
{
return $this->belongsTo('App\Procedures','default_procedure_id');
}
public function offercategory()
{
return $this->belongsTo('App\OfferCategory','offer_cat');
}
}
