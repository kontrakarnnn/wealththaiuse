@extends('system-mgmt.asset-transaction.base')

@section('action-content')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<div class="container">
    <div class="row">
<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new asset Transaction</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('asset-transaction.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="column">
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">

                                <select id="date" type="text" name="d"  size="4" placeholder="วันที่">3
                                  <option> 1</option>
                                </select> /  <input type="text" name="m"  size="4" placeholder="เดือนที่"> / <input type="text" name="y"  size="4" placeholder="ปี"><br>
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label for="ref_name" class="col-md-4 control-label">Time</label>

                            <div class="col-md-6">
                              <input name="time" class="timepicker form-control" type="text" placeholder="เวลา">
                              <script type="text/javascript">

                                  $('.timepicker').datetimepicker({

                                      format: 'HH:mm:ss'

                                  });

                              </script>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('l_s') ? ' has-error' : '' }}">
                            <label for="ref_name" class="col-md-4 control-label">L/S</label>
                        <div class="col-md-6">
                            <input id="l_s" type="text" class="form-control" name="l_s" >

                            @if ($errors->has('l_s'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('l_s') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('o_c') ? ' has-error' : '' }}">
                        <label for="ref_name" class="col-md-4 control-label">O/C</label>
                    <div class="col-md-6">
                        <input id="l_s" type="text" class="form-control" name="o_c" >

                        @if ($errors->has('l_s'))
                            <span class="help-block">
                                <strong>{{ $errors->first('o_c') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>





                        <div class="form-group">
                      <label class="col-md-4 control-label">Portfolio</label>
                        <div class="col-md-6">
                          <select class=" form-control department" id="nameid"name="port_id">

                              <option ></option>
                              @foreach ($port as $p)
                                  <option value="{{$p->id}}">{{$p->type}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Asset</label>
                        <div class="col-md-6">
                          <select class=" form-control department" id="nameid"name="asset_id">

                              <option ></option>
                              @foreach ($asset as $a)
                                  <option value="{{$a->id}}">{{$a->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                            <label for="symbol" class="col-md-4 control-label">Symbol</label>
                        <div class="col-md-6">
                            <input id="symbol" type="text" class="form-control" name="symbol" >

                            @if ($errors->has('symbol'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('symbol') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('volumn') ? ' has-error' : '' }}">
                        <label for="volumn" class="col-md-4 control-label">Volumn</label>
                    <div class="col-md-6">
                        <input id="volumn" type="text" class="form-control" name="volumn" >

                        @if ($errors->has('volumn'))
                            <span class="help-block">
                                <strong>{{ $errors->first('volumn') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price" class="col-md-4 control-label">Price</label>
                <div class="col-md-6">
                    <input id="price" type="text" class="form-control" name="price" >

                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <label for="status" class="col-md-4 control-label">Status</label>
            <div class="col-md-6">
                <input id="status" type="text" class="form-control" name="status" >

                @if ($errors->has('status'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
            <label for="note" class="col-md-4 control-label">Note</label>
        <div class="col-md-6">
            <input id="note" type="text" class="form-control" name="note" >

            @if ($errors->has('note'))
                <span class="help-block">
                    <strong>{{ $errors->first('note') }}</strong>
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
