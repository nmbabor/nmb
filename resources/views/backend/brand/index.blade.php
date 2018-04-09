@extends('backend.app')
@section('content')


<h3 class="box_title"> Brands </h3>
	<div class="box-body col-md-11">
		{!! Form::open(array('route' => 'brand.store','class'=>'form-horizontal','files'=>true)) !!}
		<div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }}">
			{{Form::label('brand_name', 'Brand Name* :', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-10">
			<input name="brand_name" id="tagboxField" value="" type="hidden">
				<ul id="tagbox"></ul>
				<span>For white space, use underscore ( _ )</span>
				@if ($errors->has('brand_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('brand_name') }}</strong>
                    </span>
	            @endif
			</div>
			
		</div>
		<div class="form-group">
			{{Form::label('category', 'Select Category* :', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-10">
				{{Form::select('category[]',$category,'', ['class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])}}
			</div>
		</div>
		<div id="loadSubCat"><!-- Load Sub Category --></div>

		<div class="form-group">
			{{Form::label('status', 'Status', array('class' => 'col-md-2 control-label'))}}

			<div class="col-md-4">
				{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-10 col-md-offset-2">
				{{Form::submit('Submit',array('class'=>'btn btn-lg btn-info'))}}
			</div>
		</div>
			
		{!! Form::close() !!}
	</div>
	<?
	$total=count($allData);
	$chunk=round($total/2);
	$i=0;
	?>
	@foreach($allData->chunk($chunk) as $data1)
	<div class="col-md-6">
		<table class="table table-striped table-hover table-bordered center_table" id="my_table">
			<thead>
				<tr>
					<th>SL</th>
					<th>Brand Name</th>
					<th>Status</th>
					<th>Sub Category</th>
					<th colspan="2" width="5%">Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data1 as $data)
			<? $i++; ?>
				<tr>
					<td>{{$i}}</td>
					<td>{{$data->brand_name}}</td>
					<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
					
					<td><small>{{$data->category}}</small></td>
					<td><a href='{{URL::to("brand/$data->id/edit")}}' data-toggle="modal" class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a></td>
					<td>
						{{Form::open(array('route'=>['brand.destroy',$data->id],'method'=>'DELETE'))}}
            				<button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        				{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		

	</div>
	@endforeach
	<div class="col-md-12">
		<div class="pull-right">
			{{$allData->render()}}	
		</div>
	</div>
	

@endsection
@section('script')
 <script type="text/javascript">
 	function loadSubCategory(id){
 		$('#loadSubCat').load('{{URL::to("brand")}}/'+id);

 	}
 </script>
@endsection