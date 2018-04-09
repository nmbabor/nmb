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
								    <h3 class="panel-title">Language Proficiency {{$i}} <span class="pull-right"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$i}}"><i class="fa fa-pencil-square"></i> Edit</button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal{{$i}}"><i class="fa fa-trash"></i> Delete</button> </span></h3>
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
								        <input type="hidden" name="form" value="language">
								        <input type="hidden" name="id" value="{{$data->id}}">
								        <h4 class="text-centers">Language Proficiency {{$i}}</h4>
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
										    <div class="col-md-4"><b>Language :</b></div>
										    <div class="col-md-8">{{$data->language_name}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Reading :</b></div>
										    <div class="col-md-8">{{$data->reading}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Writing :</b></div>
										    <div class="col-md-8">{{$data->writing}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>speaking :</b></div>
										    <div class="col-md-8">{{$data->speaking}}</div>
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
							        <h4 class="modal-title" id="myModalLabel">Language Proficiency {{$i}}</h4>
							      </div>
									{!! Form::open(array('url' =>'resume-language','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
							      <div class="modal-body">
							        <input type="hidden" name="form" value="update">
							        <input type="hidden" name="id" value="{{$data->id}}">
								<div class="form-group{{ $errors->has('language_name') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Language</label>
									<div class="col-sm-9">
										{{Form::select('language_name',['Bangla'=>'Bangla','English'=>'English'],$data->language_name,['class'=>'form-control','placeholder'=>'select','required'])}}
										<div class="help-block with-errors"></div>
										 @if ($errors->has('language_name'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('language_name') }}</strong>
						                    </span>
						                @endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('reading') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Reading</label>
									<div class="col-sm-9">
									{{Form::select('reading',['High'=>'High','Medium'=>'Medium','Low'=>'Low'],$data->reading,['class'=>'form-control','placeholder'=>'select','required'])}}
										<div class="help-block with-errors"></div>
										 @if ($errors->has('reading'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('reading') }}</strong>
						                    </span>
						                @endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('writing') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">Writing</label>
									<div class="col-sm-9">
										{{Form::select('writing',['High'=>'High','Medium'=>'Medium','Low'=>'Low'],$data->writing,['class'=>'form-control','placeholder'=>'select','required'])}}
										<div class="help-block with-errors"></div>
										 @if ($errors->has('writing'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('writing') }}</strong>
						                    </span>
						                @endif
						               
									</div>
									
								</div>
								<div class="form-group{{ $errors->has('speaking') ? ' has-error' : '' }}">
									<label class="col-sm-3 control-label">speaking</label>
									<div class="col-sm-9">
										{{Form::select('speaking',['High'=>'High','Medium'=>'Medium','Low'=>'Low'],$data->speaking,['class'=>'form-control','placeholder'=>'select','required'])}}
										<div class="help-block with-errors"></div>
										 @if ($errors->has('speaking'))
						                    <span class="help-block">
						                        <strong>{{ $errors->first('speaking') }}</strong>
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
							<button class="btn btn-info" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus-circle"></i> Add Language Proficiency</button>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Language Proficiency</h4>
      </div>
		{!! Form::open(array('url' =>'resume-language','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
      <div class="modal-body">
      <input type="hidden" name="form" value="create">
      	<div class="form-group{{ $errors->has('language_name') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Language</label>
			<div class="col-sm-9">
				{{Form::select('language_name',['Bangla'=>'Bangla','English'=>'English'],'',['class'=>'form-control','placeholder'=>'select','required'])}}
				<div class="help-block with-errors"></div>
				 @if ($errors->has('language_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('language_name') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('reading') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Reading</label>
			<div class="col-sm-9">
			{{Form::select('reading',['High'=>'High','Medium'=>'Medium','Low'=>'Low'],'',['class'=>'form-control','placeholder'=>'select','required'])}}
				<div class="help-block with-errors"></div>
				 @if ($errors->has('reading'))
                    <span class="help-block">
                        <strong>{{ $errors->first('reading') }}</strong>
                    </span>
                @endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('writing') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">Writing</label>
			<div class="col-sm-9">
				{{Form::select('writing',['High'=>'High','Medium'=>'Medium','Low'=>'Low'],'',['class'=>'form-control','placeholder'=>'select','required'])}}
				<div class="help-block with-errors"></div>
				 @if ($errors->has('writing'))
                    <span class="help-block">
                        <strong>{{ $errors->first('writing') }}</strong>
                    </span>
                @endif
               
			</div>
			
		</div>
		<div class="form-group{{ $errors->has('speaking') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label">speaking</label>
			<div class="col-sm-9">
				{{Form::select('speaking',['High'=>'High','Medium'=>'Medium','Low'=>'Low'],'',['class'=>'form-control','placeholder'=>'select','required'])}}
				<div class="help-block with-errors"></div>
				 @if ($errors->has('speaking'))
                    <span class="help-block">
                        <strong>{{ $errors->first('speaking') }}</strong>
                    </span>
                @endif
               
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
