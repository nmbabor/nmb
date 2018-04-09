@extends('backend.app')
    @section('content')
<h4 class="header-title m-t-0 m-b-30"><i class="fa fa-pencil" aria-hidden="true"></i> User Registration <a href="{{route('users.index')}}" class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View all user</a></h4>
                                    <hr>

{!! Form::open(array('route' => 'users.store','class'=>'form-horizontal')) !!}
                                    
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="fullName" class="col-sm-3 control-label">Full Name* : </label>
    <div class="col-sm-7">
        <input type="text" name="name" parsley-trigger="change" required
           placeholder="Enter Full Name" class="form-control" id="fullName" value="{{ old('name') }}">
           @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="inputEmail3" class="col-sm-3 control-label">Email* :</label>
    <div class="col-sm-7">
        <input type="email" name="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{ old('email') }}">
               @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
    </div>
</div>
<div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="pass1" class="col-sm-3 control-label">Password* :</label>
    <div class="col-sm-7">
        <input name="password" id="pass1" type="password" placeholder="Password" required class="form-control">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
    <label for="passWord2" class="col-sm-3 control-label">Confirm Password* :</label>
    <div class="col-sm-7">
        <input data-parsley-equalto="#pass1" type="password" required placeholder="Password" class="form-control" id="passWord2" name="password_confirmation">
        @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
    <label for="mobile" class="col-sm-3 control-label">Mobile Number* : </label>
    <div class="col-sm-7">
        <input type="text" name="mobile" parsley-trigger="change" required
           placeholder="Mobile number" class="form-control" id="mobile" value="{{ old('mobile') }}">
           @if ($errors->has('mobile'))
                <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
            @endif
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
    {{Form::label('address','Address :',['class'=>'col-sm-3 control-label'])}}
    <div class="col-md-7">
        {{Form::textArea('address','',['class'=>'form-control','placeholder'=>'Address','rows'=>'2','required'])}}
         @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
    {{Form::label('type','User Type* :',['class'=>'col-sm-3 control-label'])}}
    <div class="col-md-7">
        {{Form::select('type',$type,'',['class'=>'form-control','placeholder'=>'Select type','required'])}}
         @if ($errors->has('type'))
                <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
        @endif
    </div>
</div>



<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
            Register
        </button>
    </div>
</div>
    {!! Form::close() !!}                
@endsection