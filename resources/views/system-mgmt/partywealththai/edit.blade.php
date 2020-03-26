@extends('system-mgmt.partywealththai.base')
@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Party</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('partywealththai.update', ['id' => $structure->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                                          <label class="col-md-4 control-label">Guild</label>
                                          <div class="col-md-6">
                                            <select class="form-control" name="member_group_id"  id="nameid">
                                              <option></option>
                                              @foreach($memgroup as $person)
                                              <option value="{{$person->id}}" {{$person->id == $structure->member_group_id ? 'selected' : ''}}>{{$person->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                      </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Party Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $structure->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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
@endsection
