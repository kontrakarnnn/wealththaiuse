@extends('users-mgmt.base')
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
          <h3 class="box-title">List of users</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('user-management.create') }}">Add new user</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('user-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['User Name', 'First Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['username'] : '', isset($searchingVals) ? $searchingVals['firstname'] : '']])
          @endcomponent
          </br>
           @component('layouts.two-cols-search-row', ['items' => ['Last Name','email'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['lastname'] : '', isset($searchingVals) ? $searchingVals['email'] : '']])
          @endcomponent
        </br>

        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending">User Name</th>

                <th width="20%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending">First Name</th>
                <th width="20%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Last Name</th>

                <th width="20%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>

                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">PublicID</th>

                <th rowspan="20%" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)

                <tr styler="color:green;"role="row" class="odd">



                  @if($user->status == "Active")
                  <td style ="background-color:#DAF7A6  ;color:black">{{ $user->username }}</td>
                  <td style ="background-color:#DAF7A6  ;color:black">{{ $user->firstname }}</td>
                  <td style ="background-color:#DAF7A6  ;color:black" >{{ $user->lastname }}</td>
                    <td style ="background-color:#DAF7A6  ;color:black">{{ $user->email }}</td>
                    <td style ="background-color:#DAF7A6  ;color:black">{{ $user->status }}</td>
                    <td style ="background-color:#DAF7A6  ;color:black">{{ $user->user_pid }}</td>
                    <td style ="background-color:#DAF7A6  ;color:black">
                      <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <a href="{{ URL::to('admin/user/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                          ResetPassword
                          </a>
                          <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                          Update
                          </a>

                          @if ($user->username != Auth::user()->username)
                           <button type="submit" class="btn btn-danger c btn-margin">
                            Delete
                          </button>
                          @endif
                      </form>
                    </td>


              @elseif ($user->status == "Banned")
              <td style ="background-color:red;color:white;"  >{{ $user->username }}</td>
              <td style ="background-color:red;color:white;"   >{{ $user->firstname }}</td>
              <td style ="background-color:red;color:white;"   >{{ $user->lastname }}</td>
                <td style ="background-color:red;color:white;">{{ $user->email }}</td>
                <td style ="background-color:red;color:white;">{{ $user->status }}</td>
                <td style ="background-color:red;color:white;">{{ $user->user_pid }}</td>
                <td  style ="background-color:red;color:white;">
                  <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ URL::to('admin/user/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                      ResetPassword
                      </a>
                      <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                      Update
                      </a>

                      @if ($user->username != Auth::user()->username)
                       <button type="submit" class="btn btn-danger c btn-margin">
                        Delete
                      </button>
                      @endif
                  </form>
                </td>
              @elseif ($user->status == "Suspend")
              <td style ="background-color:orange;color:white"  >{{ $user->username }}</td>
              <td style ="background-color:orange;color:white"   >{{ $user->firstname }}</td>
              <td style ="background-color:orange;color:white"   >{{ $user->lastname }}</td>
                <td style ="background-color:orange;color:white">{{ $user->email }}</td>
                <td style ="background-color:orange;color:white">{{ $user->status }}</td>
                <td style ="background-color:orange;color:white">{{ $user->user_pid }}</td>
                <td style ="background-color:orange;color:white">
                  <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ URL::to('admin/user/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                      ResetPassword
                      </a>
                      <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                      Update
                      </a>

                      @if ($user->username != Auth::user()->username)
                       <button type="submit" class="btn btn-danger c btn-margin">
                        Delete
                      </button>
                      @endif
                  </form>
                </td>
              @elseif ($user->status == "Disabled")
              <td style ="background-color:grey;color:white"  >{{ $user->username }}</td>
              <td style ="background-color:grey;color:white"   >{{ $user->firstname }}</td>
              <td style ="background-color:grey;color:white"   >{{ $user->lastname }}</td>
                <td style ="background-color:grey;color:white">{{ $user->email }}</td>
                <td style ="background-color:grey;color:white">{{ $user->status }}</td>
                <td style ="background-color:grey;color:white">{{ $user->user_pid }}</td>
                <td style ="background-color:grey;color:white">
                  <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ URL::to('admin/user/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                      ResetPassword
                      </a>
                      <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                      Update
                      </a>

                      @if ($user->username != Auth::user()->username)
                       <button type="submit" class="btn btn-danger c btn-margin">
                        Delete
                      </button>
                      @endif
                  </form>
                </td>

              @else
              <td  >{{ $user->username }}</td>
              <td   >{{ $user->firstname }}</td>
              <td   >{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->user_pid }}</td>
                <td>
                  <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ URL::to('admin/user/resetpassword',$user->id)}}" class="btn btn-info  btn-margin">
                      ResetPassword
                      </a>
                      <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-warning  btn-margin">
                      Update
                      </a>

                      @if ($user->username != Auth::user()->username)
                       <button type="submit" class="btn btn-danger c btn-margin">
                        Delete
                      </button>
                      @endif
                  </form>
                </td>
                @endif




              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending">User Name</th>

                <th width="20%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending">First Name</th>
                <th width="20%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Last Name</th>

                <th width="20%" class="sorting " tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>

                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">PublicID</th>
                <th rowspan="20%" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->

  </div>
@endsection
