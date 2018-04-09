@extends('backend.app')
@section('content')

  	<h3 class="box_title">Change Password
 		<a href="{{URL::to('my-profile')}}" class="btn btn-default pull-right"> <i class="fa fa-user"></i> Profile</a>
 	</h3>

		 {!! Form::open(array('route' => 'password','class'=>'form-horizontal','method'=>'POST')) !!}
	    <div class="modal-body">
	        <div class="form-group {{ Session::has('errorPass') ? 'has-error' : '' }}">
	            {{Form::label('old_password', 'Old Password', array('class' => 'col-md-4 control-label'))}}
	            <div class="col-md-8">
	                {{Form::password('old_password',array('class'=>'form-control','placeholder'=>'Old Password','required'))}}
 					@if(Session::has('errorPass'))
	                    <span class="help-block">
	                        <strong>{{ Session::get('errorPass') }}</strong>
	                    </span>
	                @endif
	            </div>
	        </div>
	        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
	            {{Form::label('password', 'Password', array('class' => 'col-md-4 control-label'))}}
	            <div class="col-md-8">
	                {{Form::password('password',array('class'=>'form-control','placeholder'=>'Password','required'))}}
	                 @if ($errors->has('password'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('password') }}</strong>
	                    </span>
	                @endif
	            </div>
	        </div>
	        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
	            {{Form::label('password_confirmation', 'Password Confirmation', array('class' => 'col-md-4 control-label'))}}
	            <div class="col-md-8">
	                {{Form::password('password_confirmation',array('class'=>'form-control','placeholder'=>'Password Confirmation','required'))}}
	                 @if ($errors->has('password_confirmation'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('password_confirmation') }}</strong>
	                    </span>
	                @endif
	            </div>
	        </div>
	        {{Form::hidden('id',$data->id)}}
	    </div>
	      <div class="modal-footer">
	      <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o" aria-hidden="true"> Save Password</i></button>
	    </div>
	        {!! Form::close() !!}


	







@endsection