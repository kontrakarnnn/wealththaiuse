@extends('system-mgmt.tool.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Tool</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tool.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool Type</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="tool_type">
                            <option value="0" >-Select-</option>
                            @foreach ($tooltype as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tool Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tool_ref_product_id') ? ' has-error' : '' }}">
                            <label for="tool_ref_product_id" class="col-md-4 control-label">Tool Referal ProductID</label>

                            <div class="col-md-6">
                                <input id="tool_ref_product_id" type="text" class="form-control" name="tool_ref_product_id" value="{{ old('tool_ref_product_id') }}"  >

                                @if ($errors->has('tool_ref_product_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tool_ref_product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tool_info_link') ? ' has-error' : '' }}">
                            <label for="tool_info_link" class="col-md-4 control-label">Tool Infomation Link</label>

                            <div class="col-md-6">
                                <input id="tool_info_link" type="text" class="form-control" name="tool_info_link" value="{{ old('tool_info_link') }}"  >

                                @if ($errors->has('tool_info_link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tool_info_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_version') ? ' has-error' : '' }}">
                            <label for="last_version" class="col-md-4 control-label">Last Version</label>

                            <div class="col-md-6">
                                <input id="last_version" type="text" class="form-control" name="last_version" value="{{ old('last_version') }}"  >

                                @if ($errors->has('last_version'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_version') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
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
