@extends('system-mgmt.tooladmin.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Tool</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tooladmin.update', ['id' => $data->id]) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="attachment" class="col-md-4 control-label">attachment</label>

                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}"   >

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Tool Type</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="tool_type">

                              <option value="0" >-Select-</option>
                              @foreach ($tooltype as $tool)
                                  <option value="{{$tool->id}}"{{$tool->id == $data->tool_type ? 'selected' : ''}}>{{$tool->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Tool Status</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="tool_status">

                              <option value="0" >-Select-</option>
                              @foreach ($toolstatus as $tool)
                                  <option value="{{$tool->id}}"{{$tool->id == $data->tool_status ? 'selected' : ''}}>{{$tool->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tool Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

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
                                <input id="tool_ref_product_id" type="text" class="form-control" name="tool_ref_product_id" value="{{ $data->tool_ref_product_id }}" required autofocus>

                                @if ($errors->has('tool_ref_product_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tool_ref_product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('broker_id') ? ' has-error' : '' }}">
                            <label for="broker_id" class="col-md-4 control-label">Broker ID(2Character)</label>

                            <div class="col-md-6">
                                <input id="broker_id" type="text" class="form-control" name="broker_id" value="{{ $data->broker_id }}"  >

                                @if ($errors->has('broker_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('broker_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tool_info_link') ? ' has-error' : '' }}">
                            <label for="tool_info_link" class="col-md-4 control-label">Tool Information Link</label>

                            <div class="col-md-6">
                                <input id="tool_info_link" type="text" class="form-control" name="tool_info_link" value="{{ $data->tool_info_link }}"  >

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
                                <input id="last_version" type="text" class="form-control" name="last_version" value="{{ $data->last_version }}"  >

                                @if ($errors->has('last_version'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_version') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('published_date') ? ' has-error' : '' }}">
                            <label for="published_date" class="col-md-4 control-label">Published Date</label>

                            <div class="col-md-6">
                                <input id="published_date" type="text" class="form-control" name="published_date" value="{{ $data->published_date }}"  >

                                @if ($errors->has('published_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('published_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('limit_assign') ? ' has-error' : '' }}">
                            <label for="limit_assign" class="col-md-4 control-label">Customer Limit</label>

                            <div class="col-md-6">
                                <input id="limit_assign" type="text" class="form-control" name="limit_assign" value="{{ $data->limit_assign }}"  >

                                @if ($errors->has('limit_assign'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('limit_assign') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('update_date') ? ' has-error' : '' }}">
                            <label for="update_date" class="col-md-4 control-label">Updated Date</label>

                            <div class="col-md-6">
                                <input id="update_date" type="text" class="form-control" name="update_date" value="{{ $data->update_date }}"  >

                                @if ($errors->has('update_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('update_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">

                          <label class="col-md-4 control-label">Star</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="star" >
                            <option></option>
                            <option value="1" {{$data->star == 1 ? 'selected' : ''}}>1</option>
                            <option value="2" {{$data->star == 2 ? 'selected' : ''}}>2</option>
                            <option value="3" {{$data->star == 3 ? 'selected' : ''}}>3</option>
                            <option value="4" {{$data->star == 4 ? 'selected' : ''}}>4</option>
                            <option value="5" {{$data->star == 5 ? 'selected' : ''}}>5</option>
                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('update_date') ? ' has-error' : '' }}">
                            <label for="update_date" class="col-md-4 control-label">Updated Date</label>

                            <div class="col-md-6">
                                <input id="update_date" type="text" class="form-control" name="update_date" value="{{ $data->update_date }}"  >

                                @if ($errors->has('update_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('update_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ $data->description }}"  >{{ $data->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if($data->promote != NULL || $toolpromotecount < 4)
                        <div class="form-group">

                                          <label for="promote" class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                    <input id="promote" type="checkbox" {{  $data->promote =="1" ? 'checked' : '' }} name="promote" value="1"> Promote(Limit 4 Tools)<br>
                                    @if ($errors->has('promote'))
                                        <span style="color:red" class="help-block">
                                            <strong>{{ $errors->first('promote') }}</strong>
                                        </span>
                                    @endif
                                        </div>
                                        </div>
                          @elseif($toolpromotecount >= 4)

                          @endif
                          <div class="form-group">

                                  <label for="match_broker" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <input id="match_broker" type="checkbox" {{  $data->match_broker =="1" ? 'checked' : '' }} name="match_broker" value="1"> Match Broker ID<br>
                                  @if ($errors->has('match_broker'))
                                    <span style="color:red" class="help-block">
                                    <strong>{{ $errors->first('match_broker') }}</strong>
                                    </span>
                                  @endif
                                    </div>
                                    </div>
                          <div class="form-group">

                                  <label for="top_hit" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <input id="top_hit" type="checkbox" {{  $data->top_hit =="1" ? 'checked' : '' }} name="top_hit" value="1"> Top Hit<br>
                                  @if ($errors->has('top_hit'))
                                    <span style="color:red" class="help-block">
                                    <strong>{{ $errors->first('top_hit') }}</strong>
                                    </span>
                                  @endif
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
