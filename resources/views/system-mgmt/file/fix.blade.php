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
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('file.fix', ['id' => $file->id]) }}">
                      <input type="hidden" name="_method" value="PATCH">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Public Name</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="file_public_name" value="{{ $file->file_public_name }}" required autofocus >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Referal Name</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="file_ref_name" value="{{ $file->file_ref_name}}" required autofocus >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Physical Path</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="physical_path" value="{{ $file->physical_path}}" required autofocus >


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Port Type</label>
                            <div class="col-md-6">
                                <select class="form-control " name="port_id">

                                    @foreach ($filecat as $port)
                                         <option value="{{$port->id}}"{{$port->id == $file->file_cat_id? 'selected' : ''}}>{{$port->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">type</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="type" value="{{ $file->type}}"  >


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Port Type</label>
                            <div class="col-md-6">
                                <select class="form-control " name="status">
                                  <option value="{{$file->status}}">
                                    @if($file->status == 1)
                                    Active
                                    @else
                                    Delete
                                    @endif
                                  </option>

                                <option value ='1'>
                                  Active
                                </option>
                                <option value ='0'>
                                  Delete
                                </option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Referal Number1</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="ref_number1" value="{{ $file->ref_number1}}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Referal Number2</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="ref_number2" value="{{ $file->ref_number2}}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Referal Number3</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="ref_number3" value="{{ $file->ref_number3}}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">View Referal Number</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="view_ref_no" value="{{ $file->view_ref_no}}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Edit Referal Number</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="edit_ref_no" value="{{ $file->edit_ref_no}}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Delete Referal Number</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="delete_ref_no" value="{{ $file->delete_ref_no}}"  >


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

@endsection
