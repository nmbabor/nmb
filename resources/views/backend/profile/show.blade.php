@extends('backend.app')
    @section('content')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
<h4 class="header-title m-t-0 m-b-30"><i class="fa fa-pencil" aria-hidden="true"></i> Profile</h4>
                                    <hr>

         {!! Form::open(array('route' => ['users.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
                       <input type="hidden" name="id" value="{{$data->id}}">      
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="fullName" class="col-sm-3 control-label">Full Name* : </label>
    <div class="col-sm-7">
        <input type="text" name="name" parsley-trigger="change" value="{{$data->name}}" required
           placeholder="Enter Full Name" class="form-control" id="fullName">
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
        <input type="email" name="email" value=" {{$data->email}} " required parsley-type="email" class="form-control"
               id="inputEmail3" placeholder="Email">
               @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
    </div>
</div>

<div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
    <label for="mobile" class="col-sm-3 control-label">Mobile Number* : </label>
    <div class="col-sm-7">
        <input type="text" name="mobile" parsley-trigger="change" required
           placeholder="Mobile number" class="form-control" id="mobile" value="{{$data->mobile}}">
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
        {{Form::textArea('address',$data->address,['class'=>'form-control','placeholder'=>'Address','rows'=>'2','required'])}}
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
        {{Form::select('type',$type,$data->type,['class'=>'form-control','placeholder'=>'Select type','required'])}}
         @if ($errors->has('type'))
                <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
        @endif
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <a class="btn btn-warning btn-trans waves-effect w-md waves-success m-b-5" href="{{URL::to('change-password')}}" >Change Password</a>
        <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
            Save
        </button>
    </div>
</div>
    {!! Form::close() !!}
                
        @endsection