@extends('adminbase')

@section('action-content')
  <section class="content">
    <div class="box">
<div class="box-header">
  <div class="row">
      <div class="col-sm-8">
        <h3 class="box-title">List of users</h3>
      </div>

  </div>
</div>
<!-- /.box-header -->
<div class="box-body">


  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
    <div class="row">
      <div class="col-sm-12">
		  <div style="overflow-x:auto;">
        <table>
            <thead>

            <th style="width:25%">Name</th>

            <th style="width:25%">E-Mail</th>
            <th >User</th>
            <th >Author</th>
            <th >Admin</th>
            <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending"></th>
          </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr role="row">
                    <form action="{{ route('admin.assign') }}" method="post">
                        <td width="1%">{{ $user->firstname }}      {{ $user->lastname }}</td>

                        <td width="10%">{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                        <td width="5%"><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                        <td width="5%"><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author"></td>
                        <td width="5%"><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                        {{ csrf_field() }}
                        <td><button  class="btn btn-primary   " type="submit">Assign Roles</button></td>
                    </form>

            @endforeach
          </tr>
            </tbody>
        </table>
		</div>
      </div>
    </div>

  </div>
</div>
<!-- /.box-body -->
</div>
  </section>




@endsection
