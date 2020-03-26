<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term_Of_Payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='term_of_payment';

    protected $fillable = [
      'name','description'];
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


public function toolset()
{
return $this->hasMany('App\ToolSet','term_of_payment');
}
public function toolpackage()
{
return $this->hasMany('App\ToolPackage','term_of_payment');
}
}
