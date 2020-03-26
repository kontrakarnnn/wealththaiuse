@extends('system-mgmt.porttype.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Portfolio Type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('porttype.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port type</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="link" value="{{ old('link') }}" >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Port Category</label>
                        <div class="col-md-6">
                          <select class=" form-control department" id="nameid" name="port_cat">

                              <option value ="0">-Select-</option>
                              @foreach ($portcat as $portca)
                                  <option value="{{$portca->id}}">{{$portca->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">Port Limit Value</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_limit_value" value="{{ old('type') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_detail_label1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label1" value="{{ old('port_detail_label1') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_detail_label2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label2" value="{{ old('port_detail_label32') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_detail_label3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label3" value="{{ old('port_detail_label3	') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_detail_label4</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label4" value="{{ old('port_detail_label4') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_detail_label5</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label5" value="{{ old('port_detail_label5') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_detail_label6</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label6" value="{{ old('port_detail_label6') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_detail_label7</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label7" value="{{ old('port_detail_label7') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_link_name1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_name1" value="{{ old('ref_link_name1') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_link_name2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_name2" value="{{ old('ref_link_name2') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_link_name3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_name3" value="{{ old('ref_link_name3') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_label_ref1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_label_ref1" value="{{ old('port_label_ref1') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_label_ref2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_label_ref2" value="{{ old('port_label_ref2') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">port_label_ref3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_label_ref3" value="{{ old('port_label_ref3') }}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>


@endsection
