<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\User;
use App\match_id;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\PerController;

class ImportExcelController extends Controller
{
  public function __construct()
  {
      $this->middleware('view');
      $this->userconttroller = new UserManagementController;
      $this->structureconttroller = new StructureController;
      $this->datacontroller = new DataController;
      $this->blockcontroller = new BlockController;
      $this->perController = new PerController;
      $this->assetcontroller = new AssetController;
  }
    function userimport()
    {
     $data = [];
     $url = $_SERVER['REQUEST_URI'];
     return view('/admin/importexcel/user_import',compact('data','url'));
    }
    function blockimport(Request $request)
    {
      $url = $request->path();
     $flagpaginate =1;
     $blocks = $this->datacontroller->blockdata($flagpaginate);
     return view('/admin/importexcel/block_import', compact('blocks','url'));
    }
    function importshow(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();
     $data = Excel::load($path)->get();
     $datatopass  = $data->toArray();
     return $datatopass;
     return view('/admin/importexcel/user_import',compact('data','data'));
    }
    function importuser(Request $request)
    {
     $this->validate($request, [
      'select_user_file'             => 'required|mimes:xls,xlsx',
  ]);
      $userdata = $this->savedatauser($request);
     return redirect('/admin/import_excel_user?userdata=success')->with('success', 'User Data Imported successfully.');
    }
    function importblock(Request $request)
    {
      $url = url()->previous();
      if(!strstr($url,'userdata=success'))
      {
        return back()->with('warning', 'Please upload user data before upload block data !!!');
      }
     $this->validate($request, [
      'select_block_file' => 'required|mimes:xls,xlsx',
  ]);
       $blockdata = $this->savedatablock($request);
      $url = $url.'&blockdata=success';
     return redirect($url)->with('success', 'Block Data Imported successfully.');
    }

    function importcustomer(Request $request)
    {
      $url = url()->previous();
      if(!strstr($url,'blockdata=success'))
      {
        return back()->with('warning', 'Please upload block data before upload customer data !!!');
      }
     $this->validate($request, [
      'select_customer_file' => 'required|mimes:xls,xlsx',
      ]);
       $this->savedatacustomer($request);
      $url = $url.'&customerdata=success';
     return redirect($url)->with('success', 'Customer Data Imported successfully.');
    }
    function importcar(Request $request)
    {
      $url = url()->previous();
      if(!strstr($url,'customerdata=success'))
      {
        return back()->with('warning', 'Please upload customer data before upload car data !!!');
      }
     $this->validate($request, [
      'select_car_file' => 'required|mimes:xls,xlsx',
      ]);
        $this->savedatacar($request);
      $url = $url.'&cardata=success';
     return redirect($url)->with('success', 'Car Data Imported successfully.');
    }
    function importcarinsurance(Request $request)
    {
      $url = url()->previous();
      if(!strstr($url,'cardata=success'))
      {
        return back()->with('warning', 'Please upload car data before upload car insurance data !!!');
      }
     $this->validate($request, [
      'select_carinsurance_file' => 'required|mimes:xls,xlsx',
      ]);
        $this->savedatacar($request);
      $url = $url.'&cardata=success';
     return redirect($url)->with('success', 'Car insurance Data Imported successfully.');
    }
    public function savedatauser($request)
    {
      $path = $request->file('select_user_file')->getRealPath();
      $data = Excel::load($path)->get();
      $data->toArray();
      if($data->count() > 0)
      {
        foreach($data as $da)
        {
          $this->userconttroller->savedata($da);
        }
      }
      return $data;
    }
    public function savedatablock($request)
    {
      $path = $request->file('select_block_file')->getRealPath();
      $data = Excel::load($path)->get();
      $data->toArray();
      if(count($data) > 0)
      {
        foreach($data as $da)
        {
          $this->blockcontroller->savedataexcel($da);
        }
          $this->blockcontroller->updatebelongexcel($da);
      }
    }
    public function savedatacustomer($request)
    {
      $path = $request->file('select_customer_file')->getRealPath();
      $data = Excel::load($path)->get();
      $data->toArray();
      if($data->count() > 0)
      {
        foreach($data as $da)
        {
          $this->perController->savedataexcel($da);
        }
      }
      return $data;
    }
    public function savedatacar($request)
    {
      $path = $request->file('select_car_file')->getRealPath();
      $data = Excel::load($path)->get();
      $data->toArray();
      if($data->count() > 0)
      {
        foreach($data as $da)
        {
          $this->assetcontroller->savedataexcelcar($da);
        }
      }
      return $data;
    }
    public function savedatacarinsurance($request)
    {
      $path = $request->file('select_carinsurance_file')->getRealPath();
      $data = Excel::load($path)->get();
      $data->toArray();
      if($data->count() > 0)
      {
        foreach($data as $da)
        {
          $this->assetcontroller->savedataexcelcarinsurance($da);
        }
      }
      return $data;
    }
}
