
@extends('users-mgmt.base')
@section('action-content')
<section class="content">
  <div class="box">
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
      @endforeach
    </div>
    <div class="box-header">
      <div class="row">
          <div class="col-sm-8">
            <h3 class="box-title">List of users</h3>
          </div>
          <div class="col-sm-4">
            <a class="btn btn-primary" href="{{ route('user-management.create') }}">Add new user</a>
          </div>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('user-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['User Name', 'First Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['username'] : '', isset($searchingVals) ? $searchingVals['firstname'] : '']])
          @endcomponent
          </br>
           @component('layouts.two-cols-search-row', ['items' => ['Last Name','email'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['lastname'] : '', isset($searchingVals) ? $searchingVals['email'] : '']])
          @endcomponent
        </br>

        @endcomponent
      </form>
      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <div style="overflow-x:auto;">

               <div class="form-group">
                <input type="text" name="serach" id="serach" class="form-control" placeholder="Live Search"/>
               </div>


              <br />

     <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
     <thead>
      <tr>
       <th width="" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
       <th width="" class="sorting" data-sorting_type="asc" data-column_name="firstname" style="cursor: pointer">firstname <span id="post_title_icon"></span></th>
       <th width="" class="sorting" data-sorting_type="asc" data-column_name="lastname" style="cursor: pointer">Lastname <span id="id_icon"></span></th>
       <th width="" class="sorting" data-sorting_type="asc" data-column_name="email" style="cursor: pointer">Email <span id="post_title_icon"></span></th>
       <th width="" class="sorting" data-sorting_type="asc" data-column_name="status" style="cursor: pointer">Status <span id="id_icon"></span></th>
       <th width="" class="sorting" data-sorting_type="asc" data-column_name="user_pid" style="cursor: pointer">user_pid <span id="post_title_icon"></span></th>
       <th width="" class="sorting" data-sorting_type="asc" data-column_name="limit_prospect" style="cursor: pointer">Limit Prospect <span id="post_title_icon"></span></th>


       <th width="">Description</th>
      </tr>
     </thead>
     <tbody>
      @include('users-mgmt/pagination_data')
     </tbody>
    </table>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
   </div>
  </div>
  </div>
</div>
</div>
</div>
</div>
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
   url:"/admin/pagination/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }

 $(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
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
  var query = $('#serach').val();
  fetch_data(page, reverse_order, column_name, query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('#serach').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name, query);
 });

});
</script>
@endsection
