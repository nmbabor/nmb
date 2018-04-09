@extends('backend.app')
@section('content')

<div class="tab_content">

  <h4 class="box_title work_title">
 {{$data->eshop_name}}
 <a href='{{url("manage-eshop")}}' class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All</a></h4>
 	<div class="business-section col-md-12">
		<!-- profile-details -->
		<div class="profile-details section">
			<!-- form -->
			{!! Form::open(array('route' => ['manage-eshop.update',$data->id],'class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'PUT','files'=>'true')) !!}
			<div class="form-group">
				<label class="col-sm-3 control-label">Email &amp; Mobile</label>
				<div class="col-sm-5">
					<div class="form-control">{{$data->email}}
					@if($data->email_verified==1)
					<span class="verified pull-right"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
					@else
					<a href="#" class="pull-right text-danger" title="Not Verified !"><i class="fa fa-info-circle"></i></a>
					@endif
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-control">{{$data->mobile}} 
					@if($data->mobile_verified==1)
					<span class="verified pull-right"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
					@else
					<a href="#" class="pull-right text-danger" title="Not Verified !"><i class="fa fa-info-circle"></i></a>
					@endif
					</div>
				</div>
				 
			</div>
			<div class="form-group{{ $errors->has('subdomain') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">SubDomain</label>
				<div class="col-sm-9">
				    <div class="input-group">
				    <input type="text" name="subdomain" class="form-control" placeholder="Your Subdomain" required pattern="[^', _/%+=)(^!@#$&{}\x22]+" value="{{$data->subdomain}}" title="Do no use special character. ">
				      <div class="input-group-addon">.tradebangla.com.bd </div>
				    </div>
					
					<div class="help-block with-errors"></div>
					 @if ($errors->has('subdomain'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subdomain') }}</strong>
                        </span>
                    @endif
                   
				</div>
				
			</div>

			<div class="form-group{{ $errors->has('eshop_name') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">Eshop Name</label>
				<div class="col-sm-9">
					
					<input name="eshop_name" type="text" class="form-control" placeholder="Ex: Smart Software" value="{{$data->eshop_name}}" required>
					<div class="help-block with-errors"></div>
					 @if ($errors->has('eshop_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('eshop_name') }}</strong>
                        </span>
                    @endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">Title</label>
				<div class="col-sm-9">
					
					<input name="title" type="text" class="form-control" placeholder="Ex: Best Software Solution" value="{{$data->title}}" required>
					<div class="help-block with-errors"></div>
					 @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">Address</label>
				<div class="col-sm-9">
					
					<input name="location" type="text" class="form-control" placeholder="Address" value="{{$data->location}}" required>
					<div class="help-block with-errors"></div>
					 @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
				</div>
				
			</div>

			<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">About Organization</label>
				<div class="col-sm-9">
					<? $description=(isset($data->description))?$data->description:''; ?>
					{{Form::textArea('description',$description,['class'=>'form-control textarea','placeholder'=>'About Organization','required'])}}
					<div class="help-block with-errors"></div>
					 @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('db_name') ? ' has-error' : '' }}">
			    <label class="col-sm-3 control-label">Data Base Name</label>
			    <div class="col-sm-5">
			      <input type="text" name="db_name" class="form-control" id="exampleInputAmount" placeholder="Data Base Name" value="{{$data->db_name}}">
			    </div>
			    @if ($errors->has('db_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('db_name') }}</strong>
                        </span>
                    @endif
			   
			 </div>
			@if($data->is_approved==1)
			 <div class="form-group">
			    <label class="col-sm-3 control-label">Site Link</label>
			    <div class="col-sm-5">
			      <a target="_blank" href='http://{{$data->subdomain}}.tradebangla.com.bd' class="btn btn-xs btn-info">{{$data->subdomain}}.tradebangla.com.bd</a>
			    </div>
			   
			 </div>
			@endif


			<div class="form-group ">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-9">
				<button type="submit" class="business-btn btn btn-success">Save Change</button>
				@if($data->is_approved!=1)
				<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"> <i class="fa fa-check"></i> Approve</button>
			        @else
			        <a href='{{URL::to("manage-eshop/create?is_approved=3&id=$data->id")}}' class="btn btn-danger pull-right" id="submit">Deny</a>
			        @endif
				</div>
			</div>
		{{Form::close()}}				
		</div><!-- profile-details -->
	</div><!-- user-pro-edit -->
 </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create SubDomain and approve</h4>
      </div>
     {!! Form::open(array('route' =>'manage-eshop.store','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST')) !!}
      <div class="modal-body">
        <div class="form-group">
		    <label class="col-sm-3 control-label">SubDomain</label>
		    <div class="col-sm-9">
		      <input type="text" name="subdomain" class="form-control" placeholder="SubDomain" value="{{$data->subdomain}}">
		    </div>
		 </div>
		 <input type="hidden" name="id" value="{{$data->id}}">
		 <div class="form-group">
		    <label class="col-sm-3 control-label">Data Base Name</label>
		    <div class="col-sm-9">
		      <input type="text" name="db_name" class="form-control" id="exampleInputAmount" placeholder="Data Base Name" value="{{$data->db_name}}">
		    </div>
		 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create and approve</button>
      </div>
      {{Form::close()}}	
    </div>
  </div>
</div>
					
				
@endsection
@section('script')
	<script type="text/javascript">
		function loadSubCat(id){
			$('#loadSubCategory').load('{{URL::to("loadSubCategory")}}/'+id);
		}
	</script>
<script src="{{asset('public/frontend/js/validator.js')}}"></script>
<script type="text/javascript">
    function loadArea(id){
        $('#loadArea').load('{{URL::to("loadArea")}}/'+id);
    }

    function loadPhoto(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).css('display','block');
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection