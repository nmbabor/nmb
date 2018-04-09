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
								    <h3 class="panel-title">Academic Qualification {{$i}} <span class="pull-right"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$i}}"><i class="fa fa-pencil-square"></i> Edit</button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal{{$i}}"><i class="fa fa-trash"></i> Delete</button> </span></h3>
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
								        <input type="hidden" name="form" value="education">
								        <input type="hidden" name="id" value="{{$data->id}}">
								        <h4 class="text-centers">Academic Qualification {{$i}}</h4>
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
										    <div class="col-md-4"><b>Level of education :</b></div>
										    <div class="col-md-8">{{$data->level_name}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Major/Group/Subject :</b></div>
										    <div class="col-md-8">{{$data->subject}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Name of Institute :</b></div>
										    <div class="col-md-8">{{$data->institute}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Result :</b></div>
										    <div class="col-md-8">{{$data->result}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Pass Year :</b></div>
										    <div class="col-md-8">{{$data->pass_year}}</div>
								  		</li>
								  		<li>
										    <div class="col-md-4"><b>Duration Year :</b></div>
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
							        <h4 class="modal-title" id="myModalLabel">Academic Qualification {{$i}}</h4>
							      </div>
							        {!! Form::open(array('url' =>'resume-education','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
							      <div class="modal-body">
							        <input type="hidden" name="form" value="update">
							        <input type="hidden" name="id" value="{{$data->id}}">
									<div class="form-group{{ $errors->has('exam_title') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Level of Education</label>
										<div class="col-sm-9">
										<? $exam_title=isset($data->exam_title)?$data->exam_title:''; ?>
											{{Form::select('exam_title',$levels,$exam_title,['class'=>'form-control','placeholder'=>'Select','required'])}}
											<div class="help-block with-errors"></div>
											 @if ($errors->has('exam_title'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('exam_title') }}</strong>
				                                </span>
				                            @endif
				                           
										</div>
										
									</div>
									<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Group/Mejor/Subject</label>
										<div class="col-sm-9">
										<? $subject=isset($data->subject)?$data->subject:''; ?>
											<input name="subject" type="text" class="form-control" value="{{$subject}}" required>
											<div class="help-block with-errors"></div>
											 @if ($errors->has('subject'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('subject') }}</strong>
				                                </span>
				                            @endif
				                           
										</div>
										
									</div>
									<div class="form-group{{ $errors->has('institute') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Institute</label>
										<div class="col-sm-9">
										<? $institute=isset($data->institute)?$data->institute:''; ?>
											<input name="institute" type="text" class="form-control" value="{{$institute}}" placeholder="Institute" required>
											<div class="help-block with-errors"></div>
											 @if ($errors->has('institute'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('institute') }}</strong>
				                                </span>
				                            @endif
				                           
										</div>
										
									</div>
									<div class="form-group{{ $errors->has('result') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Result</label>
										<div class="col-sm-9">
										<? $result=isset($data->result)?$data->result:''; ?>
											<input name="result" type="text" class="form-control" value="{{$result}}" placeholder="Result" required>
											<div class="help-block with-errors"></div>
											 @if ($errors->has('result'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('result') }}</strong>
				                                </span>
				                            @endif
										</div>
									</div>
									<div class="form-group{{ $errors->has('pass_year') ? ' has-error' : '' }}">
										<label class="col-sm-3 control-label">Pass Year &amp; Duration</label>
										<div class="col-sm-5">
										<? $pass_year=isset($data->pass_year)?$data->pass_year:'2010'; ?>
											<input name="pass_year" type="number" min="1965" class="form-control" value="{{$pass_year}}" placeholder="Pass Year" required>
											<span>Pass Year</span>
											<div class="help-block with-errors"></div>
											 @if ($errors->has('pass_year'))
				                                <span class="help-block">
				                                    <strong>{{ $errors->first('pass_year') }}</strong>
				                                </span>
				                            @endif
										</div>
										<div class="col-sm-4">
										<? $duration=isset($data->duration)?$data->duration:'1'; ?>
											<input name="duration" type="number" min="1" class="form-control" value="{{$duration}}" placeholder="Duration" required>
											<span>Duration Year</span>
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
							<button class="btn btn-info" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus-circle"></i> Add Education</button>
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
        <h4 class="modal-title" id="myModalLabel">Academic Qualification</h4>
      </div>
        {!! Form::open(array('url' =>'resume-education','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'POST','files'=>'true')) !!}
      <div class="modal-body">
				<div class="form-group{{ $errors->has('exam_title') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Level of Education</label>
					<div class="col-sm-9">
					<input type="hidden" name="form" value="create">
						{{Form::select('exam_title',$levels,'',['class'=>'form-control','placeholder'=>'Select','required'])}}
						<div class="help-block with-errors"></div>
						 @if ($errors->has('exam_title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('exam_title') }}</strong>
                            </span>
                        @endif
                       
					</div>
					
				</div>
				<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Group/Mejor/Subject</label>
					<div class="col-sm-9">
						<input name="subject" type="text" class="form-control" value="" required>
						<div class="help-block with-errors"></div>
						 @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                       
					</div>
					
				</div>
				<div class="form-group{{ $errors->has('institute') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Institute</label>
					<div class="col-sm-9">
						<input name="institute" type="text" class="form-control" value="" placeholder="Institute" required>
						<div class="help-block with-errors"></div>
						 @if ($errors->has('institute'))
                            <span class="help-block">
                                <strong>{{ $errors->first('institute') }}</strong>
                            </span>
                        @endif
                       
					</div>
					
				</div>
				<div class="form-group{{ $errors->has('result') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Result</label>
					<div class="col-sm-9">
						<input name="result" type="text" class="form-control" value="" placeholder="Result" required>
						<div class="help-block with-errors"></div>
						 @if ($errors->has('result'))
                            <span class="help-block">
                                <strong>{{ $errors->first('result') }}</strong>
                            </span>
                        @endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('pass_year') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Pass Year &amp; Duration</label>
					<div class="col-sm-5">
						<input name="pass_year" type="number" min="1965" class="form-control" value="2010" placeholder="Pass Year" required>
						<span>Pass Year</span>
						<div class="help-block with-errors"></div>
						 @if ($errors->has('pass_year'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pass_year') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="col-sm-4">
						<input name="duration" type="number" min="1" class="form-control" value="1" placeholder="Duration" required>
						<span>Duration Year</span>
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
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
			{{Form::close()}}
    </div>
  </div>
</div>

@endsection
