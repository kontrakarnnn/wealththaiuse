@extends('system-mgmt.check-order.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Tool Order Status</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('check-order.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
                            <label for="invoice_number" class="col-md-4 control-label">Invoice Number</label>

                            <div class="col-md-6">
                                <input id="invoice_number" type="text" class="form-control" name="invoice_number" value="{{ old('invoice_number') }}" >

                                @if ($errors->has('invoice_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Member</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="member_id" onchange="window.location.href=this.value;">

                            @foreach ($member as $ca)
                              <option value={{url()->current()}}?{{$ca->id}} >{{$ca->name}} {{$ca->lname}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Portfolio</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="port_id" >

                            @foreach ($portfolio as $ca)
                              <option value={{$ca->id}}>Name : {{$ca->type}} Number: {{$ca->number}} Type: {{$ca->Port_type->type}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool</label>
                          <div class="col-md-6">
                          <select class="form-control  country" >
                            <option></option>
                            @foreach ($tool as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool Set</label>
                          <div class="col-md-6">
                          <select class="form-control  pro" name="tool_set_id">
                            <option  ></option>
                            @foreach ($toolset as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool Package</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="tool_package_id">
                            <option  ></option>                            @foreach ($toolpackage as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('initial_fee') ? ' has-error' : '' }}">
                            <label for="initial_fee" class="col-md-4 control-label">Initial Fee</label>

                            <div class="col-md-6">
                                <input id="initial_fee" type="text" class="form-control" name="initial_fee" value="{{ old('initial_fee') }}" required autofocus>

                                @if ($errors->has('initial_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('initial_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('period_fee') ? ' has-error' : '' }}">
                            <label for="period_fee" class="col-md-4 control-label">Period Fee</label>

                            <div class="col-md-6">
                                <input id="period_fee" type="text" class="form-control" name="period_fee" value="{{ old('period_fee') }}"  >

                                @if ($errors->has('period_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('period_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('exit_fee') ? ' has-error' : '' }}">
                            <label for="exit_fee" class="col-md-4 control-label">Exit Fee</label>

                            <div class="col-md-6">
                                <input id="exit_fee" type="text" class="form-control" name="exit_fee" value="{{ old('exit_fee') }}" >

                                @if ($errors->has('exit_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exit_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      {{--}}  <div class="form-group{{ $errors->has('initial_deal_date') ? ' has-error' : '' }}">
                            <label for="initial_deal_date" class="col-md-4 control-label">Initial Deal Date</label>

                            <div class="col-md-6">
                                <input id="initial_deal_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" name="initial_deal_date" value="{{ old('initial_deal_date') }}" required autofocus>

                                @if ($errors->has('initial_deal_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('initial_deal_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}

                    {{--}}    <div class="form-group{{ $errors->has('next_period_deal_date') ? ' has-error' : '' }}">
                            <label for="next_period_deal_date" class="col-md-4 control-label">Next Period Deal Date</label>

                            <div class="col-md-6">
                                <input id="next_period_deal_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"  class="form-control" name="next_period_deal_date" value="{{ old('next_period_deal_date') }}" required autofocus>

                                @if ($errors->has('next_period_deal_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('next_period_deal_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}

                        <div class="form-group">

                          <label class="col-md-4 control-label">Order Status</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="order_status">
                            <option ></option>
                            @foreach ($toolorderstatus as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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

      $(".nameid").select2({
            placeholder: "Select",
            allowClear: true
        });
</script>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.country',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findToolSet')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

                  }
                  $('.pro').html(" ");
                  $('.pro').append(op);

                },
                error:function(){

                }
            });
        });
    });
</script>
@endsection
