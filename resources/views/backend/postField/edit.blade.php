@extends('backend.app')
@section('content')


<h3 class="box_title">Edit : {{$data->title}}
 <a href='{{URL::to("post-field")}}' class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All </a></h3>
 <div class="col-md-11">
     
    {!! Form::open(array('route' => ['post-field.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
       <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{Form::label('title', 'Title* :', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-8">
            {{Form::text('title',$data->title,array('class'=>'form-control','placeholder'=>'Title','required'))}}
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-2">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), $data->status, ['class' => 'form-control'])}}
            </div>
            
        </div>
        <div class="form-group col-md-6">
            {{Form::label('type', 'Input Type', array('class' => 'col-md-4 control-label'))}}

            <div class="col-md-8">
                {{Form::select('type',$type, $data->type, ['class' => 'form-control','onchange'=>'loadValue(this.value)'])}}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('required', 'Required', array('class' => 'col-md-4 control-label'))}}

            <div class="col-md-8">
                {{Form::select('required',['required'=>'Yes',''=>'No'], $data->required, ['class' => 'form-control'])}}
            </div>
        </div>
        <div id="loadValue">
        @if($data->type=='dropdown')
            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                {{Form::label('value', 'Value* :', array('class' => 'col-md-2 control-label'))}}
                <div class="col-md-10">
                <input name="value" id="tagboxField" value="{{$data->value}}" type="hidden">
                    <ul id="tagbox"></ul>
                    <span>For white space, use underscore ( _ )</span>
                    @if ($errors->has('value'))
                        <span class="help-block">
                            <strong>{{ $errors->first('value') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endif
        </div>
        <div class="form-group">
            {{Form::label('category', 'Select Category* :', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-10">
                {{Form::select('category[]',$category,$categoryId, ['class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])}}
            </div>
        </div>
        <div id="loadSubCat">
            <div class="form-group">
                {{Form::label('sub_category_id', 'Sub Category* :', array('class' => 'col-md-2 control-label'))}}
                <div class="col-md-10">
                    {{Form::select('sub_category_id[]',$subCategory,$existSubCat, ['class' => 'form-control chosen-select','data-placeholder'=>'Select Sub Category','multiple','required'])}}
                </div>
            </div>
            <div class="form-group">
            {{Form::label('part_of', 'Part of Field:', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-4">
                {{Form::select('part_of',$partOf,$data->part_of, ['class' => 'form-control select','placeholder'=>'Select Field'])}}
            </div>
        </div>
        </div>
        {{Form::hidden('id',$data->id)}}
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                {{Form::submit('Save Change',array('class'=>'btn btn-lg btn-info'))}}
            </div>
        </div>
            
      
    {!! Form::close() !!}
 </div>

@endsection

@section('script')
 <script type="text/javascript">
    function loadSubCategory(id){
        $('#loadSubCat').load('{{URL::to("post-field")}}/'+id);
    }
    function loadValue(value){
        if(value=='dropdown'){
            $('#loadValue').load('{{URL::to("post-field/create")}}');
        }else{
            $('#loadValue').html('');
        }
    }
 </script>
@endsection