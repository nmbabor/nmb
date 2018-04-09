@extends('backend.app')
@section('content')
<div class="tab_content">

<h3 class="box_title">Add New 
 <a href="{{route('pages.index')}}" class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All </a></h3>
	{!! Form::open(array('route' => 'pages.store','class'=>'form-horizontal','files'=>true)) !!}
        <div class="form-group  {{ $errors->has('link') ? 'has-error' : '' }}">
            
            {{Form::label('link', 'Page link', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <div class="input-group">
                    <div class="input-group-addon">{{URL::to('page')}}/</div>
                    {{Form::text('link','',array('class'=>'form-control','placeholder'=>'Page link','required'))}}
                </div>
                @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            {{Form::label('name', 'Page Name', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Page Name','required'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('title', 'Page Title', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('title','',array('class'=>'form-control','placeholder'=>'Page Title','required','rows'=>'2'))}}
            </div>
        </div>
        <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
            {{Form::label('file', 'Pdf file', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::file('file',array('class'=>'form-control'))}}
                 @if ($errors->has('file'))
                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                    <br>
                    <b>OR</b>
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('description','',array('class'=>'form-control ','id'=>'ckeditor','placeholder'=>'Write some thing about page','rows'=>'5'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
            {{Form::label('photo', 'Image', array('class' => 'control-label col-md-3'))}}
            <div class="col-md-8">
            <small>Max image size 2MB</small>
                <div id="formdiv">
                    <div class="img_control">
                      <div id="filediv">
                      {{ Form::file('photo[]', array('multiple'=>true,'id'=>'files')) }}
                      </div>
                        <div class="add_btn">
                            <input type="button" id="add_more" class="upload btn btn-warning" value="Add More Photo"/>
                        </div>
                    </div>
                </div>
                @if ($errors->has('photo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
            </div>
         </div>
        
        <div class="from-group col-md-6 multiple_upload">
        <!-- Load multiple photo -->
        </div>

	    <div class="form-group">
	        <div class="col-md-9 col-md-offset-3">
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
	    </div>
      </div>
	{!! Form::close() !!}

@endsection

