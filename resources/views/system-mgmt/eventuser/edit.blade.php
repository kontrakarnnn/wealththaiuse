@extends('system-mgmt.eventuser.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Event</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('event.update', ['id' => $event->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group">
                      <label class="col-md-4 control-label">Event Type:</label>
                        <div class="col-md-6">
                          <select class=" form-control department nameid" name="event_type_id">

                              <option value="0" >-Select-</option>
                              @foreach ($eventtypes as $eventtype)
                                  <option value="{{$eventtype->id}}"{{$eventtype->id == $event->event_type_id ? 'selected' : ''}}>{{$eventtype->name}}</option>
                              @endforeach

                          </select>



                        </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Organization Name:</label>
                        <div class="col-md-6">
                          <select class=" form-control department nameid" name="organization_id">

                              <option value="0" >-Select-</option>
                              @foreach ($organizes as $organize)
                                  <option value="{{$organize->id}}"{{$organize->id == $event->organization_id ? 'selected' : ''}}>{{$organize->name}}</option>
                              @endforeach

                          </select>



                        </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Group Name:</label>
                        <div class="col-md-6">
                          <select class=" form-control department nameid" name="group_id">

                              <option value="0" >-Select-</option>
                              @foreach ($groups as $group)
                                  <option value="{{$group->id}}"{{$group->id == $event->group_id ? 'selected' : ''}}>{{$group->name}}</option>
                              @endforeach

                          </select>



                        </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Group Of Member Name:</label>
                        <div class="col-md-6">
                          <select class=" form-control department nameid" name="member_group_id">

                              <option value="0" >-Select-</option>
                              @foreach ($groupmems as $groupmem)
                                  <option value="{{$groupmem->id}}"{{$groupmem->id == $event->member_group_id ? 'selected' : ''}}>{{$groupmem->name}}</option>
                              @endforeach

                          </select>



                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_name') ? ' has-error' : '' }}">
                            <label for="event_name" class="col-md-4 control-label">Event Name</label>

                            <div class="col-md-6">
                                <input id="event_name" type="text" class="form-control" name="event_name" value="{{ $event->event_name }}" required autofocus>

                                @if ($errors->has('event_name'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('event_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ $event->location }}" required autofocus>

                                @if ($errors->has('location'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location Map</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="link" value="{{ $event->link }}" >

                                @if ($errors->has('location'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('event_start_date') ? ' has-error' : '' }}">
                            <label for="event_name" class="col-md-4 control-label">Event Start Date</label>

                            <div class="col-md-6">

                                <input type="text" name="sd"  size="4"placeholder="วันที่" value="{{$curdate}}"> <input type="text" name="sm"  size="4" placeholder="เดือนที่" value="{{$curmonth}}"> <input type="text" name="sy"  size="4" placeholder="ปี" value="{{$curyear}}"><br>




                                @if ($errors->has('event_start_date'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('event_start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_start_time') ? ' has-error' : '' }}">
                            <label for="event_start_time" class="col-md-4 control-label">Event Start Time</label>

                            <div class="col-md-6">

                                <input name="event_start_time" class="timepicker" type="text" placeholder="เวลา" value="{{$event->event_start_time}}">
                                <script type="text/javascript">

                                    $('.timepicker').datetimepicker({

                                        format: 'HH:mm:ss'

                                    });

                                </script>




                                @if ($errors->has('event_name'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('event_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_end_date') ? ' has-error' : '' }}">
                            <label for="event_end_date" class="col-md-4 control-label">Event End Date</label>

                            <div class="col-md-6">
                                <input type="text" name="ed"  size="4" placeholder="วันที่"  value="{{$curedate}}"> <input type="text" name="em"  size="4" placeholder="เดือนที่" value="{{$curemonth}}"> <input type="text" name="ey"  size="4" placeholder="ปี" value="{{$cureyear}}"><br>




                                @if ($errors->has('event_end_date'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('event_end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_end_time') ? ' has-error' : '' }}">
                            <label for="event_end_time" class="col-md-4 control-label">Event End Time</label>

                            <div class="col-md-6">

                                <input name="event_end_time" class="timepicker" type="text" placeholder="เวลา" value="{{$event->event_end_time}}">
                                <script type="text/javascript">

                                    $('.timepicker').datetimepicker({

                                        format: 'HH:mm:ss'

                                    });

                                </script>




                                @if ($errors->has('event_end_time'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('event_end_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Default Register Status</label>
                        <div class="col-md-6">
                          <select class=" form-control department nameid" name="regis_default_status">

                              <option value="0" >-Select-</option>
                              @foreach ($status as $sta)
                                  <option value="{{$sta->id}}"{{$sta->id == $event->regis_default_status ? 'selected' : ''}}>{{$sta->name}}</option>
                              @endforeach

                          </select>



                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('number_seat') ? ' has-error' : '' }}">
                            <label for="number_seat" class="col-md-4 control-label">Number Of Seats</label>

                            <div class="col-md-6">
                                <input id="number_seat" type="text" class="form-control" name="number_seat" value="{{ $event->number_seat }}" >

                                @if ($errors->has('number_seat'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('number_seat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link_moreinfo') ? ' has-error' : '' }}">
                            <label for="link_moreinfo" class="col-md-4 control-label">Link More Info</label>

                            <div class="col-md-6">
                                <input id="link_moreinfo" type="text" class="form-control" name="link_moreinfo" value="{{ $event->link_moreinfo }}" >

                                @if ($errors->has('link_moreinfo'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('link_moreinfo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Show In Member View </label>
                        <div class="col-md-6">
                          <select class=" form-control department " name="show_member">
                            @if($event->show_member == 1)
                            <option value="1" >Yes</option>
                            @elseif($event->show_member == 0)
                            <option value="0" >No</option>
                            @endif
                              <option value="1" >Yes</option>
                            <option value="0" >No</option>


                          </select>
                        </div>
                    </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Request Captcha</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="captcha">

                              <option value="{{$event->captcha}}" >{{$event->captcha}}</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>

                          </select>



                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('event_description') ? ' has-error' : '' }}">
                            <label for="event_description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="message-text" name="event_description" value = "{{$event->event_description}}"></textarea>

                                @if ($errors->has('event_description'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('event_description') }}</strong>
                                    </span>
                                @endif
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

      $(".nameid").select2({
            placeholder: "Select a Name",

        });
</script>

@endsection
