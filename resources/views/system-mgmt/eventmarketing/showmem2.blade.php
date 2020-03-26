@extends('system-mgmt.eventmarketing.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Event</div>
                <div class="panel-body">


                        @foreach(App\Person::where('event_id',$event->id)->get(); as $indexKey => $depList)
                          {{++$indexKey}}
                          {{$depList->name}}
                          {{$depList->lname}}
                        @endforeach

                          </div>
                        </div>


            </div>
        </div>
    </div>
</div>


@endsection
