<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseSubType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

     public static function arraycolumn() {

    //  $perm = CaseCategory::where('user_id', $id)->where(Permission::$colName, 1)->first();
    $col0 = 'id';
    $col1 = 'case_type';
    $col2 = 'name';
    $col3 = 'description';
    $col4 = 'created_at';
    $col5 = 'updated_at';
    $data = [$col0,$col1,$col2,$col3,$col4,$col5];
    return $data;
    }
     protected $table ='case_sub_type';

  /*  protected $fillable = [
      'name','description'];*/

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function casetype()
{
    return $this->belongsTo('App\CaseType','case_type');
}
public function cases()
{
return $this->hasMany('App\Cases','sub_type_id');
}
}
