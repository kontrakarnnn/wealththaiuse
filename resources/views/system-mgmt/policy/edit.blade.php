@extends('system-mgmt.policy.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Policy</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('policy.update', ['id' => $policy->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$policy->name}}" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('policy') ? ' has-error' : '' }}">
                            <label for="policy" class="col-md-4 control-label">Policy Description</label>

                            <div class="col-md-6">
                                <textarea rows="8" cols="80" id="link" type="text" class="form-control" name="policy" value="{{$policy->policy}}" >{{$policy->policy}}</textarea>

                                @if ($errors->has('policy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('policy') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
												                            <div class="form-group">

                                            <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6" style="color:red">
                                            **ใส่ &lt;br/&gt; ไว้ข้างหลังประโยคที่ต้องการเว้นบรรทัด**<br>
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
</script>
@endsection
