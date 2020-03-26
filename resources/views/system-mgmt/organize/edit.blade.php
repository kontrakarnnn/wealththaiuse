@extends('system-mgmt.organize.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update organize</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('organize.update', ['id' => $structure->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">




                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Organization Name</label>

                            <div class="col-md-6">
                              @foreach ($member as $mem)


                                <input id="name" type="text" class="form-control" name="name" value="{{$mem->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$mem->email}}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{$mem->mobile}}" required>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('id_num') ? ' has-error' : '' }}">
                            <label for="id_num" class="col-md-4 control-label">Citizen ID</label>

                            <div class="col-md-6">
                                <input id="id_num" type="id_num" class="form-control" name="id_num" value="{{$mem->id_num}}" required>

                                @if ($errors->has('id_num'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_num') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach




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
