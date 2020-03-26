@extends('system-mgmt.family.base')

@section('action-content')

<section class="content">

  <div class="box">

<!-- /.box-header -->
<div class="box-body">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Invitation</a></li>
    <li><a data-toggle="tab" href="#menu1">Detail</a></li>
    {{--<li><a data-toggle="tab" href="#menu2">Approve Member</a></li>--}}

  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3></h3>
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('familyauth.create') }}">Invite Member to Group</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
			<div style="overflow-x:auto;">

        <div class="form-group" style="display:inline-block">
          <select class="form-control name"size="1" name="links" onchange="window.location.href=this.value;">
			<option>Status</option>
              <option   value="{{url()->current()}}/Accept">Accept</option>
              <option   value="{{url()->current()}}/Request">Request</option>
              <option   value="{{url()->current()}}/Waiting">Waiting</option>
          </select>


  </div><a class="btn btn-default" href="{{ URL::current() }}">Show All</a>

          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr >
                <th width="" class="sorting" data-sorting_type="asc" data-column_name="member_name" style="cursor: pointer">Member Name <span id="id_icon"></span></th>
                <th width="" class="sorting" data-sorting_type="asc" data-column_name="family_name" style="cursor: pointer">Group Name <span id="id_icon"></span></th>
                <th width="" class="sorting" data-sorting_type="asc" data-column_name="status" style="cursor: pointer">Status<span id="id_icon"></span></th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              @include('system-mgmt/family/pagination_data')

            </tbody>
            <tfoot>
              <tr>
                <th width="" class="sorting" data-sorting_type="asc" data-column_name="member_name" style="cursor: pointer">Member Name <span id="id_icon"></span></th>
                <th width="" class="sorting" data-sorting_type="asc" data-column_name="family_name" style="cursor: pointer">Group Name <span id="id_icon"></span></th>
                <th width="" class="sorting" data-sorting_type="asc" data-column_name="status" style="cursor: pointer">Status<span id="id_icon"></span></th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
          <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
          <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
          <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($userauths)}} of {{count($userauths)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $userauths->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>


    </div>
    <div id="menu1" class="tab-pane fade">
      <h3></h3>
      <div class="col-md-8 col-md-offset-2">


                  <form class="form-horizontal" role="form" method="POST" action="{{ route('family.update', ['id' => $structure->id]) }}">
                      <input type="hidden" name="_method" value="PATCH">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Group Name</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ $structure->name }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">

                                      <label class="col-md-4 control-label"></label>
                                    <div class="col-md-6">
                                      <input type="checkbox"  name="approve" {{  $structure->approve =="1" ? 'checked' : '' }} value="1">Enable Approve
                                      <input type="checkbox"  name="show_mem" value="1" {{  $structure->show_mem =="1" ? 'checked' : '' }}> Show Member Lists
                                        </div>
                                        </div>


                      <input type="hidden"id="created_by" type="text" class="form-control" name="created_by"  @foreach($currentid as $current) value="{{ $current->id}}"  @endforeach>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Update
                              </button>
                            </form>


                              @if ($structures == 1)
                              <form style="display: inline-block;"class="form-horizontal" method="POST" action="{{ route('family.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}"> <button type="submit" class="btn btn-danger  btn-margin">
                                                        Delete Group
                                                      </button> @else @endif
                              </form>

                          </div>
                      </div>


      </div>

    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Approve Member</h3>
      <p>Approve Your Member Request</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>
<!-- /.box-body -->
</div>
</section>

<script>
$(document).ready(function(){

 function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query)
 {
  $.ajax({
   url:"/familys/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }

 $(document).on('keyup', '.serach', function(){
  var query = $('.serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  fetch_data(page, sort_type, column_name, query);
 });

 $(document).on('click', '.sorting', function(){
  var column_name = $(this).data('column_name');
  var order_type = $(this).data('sorting_type');
  var reverse_order = '';
  if(order_type == 'asc')
  {
   $(this).data('sorting_type', 'desc');
   reverse_order = 'desc';
   clear_icon();
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
  }
  if(order_type == 'desc')
  {
   $(this).data('sorting_type', 'asc');
   reverse_order = 'asc';
   clear_icon
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
  }
  $('#hidden_column_name').val(column_name);
  $('#hidden_sort_type').val(reverse_order);
  var page = $('#hidden_page').val();
  var query = $('.serach').val();
  fetch_data(page, reverse_order, column_name, query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('.serach').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name, query);
 });

});
</script>

@endsection
