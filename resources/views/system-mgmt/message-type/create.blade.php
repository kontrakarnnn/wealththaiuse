@extends('system-mgmt.message-type.base')

@section('action-content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('message-type.store') }}">
                        {{ csrf_field() }}



                      <div class="form-group">
                      <label class="col-md-4 control-label">Message Category:</label>
                        <div class="col-md-6">
                    <select class=" form-control" name="message_cat_id">

                      <option value="0" >-Select-</option>
                    @foreach ($msg_cats as $mc)
                      <option value="{{$mc->id}}">{{$mc->name}}</option>
                            @endforeach

              </select>

                        </div>
                        </div>


                        <div class="form-group{{ $errors->has('message_template') ? ' has-error' : '' }}">
                            <label for="message_template" class="col-md-4 control-label">message_template</label>

                            <div class="col-md-6">
                                <input id="message_template" type="text" class="form-control" name="message_template" value="{{ old('message_template') }}" required autofocus>

                                @if ($errors->has('message_template'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message_template') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('message_default') ? ' has-error' : '' }}">
                            <label for="message_template" class="col-md-4 control-label">message_default</label>

                            <div class="col-md-6">
                                <textarea id="message_default" type="text" class="form-control" name="message_default" value="{{ old('message_default') }}" ></textarea>

                                @if ($errors->has('message_default'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message_default') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cc_recieve') ? ' has-error' : '' }}">
                            <label for="cc_recieve" class="col-md-4 control-label">cc_recieve</label>

                            <div class="col-md-6">
                                <input id="cc_recieve" type="text" class="form-control" name="cc_recieve" value="{{ old('cc_recieve') }}" >

                                @if ($errors->has('cc_recieve'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cc_recieve') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cc_email') ? ' has-error' : '' }}">
                            <label for="cc_email" class="col-md-4 control-label">	cc_email</label>

                            <div class="col-md-6">
                                <input id="cc_email" type="text" class="form-control" name="cc_email" value="{{ old('cc_email') }}" >

                                @if ($errors->has('cc_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cc_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('default_recieve_id') ? ' has-error' : '' }}">
                            <label for="	default_recieve" class="col-md-4 control-label">	default_recieve ID</label>

                            <div class="col-md-6">
                                <input id="default_recieve_id" type="text" class="form-control" name="default_recieve_id" value="{{ old('default_recieve_id') }}" >

                                @if ($errors->has('default_recieve_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('default_recieve_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('	default_email') ? ' has-error' : '' }}">
                            <label for="	default_email" class="col-md-4 control-label">default_email</label>

                            <div class="col-md-6">
                                <input id="default_email" type="text" class="form-control" name="default_email" value="{{ old('	cc_email') }}" >

                                @if ($errors->has('	default_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('default_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('default_status') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">default_status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="default_status">
                                    <option></option>
                                    <option>Request</option>
                                    <option>On Progress</option>
                                    <option>Reject</option>
                                    <option>Finish</option>
                                </select>
                                 @if ($errors->has('default_status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('default_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">

                                          <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                		<input type="checkbox" id="myCheck"  onclick="myFunction()"  name="auto_reply" value="Yes"> Auto Reply Message<br>
                                        </div>
                                        </div>
                                        <div id="text" style="display:none" class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                      <select class=" form-control" name="reply_mst_id">

                                        <option value="0" >-Select Reply Message Template-</option>
                                      @foreach ($msg_types as $mc)
                                        <option value="{{$mc->id}}">{{$mc->message_template}}</option>
                                              @endforeach

                                </select>

                                          </div>
                                          </div>
                                        <div class="form-group">

                                                          <label class="col-md-4 control-label"></label>
                                                          <div class="col-md-6">
                                                		<input type="checkbox" id="myCheck2"   name="email_flag" value="1"> Sent to Email<br>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">

                                                                          <label class="col-md-4 control-label"></label>
                                                                          <div class="col-md-6">
                                                                		<input type="checkbox" id="myCheck3"   name="line_flag" value="1"> Sent to LINE<br>
                                                                        </div>
                                                                        </div>

                                                                        <div class="form-group">

                                                                                          <label class="col-md-4 control-label"></label>
                                                                                          <div class="col-md-6">
                                                                                    <input type="checkbox" id="myCheck4"    name="app_flag" value="1"> Sent to Application<br>
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

<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<script>
function myFunction2() {
  var checkBox = document.getElementById("myCheck2");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<script>
function myFunction3() {
  var checkBox = document.getElementById("myCheck3");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<script>
function myFunction4() {
  var checkBox = document.getElementById("myCheck4");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
@endsection
