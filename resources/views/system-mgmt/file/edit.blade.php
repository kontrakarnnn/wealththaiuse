@extends('system-mgmt.file.base')

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
                <div class="panel-heading">Add new file</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('file.change', ['id' => $file->id]) }}">
                        {{ csrf_field() }}

                        <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Public Name</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="file_public_name" value="{{ old('file_public_name') }}" required autofocus >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="attachment" class="col-md-4 control-label">File</label>

                            <div class="col-md-6">
                                <input id="name" type="file" onchange="showMyImage(this)"class="form-control" name="attachment" value="{{ old('attachment') }}"  >

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        @foreach($filecat as $cat)

                        @if($cat->ref_label2 != NULL)
                        
                          <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                              <label for="location" class="col-md-4 control-label">{{$cat->ref_label2}}</label>

                              <div class="col-md-6">
                                  <input id="ref_label2" type="text" class="form-control" name="ref_number2" value="{{ old('ref_number2') }}"  >


                              </div>
                          </div>

                        @endif
                        @if($cat->ref_label3 != NULL)


                        <div class="form-group{{ $errors->has('ref_label3') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">{{$cat->ref_label3}}</label>

                            <div class="col-md-6">
                                <input id="ref_label3" type="text" class="form-control" name="ref_number3" value="{{ old('ref_number3') }}"  >


                            </div>
                        </div>

                      @endif
                        <input type="hidden"id="sender_id" type="text" class="form-control" name="catid" value=" {{$cat->id}}">
                          <input type="hidden"id="sender_id" type="text" class="form-control" name="txt" value=" {{$cat->txt}}">
                        @endforeach


                        <div class="form-group{{ $errors->has('ref_label3') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Preview (Only Image)</label>

                            <div class="col-md-6">
                                  <img id="thumbnil" style="width:100%; margin-top:10px;"  src="{{url('../')}}/img/noimg.png" alt=""/>


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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.department',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findDivisionName')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>chose event</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

                  }
                  div.find('.name').html(" ");
                  div.find('.name').append(op);

                },
                error:function(){

                }
            });
        });
    });
</script>
<script>
function showMyImage(fileInput) {
       var files = fileInput.files;
       for (var i = 0; i < files.length; i++) {
           var file = files[i];
           var imageType = /image.*/;
           if (!file.type.match(imageType)) {
               continue;
           }
           var img=document.getElementById("thumbnil");
           img.file = file;
           var reader = new FileReader();
           reader.onload = (function(aImg) {
               return function(e) {
                   aImg.src = e.target.result;
               };
           })(img);
           reader.readAsDataURL(file);
       }
   }
</script>
@endsection
