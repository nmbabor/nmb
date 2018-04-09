@extends('backend.app')
@section('content')


<h3 class="box_title"> Different Post Field </h3>
	<div class="box-body col-md-11">
		{!! Form::open(array('route' => 'post-field.store','class'=>'form-horizontal','files'=>true)) !!}
		<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
			{{Form::label('title', 'Title* :', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-8">
			{{Form::text('title','',array('class'=>'form-control','placeholder'=>'Title','required'))}}
				@if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
	            @endif
			</div>
			<div class="col-md-2">
				{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
			</div>
			
		</div>
		<div class="form-group col-md-6">
			{{Form::label('type', 'Input Type', array('class' => 'col-md-4 control-label'))}}

			<div class="col-md-8">
				{{Form::select('type',$type, '', ['class' => 'form-control','onchange'=>'loadValue(this.value)'])}}
			</div>
		</div>
		<div class="form-group col-md-6">
			{{Form::label('required', 'Required', array('class' => 'col-md-4 control-label'))}}

			<div class="col-md-8">
				{{Form::select('required',['required'=>'Yes',''=>'No'], 'required', ['class' => 'form-control'])}}
			</div>
		</div>
		<div id="loadValue"><!-- Load Sub Category --></div>
		<div class="form-group">
			{{Form::label('category', 'Select Category* :', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-4">
				{{Form::select('category[]',$category,'', ['class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])}}
			</div>
		</div>
		<div id="loadSubCat"><!-- Load Sub Category --></div>

		<div class="form-group">
			<div class="col-md-10 col-md-offset-2">
				{{Form::submit('Submit',array('class'=>'btn btn-lg btn-info'))}}
			</div>
		</div>
			
		{!! Form::close() !!}
	</div>
	<?
	$i=0;
	?>
	<div class="col-md-12">
		<table class="table table-striped table-hover table-bordered center_table" id="my_table">
			<thead>
				<tr>
					<th width="2%">SL</th>
					<th>Field Name</th>
					<th>Type</th>
					<th width="4%">Status</th>
					<th width="7%">Required</th>
					<th>Sub Category</th>
					<th colspan="2" width="5%">Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($allData as $data)
			<? $i++; ?>
				<tr>
					<td>{{$i}}</td>
					<td>{{$data->title}}</td>
					<td>{{ucwords($data->type)}}</td>
					<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
					
					<td>{{ucwords($data->required)}}</td>
					<td><small>{{$data->category}}</small></td>
					<td><a href='{{URL::to("post-field/$data->id/edit")}}' class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a></td>
					<td>
						{{Form::open(array('route'=>['post-field.destroy',$data->id],'method'=>'DELETE'))}}
            				<button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        				{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		

	</div>
	<div class="col-md-12">
		<div class="pull-right">
			{{$allData->render()}}	
		</div>
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