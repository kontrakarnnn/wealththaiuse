@extends('system-mgmt.file-package.base')


@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update File Category</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('file-package.update', ['id' => $event->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">







                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">name</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="name" value = "{{$event->name}}">
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="message-text" name="description">{{$event->description}}</textarea>
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
