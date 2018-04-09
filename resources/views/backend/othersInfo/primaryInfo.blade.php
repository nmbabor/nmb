@extends('backend.app')
@section('content')


<h3 class="box_title">Primary Information</h3>
    {!! Form::open(array('route' =>['others-info.update', $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
        <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
            {{Form::label('logo', 'Organization Logo', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <label class="upload_photo upload client_logo_upload" for="file">
                    <!--  -->
                    <img src="{{asset('public/img/'.$data->logo)}}" id="image_load">
                    <i class="upload_hover ion ion-ios-camera-outline"></i>
                </label>
                {{Form::file('logo',array('id'=>'file','style'=>'display:none'))}}
                 @if ($errors->has('logo'))
                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('logo') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group  {{ $errors->has('company_name') ? 'has-error' : '' }}">
            {{Form::label('company_name', 'Name of Organization', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('company_name',$data->company_name,array('class'=>'form-control','placeholder'=>'Name of Organization'))}}
                @if ($errors->has('company_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_name') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group  {{ $errors->has('location') ? 'has-error' : '' }}">
            {{Form::label('location', 'Organization Location', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('location',$data->location,array('class'=>'form-control','placeholder'=>'Organization location'))}}
                @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group  {{ $errors->has('details') ? 'has-error' : '' }}">
            {{Form::label('details', 'Other Details', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('details',$data->details,array('class'=>'form-control ckeditor','placeholder'=>'Other Details','rows'=>'3'))}}
                @if ($errors->has('details'))
                        <span class="help-block">
                            <strong>{{ $errors->first('details') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group  {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
            {{Form::label('mobile_no', 'Contact Number', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('mobile_no',$data->mobile_no,array('class'=>'form-control','placeholder'=>'Contact Number'))}}
                @if ($errors->has('mobile_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile_no') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
            {{Form::label('email', 'Email', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::email('email',$data->email,array('class'=>'form-control','placeholder'=>'Email'))}}
                @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group  {{ $errors->has('fb_link') ? 'has-error' : '' }}">
            {{Form::label('fb_link', 'Facebook page link', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('fb_link',$data->fb_link,array('class'=>'form-control','placeholder'=>'Facebook page link'))}}
                @if ($errors->has('fb_link'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fb_link') }}</strong>
                        </span>
                    @endif
            </div>
        </div>

        <div class="form-group  {{ $errors->has('map_embed') ? 'has-error' : '' }}">
            {{Form::label('map_embed', 'Google Map Embed Code', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('map_embed',$data->map_embed,array('class'=>'form-control','placeholder'=>'Google Map Embed Code','rows'=>'5'))}}
                @if ($errors->has('map_embed'))
                        <span class="help-block">
                            <strong>{{ $errors->first('map_embed') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group">
            {{Form::label('Google Map', 'Google Map', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <iframe src="{{$data->map_embed}}" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>

            {{Form::hidden('id',$data->id)}}
        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      
	{!! Form::close() !!}

@endsection

