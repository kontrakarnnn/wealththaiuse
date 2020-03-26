@extends('system-mgmt.partnerblock.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Tool Type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('partnerblock.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Block Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                            <label for="contact_name" class="col-md-4 control-label">Contact Name</label>

                            <div class="col-md-6">
                                <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{$data->contact_name}}">

                                @if ($errors->has('contact_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('contact_tel') ? ' has-error' : '' }}">
                            <label for="contact_tel" class="col-md-4 control-label">Contact Phone</label>

                            <div class="col-md-6">
                                <input id="contact_tel" type="text" class="form-control" name="contact_tel" value="{{$data->contact_tel }}" >

                                @if ($errors->has('contact_tel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_tel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label for="contact_email" class="col-md-4 control-label">Contact E-mail</label>

                            <div class="col-md-6">
                                <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{ $data->contact_email}}" >

                                @if ($errors->has('contact_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('default_pid') ? ' has-error' : '' }}">
                            <label for="default_pid" class="col-md-4 control-label">Default PID</label>

                            <div class="col-md-6">
                                <input id="default_pid" type="text" class="form-control" name="default_pid" value="{{ $data->default_pid }}" >

                                @if ($errors->has('default_pid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('default_pid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option>{{ $data->status}}</option>
                                    <option>0</option>
                                    <option>1</option>
                                </select>
                                 @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                                                <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                                              <label class="col-md-4 control-label">Structure:</label>
                                                <div class="col-md-6">
                                                  <select class=" form-control department" name="structure_id">

                                                      <option value="0" >-Select-</option>
                                                      @foreach ($partnerstructure as $structure)
                                                          <option value="{{$structure->id}}"{{$structure->id == $data->structure_id ? 'selected' : ''}}>{{$structure->name}}</option>
                                                      @endforeach

                                                  </select>
                                                  <label class="col-md-4 control-label">Belong to:</label>

                                                  <select class="col-md-6 form-control name " name="under_block" >
                                                    <option value="">

                                                    </option>
                                                    @foreach ($datas as $blo)
                                                      <option value="{{$blo->id}}"{{$blo->id == $data->under_block ? 'selected' : ''}}>{{$blo->name}}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                                </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
