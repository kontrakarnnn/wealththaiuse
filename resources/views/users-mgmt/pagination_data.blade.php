
@foreach ($users as $user)

    <tr styler="color:green;"role="row" class="odd">



      @if($user->status == "Active")
      <td style ="background-color:#DAF7A6  ;color:black">{{ $user->username }}</td>
      <td style ="background-color:#DAF7A6  ;color:black">{{ $user->firstname }}</td>
      <td style ="background-color:#DAF7A6  ;color:black" >{{ $user->lastname }}</td>
        <td style ="background-color:#DAF7A6  ;color:black">{{ $user->email }}</td>
        <td style ="background-color:#DAF7A6  ;color:black">{{ $user->status }}</td>
        <td style ="background-color:#DAF7A6  ;color:black">{{ $user->user_pid }}</td>
        <td style ="background-color:#DAF7A6;color:black">{{ $user->limit_prospect }}</td>

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
    <td style ="background-color:red;color:white">{{ $user->limit_prospect }}</td>

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
    <td style ="background-color:orange;color:white">{{ $user->limit_prospect }}</td>
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
    <td style ="background-color:grey;color:white">{{ $user->limit_prospect }}</td>

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
    <td>{{ $user->limit_prospect }}</td>

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
<tr>
       <td colspan="8" align="center">
         {!! $users->links() !!}
       </td>
      </tr>
<div class="row">
  <div class="col-sm-5">
    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
  </div>
  <div class="col-sm-7">
    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
         </div>
  </div>
</div>
