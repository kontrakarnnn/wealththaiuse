@extends('system-mgmt.portcat.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Category</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('portcat.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">Port Category</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>


                            </div>
                        </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Structure:</label>
                        <div class="col-md-6">
                          <select class=" form-control department" id="nameid" name="structure_id">

                              <option value ="0">-Select-</option>
                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}">{{$structure->name}}</option>
                              @endforeach

                          </select>

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
