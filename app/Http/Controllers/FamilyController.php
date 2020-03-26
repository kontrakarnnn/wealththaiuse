<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Family;
use App\Family_auth;
use App\ Port_Group_auth;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewper;
use Session;

class FamilyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('viewper');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current = Auth::guard('person')->user()->id;

        $curfam = DB::table('family_auths')
        ->where('member_id',$current)
        ->where('status',"Accept")
        ->pluck('family_id');
        $alertinvite = DB::table('family_auths')->where('member_id',$current)->where('status','Request')->count();
        $structures = Family::whereIn('id',$curfam)->paginate(1000);
        return view('system-mgmt/family/index', [ 'alertinvite' => $alertinvite, 'current' => $current,'structures' => $structures  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


      $current = Auth::guard('person')->user()->id;
      $currentid = DB::table('persons')

              ->where(//[ 'structure_id', '=',9 ],
                        'id', '=',$current

                     )
                     ->get();


        return view('system-mgmt/family/create',['currentid' =>$currentid  ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $current = Auth::guard('person')->user()->id;

        $this->validateInput($request);

        $fam = new Family;
        $fam -> name = $request->name;
        $fam -> approve = $request->approve;
        $fam -> show_mem = $request->show_mem;
        $fam -> created_by = $request->created_by;
        $fam->save();
        $famauth = new Family_auth;
        $famauth->family_id = $fam->id;
        $famauth->member_id = $current;
        $famauth->status = 'Accept';
        $famauth->created_by = $current;
        $famauth->save();

        return redirect()->intended('/family');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $current = Auth::guard('person')->user()->id;
      $structures = DB::table('family_auths')->where('family_id',$id)->where('status','Accept')->pluck('member_id')->toArray();
      $member = DB::table('persons')->whereIn('id',$structures)->get();
      return view('system-mgmt/family/show', compact(['member']));
    }

    public function portgroup($id)
    {
          $current = Auth::guard('person')->user()->id;

          $currentgroup = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
          if(in_array($id,$currentgroup))
          {


      $groupid = $id;
      $portingroup = DB::table('port_group_auths')->where('group_id',$id)
      ->leftJoin('persons','port_group_auths.created_by','persons.id')
      ->leftJoin('portfolio','port_group_auths.port_id','=','portfolio.id')
	  ->leftJoin('port_types','portfolio.port_id','=','port_types.id')
      ->leftJoin('structure','portfolio.structure_id','=','structure.id')
      ->leftJoin('block','portfolio.block_id','=','block.id')
      ->select('port_group_auths.*','port_types.type as port_type_name','portfolio.id as port_id','portfolio.number as number','portfolio.type as port_name','persons.name as creator','persons.lname as 					   creatorl','structure.name as structure_name',
      'block.name as block_name','block.contact_name as contact_name','block.contact_tel as contact_tel','block.contact_email as contact_email')
      ->get();
    /*  $portingroup = DB::table('portfolio')->whereIn('portfolio.id',$portauth)
      ->leftJoin('persons','portfolio.member_id','=','persons.id')
      ->leftJoin('structure','portfolio.structure_id','structure.id')
      ->leftJoin('block','portfolio.block_id','block.id')
      ->select('portfolio.*','structure.name as structure_name','block.name as block_name',
      'block.contact_name as contact_name','block.contact_tel as contact_tel','block.contact_email as contact_email')
      ->get();*/
      $structures = DB::table('family_auths')->where('family_id',$id)->pluck('member_id')->toArray();
      $member = DB::table('persons')->whereIn('id',$structures)->get();
      return view('system-mgmt/family/port', compact(['portingroup','member']));
    }
    return view('error');
}


    /**
     * Show the form for ing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

     $current = Auth::guard('person')->user()->id;

      $currentid = DB::table('persons')

              ->where(//[ 'structure_id', '=',9 ],
                        'id', '=',$current

                     )
                     ->get();
                     $curfam = DB::table('family_auths')
                     ->where('member_id',$current)
                     ->where('status',"Accept")
                     ->pluck('family_id');
                     //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
                       $structures = Family::where('created_by',$current)->orwhereIn('id',$curfam)->pluck('id');
                       $structures = $structures->toArray();
        $structure = Family::find($id);

        $current = Auth::guard('person')->user()->id;
        $url  = $_SERVER['REQUEST_URI'];
        $url = explode('/',$url);
        $url = $url[2];
       $userauths = DB::table('family_auths')
       ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
      ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
      ->where('family.id' , $url)
      //->where('family_auths.status','Waiting')
      ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id')
      ->paginate(100);

        // Redirect to department list if updating department wasn't existed
        if(in_array($id,$structures)) {
          $structure = Family::find($id);
          $data = array(
              'structure' => $structure
            );
            $current = Auth::guard('person')->user()->id;
            $st = Family::where('id',$id)->value('created_by');
            $structures = 0;
            if($st == $current){
              $structures = 1;
            }

            //return $structures;
            return view('system-mgmt/family/edit', ['current' => $current,'structures' => $structures,'userauths' => $userauths,'structure' => $structure,'currentid'=> $currentid  ]);
        }



        return view('error');

    }


    public function status(Request $request,$id)
    {
	$status   = $request->status;
     $current = Auth::guard('person')->user()->id;

      $currentid = DB::table('persons')

              ->where(//[ 'structure_id', '=',9 ],
                        'id', '=',$current

                     )
                     ->get();
                     $curfam = DB::table('family_auths')
                     ->where('member_id',$current)
                     ->where('status',"Accept")
                     ->pluck('family_id');
                     //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
                       $structures = Family::where('created_by',$current)->orwhereIn('id',$curfam)->pluck('id');
                       $structures = $structures->toArray();
        $structure = Family::find($id);

        $current = Auth::guard('person')->user()->id;
        $url  = $_SERVER['REQUEST_URI'];
        $url = explode('/',$url);
        $url = $url[2];
       $userauths = DB::table('family_auths')
       ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
      ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
      ->where('family.id' , $url)
      ->where('family_auths.status' , $status)
      //->where('family_auths.status','Waiting')
      ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id')
      ->paginate(100);

        // Redirect to department list if updating department wasn't existed
        if(in_array($id,$structures)) {
          $structure = Family::find($id);
          $data = array(
              'structure' => $structure
            );
            $current = Auth::guard('person')->user()->id;
            $st = Family::where('id',$id)->value('created_by');
            $structures = 0;
            if($st == $current){
              $structures = 1;
            }

            //return $structures;
            return view('system-mgmt/family/status', ['current' => $current,'structures' => $structures,'userauths' => $userauths,'structure' => $structure,'currentid'=> $currentid  ]);
        }



        return view('error');

    }

    function fetch_data(Request $request)
    {

     if($request->ajax())
     {
       $url  = $_SERVER['REQUEST_URI'];
       $url = explode('/',$url);
       $url = $url[2];
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
      $query = $request->get('query');
      $query = str_replace(" ", "%", $query);
      $userauths = DB::table('family_auths')
      ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
     ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
      ->where('family.id' , $url)
      ->where(function ($q) use ($query)  {
              return   $q->where('persons.name', 'like', '%'.$query.'%')
                ->orWhere('family.name', 'like', '%'.$query.'%')
                ->orWhere('family_auths.status', 'like', '%'.$query.'%');
            })

      ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id')
      ->orderBy($sort_by, $sort_type)
      ->get();
      return view('system-mgmt/family/pagination_data', compact('userauths'))->render();
     }
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



        $structure = Family::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'created_by' => $request['created_by'],
            'approve' => $request['approve'],
            'show_mem' => $request['show_mem'],
        ];
        Family::where('id', $id)
            ->update($input);

        return redirect()->intended('/family');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Family::where('id', $id)->delete();
        Family_auth::where('family_id',$id)->delete();
        Port_Group_auth::where('group_id',$id)->delete();
        return redirect()->intended('/family');
    }

    public function leavegroup($id)
    {
      $current = Auth::guard('person')->user()->id;
      $re = Family_auth::where('family_id',$id)->where('member_id',$current)->delete();
      Family_auth::where('family_id',$id)->where('member_id',$current)->delete();
      Port_Group_auth::where('group_id',$id)->where('created_by',$current)->delete();
      return redirect()->back();
    }



    public function approve($id)
    {
      $current = Auth::guard('person')->user()->id;
      Family_auth::where('id', $id)
      ->update(['status'=>'Accept']);
      return redirect()->back();
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

    $current = Auth::guard('person')->user()->id;


        $constraints = [
            'name' => $request['name']
            ];
            $current = Auth::guard('person')->user()->id;
            $curfam = DB::table('family_auths')
            ->where('member_id',$current)
            ->where('status',"Accept")
            ->pluck('family_id');
            $alertinvite = DB::table('family_auths')->where('member_id',$current)->where('status','Request')->count();
       $structures = $this->doSearchingQuery($constraints);
       return view('system-mgmt/family/index', ['current' => $current,'alertinvite' => $alertinvite,'structures' => $structures, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
		
		        $current = Auth::guard('person')->user()->id;

        $curfam = DB::table('family_auths')
        ->where('member_id',$current)
        ->where('status',"Accept")
        ->pluck('family_id');

        $query = Family::whereIn('id',$curfam);
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(1000000);
    }


    public function searchedit(Request $request) {

    $current = Auth::guard('person')->user()->id;


        $constraints = [
            'name' => $request['name']
            ];
            $current = Auth::guard('person')->user()->id;
            $curfam = DB::table('family_auths')
            ->where('member_id',$current)
            ->where('status',"Accept")
            ->pluck('family_id');
            $alertinvite = DB::table('family_auths')->where('member_id',$current)->where('status','Request')->count();
       $structures = $this->doSearchingQueryedit($constraints);
       return view('system-mgmt/family/index', ['current' => $current,'alertinvite' => $alertinvite,'structures' => $structures, 'searchingVals' => $constraints]);
    }
    private function doSearchingQueryedit($constraints) {
      $current = Auth::guard('person')->user()->id;
      $url  = $_SERVER['REQUEST_URI'];
      $url = explode('/',$url);
      $url = $url[2];
        $query = DB::table('family_auths')
        ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
       ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
       ->where('family.id' , $url)
       //->where('family_auths.status','Waiting')
       ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id');

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
        'name' => 'required|max:60'
    ]);
    }
}
