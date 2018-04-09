@extends('backend.app')
@section('content')


<h3 class="box_title">About Organization</h3>
    {!! Form::open(array('route' =>['others-info.update', $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
        
        <div class="form-group  {{ $errors->has('short_description') ? 'has-error' : '' }}">
            {{Form::label('short_description', 'Short Description', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('short_description',$data->short_description,array('class'=>'form-control','placeholder'=>'Short Description','rows'=>'5'))}}
                @if ($errors->has('short_description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('short_description') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group  {{ $errors->has('description') ? 'has-error' : '' }}">
            {{Form::label('description', 'Long Description', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('description',$data->description,array('class'=>'form-control ckeditor','id'=>'ckeditor','placeholder'=>'Google Map Embed Code','rows'=>'10'))}}
                @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
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

