@extends('layouts/app-per')

@section('content')



  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
    <div class="panel-heading">
      @if(isset($per))
        <h4>EDIT</h4>
      @else
        Input Information
      @endif
    </div>
    @if(isset($per))
      {{Form::open(['method' => 'put', 'route' => ['per.addport',$per->id]])}}
    @else
      {{Form::open(['url'=>'per']) }}
    @endif
    <div class="panel-body">


      @if (count($errors) > 0)
        <div class ="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
      @endif
  <div class="form-horizontal">


      <div class="card2">


      <div class="card-body">

            {{Form::label('name', 'Name') }}

            @if(isset($per->name))
            {{Form::text('name',$per->name,['class'=> 'form-control'])}}
            @else
            {{Form::text('name','',['class'=> 'form-control'])}}
            @endif
            <br>
            {{Form::label('Eng_name', 'English Name') }}
            @if(isset($per->Eng_name))
            {{Form::text('Eng_name',$per->Eng_name,['class'=> 'form-control'])}}
            @else
            {{Form::text('Eng_name','',['class'=> 'form-control'])}}
            @endif

            <br>
            {{Form::label('lname', 'Last Name') }}

            @if(isset($per->lname))
            {{Form::text('lname',$per->lname,['class'=> 'form-control'])}}
            @else
            {{Form::text('lname','',['class'=> 'form-control'])}}
            @endif

            <br>
            {{Form::label('Eng_lastname', 'English Lastname') }}

            @if(isset($per->Eng_lastname))
            {{Form::text('Eng_lastname',$per->Eng_lastname,['class'=> 'form-control'])}}
            @else
            {{Form::text('Eng_lastname','',['class'=> 'form-control'])}}
            @endif
            <br>




            <br>
            <br>
            <br>
            <h5 style="color:red">**กรุณากรอกข้อมูลเกี่ยวกับพอร์ต**</h5>
          <label class="control-label">Structure:</label>

              <select class=" form-control department" name="department_id">

                  <option value="0" >-Select-</option>
                  @foreach ($departments as $department)
                      <option value="{{$department->id}}">{{$department->name}}</option>
                  @endforeach

              </select>
              <label class="control-label">Block:</label>

              <select class=" form-control name" name="under_division">

                  <option value="0" disabled="true" selected="true">Block</option>
              </select>

            <br>


                  {{Form::submit('Save',['class'=> 'btn btn-pripery'])}}


          </div>


      </div>
    </div>
  </div>
  </div>

      <br>

      </div>
    </div>
    {{Form::close() }}
  </div>

@endsection
