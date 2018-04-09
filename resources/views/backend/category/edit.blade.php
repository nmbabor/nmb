@extends('backend.app')
@section('content')


<h3 class="box_title">Edit Category
 <a href='{{URL::to("$url")}}' class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All </a></h3>
 <div class="col-md-11">
     
    {!! Form::open(array('route' => ['category.update', $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{Form::label('name', 'Category Name', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-8">
                {{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Category Name','required'))}}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-2">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), $data->status, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('short_description', 'Short Description', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-10">
                {{Form::textArea('short_description',$data->short_description, ['class' => 'form-control','rows'=>'2','placeholder'=>'Short Description for Home Page'])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-10">
                {{Form::textArea('description',$data->description, ['class' => 'form-control','rows'=>'8','placeholder'=>'Write something about category. This is helpful for seo.'])}}
            </div>
        </div>
        <div class="form-group {{ $errors->has('icon_photo') ? 'has-error' : '' }}">
            {{Form::label('icon_photo', 'Icon', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-2">
                <label class="upload_photo upload icon_upload" for="file">
                @if($data->icon_photo!=null)
                    <img src='{{asset("public/img/category/$data->type/$data->icon_photo")}}' id="image_load">
                @else
                <img id="image_load">
                @endif
                    <i class="upload_hover ion ion-ios-camera-outline"></i>
                </label>
                {{Form::file('icon_photo',array('id'=>'file','style'=>'display:none'))}}
                 @if ($errors->has('icon_photo'))
                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('icon_photo') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="col-md-1">
                <b>OR</b>
            </div>
            <div class="col-md-5">
                {{Form::text('icon_class',$data->icon_class,array('class'=>'form-control','placeholder'=>'Ex: fa fa-facebook, ion-gear-a'))}}
                <span>Use : <a class="btn btn-link" href="http://fontawesome.io/icons/">Font Awesome</a>, <a class="btn btn-link" href="http://ionicons.com/">ion icons</a></span>
            </div>
        <? $max=$max_serial+1; ?>
            <div class="col-md-2">
                {{Form::number('serial_num',$data->serial_num, ['min'=>'1','max'=>$max,'class' => 'form-control','required'])}}
                <span>Category Serial</span>
            </div>
        </div>
        <div class="form-group">
            {{Form::label('post_type', 'Category Type', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-3">
                {{Form::select('post_type', array('1' => 'Normal Category', '2' => 'Job Category'), $data->post_type, ['class' => 'form-control'])}}
            </div>
        </div>
        {{Form::hidden('type',$data->type)}}
        {{Form::hidden('id',$data->id)}}
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                {{Form::submit('Save Change',array('class'=>'btn btn-lg btn-info'))}}
            </div>
        </div>
            
      
    {!! Form::close() !!}
 </div>

@endsection

