<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

     public static function casecategory() {

    //  $perm = CaseCategory::where('user_id', $id)->where(Permission::$colName, 1)->first();
    $col0 = 'id';
    $col1 = 'name';
    $col2 = 'description';
    $col3 = 'created_at';
    $col4 = 'updated_at';
    $data = [$col0,$col1,$col2,$col3,$col4];
    return $data;
    }
     protected $table ='case_category';

  /*  protected $fillable = [
      'name','description'];*/
      public static $colName = 'name';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function casetype()
{
    return $this->hasMany('App\CaseType','case_cat_id');
}
}
