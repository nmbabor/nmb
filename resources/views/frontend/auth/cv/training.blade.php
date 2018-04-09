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
								    <h3 class="panel-title">Training Professional  Summary {{$i}} <span class="pull-right"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$i}}"><i class="fa fa-pencil-square"></i> Edit</button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal{{$i}}"><i class="fa fa-trash"></i> Delete</button> </span></h3>
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
								        <input type="hidden" name="form" value="training">
								        <input type="hidden" name="id" value="{{$data->id}}">
								        <h4 class="text-centers">Training Professional  Summary {{$i}}</h4>
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
										    <div class="col-md-4"><b>Course title :</b></div>
										    <div class="col-md-8">{{$data->course_title}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Course topic :</b></div>
										    <div class="col-md-8">{{$data->course_topic}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Name of Organization :</b></div>
										    <div class="col-md-8">{{$data->organization}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Location :</b></div>
										    <div class="col-md-8">{{$data->location}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Year :</b></div>
										    <div class="col-md-8">{{$data->year}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Duration :</b></div>
										    <div class="col-md-8">{{$data->duration}}</div>
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
							        <h4 class="modal-title" id="myModalLabel">Training Professional  Summary {{$i}}</h4>
							      </div>
									{!! Form::open(array('url' =>'resume-training','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
							      <div class="modal-body">
							        <input type="hidden" name="form" value="update">
							        <input type="hidden" name="id" value="{{$data->id}}">
								<div class="form-group{{ $errors->has('course_title') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Course title</label>
									<div class="col-sm-9">
										<input name="course_title" type="text" class="form-control" value="{{$data->course_title}}" placeholder="Course title" required>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('course_title'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('course_title') }}</strong>
						                    </span>
						                @endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('course_topic') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Course topic</label>
									<div class="col-sm-9">
									<textarea  name="course_topic" class="form-control" placeholder="Cuorse topic" rows='3'>{{$data->course_topic}}</textarea>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('course_topic'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('course_topic') }}</strong>
						                    </span>
						                @endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Name of Organization</label>
									<div class="col-sm-9">
										<input name="organization" type="text" class="form-control" value="{{$data->organization}}" placeholder="Name of Organization" required>
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
										<input name="location" type="text" class="form-control" value="{{$data->location}}" placeholder="Location" required>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('location'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('location') }}</strong>
						                    </span>
						                @endif
						               
									</div>
									
								</div>
								
								<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Year</label>
									<div class="col-sm-5">
										<input name="year" type="number" step="any" min="1965" class="form-control" value="{{$data->year}}" placeholder="year" required>
										<div class="help-block with-errors"></div>
										 @if ($errors->has('year'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('year') }}</strong>
						                    </span>
						                @endif
									</div>
									<div class="col-sm-4">
										<input name="duration" type="text" class="form-control" placeholder="Duration" value="{{$data->duration}}">
										<div class="help-block with-errors"></div>
										@if ($errors->has('duration'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('duration') }}</strong>
						                    </span>
						                @endif
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
							<button class="btn btn-info" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus-circle"></i> Add Training Professional  Summary</button>
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
        <h4 class="modal-title" id="myModalLabel">Training Professional  Summary</h4>
      </div>
		{!! Form::open(array('url' =>'resume-training','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
      <div class="modal-body">
      <input type="hidden" name="form" value="create">
      	<div class="form-group{{ $errors->has('course_title') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Course title</label>
			<div class="col-sm-9">
				<input name="course_title" type="text" class="form-control" value="" placeholder="Course title" required>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('course_title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('course_title') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('course_topic') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Course topic</label>
			<div class="col-sm-9">
			<textarea  name="course_topic" class="form-control" placeholder="Cuorse topic" rows='3'></textarea>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('course_topic'))
                    <span class="help-block">
                        <strong>{{ $errors->first('course_topic') }}</strong>
                    </span>
                @endif
			</div>
		</div>
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
		
		<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Year</label>
			<div class="col-sm-5">
				<input name="year" type="number" step="any" min="1965" class="form-control" value="2010" placeholder="year" required>
				<div class="help-block with-errors"></div>
				 @if ($errors->has('year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                @endif
			</div>
			<div class="col-sm-4">
				<input name="duration" type="text" class="form-control" placeholder="Duration">
				<div class="help-block with-errors"></div>
				@if ($errors->has('duration'))
                    <span class="help-block">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                @endif
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
</div>

@endsection
