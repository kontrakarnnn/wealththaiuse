@extends('system-mgmt.mytool.base')

@section('action-content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">ฉนืดรเ ธนนส ธน ญนพะ</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('member-tool-admin.store') }}">
                        {{ csrf_field() }}
                        <div style="overflow-x:auto;">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                              <thead>
                                <tr role="row">
                                  <th >Portfolio Name</th>
                                  <th>Portfolio Number</th>
                                  <th>Department Name</th>
                                  <th>Block Name</th>
                                  <th>Portfolio Type</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($portfolio as $da)
                                  <tr role="row" class="odd">
                                    <td>{{ $da->type }}</td>
                                    <td>{{ $da->number }}</td>
                                    <td>{{ $da->Structure->name }}</td>
                                    <td>{{ $da->Block->name }}</td>
                                    <td>{{ $da->Port_type->type }}</td>


                                    <td>
                                      <form class="row" method="POST" action="{{ route('member-tool-admin.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">

                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <label class="switch">

                                            <input type="checkbox"  onchange="window.location.href=this.value;">
                                            <span class="slider round"></span>
                                          </label>
                                          <button type="submit" class="btn btn-danger btn-margin">
                                            Delete
                                          </button>
                                        </form>

                                    </td>
                                </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th >Portfolio Name</th>
                                  <th>Portfolio Number</th>
                                  <th>Department Name</th>
                                  <th>Block Name</th>
                                  <th>Portfolio Type</th>
                                  <th>Action</th>
                                </tr>
                              </tfoot>
                            </table>
                  			</div>
                          </div>
                        </div>

                      </div>


                    </form>
                </div>
            </div>
    </div>
</div>


@endsection
