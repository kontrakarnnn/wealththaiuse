@extends('layouts.app')

@section('content')
  <div class ="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class ="panel-heading">Dashboard</div>

        <div class="panel-body">
          <div class="list-group">
              @foreach ($division as $div)
                <div class="list-group-item">
                  <h4 class="list-group-item-heading">
                        Name{{ $div->name}}
                  </h4>
                  <p class="list-group-item-text">
                    DivID  {{$div->id}}

                  </p>
                  <p class="list-group-item-text">

                      DepartmentID{{$div->department_id}}

                  </p>
                  <p class="list-group-item-text">

                      Underdivision{{$div->under_division}}
                  </p>
                </div>

              @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>






@endsection
