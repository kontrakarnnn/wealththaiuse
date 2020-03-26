@extends('peradmin.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Member</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('peradmin.create') }}">Add new Member</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('peradmin.search') }}">
         {{ csrf_field() }}
          @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name', 'lname'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '', isset($searchingVals) ? $searchingVals['lname'] :'']])
          @endcomponent
          <br>
         @component('layouts.two-cols-search-row', ['items' => ['mobile', 'id_num'],
         'oldVals' => [isset($searchingVals) ? $searchingVals['mobile'] : '', isset($searchingVals) ? $searchingVals['id_num'] :'']])
         @endcomponent
         <br>

         @component('layouts.two-cols-search-row', ['items' => ['email', 'nickname'],
         'oldVals' => [isset($searchingVals) ? $searchingVals['email'] : '', isset($searchingVals) ? $searchingVals['nickname'] :'']])
         @endcomponent
         <br>
         @component('layouts.two-cols-search-row', ['items' => ['memtype_name'],
         'oldVals' => [isset($searchingVals) ? $searchingVals['memtype_name'] : '']])
         @endcomponent
       @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

      <div class="row">
        <div class="col-sm-12">
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Nick Name</th>
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th  class=" " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
                   <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th width="12%" class=" " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
                <th  class=" " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Type</th>
                <th  class=" " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($persons as $user)
                <tr role="row" class="odd">
                  @if($user->status == "Active")

                  <td  style ="background-color:#DAF7A6  ;color:black">{{ $user->nickname }}</td>
                  <td  style ="background-color:#DAF7A6  ;color:black">{{ $user->name }}</td>
                  <td  style ="background-color:#DAF7A6  ;color:black">{{ $user->lname }}</td>
                  <td style ="background-color:#DAF7A6  ;color:black">{{ $user->Eng_name }}</td>
					<td style ="background-color:#DAF7A6  ;color:black">{{ $user->Eng_lastname }}</td>
          <td style ="background-color:#DAF7A6  ;color:black">{{ $user->memtype_name }}</td>
          <td style ="background-color:#DAF7A6  ;color:black">{{ $user->status }}</td>


                  <td  style ="background-color:#DAF7A6  ;color:black">
                    <form class="row" method="POST" action="{{ route('peradmin.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ URL::to('admin/member/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                        ResetPassword
                        </a>

                        <a href="{{ route('peradmin.show', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                        View
                        </a>
                        <a href="{{ route('peradmin.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>

                         <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>

                    </form>
                  </td>
                  @elseif ($user->status == "Banned")
                    <td  style ="background-color:red;color:white;">{{ $user->nickname }}</td>
                    <td  style ="background-color:red;color:white;">{{ $user->name }}</td>
                    <td  style ="background-color:red;color:white;">{{ $user->lname }}</td>
                    <td style ="background-color:red;color:white;">{{ $user->Eng_name }}</td>
  					<td style ="background-color:red;color:white;">{{ $user->Eng_lastname }}</td>
            <td style ="background-color:red;color:white;">{{ $user->memtype_name }}</td>
            <td style ="background-color:red;color:white;">{{ $user->status }}</td>


                    <td  style ="background-color:red;color:white;">
                      <form class="row" method="POST" action="{{ route('peradmin.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <a href="{{ URL::to('admin/member/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                          ResetPassword
                          </a>

                          <a href="{{ route('peradmin.show', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                          View
                          </a>
                          <a href="{{ route('peradmin.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                          Update
                          </a>

                           <button type="submit" class="btn btn-danger  btn-margin">
                            Delete
                          </button>

                      </form>
                    </td>
                    @elseif ($user->status == "Disabled")
                      <td  style ="background-color:grey;color:white">{{ $user->nickname }}</td>
                      <td  style ="background-color:grey;color:white">{{ $user->name }}</td>
                      <td  style ="background-color:grey;color:white">{{ $user->lname }}</td>
                      <td style ="background-color:grey;color:white">{{ $user->Eng_name }}</td>
              <td style ="background-color:grey;color:white">{{ $user->Eng_lastname }}</td>
              <td style ="background-color:grey;color:white">{{ $user->memtype_name }}</td>
              <td style ="background-color:grey;color:white">{{ $user->status }}</td>


                      <td  style ="background-color:grey;color:white">
                        <form class="row" method="POST" action="{{ route('peradmin.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ URL::to('admin/member/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                            ResetPassword
                            </a>

                            <a href="{{ route('peradmin.show', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                            View
                            </a>
                            <a href="{{ route('peradmin.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                            Update
                            </a>

                             <button type="submit" class="btn btn-danger  btn-margin">
                              Delete
                            </button>

                        </form>
                      </td>
                      @elseif ($user->status == "Request Reset Password")
                        <td  style ="background-color:#E6E6FA;color:black">{{ $user->nickname }}</td>
                        <td  style ="background-color:#E6E6FA;color:black">{{ $user->name }}</td>
                        <td  style ="background-color:#E6E6FA;color:black">{{ $user->lname }}</td>
                        <td style ="background-color:#E6E6FA;color:black">{{ $user->Eng_name }}</td>
                <td style ="background-color:#E6E6FA;color:black">{{ $user->Eng_lastname }}</td>
                <td style ="background-color:#E6E6FA;color:black">{{ $user->memtype_name }}</td>
                <td style ="background-color:#E6E6FA;color:black">{{ $user->status }}</td>


                        <td  style ="background-color:#E6E6FA;color:black">
                          <form class="row" method="POST" action="{{ route('peradmin.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <a href="{{ URL::to('admin/member/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                              ResetPassword
                              </a>

                              <a href="{{ route('peradmin.show', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                              View
                              </a>
                              <a href="{{ route('peradmin.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                              Update
                              </a>

                               <button type="submit" class="btn btn-danger  btn-margin">
                                Delete
                              </button>

                          </form>
                        </td>
                        @else
                          <td  >{{ $user->nickname }}</td>
                          <td  >{{ $user->name }}</td>
                          <td  >{{ $user->lname }}</td>
                          <td >{{ $user->Eng_name }}</td>
                  <td >{{ $user->Eng_lastname }}</td>
                  <td >{{ $user->memtype_name }}</td>
                  <td >{{ $user->status }}</td>


                          <td  >
                            <form class="row" method="POST" action="{{ route('peradmin.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="{{ URL::to('admin/member/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                                ResetPassword
                                </a>

                                <a href="{{ route('peradmin.show', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                                View
                                </a>
                                <a href="{{ route('peradmin.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                                Update
                                </a>

                                 <button type="submit" class="btn btn-danger  btn-margin">
                                  Delete
                                </button>

                            </form>
                          </td>
                          @endif
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Nick Name</th>
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th  class=" " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
                   <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th  class=" " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
                <th  class=" " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Type</th>
                                <th >Status</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
		  </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($persons)}} of {{count($persons)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $persons->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
@endsection
