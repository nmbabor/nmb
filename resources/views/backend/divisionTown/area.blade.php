@extends('backend.app')
@section('content')


<h4 class="box_title"> Area of {{$division->name}}<a class="btn btn-success btn-xs pull-right" href="{{URL::to('division-town')}}">All Division/Town</a></h4>
	<div class="box-body col-md-11">
		{!! Form::open(array('route' => 'area.store','class'=>'form-horizontal','files'=>true)) !!}
		<div class="form-group {{ $errors->has('area_name') ? 'has-error' : '' }}">
			{{Form::label('area_name', 'Area Name* :', array('class' => 'col-md-3 control-label'))}}
			<div class="col-md-9">
			<input name="area_name" id="tagboxField" value="" type="hidden">
				<ul id="tagbox"></ul>
				<span>For white space, use underscore ( _ )</span>
				@if ($errors->has('area_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('area_name') }}</strong>
                    </span>
	            @endif
			</div>
			
		</div>
		{{Form::hidden('fk_division_id',$division->id)}}

		<div class="form-group">
			{{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}

			<div class="col-md-4">
				{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-9 col-md-offset-3">
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
					<th width="3%">SL</th>
					<th>Area Name</th>
					<th width="5%">Status</th>
					<th colspan="2" width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data1 as $data)
			<? $i++; ?>
				<tr>
					<td>{{$i}}</td>
					<td>{{$data->area_name}}</td>
					<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
					<td><a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a>
					<!-- Modal -->
<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit : {{$data->area_name}}</h4>
      </div>
        {!! Form::open(array('route' => ['area.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
      <div class="modal-body">
		<div class="form-group {{ $errors->has('area_name') ? 'has-error' : '' }}">
			{{Form::label('area_name', 'Name', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-8">
				{{Form::text('area_name',$data->area_name,array('class'=>'form-control','placeholder'=>'Area name','required'))}}
				@if ($errors->has('area_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('area_name') }}</strong>
                    </span>
	            @endif
			</div>
			
		</div>
		<div class="form-group">
			{{Form::label('status', 'Status', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-8">
				{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
			</div>
		</div>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{{Form::submit('Save changes',array('class'=>'btn btn-info'))}}
      </div>
		{!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

					</td>
					<td>
						{{Form::open(array('route'=>['area.destroy',$data->id],'method'=>'DELETE'))}}
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
