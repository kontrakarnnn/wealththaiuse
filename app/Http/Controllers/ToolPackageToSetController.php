<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Structure;
use App\Block;
use App\User;
use App\User_auth;
use App\Tool_Package_To_Set;
use App\ToolSet;
use App\ToolPackage;

use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;

class ToolPackageToSetController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $toolpackage = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->get();
      $toolset= ToolSet::with(['Tool','Term_Of_Payment','Member_Tool_Status'])->orderBy('created_at','DESC')->get();

      $data = Tool_Package_To_Set::with(['ToolSet','ToolPackage'])->paginate(30);
     return view('system-mgmt/tool-package-to-set/index', ['data' => $data,'toolpackage' => $toolpackage,'toolset' => $toolset]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {

       //sidebar

  $tree = session()->get('tree');
  //sidebar




  $toolpackage = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->get();
  $toolset= ToolSet::with(['Tool','Term_Of_Payment','Member_Tool_Status'])->orderBy('created_at','DESC')->get();
        return view('system-mgmt/tool-package-to-set/create', ['toolpackage' => $toolpackage, 'toolset' => $toolset]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
       $this->validateInput($request,[

      ]);
        Tool_Package_To_Set::create([
          'tool_package' => $request['tool_package'],
          'tool_set' => $request['tool_set'],
          'description' => $request['description'],


       ]);


         return redirect ('admin/tool-package-to-set');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */



     public function edit($id)
     {
         $data = Tool_Package_To_Set::find($id);
         // Redirect to division list if updating division wasn't existed
         if ($data == null) {
           $data = Tool_Package_To_Set::find($id);
           $data = array(
               'data' => $data
             );
             return redirect ('/admin/tool-package-to-set');
           }
           $toolpackage = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->get();
           $toolset= ToolSet::with(['Tool','Term_Of_Payment','Member_Tool_Status'])->orderBy('created_at','DESC')->get();
         return view('system-mgmt/tool-package-to-set/edit', ['data' => $data,'toolpackage' => $toolpackage,'toolset' => $toolset]);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
         $userauth = Tool_Package_To_Set::findOrFail($id);
         $input = [
           'tool_package' => $request['tool_package'],
           'tool_set' => $request['tool_set'],
           'description' => $request['description'],
         ];
         $this->validate($request, [

         ]);
         Tool_Package_To_Set::where('id', $id)
             ->update($input);
         return redirect ('/admin/tool-package-to-set');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Tool_Package_To_Set::where('id', $id)->delete();
          return redirect ('/admin/tool-package-to-set');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */
     public function search(Request $request) {

       //sidebar

   $tree = session()->get('tree');
   //sidebar
   $toolpackage = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->get();
   $toolset= ToolSet::with(['Tool','Term_Of_Payment','Member_Tool_Status'])->orderBy('created_at','DESC')->get();

          $constraints = [
           'tool_package' => $request['tool_package'],
           'tool_set' => $request['tool_set'],

             ];

        $data = $this->doSearchingQuery($constraints);

        return view('system-mgmt/tool-package-to-set/index', ['toolpackage' => $toolpackage,'toolset' => $toolset,'data' => $data, 'searchingVals' => $constraints]);
     }

     private function doSearchingQuery($constraints) {

                $query = Tool_Package_To_Set::with(['ToolSet','ToolPackage']);


         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(1000);
     }
     private function validateInput($request) {
         $this->validate($request, [

     ]);
     }
 }
