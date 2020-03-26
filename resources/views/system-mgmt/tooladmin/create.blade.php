@extends('system-mgmt.tooladmin.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Tool</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tooladmin.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="attachment" class="col-md-4 control-label">attachment</label>

                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}"  required autofocus>

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool Type</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="tool_type" required autofocus>
                            <option value="" >-Select-</option>
                            @foreach ($tooltype as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>
                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool Status</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="tool_status" required autofocus>
                            <option value="" >-Select-</option>
                            @foreach ($toolstatus as $ca)
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
                        <div class="form-group{{ $errors->has('broker_id') ? ' has-error' : '' }}">
                            <label for="broker_id" class="col-md-4 control-label">Broker ID (2Character)</label>

                            <div class="col-md-6">
                                <input id="broker_id" type="text" class="form-control" name="broker_id" value="{{ old('broker_id') }}"  >

                                @if ($errors->has('broker_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('broker_id') }}</strong>
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

                        <div class="form-group">

                          <label class="col-md-4 control-label">Star</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="star" >
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                          </select>
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('limit_assign') ? ' has-error' : '' }}">
                            <label for="limit_assign" class="col-md-4 control-label">Limit Port</label>

                            <div class="col-md-6">
                                <input id="limit_assign" type="text" class="form-control" name="limit_assign" value="{{ old('limit_assign') }}"  >

                                @if ($errors->has('limit_assign'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('limit_assign') }}</strong>
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
                        @if($toolpromotecount >= 4 )
                        @else
                        <div class="form-group">

                                          <label for="promote" class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                    <input id="promote" type="checkbox"  name="promote" value="1"> Promote (Limit 4 Tool)<br>
                                    @if ($errors->has('promote'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('promote') }}</strong>
                                        </span>
                                    @endif
                                        </div>
                                        </div>
                        @endif
                        <div class="form-group">

                              <label for="match_broker" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                      <input id="match_broker" type="checkbox"  name="match_broker" value="1"> Match Broker ID<br>
                                  @if ($errors->has('match_broker'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('match_broker') }}</strong>
                                        </span>
                                      @endif
                                      </div>
                                      </div>
                        <div class="form-group">

                              <label for="top_hit" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                      <input id="top_hit" type="checkbox"  name="top_hit" value="1"> Top Hit<br>
                                  @if ($errors->has('top_hit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('top_hit') }}</strong>
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
