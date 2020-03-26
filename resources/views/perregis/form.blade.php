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
    {{Form::open(['url'=>'perregis']) }}
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

          {{Form::label('name', 'ชื่อภาษาไทย') }}

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
          {{Form::label('lname', 'นามสกุลภาษาไทย') }}

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


          {{Form::label('email', 'E-mail') }}

          @if(isset($per->email))
          {{Form::text('email',$per->email,['class'=> 'form-control'])}}
          @else
          {{Form::text('email','',['class'=> 'form-control'])}}
          @endif

          <br>

              <label for="password" >{{ __('Password') }}</label>


                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif


                  <br>

              <label for="password-confirm" >{{ __('Confirm Password') }}</label>


                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                  <br>
          {{Form::label('phone', 'Phone') }}

          @if(isset($per->phone))
          {{Form::text('phone',$per->phone,['class'=> 'form-control'])}}
          @else
          {{Form::text('phone','',['class'=> 'form-control'])}}
          @endif
          <br>

          {{Form::label('dob', 'Your birthdate') }}

          @if(isset($per->dob))
          {{Form::date('dob',$per->dob,['class'=> 'form-control'])}}
          @else
          {{Form::date('dob','',['class'=> 'form-control'])}}
          @endif

          <br>
          {{Form::label('age', 'Age') }}

          @if(isset($per->age))
          {{Form::text('age',$per->age,['class'=> 'form-control'])}}
          @else
          {{Form::text('age','',['class'=> 'form-control'])}}
          @endif

          <br>
          {{Form::label('id_num', 'ID Number') }}

          @if(isset($per->id_num))
          {{Form::text('id_num',$per->id_num,['class'=> 'form-control'])}}
          @else
          {{Form::text('id_num','',['class'=> 'form-control'])}}
          @endif
          <br>




          <br>
          <br>
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
          <br>
          <br>
          
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.department',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findDivName')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>chose Block</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

                  }
                  div.find('.name').html(" ");
                  div.find('.name').append(op);

                },
                error:function(){

                }
            });
        });
    });
</script>

@endsection
