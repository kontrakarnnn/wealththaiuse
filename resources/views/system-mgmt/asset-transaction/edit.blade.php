@extends('system-mgmt.asset-transaction.base')

@section('action-content')

<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Update Asset Transaction</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('asset-transaction.update', ['id' => $porttype->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                          <div class="column">
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">date</label>

                            <div class="col-md-6">
                                <input type="text" name="d"  size="4"placeholder="วันที่" value="{{$curdate}}"> / <input type="text" name="m"  size="4" placeholder="เดือนที่" value="{{$curmonth}}"> / <input type="text" name="y"  size="4" placeholder="ปี" value="{{$curyear}}"><br>

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input  type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">


                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label for="ref_name" class="col-md-4 control-label">Time</label>

                            <div class="col-md-6">
                                <input id="time" type="text" class="form-control" name="time" value="{{$porttype->time}}" >

                                @if ($errors->has('time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('l_s') ? ' has-error' : '' }}">
                            <label for="ref_name" class="col-md-4 control-label">L/S</label>
                        <div class="col-md-6">
                            <input id="l_s" type="text" class="form-control" name="l_s" value="{{$porttype->l_s}}">

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
                        <input id="l_s" type="text" class="form-control" name="o_c" value="{{$porttype->o_c}}" >

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
                          <select class=" form-control department" id="nameid"name="port_id" value="{{$porttype->port_id}}">

                              <option ></option>
                              @foreach ($port as $p)
                                  <option value="{{$p->id}}"{{$p->id == $porttype->port_id ? 'selected' : ''}}>{{$p->type}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Asset</label>
                        <div class="col-md-6">
                          <select class=" form-control department" id="nameid"name="asset_id" value="{{$porttype->asset_id}}" >

                              <option ></option>
                              @foreach ($asset as $a)
                                  <option value="{{$a->id}}"{{$a->id == $porttype->asset_id ? 'selected' : ''}}>{{$a->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                            <label for="symbol" class="col-md-4 control-label">Symbol</label>
                        <div class="col-md-6">
                            <input id="symbol" type="text" class="form-control" name="symbol" value="{{$porttype->symbol}}" >

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
                        <input id="volumn" type="text" class="form-control" name="volumn" value="{{$porttype->volumn}}" >

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
                    <input id="price" type="text" class="form-control" name="price" value="{{$porttype->price}}">

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
                <input id="status" type="text" class="form-control" name="status" value="{{$porttype->status}}">

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
            <input id="note" type="text" class="form-control" name="note" value="{{$porttype->note}}">

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
                                    Update
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
