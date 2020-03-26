<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Server;
use App\Http\Controllers\SidebarController;


class ServerController extends Controller
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

      //sidebar

    $tree = session()->get('tree');
    //sidebar


        $structures = Server::paginate(30);

        return view('system-mgmt/server/index', ['structures' => $structures,'tree'=>$tree]);
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

        return view('system-mgmt/server/create',['tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
         Server::create([
            'name' => $request['name'],
            'ip' => $request['ip'],
            'description' => $request['description'],
        ]);

        return redirect ('/admin/server');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //sidebar

      $tree = session()->get('tree');
      //sidebar


      $blocks = Server::find($id)->portfolio;
      $structures = Server::paginate(5);
      return view('system-mgmt/server/index', compact(['structures','blocks','tree']));
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


        $structure = Server::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($structure == null) {
          $structure = Server::find($id);
          $data = array(
              'structure' => $structure
            );
            return redirect ('/admin/server');
        }

        return view('system-mgmt/server/edit', ['structure' => $structure,'tree'=>$tree]);
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
        $structure = Server::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'ip' => $request['ip'],
          'description' => $request['description'],
        ];
        Server::where('id', $id)
            ->update($input);

        return redirect ('/admin/server');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Server::where('id', $id)->delete();
         return redirect ('/admin/server');
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
          'name' => $request['name'],
          'ip' => $request['ip'],
          'description' => $request['description'],
            ];

       $structures = $this->doSearchingQuery($constraints);
       return view('system-mgmt/server/index', ['structures' => $structures, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = Server::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
      //  'name' => 'required|max:60|unique:server'
    ]);
    }
}
