@extends('system-mgmt.file-cat.base')

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
                <div class="panel-heading">Add New File Category</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('file-cat.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                      <label class="col-md-4 control-label">File Category Group</label>
                        <div class="col-md-6">
                          <select class=" form-control " name="file_cat_group">

                              <option value="" >-Select-</option>
                              @foreach ($filecatgroup as $ser)
                                  <option value="{{$ser->id}}">{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                      </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">name</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus >
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('file_type') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">file_type</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="file_type" value="{{ old('file_type') }}"  >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">ref_label1</label>

                            <div class="col-md-6">
                                <input id="ref_label1" type="text" class="form-control" name="ref_label1" value="{{ old('ref_label1') }}"  >

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">ref_label2</label>

                            <div class="col-md-6">
                                <input id="ref_label2" type="text" class="form-control" name="ref_label2" value="{{ old('ref_label2') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_label3') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">ref_label3</label>

                            <div class="col-md-6">
                                <input id="ref_label3" type="text" class="form-control" name="ref_label3" value="{{ old('ref_label3') }}"  >


                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-md-4 control-label">File Auth Type View Referal </label>
                        <div class="col-md-6">
                          <select class=" form-control " name="view_ref_id">

                              <option value="" >-Select-</option>
                              @foreach ($fileauth as $ser)
                                  <option value="{{$ser->id}}">{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                        </div>


                        <div class="form-group">
                        <label class="col-md-4 control-label">File Auth Type Edit Referal </label>
                        <div class="col-md-6">
                          <select class=" form-control " name="edit_ref_id">

                              <option value="" >-Select-</option>
                              @foreach ($fileauth as $ser)
                                  <option value="{{$ser->id}}">{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="col-md-4 control-label">File Auth Type Delete Referal </label>
                        <div class="col-md-6">
                          <select class=" form-control " name="delete_ref_id">

                              <option value="" >-Select-</option>
                              @foreach ($fileauth as $ser)
                                  <option value="{{$ser->id}}">{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                        </div>


                        <div class="form-group{{ $errors->has('maz_file_size') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">max_file_size(MB)</label>

                            <div class="col-md-6">
                                <input id="max_file_size" type="text" class="form-control" name="max_file_size" value="{{ old('max_file_size') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">default_folder_path</label>

                            <div class="col-md-6">
                                <input id="default_folder_path" type="text" class="form-control" name="default_folder_path" value="{{ old('default_folder_path') }}"  >


                            </div>
                        </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Server</label>
                        <div class="col-md-6">
                          <select class=" form-control " name="default_server_id">

                              <option value="" >-Select-</option>
                              @foreach ($server as $ser)
                                  <option value="{{$ser->id}}">{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                      </div>

                        <div class="form-group{{ $errors->has('txt') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Front Text File</label>

                            <div class="col-md-6">
                                <input id="txt" type="text" class="form-control" name="txt" value="{{ old('txt') }}"  >


                            </div>
                        </div>

                        <div class="form-group">

                                        <label class="col-md-4 control-label"></label>
                                      <div class="col-md-6">
                                        <input type="checkbox"  name="subfolder" value="Yes"> Create Subfolder By View Referal ID <br>
                                          </div>
                                          </div>


                                          <div class="form-group">

                                          <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                          <input type="checkbox"  name="member_view" value="1"> Member View<br>
                                          </div>
                                          </div>


                                          <div class="form-group">

                                          <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                          <input type="checkbox"  name="user_view" value="1"> User View<br>
                                          </div>
                                          </div>

                                          <div class="form-group">

                                          <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                          <input type="checkbox"  name="middle_view" value="1"> Middle View<br>
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
