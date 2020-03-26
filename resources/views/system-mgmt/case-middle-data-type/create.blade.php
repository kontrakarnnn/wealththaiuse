@extends('system-mgmt.case-middle-data-type.base')
@section('action-content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Case Middle Data Type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('case-middle-data-type.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label class="col-md-4 control-label" for="name" class="">Case Category</label>

                            <div class="col-md-6">

                            <select class="form-control  name" name="case_category">
                              <option value="0" >-Select-</option>
                              @foreach ($casecategory as $ca)
                                <option value={{$ca->id}} >{{$ca->name}}</option>
                              @endforeach
                            </select>
                          </div>

                      </div>
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Name</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                      <label for="name" class="col-md-4 control-label">Parameter Name1</label>

                      <div class="col-md-6">

                          <input id="para_name1" type="text" class="form-control" name="para_name1"  value="{{ old('para_name1') }}" >

                          @if ($errors->has('para_name1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('para_name1') }}</strong>
                              </span>
                          @endif
                        </div>

                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                <label for="name" class="col-md-4 control-label">Parameter Name2</label>

                <div class="col-md-6">

                    <input id="para_name2" type="text" class="form-control" name="para_name2"  value="{{ old('para_name2') }}" >

                    @if ($errors->has('para_name2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('para_name2') }}</strong>
                        </span>
                    @endif
                  </div>

          </div>
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

          <label for="name" class="col-md-4 control-label">Parameter Name3</label>

          <div class="col-md-6">

              <input id="para_name3" type="text" class="form-control" name="para_name3"  value="{{ old('para_name3') }}" >

              @if ($errors->has('para_name3'))
                  <span class="help-block">
                      <strong>{{ $errors->first('para_name3') }}</strong>
                  </span>
              @endif
            </div>

    </div>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

    <label for="name" class="col-md-4 control-label">Parameter Name4</label>

    <div class="col-md-6">

        <input id="para_name4" type="text" class="form-control" name="para_name4"  value="{{ old('para_name4') }}" >

        @if ($errors->has('para_name4'))
            <span class="help-block">
                <strong>{{ $errors->first('para_name4') }}</strong>
            </span>
        @endif
      </div>

</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

<label for="name" class="col-md-4 control-label">Parameter Name5</label>

<div class="col-md-6">

    <input id="para_name5" type="text" class="form-control" name="para_name5"  value="{{ old('para_name5') }}" >

    @if ($errors->has('para_name5'))
        <span class="help-block">
            <strong>{{ $errors->first('para_name5') }}</strong>
        </span>
    @endif
  </div>

</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

<label for="name" class="col-md-4 control-label">Parameter Name6</label>

<div class="col-md-6">

    <input id="para_name6" type="text" class="form-control" name="para_name6"  value="{{ old('para_name6') }}" >

    @if ($errors->has('para_name6'))
        <span class="help-block">
            <strong>{{ $errors->first('para_name6') }}</strong>
        </span>
    @endif
  </div>

</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

<label for="name" class="col-md-4 control-label">Parameter Name7</label>

<div class="col-md-6">

    <input id="para_name7" type="text" class="form-control" name="para_name7"  value="{{ old('para_name7') }}" >

    @if ($errors->has('para_name7'))
        <span class="help-block">
            <strong>{{ $errors->first('para_name1') }}</strong>
        </span>
    @endif
  </div>

</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

<label for="name" class="col-md-4 control-label">Parameter Name8</label>

<div class="col-md-6">

    <input id="para_name8" type="text" class="form-control" name="para_name8"  value="{{ old('para_name8') }}" >

    @if ($errors->has('para_name8'))
        <span class="help-block">
            <strong>{{ $errors->first('para_name8') }}</strong>
        </span>
    @endif
  </div>

</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

<label for="name" class="col-md-4 control-label">Parameter Name9</label>

<div class="col-md-6">

    <input id="para_name9" type="text" class="form-control" name="para_name9"  value="{{ old('para_name9') }}" >

    @if ($errors->has('para_name9'))
        <span class="help-block">
            <strong>{{ $errors->first('para_name9') }}</strong>
        </span>
    @endif
  </div>

</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

<label for="name" class="col-md-4 control-label">Parameter Name10</label>

<div class="col-md-6">

    <input id="para_name10" type="text" class="form-control" name="para_name10"  value="{{ old('para_name10') }}" >

    @if ($errors->has('para_name10'))
        <span class="help-block">
            <strong>{{ $errors->first('para_name1') }}</strong>
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
                //allowClear: true
            });
    </script>
@endsection
