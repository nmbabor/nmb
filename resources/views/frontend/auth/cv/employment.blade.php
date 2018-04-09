@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>Edit Resume</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->
			@include('frontend.profile.profileHeader')			
		

		<div class="profile">
			<div class="row">
				
				
				<div class="col-sm-10">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
							<div class="updateHeader">
								@include('frontend.auth.cv.updateHeader')
							</div>
							<!-- form -->
						<? $i=0; ?>
						@foreach($allData as $data)
						<? $i++; ?>
							<div class="resume-form">
								<div class="panel panel-default">
								  <div class="panel-heading">
								    <h3 class="panel-title">Employment History {{$i}} <span class="pull-right"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$i}}"><i class="fa fa-pencil-square"></i> Edit</button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal{{$i}}"><i class="fa fa-trash"></i> Delete</button> </span></h3>
								  </div>
								  <!-- Modal -->
								<div class="modal fade" id="deleteModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								    <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete ? </h4>
								      </div>
										{!! Form::open(array('url' =>'resume-delete','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
								      <div class="modal-body ">
								        <input type="hidden" name="form" value="employment">
								        <input type="hidden" name="id" value="{{$data->id}}">
								        <h4 class="text-centers">Employment History {{$i}}</h4>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
								        <button type="submit" class="btn btn-primary">Confirm</button>
								      </div>
									{{Form::close()}}
								    </div>
								  </div>
								</div><!-- /Delete Modal -->
								  <div class="panel-body education_list">
								  	<ul>
								  		<li>
										    <div class="col-md-4"><b>Name of Organization :</b></div>
										    <div class="col-md-8">{{$data->organization}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Location :</b></div>
										    <div class="col-md-8">{{$data->location}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Designation :</b></div>
										    <div class="col-md-8">{{$data->designation}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Responsibilities :</b></div>
										    <div class="col-md-8">{{$data->responsibilities}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Year of Experience :</b></div>
										    <div class="col-md-8">{{$data->experience}} Year(s) <? echo ($data->till_now==1)?' , <span class="text-success">Ongoing</span>':''?></div>
								  		</li>
								  	</ul>
								  </div>
								</div>
						

							<!-- Modal -->
							<div class="modal fade" id="editModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog modal-lg" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Employment History {{$i}}</h4>
							      </div>
									{!! Form::open(array('url' =>'resume-employment','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
							      <div class="modal-body">
							        <input type="hidden" name="form" value="update">
							        <input type="hidden" name="id" value="{{$data->id}}">
								<div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Name of Organization</label>
									<div class="col-sm-9">
									<? $organization=isset($data->organization)?$data->organization:''; ?>
										<input name="organization" type="text" class="form-control" value="{{$organization}}" placeholder="Name of Organization" required>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('organization'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('organization') }}</strong>
			                                </span>
			                            @endif
			                           
									</div>
									
								</div>
								<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Location</label>
									<div class="col-sm-9">
									<? $location=isset($data->location)?$data->location:''; ?>
										<input name="location" type="text" class="form-control" value="{{$location}}" placeholder="Location" required>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('location'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('location') }}</strong>
			                                </span>
			                            @endif
			                           
									</div>
									
								</div>
								<div class="form-group{{ $errors->has('designation') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Designation</label>
									<div class="col-sm-9">
									<? $designation=isset($data->designation)?$data->designation:''; ?>
										<input name="designation" type="text" class="form-control" value="{{$designation}}" placeholder="Designation" required>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('designation'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('designation') }}</strong>
			                                </span>
			                            @endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('responsibilities') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Responsibilities</label>
									<div class="col-sm-9">
									<? $responsibilities=isset($data->responsibilities)?$data->responsibilities:''; ?>
									<textarea  name="responsibilities" class="form-control" placeholder="Responsibilities" rows='4'>{{$responsibilities}}</textarea>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('responsibilities'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('responsibilities') }}</strong>
			                                </span>
			                            @endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Year of Experience</label>
									<div class="col-sm-5">
									<? $experience=isset($data->experience)?$data->experience:'0'; ?>
										<input name="experience" type="number" step="any" min="0.1" class="form-control" value="{{$experience}}" placeholder="Experience" required>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('experience'))
			                                <span class="help-block">
			                                    <strong>{{ $errors->first('experience') }}</strong>
			                                </span>
			                            @endif
									</div>
									<div class="col-sm-4">
									
										<label><input type="checkbox" name="till_now" value="1" {{(isset($data->till_now) and $data->till_now==1)?'checked':''}}> Is Ongoing</label>
									</div>
								</div>
						
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        <button type="submit" class="btn btn-primary">Save changes</button>
							      </div>
								{{Form::close()}}
							    </div>
							  </div>
							</div><!-- /Modal -->
						</div><!-- /.. -->
					@endforeach

						<div class="col-md-12 text-center">
						<hr>
							<button class="btn btn-info" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus-circle"></i> Add Employment History</button>
						</div>
						</div><!-- profile-details -->
					</div><!-- user-pro-edit -->
				</div><!-- profile -->
				<div class="col-sm-2 no-padding-left">
					@include('frontend._partials.support')
				</div>
			</div><!-- row -->	
		</div>				
	</div><!-- container -->
</section><!-- ad-profile-page -->
<!-- Add new Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Employment History</h4>
      </div>
		{!! Form::open(array('url' =>'resume-employment','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
      <div class="modal-body">
      <input type="hidden" name="form" value="create">
		<div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Name of Organization</label>
			<div class="col-sm-9">
				<input name="organization" type="text" class="form-control" value="" placeholder="Name of Organization" required>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('organization'))
                    <span class="help-block">
                        <strong>{{ $errors->first('organization') }}</strong>
                    </span>
                @endif
               
			</div>
			
		</div>
		<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Location</label>
			<div class="col-sm-9">
				<input name="location" type="text" class="form-control" value="" placeholder="Location" required>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('location'))
                    <span class="help-block">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                @endif
               
			</div>
			
		</div>
		<div class="form-group{{ $errors->has('designation') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Designation</label>
			<div class="col-sm-9">
				<input name="designation" type="text" class="form-control" value="" placeholder="Designation" required>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('designation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('designation') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('responsibilities') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Responsibilities</label>
			<div class="col-sm-9">
			<textarea  name="responsibilities" class="form-control" placeholder="Responsibilities" rows='4'></textarea>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('responsibilities'))
                    <span class="help-block">
                        <strong>{{ $errors->first('responsibilities') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Year of Experience</label>
			<div class="col-sm-5">
				<input name="experience" type="number" step="any" min="0.1" class="form-control" value="" placeholder="Experience" required>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('experience'))
                    <span class="help-block">
                        <strong>{{ $errors->first('experience') }}</strong>
                    </span>
                @endif
			</div>
			<div class="col-sm-4">
			
				<label><input type="checkbox" name="till_now" value="1"> Is Ongoing</label>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
			{{Form::close()}}
    </div>
  </div>
</div>

@endsection
