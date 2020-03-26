<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\ActionType;
use App\ActionCategory;
use App\Action;
use App\StageAction;
use App\Path_condition;
use App\Cases;
use App\Stage;

use App\Http\Controllers\SidebarController;
class CaseAjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('view');
    }

    public function updatepathcondition() {
      $url=$_SERVER['REQUEST_URI'];
      $ex = explode('?',$url);
      $detail = explode('/',$ex[1]);
      $id = explode('pathconid=',$detail[0]);
      $reverse1 = explode('reverse1=',$detail[1]);
      $reverse2 = explode('reverse2=',$detail[2]);
      $reverse3 = explode('reverse3=',$detail[3]);
      $reverse4 = explode('reverse4=',$detail[4]);
      $reverse5 = explode('reverse5=',$detail[5]);
      $reverse6 = explode('reverse6=',$detail[6]);
      $reverse7 = explode('reverse7=',$detail[7]);
      $reverse8 = explode('reverse8=',$detail[8]);
      $reverse9 = explode('reverse9=',$detail[9]);
      $reverse10 = explode('reverse10=',$detail[10]);
      $pathdetail1 = explode('pathdetail1=',$detail[11]);
      $pathdetail2 = explode('pathdetail2=',$detail[12]);
      $pathdetail3 = explode('pathdetail3=',$detail[13]);
      $pathdetail4 = explode('pathdetail4=',$detail[14]);
      $pathdetail5 = explode('pathdetail5=',$detail[15]);
      $pathdetail6 = explode('pathdetail6=',$detail[16]);
      $pathdetail7 = explode('pathdetail7=',$detail[17]);
      $pathdetail8 = explode('pathdetail8=',$detail[18]);
      $pathdetail9 = explode('pathdetail9=',$detail[19]);
      $pathdetail10 = explode('pathdetail10=',$detail[20]);

      if(isset($_POST["pathconid"]))
{

  $input = [
    'reverse_each_preposition1' => $reverse1[1],
    'reverse_each_preposition2' => $reverse2[1],
    'reverse_each_preposition3' => $reverse3[1],
    'reverse_each_preposition4' => $reverse4[1],
    'reverse_each_preposition5' => $reverse5[1],
    'reverse_each_preposition6' => $reverse6[1],
    'reverse_each_preposition7' => $reverse7[1],
    'reverse_each_preposition8' => $reverse8[1],
    'reverse_each_preposition9' => $reverse9[1],
    'reverse_each_preposition10' => $reverse10[1],
    'path_condition_detail1' => $pathdetail1[1],
    'path_condition_detail2' => $pathdetail2[1],
    'path_condition_detail3' => $pathdetail3[1],
    'path_condition_detail4' => $pathdetail4[1],
    'path_condition_detail5' => $pathdetail5[1],
    'path_condition_detail6' => $pathdetail6[1],
    'path_condition_detail7' => $pathdetail7[1],
    'path_condition_detail8' => $pathdetail8[1],
    'path_condition_detail9' => $pathdetail9[1],
    'path_condition_detail10' => $pathdetail10[1],


  ];
    Path_condition::where('id', $_POST["pathconid"])->update($input);
    $path =   Path_condition::where('id', $_POST["pathconid"])->get();
    return "Data Changed";
    }
    else{
      return "No ";

    }
  }
  public function createactiontostage()
  {
    return "yes";
  }



}
