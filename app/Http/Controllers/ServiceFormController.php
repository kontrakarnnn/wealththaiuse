<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\Noti;
use App\Group_service;
use App\Type_service;
use App\Message_type;
use App\service_form;
use App\Message_cat;
use App\Text5_service;
use Session;
use Storage;
use Image;
use App\Http\Controllers\SidebarController;

class ServiceFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('view');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('view');
     }
     public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

  $CurrentDivisions = Block::where('id', '=',$currentid )->get();
  $result =$notebook;
  $ChildDivisions = Block::whereIn('under_block',$currentid )->pluck('id');
  foreach ( $ChildDivisions as $Division => $get) {
    $nextblockID[$Division] = $get;
    $arraylength = sizeof($result);
    //$currentid=$currentid;
    $result[$arraylength]  = $nextblockID[$Division];
    $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);
    }

    return $result;
}

public function blockbtu($currentstruc2,$currentid2,$notebook2){

$CurrentDivisions = Block::where('under_block', '=', NULL )->pluck('id');
$result2 =$notebook2;
$ChildDivisions = Block::whereIn('id',$currentid2)->pluck('under_block');
//$ChildDivisions = Block::whereIn('under_block',$currentid2)->pluck('id'); topdown
//  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
foreach ( $ChildDivisions as $Division => $get) {
  $nextblockID2[$Division] = $get;
  $arraylength = sizeof($result2);
  //$currentid=$currentid;
  $result2[$arraylength]  = $nextblockID2[$Division];
  $result2 = $this->blockbtu($currentstruc2,$nextblockID2,$result2);
  }

  return $result2;
}


    public function index()
    {

      //sidebar

  $tree = session()->get('tree');
  //sidebar

$curfamss = service_form::all();
$serg = Group_service::all();

          $serviceforms = DB::table('service_form')
        ->leftJoin('group_of_service', 'service_form.group_service_id', '=', 'group_of_service.id')
        ->leftJoin('message_types', 'service_form.msg_type_id', '=', 'message_types.id')
        ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                                      ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')
        ->paginate(50);

        return view('system-mgmt/serviceform/index', ['serg' => $serg,'curfamss' => $curfamss,'serviceforms' => $serviceforms,'tree'=>$tree]);
    }





    public function sentservice(Request $request){
      //  $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
    //  $ew = $request->ew;
    //  $dw =$request->dw;
  //    $mer = $ew."<br>".$dw;
  $current = Auth::user()->id;
      $matchids = DB::table('match_id')
      ->where('match_id.user_id',$current)

     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     ->value('id');


      $noti = new Noti;
                //$noti->message_type_id = 7;
                $noti->message = $request-> ew;
                $noti->topic = $request-> dw;
                //$noti->sender_note  = $request-> sender_note;
                //$noti->status = $request-> status;
                //$noti->sender_id  = $match_id->id;
                $noti->created_by = 1;
                $noti->recieve_id = $matchids;
                $noti->save();

    //  dd($mer);
 //return $mer;

      return redirect ('/admin/service');
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




        //$views = View::all();
		$cats = Message_cat::all();
        $groups = Group_service::all();
        $types = Message_type::all();
        return view('system-mgmt/serviceform/create',['cats' => $cats,'types' => $types,'groups' => $groups,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      Group_service::findOrFail($request['group_service_id']);
      Message_type::findOrFail($request['msg_type_id']);


      $service = new service_form;
      $service->group_service_id = $request-> group_service_id ;
      $service->msg_type_id = $request-> msg_type_id;
      $service->name = $request-> name;
      $service->text_field1 = $request-> text_field1;
      $service->unit_field1 = $request-> unit_field1;
      $service->text_field2 = $request-> text_field2;
      $service->unit_field2 = $request-> unit_field2;
      $service->text_field3 = $request-> text_field3;
      $service->unit_field3 = $request-> unit_field3;
      $service->text_field4 = $request-> text_field4;
      $service->unit_field4 = $request-> unit_field4;
      $service->text_field5 = $request-> text_field5 ;
      $service->unit_field5 = $request-> unit_field5;
      $service->icon = $request-> icon;
      $service->citizen_id = $request-> citizen_id;
      $service->port_number = $request-> port_number;
      $service->parallel = $request-> parallel;
      if($request->file('attachment')){
        $filename = $request->file('attachment')->getClientOriginalName();
    //
      //  return $filename;
      //  Storage::disk('myowndisk')->put($filename, file_get_contents($request->file('attachment')->getRealPath()));
        $image_thumb = Image::make($request->file('attachment'))->resize(362, 200)->stream();
        $uploaded = Storage::disk('myowndisk')->put($filename, $image_thumb);
        $service->attachment = $filename;

      }
    //  dd($request->all());
      $service->save();




        return redirect ('/admin/serviceform');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $blocks = View::find($id)->portfolio;
      $views = Vew::paginate(5);
      return view('/view/index', compact(['views','blocks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      //sidebar

$tree = session()->get('tree');
//sidebar

        $view =service_form::find($id);
		$views =service_form::all();
        // Redirect to department list if updating department wasn't existed
        if ($view == null) {
          $view = service_form::find($id);
          $data = array(
              'view' => $view
            );
            return redirect ('/admin/service');
        }

      $group = Group_service::all();
      $type = Message_type::all();
		$cats = Message_cat::all();

        return view('system-mgmt/serviceform/edit', ['cats' => $cats,'group' => $group,
                                                        'type' => $type,'view' => $view,
                                                        'views' => $views,'tree'=>$tree]);
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
        $view = service_form::findOrFail($id);
        //$this->validateInput($request);
        $service = service_form::find($id);
        $service->group_service_id = $request-> group_service_id ;
        $service->msg_type_id = $request-> msg_type_id;
        $service->name = $request-> name;
        $service->text_field1 = $request-> text_field1;
        $service->unit_field1 = $request-> unit_field1;
        $service->text_field2 = $request-> text_field2;
        $service->unit_field2 = $request-> unit_field2;
        $service->text_field3 = $request-> text_field3;
        $service->unit_field3 = $request-> unit_field3;
        $service->text_field4 = $request-> text_field4;
        $service->unit_field4 = $request-> unit_field4;
        $service->text_field5 = $request-> text_field5 ;
        $service->unit_field5 = $request-> unit_field5;
        $service->icon = $request-> icon;
        $service->citizen_id = $request-> citizen_id;
        $service->port_number = $request-> port_number;
        $service->parallel = $request-> parallel;

        if($request->hasFile('attachment')){
          $filename = $request->file('attachment')->getClientOriginalName();
      //
        //  return $filename;
        //  Storage::disk('myowndisk')->put($filename, file_get_contents($request->file('attachment')->getRealPath()));
          $image_thumb = Image::make($request->file('attachment'))->resize(362, 200)->stream();
          $uploaded = Storage::disk('myowndisk')->put($filename, $image_thumb);
          $service->attachment = $filename;
  //return  $service->attachment = $filename;
        }

      //  dd($request->all());
        $service->save();

        return redirect ('/admin/serviceform');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        service_form::where('id', $id)->delete();
         return redirect()->back();
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

      //sidebar

  $tree = session()->get('tree');
  //sidebar

        $constraints = [
            'name' => $request['name']
            ];

       $views = $this->doSearchingQuery($constraints);
       return view('system-mgmt/view/index', ['views' => $views, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = View::query();
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
        //'name' => 'unique:views',
      //  'select_file'  => 'required|image|mimes:jpg,png,gif|max:2048'
    ]);
    }
    public function listtype(Request $request){


      //sidebar

      $tree = session()->get('tree');
      //sidebar

            $org = $request->org;

          //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
              $curfamss = service_form::all();
              $serg = Group_service::all();


      $serviceforms = DB::table('service_form')
      ->leftJoin('group_of_service', 'service_form.group_service_id', '=', 'group_of_service.id')
      ->leftJoin('message_types', 'service_form.msg_type_id', '=', 'message_types.id')
      ->where('service_form.name' , $org)
      ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')



           ->paginate(100);
           return view('system-mgmt/serviceform/index', ['serg'=>$serg,'serviceforms'=>$serviceforms,'curfamss'=>$curfamss,'tree' =>$tree]);

    }

}
