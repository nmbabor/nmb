@extends('backend.app')
@section('content')


<h3 class="box_title">Edit 
 <a href="{{route('pages.index')}}" class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All </a>
 </h3>
    {!! Form::open(array('route' => ['pages.update', $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
        <div class="form-group ">
            
            {{Form::label('link', 'Page link', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <div class="input-group">
                    <div class="input-group-addon">{{URL::to('page')}}/</div>
                    {{Form::text('link',$data->link,array('class'=>'form-control','placeholder'=>'Page link','required'))}}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{Form::label('name', 'Page Name', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Page Name','required'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('title', 'Page title', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('title',$data->title,array('class'=>'form-control','placeholder'=>'Page title','required'))}}
            </div>
        </div>
        <div class="form-group {{$errors->has('file') ? ' has-error' : '' }}">
            {{Form::label('file', 'Pdf File', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
            @if($data->file!=null)
                <div id="pdf">
                  <object type="application/pdf" data='{{asset("public/files/page/$data->file")}}?#zoom=80&scrollbar=0&toolbar=0&navpanes=0' id="pdf_content">
                    <p>Not Found PDF File.</p>
                  </object>
                </div>
            @endif
                {{Form::file('file',array('class'=>'form-control'))}}
                 @if ($errors->has('file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('description',$data->description,array('class'=>'form-control ','id'=>'ckeditor','placeholder'=>'Write some thing about page','rows'=>'5'))}}
            </div>
        </div>
        
        <div class="form-group">
            {{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-8">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                {{Form::label('photo', 'Image', array('class' => 'control-label col-md-3'))}}
                <div class="col-md-8">
                    <div id="formdiv">
                        <div class="img_control">
                          <? 
                          if(!empty($data->photo)){
                            foreach ($data->photo as $photo) { ?>
                            <div id="filediv">
                                <div id="abcd" class="abcd"><img id="previewimg" src="{{asset('public/img/page/'.$photo['photo'])}}"><input type="hidden" id="exist_file" value="<? echo $photo['id']; ?>" /><img id="exist_img" src="{{asset('public/img/x.png')}}" alt="X" title="Delete"></div>
                            </div>

                             <?} } ?>
                             <div id="filediv"><input name="photo[]" type="file" id="files"/></div>
                             <div id="loadDelete"><!-- Load Delete value --></div>
                        <input type="button" id="add_more" class="upload btn btn-warning" value="Add More Photo"/>
                        </div>
                    </div>
                    @if ($errors->has('photo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
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

