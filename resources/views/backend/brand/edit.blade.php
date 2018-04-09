@extends('backend.app')
@section('content')


<h3 class="box_title">Edit {{$data->brand_name}}
 <a href='{{URL::to("brand")}}' class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All </a></h3>
 <div class="col-md-11">
     
    {!! Form::open(array('route' => ['brand.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
        <div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }}">
             {{Form::label('brand_name', 'Name', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-8">
                {{Form::text('brand_name',$data->brand_name,array('class'=>'form-control','placeholder'=>'Brand Name','required'))}}
                @if ($errors->has('brand_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('brand_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-2">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), $data->status, ['class' => 'form-control'])}}
            </div>
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
        $('#loadSubCat').load('{{URL::to("brand")}}/'+id);

    }
 </script>
@endsection