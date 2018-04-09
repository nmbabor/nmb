@extends('backend.app')
@section('content')


<h3 class="box_title"> Division/Town </h3>
	<div class="box-body col-md-11">
		{!! Form::open(array('route' => 'division-town.store','class'=>'form-horizontal','files'=>true)) !!}
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{{Form::label('name', 'Division/Town Name* :', array('class' => 'col-md-3 control-label'))}}
			<div class="col-md-9">
			<input name="name" id="tagboxField" value="" type="hidden">
				<ul id="tagbox"></ul>
				<span>For white space, use underscore ( _ )</span>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
	            @endif
			</div>
			
		</div>
		<div class="form-group">
			{{Form::label('type', 'Type* :', array('class' => 'col-md-3 control-label'))}}
			<div class="col-md-9">
				{{Form::select('type',['1'=>'Division','2'=>'Town'],'', ['class' => 'form-control','required','placeholder'=>'select type'])}}
			</div>
		</div>
		<div id="loadSubCat"><!-- Load Sub Category --></div>

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
	<div class="col-md-12">
		<table class="table table-striped table-hover table-bordered center_table" id="my_table">
			<thead>
				<tr>
					<th>SL</th>
					<th>Division/Town Name</th>
					<th>Status</th>
					<th>Type</th>
					<th>Area</th>
					<th colspan="2" width="5%">Action</th>
				</tr>
			</thead>
			<tbody>
			<? $i=1; ?>
			@foreach($allData as $data)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$data->name}}</td>
					<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
					
					<td>{{($data->type==1)? 'Division' : 'Town'}}</td>
					<td><a class="btn btn-success btn-xs" href='{{URL::to("area/$data->id")}}'>Area</a></td>
					<td><a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a>
					<!-- Modal -->
<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit : {{$data->name}}</h4>
      </div>
        {!! Form::open(array('route' => ['division-town.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
      <div class="modal-body">
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{{Form::label('name', 'Name', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-8">
				{{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Name','required'))}}
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
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
						{{Form::open(array('route'=>['division-town.destroy',$data->id],'method'=>'DELETE'))}}
            				<button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
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
