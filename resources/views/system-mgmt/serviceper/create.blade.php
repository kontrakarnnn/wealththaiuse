@extends('system-mgmt.serviceform.base')

@section('action-content')


  <style>
  	select{
  		font-family: fontAwesome
  	}
  </style>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new view</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('serviceform.store') }}">
                        {{ csrf_field() }}



                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="attachment" class="col-md-4 control-label">attachment</label>

                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}"  >

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">




                          <label class="col-md-4 control-label">Group Service</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="group_service_id">
                            <option value="" >-Select-</option>
                            @foreach ($groups as $group)
                              <option value={{$group->id}} >{{$group->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>
                        <div class="form-group">

                          <label class="col-md-4 control-label">Type Service</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="msg_type_id">
                            <option value="" >-Select-</option>
                            @foreach ($types as $type)
                              <option value={{$type->id}} >{{$type->message_template}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('text_field1') ? ' has-error' : '' }}">
                            <label for="text_field1" class="col-md-4 control-label">text_field1</label>

                            <div class="col-md-6">
                                <input id="text_field1" type="text" class="form-control" name="text_field1" value="{{ old('text_field1') }}"  >

                                @if ($errors->has('text_field1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text_field1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit_field1') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">unit_field1</label>

                            <div class="col-md-6">
                                <input id="unit_field1" type="text" class="form-control" name="unit_field1" value="{{ old('unit_field1') }}"  >

                                @if ($errors->has('unit_field1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_field1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('text_field2') ? ' has-error' : '' }}">
                            <label for="text_field2" class="col-md-4 control-label">text_field2</label>

                            <div class="col-md-6">
                                <input id="text_field2" type="text" class="form-control" name="text_field2" value="{{ old('text_field2') }}"  >

                                @if ($errors->has('text_field2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text_field2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit_field2') ? ' has-error' : '' }}">
                            <label for="unit_field2" class="col-md-4 control-label">unit_field2</label>

                            <div class="col-md-6">
                                <input id="unit_field2" type="text" class="form-control" name="unit_field2" value="{{ old('unit_field2') }}"  >

                                @if ($errors->has('unit_field2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_field2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('text_field3') ? ' has-error' : '' }}">
                            <label for="text_field3" class="col-md-4 control-label">text_field3</label>

                            <div class="col-md-6">
                                <input id="text_field3" type="text" class="form-control" name="text_field3" value="{{ old('text_field3') }}"  >

                                @if ($errors->has('text_field3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text_field3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit_field3') ? ' has-error' : '' }}">
                            <label for="unit_field3" class="col-md-4 control-label">unit_field3</label>

                            <div class="col-md-6">
                                <input id="unit_field3" type="text" class="form-control" name="unit_field3" value="{{ old('unit_field3') }}"  >

                                @if ($errors->has('unit_field3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_field3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('text_field4') ? ' has-error' : '' }}">
                            <label for="text_field4" class="col-md-4 control-label">text_field4</label>

                            <div class="col-md-6">
                                <input id="text_field4" type="text" class="form-control" name="text_field4" value="{{ old('text_field4') }}"  >

                                @if ($errors->has('text_field4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text_field4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit_field4') ? ' has-error' : '' }}">
                            <label for="unit_field4" class="col-md-4 control-label">unit_field4</label>

                            <div class="col-md-6">
                                <input id="unit_field4" type="text" class="form-control" name="unit_field4" value="{{ old('unit_field4') }}"  >

                                @if ($errors->has('unit_field4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_field4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('text_field5') ? ' has-error' : '' }}">
                            <label for="text_field4" class="col-md-4 control-label">text_field5</label>

                            <div class="col-md-6">
                                <input id="text_field5" type="text" class="form-control" name="text_field5" value="{{ old('text_field5') }}"  >

                                @if ($errors->has('text_field5'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text_field5') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit_field5') ? ' has-error' : '' }}">
                            <label for="unit_field5" class="col-md-4 control-label">unit_field5</label>

                            <div class="col-md-6">
                                <input id="unit_field5" type="text" class="form-control" name="unit_field5" value="{{ old('unit_field5') }}"  >

                                @if ($errors->has('unit_field5'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_field5') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                                          <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                		<input type="checkbox"  name="citizen_id" value="Yes"> Request Citizen ID<br>
                                        </div>
                                        </div>

                          <div class="form-group">

                                            <label class="col-md-4 control-label"></label>
                                            <div class="col-md-6">
                                          	<input type="checkbox"  name="port_number" value="Yes"> Request Portfolio Number<br>
                                            </div>
                                            </div>

                            <div class="form-group">

                                            <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                            <input type="checkbox"  name="parallel" value="Yes">Can all over request<br>
                                              </div>
                                              </div>




                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
