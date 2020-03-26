@extends('system-mgmt.case-log.base')

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
                <div class="panel-heading">Add new Case Log</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('case-log.store') }}">
                        {{ csrf_field() }}



                        <div class="form-group{{ $errors->has('case_id') ? ' has-error' : '' }}">
                            <label for="case_id" class="col-md-4 control-label">Case</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="case_id">
                                <option value="0" >-Select-</option>
                                @foreach ($case as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('move_from_stage') ? ' has-error' : '' }}">
                            <label for="move_from_stage" class="col-md-4 control-label">Move From Stage</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="move_from_stage">
                                <option value="0" >-Select-</option>
                                @foreach ($stage as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('move_to_stage') ? ' has-error' : '' }}">
                            <label for="move_to_stage" class="col-md-4 control-label">Move To Stage</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="move_to_stage">
                                <option value="0" >-Select-</option>
                                @foreach ($stage as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('moving_path') ? ' has-error' : '' }}">
                            <label for="moving_path" class="col-md-4 control-label">Moving Path</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="moving_path">
                                <option value="0" >-Select-</option>
                                @foreach ($path as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">
                                <input id="date" type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyy" class="form-control" name="date" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label for="time" class="col-md-4 control-label">Time</label>

                            <div class="col-md-6">
                              <input type="text" name="time" class="form-control timepicker" placeholder="00:00:00"/>
                              <script type="text/javascript">

                                    $('.timepicker').datetimepicker({

                                        format: 'HH:mm:ss'

                                    });

                                </script>
                                @if ($errors->has('time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('condition_match') ? ' has-error' : '' }}">
                            <label for="condition_match" class="col-md-4 control-label">Condition Match</label>

                            <div class="col-md-6">
                                <input id="condition_match" type="text" class="form-control" name="condition_match" value="{{ old('condition_match') }}" >

                                @if ($errors->has('condition_match'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('condition_match') }}</strong>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $(".name").select2({
            placeholder: "Select",
            allowClear: true
        });
</script>
@endsection
