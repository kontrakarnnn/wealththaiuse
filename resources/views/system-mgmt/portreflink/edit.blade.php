@extends('system-mgmt.portreflink.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Portfolio ReferalLink</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('portreflink.update', ['id' => $structure->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Referal Link ID</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="ref_link_id" value="{{ $structure->ref_link_id }}" required autofocus>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Portfolio ID</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="port_id" value="{{ $structure->port_id }}" required autofocus>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Real Url</label>

                            <div class="col-md-6">
                                <input id="real_url" type="text" class="form-control" name="real_url" value="{{ $structure->real_url }}" >


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
