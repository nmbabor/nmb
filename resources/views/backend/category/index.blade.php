@extends('backend.app')
@section('content')


<h3 class="box_title">{{($type==1)?'Product':'Business'}} Category</h3>
	<div class="box-body col-md-11">
		{!! Form::open(array('route' => 'category.store','class'=>'form-horizontal','files'=>true)) !!}
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{{Form::label('name', 'Category Name', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-8">
				{{Form::text('name','',array('class'=>'form-control','placeholder'=>'Category Name','required'))}}
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
	            @endif
			</div>
			<div class="col-md-2">
				{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
			</div>
		</div>
		<div class="form-group">
			{{Form::label('short_description', 'Short Description', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-10">
				{{Form::textArea('short_description','', ['class' => 'form-control','rows'=>'2','placeholder'=>'Short Description for Home Page'])}}
			</div>
		</div>
		<div class="form-group">
			{{Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-10">
				{{Form::textArea('description','', ['class' => 'form-control','rows'=>'4','placeholder'=>'Write something about category. This is helpful for seo.'])}}
			</div>
		</div>
		<div class="form-group {{ $errors->has('icon_photo') ? 'has-error' : '' }}">
            {{Form::label('icon_photo', 'Icon', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-2">
                <label class="upload_photo upload icon_upload" for="file">
                    <!--  -->
                    <img id="image_load">
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
				{{Form::text('icon_class','',array('class'=>'form-control','placeholder'=>'Ex: fa fa-facebook, ion-gear-a'))}}
				<span>Use : <a class="btn btn-link" href="http://fontawesome.io/icons/">Font Awesome</a>, <a class="btn btn-link" href="http://ionicons.com/">ion icons</a></span>
			</div>
		<? $max=$max_serial+1; ?>
			<div class="col-md-2">
				{{Form::number('serial_num',$max, ['min'=>'1','max'=>$max,'class' => 'form-control','required'])}}
				<span>Category Serial</span>
			</div>
        </div>

		{{Form::hidden('type',$type)}}
		<div class="form-group">
			{{Form::label('post_type', 'Category Type', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-3">
				{{Form::select('post_type', array('1' => 'Normal Category', '2' => 'Job Category'), '1', ['class' => 'form-control'])}}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-10 col-md-offset-2">
				{{Form::submit('Submit',array('class'=>'btn btn-lg btn-info'))}}
			</div>
		</div>
			
		{!! Form::close() !!}
	</div>
	<div class="col-md-12">
		<table class="table table-striped table-hover table-bordered center_table" id="my_table">
			<thead>
				<tr>
					<th>SL</th>
					<th>Category Name</th>
					<th>Status</th>
					<th>Icon Photo</th>
					<th>Icon Class</th>
					<th>Sub Category</th>
					@if($type==1)
					<th>Brand</th>
					@endif
					<th colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
			<? $i=1; ?>
			@foreach($allData as $data)
				<tr>
					<td>{{$i++}}</td>
					<td><a href='{{URL::to("$url/$data->id/edit")}}'>{{$data->name}}</a></td>
					<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
					<td>@if($data->icon_photo!=null)
                    <img width="40px" class="img-responsive" src='{{asset("public/img/category/$data->type/$data->icon_photo")}}' alt="{{$data->name}}">
	                @endif
	                </td>
					<td>{{$data->icon_class}}</td>
					<td><a class="btn btn-xs btn-sm btn-default" href='{{URL::to("sub-category/$data->id")}}'>Sub Category ({{DB::table('sub_category')->where('fk_category_id',$data->id)->count()}})</a></td>
					@if($type==1)
					<td>
					<a href="" class="btn btn-xs btn-success">Brands</a>
					</td>
					@endif
					<td><a href='{{URL::to("$url/$data->id/edit")}}' class="btn btn-info"><i class="ion ion-compose"></i></a>
					</td>
					<td>
						{{Form::open(array('route'=>['category.destroy',$data->id],'method'=>'DELETE'))}}
            				<button type="submit" class="btn btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        				{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div class="pull-right">
		{{$allData->render()}}	
		</div>
	</div>

























@endsection




<script type="text/javascript">

function deleteConfirm(){
  var con= confirm("Do you want to delete?");
  if(con){
    return true;
  }else 
  return false;
}
</script>