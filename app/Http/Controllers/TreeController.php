<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Division;

class TreeController extends Controller {
   public function treeView(){
        $Divisions = Division::where('under_division', '=',NULL )->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($Divisions as $Division) {
             $tree .='<li class="tree-view closed"<a  class="tree-name">'.$Division->name.'</a>';
             if(count($Division->childs)) {
                $tree .=$this->childView($Division);
            }
        }
        $tree .='<ul>';
        // return $tree;
        return view('files.treeview',compact('tree'));
    }
    public function childView($Division){
            $html ='<ul>';
            foreach ($Division->childs as $arr) {
                if(count($arr->childs)){
                $html .='<li class="tree-view closed"><a class="tree-name">'.$arr->name.'</a>';
                        $html.= $this->childView($arr);
                    }else{
                        $html .='<li class="tree-view"><a class="tree-name">'.$arr->name.'</a>';
                        $html .="</li>";
                    }

            }

            $html .="</ul>";
            return $html;
    }
}
