@extends('system-mgmt.proposal.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Path</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('proposal.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Proposal Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('case_id') ? ' has-error' : '' }}">
                            <label for="case_id" class="col-md-4 control-label">Cases</label>

                            <div class="col-md-6">
                              <select class="form-control name " name="case_id">
                                  <option value="" >-select</option>
                                  @foreach($cases as $ca)
                                  <option value="{{$ca->id}}" >{{$ca->name}}</option>
                                  @endforeach

                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('public_name') ? ' has-error' : '' }}">
                            <label for="public_name" class="col-md-4 control-label">Created By</label>

                            <div class="col-md-6">
                              <select class="form-control name " name="created_by">
                                  <option value="" >-select</option>
                                  @foreach($publicid as $ca)
                                  <option value="{{$ca->id}}" >{{$ca->public_name}}</option>
                                  @endforeach

                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('partner_block') ? ' has-error' : '' }}">
                            <label for="partner_block" class="col-md-4 control-label">Partner Block</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="partner_block">
                                  <option value="" >-select</option>
                                  @foreach($partnerblock as $ca)
                                  <option value="{{$ca->id}}" >{{$ca->name}}</option>
                                  @endforeach

                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('user_block') ? ' has-error' : '' }}">
                            <label for="user_block" class="col-md-4 control-label">User Block</label>

                            <div class="col-md-6">
                              <select class="form-control name " name="user_block">
                                  <option value="" >-select</option>
                                  @foreach($userblock as $ca)
                                  <option value="{{$ca->id}}" >{{$ca->name}}</option>
                                  @endforeach

                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('member_id') ? ' has-error' : '' }}">
                            <label for="member_id" class="col-md-4 control-label">Member</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="member_id">
                                  <option value="" >-select</option>
                                  @foreach($member as $ca)
                                  <option value="{{$ca->id}}" >{{$ca->name}}  {{$ca->lname}}</option>
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

      $(".name").select2({
            placeholder: "Select",
            allowClear: true
        });
</script>
@endsection
