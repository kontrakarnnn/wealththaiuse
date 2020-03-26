@extends('admin.partnermanage.base')
@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/admin/partnermanage/create" >Create New Partner </a> <a class="btn btn-default" href="/admin/selectmember" style="margin-left:50px">Select From Member</a></div>
                <div class="panel-body">


                  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                  @endforeach


                      <form class="form-horizontal" role="form" method="POST" action="{{ route('partnermanage.store') }}">
                          {{ csrf_field() }}

                          <div class="form-group">
                              <label class="col-md-4 control-label">Member</label>
                              <div class="col-md-6">
                                  <select style="width:100%"class="form-control searchname" name="member_id" required autofocus>
                                    <option value="" >-เลือก-</option>
                                    @foreach($member as $p)
                                    <option value = "{{$p->id}}">  {{$p->name}} {{$p->lname}}  </option>
                                    @endforeach
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary">
                                      Submit
                                  </button>
                              </div>
                          </div>








                      </form>
                </div>



                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $(".searchname").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#cityid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
