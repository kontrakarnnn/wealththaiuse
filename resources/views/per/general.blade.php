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
      {{Form::open(['method' => 'put', 'route' => ['per.update',$per->id]])}}
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
  

            <h5 style="color:red">ข้อมูลเกี่ยวกับการหางานสามารถกรอกที่หลังได้</h5>
            {{Form::label('address', 'Address') }}

            @if(isset($per->address))
            {{Form::textarea('address',$per->address,['class'=> 'form-control'])}}
            @else
            {{Form::textarea('address','',['class'=> 'form-control'])}}
            @endif
            <br>
            {{Form::label('university', 'University') }}

            @if(isset($per->university))
            {{Form::text('university',$per->university,['class'=> 'form-control'])}}
            @else
            {{Form::text('university','',['class'=> 'form-control'])}}
            @endif

            <br>

            {{Form::label('faculty', 'Faculty') }}

            @if(isset($per->faculty))
            {{Form::text('faculty',$per->faculty,['class'=> 'form-control'])}}
            @else
            {{Form::text('faculty','',['class'=> 'form-control'])}}
            @endif

            <br>

            {{Form::label('major', 'Major') }}

            @if(isset($per->major))
            {{Form::text('major',$per->major,['class'=> 'form-control'])}}
            @else
            {{Form::text('major','',['class'=> 'form-control'])}}
            @endif


            <br>
            {{Form::label('gpa', 'Gpax') }}

            @if(isset($per->gpa))
            {{Form::text('gpa',$per->gpa,['class'=> 'form-control'])}}
            @else
            {{Form::text('gpa','',['class'=> 'form-control'])}}
            @endif
            <br>

            {{Form::label('job', 'Your Interested Job') }}

            @if(isset($per->job))
            {{Form::text('job',$per->job,['class'=> 'form-control'])}}
            @else
            {{Form::text('job','',['class'=> 'form-control'])}}
            @endif

            <br>
            {{Form::label('workexpr', 'Work Experience') }}

            @if(isset($per->workexpr))
            {{Form::textarea('workexpr',$per->workexpr,['class'=> 'form-control'])}}
            @else
            {{Form::textarea('workexpr','',['class'=> 'form-control'])}}
            @endif

            <br>
            {{Form::label('skill', 'Skills') }}

            @if(isset($per->skill))
            {{Form::textarea('skill',$per->skill,['class'=> 'form-control'])}}
            @else
            {{Form::textarea('skill','',['class'=> 'form-control'])}}
            @endif

            <br>
            {{Form::label('interest', 'Your Interesting') }}

            @if(isset($per->interest))
            {{Form::textarea('interest',$per->interest,['class'=> 'form-control'])}}
            @else
            {{Form::textarea('interest','',['class'=> 'form-control'])}}
            @endif
            <br>

            {{Form::label('another', 'Another') }}

            @if(isset($per->another))
            {{Form::textarea('another',$per->another,['class'=> 'form-control'])}}
            @else
            {{Form::textarea('another','',['class'=> 'form-control'])}}
            @endif
            <br>

            {{Form::label('status', 'Status') }}

            @if(isset($per->status))
            {{Form::select('status', array('หางานอยู่' => 'หางานอยู่', 'ได้งานแล้ว' => 'ได้งานแล้ว', 'ได้งานแล้วแต่ยังสนใจหางานต่อ' => 'ได้งานแล้วแต่ยังสนใจหางานต่อ'))}}
            @else
            {{Form::select('status', array('หางานอยู่' => 'หางานอยู่', 'ได้งานแล้ว' => 'ได้งานแล้ว','ได้งานแล้วแต่ยังสนใจหางานต่อ' => 'ได้งานแล้วแต่ยังสนใจหางานต่อ'))}}
            @endif

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
