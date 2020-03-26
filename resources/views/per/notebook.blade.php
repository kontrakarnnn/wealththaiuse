
@extends('per.base')
@section('action-content')






                <div class="panel-heading"></div>
                <div class="panel-body">

                    <form   class="form-horizontal" role="form" method="POST" action="{{ URL::to('/SecurityBroke/noteup')}}">
                      {{--}}<form  method="POST" action="{{ route('update')}}">--}}
                       {{ csrf_field() }}
                       <input type="hidden" name="id" value="{{ $per->id }}">


                      {{--}}  <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">notebook</label>

                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control" name="note" value="{{ $portfolio->note }}" >

                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}
                        <div class="flash-message">
                          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                            <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                          @endforeach
                        </div>
                        @if(isset($per->note))
                        {{Form::textarea('note',$per->note,['class'=> 'form-control'])}}
                        @else
                        {{Form::textarea('note','',['class'=> 'form-control'])}}
                        @endif








                        <br>
                        <div class="form-group">
                            <div class="col-md-6 ">
                                <a  href ="/per"type="button" class="btn btn-warning">
                                    Back
                                </a>
								<button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>





            <!-- /.content -->
        @endsection
