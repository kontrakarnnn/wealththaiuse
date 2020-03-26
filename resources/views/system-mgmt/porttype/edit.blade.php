@extends('system-mgmt.porttype.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update portfolio type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('porttype.update', ['id' => $porttype->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">PortType</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ $porttype->type }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="link" value="{{ $porttype->link}}" >

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Portfolio Category</label>
                        <div class="col-md-6">
                          <select class=" form-control department" id="nameid" name="port_cat">

                              <option value="0" >-Select-</option>
                              @foreach ($portcat as $port)
                                  <option value="{{$port->id}}"{{$port->id == $porttype->port_cat ? 'selected' : ''}}>{{$port->name}}</option>
                              @endforeach

                          </select>


                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_limit_value</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_limit_value" value="{{ $porttype->port_limit_value }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_label1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label1" value="{{ $porttype->port_detail_label1 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_label2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label2" value="{{ $porttype->port_detail_label2 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_label3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label3" value="{{ $porttype->port_detail_label3 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_label4</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label4" value="{{ $porttype->port_detail_label4 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_label5</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label5" value="{{ $porttype->port_detail_label5 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_label6</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label6" value="{{ $porttype->port_detail_label6 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_label7</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_label7" value="{{ $porttype->port_detail_label7 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_name1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_name1" value="{{ $porttype->ref_link_name1 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_name2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_name2" value="{{ $porttype->ref_link_name2 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_name3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_name3" value="{{ $porttype->ref_link_name3 }}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_label_ref1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_label_ref1" value="{{ $porttype->port_label_ref1}}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_label_ref2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_label_ref2" value="{{ $porttype->port_label_ref2}}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_label_ref3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_label_ref3" value="{{ $porttype->port_label_ref3}}"   >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
@endsection
