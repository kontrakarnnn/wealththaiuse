@extends('system-mgmt.file-cat.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update File Category</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('file-cat.update', ['id' => $event->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @foreach(App\Person::where('event_id',$event->id)->get(); as $depList)

                          {{$depList->name}}
                        @endforeach

                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">File Category Group</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="file_cat_group">

                              <option value="" >-Select-</option>
                              @foreach ($filecatgroup as $ser)
                                  <option value="{{$ser->id}}"{{$ser->id == $event->file_cat_group ? 'selected' : ''}}>{{$ser->name}}</option>
                              @endforeach

                          </select>
                 </div>
                        </div>


                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="name" value = "{{$event->name}}">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">File Type</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="file_type" value = "{{$event->file_type}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Ref Label1</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="ref_label1" value = "{{$event->ref_label1}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Ref Label2</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="ref_label2" value = "{{$event->ref_label2}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Ref Label3</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="ref_label3" value = "{{$event->ref_label3}}">
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">File Auth Type View Referal </label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="view_ref_id">

                              <option value="" >-Select-</option>
                              @foreach ($fileauth as $ser)
                                  <option value="{{$ser->id}}"{{$ser->id == $event->view_ref_id ? 'selected' : ''}}>{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">File Auth Type Edit Referal </label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="edit_ref_id">

                              <option value="" >-Select-</option>
                              @foreach ($fileauth as $ser)
                                  <option value="{{$ser->id}}"{{$ser->id == $event->edit_ref_id ? 'selected' : ''}}>{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">File Auth Type Delete Referal </label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="delete_ref_id">

                              <option value="" >-Select-</option>
                              @foreach ($fileauth as $ser)
                                  <option value="{{$ser->id}}"{{$ser->id == $event->delete_ref_id ? 'selected' : ''}}>{{$ser->name}}</option>
                              @endforeach

                          </select>
                        </div>
                        </div>


                        <div class="form-group{{ $errors->has('max_file_size	') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Max File Size(MB)	</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="max_file_size" value = "{{$event->max_file_size}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Default Folder Path</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="default_folder_path" value = "{{$event->default_folder_path}}">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Server:</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="default_server_id">

                              <option value="" >-Select-</option>
                              @foreach ($server as $ser)
                                  <option value="{{$ser->id}}"{{$ser->id == $event->default_server_id ? 'selected' : ''}}>{{$ser->name}}</option>
                              @endforeach

                          </select>
                 </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">txt</label>

                            <div class="col-md-6">
                                <input class="form-control" id="message-text" name="txt" value = "{{$event->txt}}">
                            </div>
                        </div>

                        <div class="form-group">

                                          <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                    <input type="checkbox" {{  $event->subfolder =="Yes" ? 'checked' : '' }} name="subfolder" value="Yes">  Create Subfolder By View Referal ID <br>
                                        </div>
                                        </div>


                          <div class="form-group">

                          <label class="col-md-4 control-label"></label>
                          <div class="col-md-6">
                          <input type="checkbox" {{  $event->member_view =="1" ? 'checked' : '' }} name="member_view" value="1">  Member View <br>
                          </div>
                          </div>


                          <div class="form-group">

                          <label class="col-md-4 control-label"></label>
                          <div class="col-md-6">
                          <input type="checkbox" {{  $event->user_view =="1" ? 'checked' : '' }} name="user_view" value="1">  User View <br>
                          </div>
                          </div>

                          <div class="form-group">

                          <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                            <input type="checkbox" {{  $event->middle_view =="1" ? 'checked' : '' }} name="middle_view" value="1">  Middle View <br>
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
