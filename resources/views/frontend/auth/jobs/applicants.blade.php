@extends('frontend.app')
@section('content')
<!-- myads-page -->
	<section id="main" class="clearfix myads-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>Job Post</li>
				</ol><!-- breadcrumb -->
			</div><!-- banner -->

			@include('frontend.profile.profileHeader')			
			
			<div class="ads-info">
				<div class="row">
					<div class="col-sm-3">
						<div class="recommended-cta all-applicants">					
							<div class="cta">
							<div class="col-md-12">
								<select class="form-control" id="filter" onchange='loadApplicatns(this.value+"/{{$link}}")'>
								<option value="all">Filter</option>
								@foreach($total as $tot)
									<option value="{{$tot->status}}" {{($status==$tot->status)?'selected':''}}>@if($tot->status==0)
									Unread
									@elseif($tot->status==3)
									View
									@elseif($tot->status==1)
									Short List
									@elseif($tot->status==2)
									Reject List
									@endif
									 ({{$tot->total}})</option>
								@endforeach
								</select>
								<h3 class="title">Applicants List</h3>
								{!! Form::open(array('url' => 'application-status','class'=>'form-horizontal', 'data-toggle'=>'validator','role'=>'form','method'=>'post')) !!}
								
								<div id="list-btn" style="display: none;">
									<div class="col-md-6 no-padding">
									<select class="form-control" name="status" required>
										<option value="1">Short List</option>
										<option value="2">Reject</option>
									</select>
									</div>
									<div class="col-md-6 no-padding-right">
									<button type="submit" class="btn btn-primary btn-sm">Submit</button>
										
									</div>
								</div>
								<hr>
							</div>
							<div class="col-md-12 no-padding">
								<ul class="applicants_list">
								@foreach($applicants as $keys => $applicant)
								<? $education=DB::table('cv_education')->leftJoin('cv_education_level','cv_education.exam_title','cv_education_level.id')->where('created_by',$applicant->fk_user_id)->get();
								 ?>
									<li class="{{(isset($id) and $id==$applicant->fk_user_id)?'active':''}} active{{$applicant->fk_user_id}}">
										<div class="col-md-2 no-padding-right">
											<input type="checkbox" class="form-control checkThis" name="id[]" value="{{$applicant->id}}">
										</div>
										<div class="col-md-10 no-padding-right applicant" onclick="loadCV({{$applicant->fk_user_id}},{{$ad->id}})">
											<h4>{{$applicant->name}}</h4>
											@if($applicant->experience!=null)
											<h5>Total Experience : {{$applicant->experience}} year(s)</h5>
											@endif
											@if(count($education)>0)
												<h5>
													@foreach($education as $key => $edu)
													{{($key>0)?',':''}} {{$edu->level_name}}
													@endforeach
												</h5>
											@endif
										</div>
									</li>
								@endforeach
								</ul>

							</div>
							{{Form::close()}}
							</div>
							
						</div><!-- cta -->
					</div><!-- recommended-cta-->		
					<div class="col-sm-9 no-padding-left">
						<div class=" section view-resume">
							<h2>Applicant Resume<br><small><a href='{{URL::to("ad-post/$ad->id/$ad->link")}}'  title="{{$ad->title}}">{{$ad->title}}</a></small></h2>
							<!-- ad-item -->
							<div class="all-info col-md-12">
								<? $all=0; ?>
							@foreach($total as $tot)
							<div class="col-md-2">
								<? $all+=$tot->total; ?>
							<h5>
								@if($tot->status==0)
								Unread
								@elseif($tot->status==3)
								View
								@elseif($tot->status==1)
								Short List
								@elseif($tot->status==2)
								Reject List
								@endif
								  : {{$tot->total}}
							</h5>
							</div>
							@endforeach
							<div class="col-md-2"><h5>Total : {{$all}}</h5></div>
							</div>
									<br>
							<div class="row" id="loadResume">
							@if(isset($data))
									<div class="user_resume col-md-12">
										<div class="col-md-9">
										<h1 class="title">{{$data->name}}</h1>
										<p>Address: {{$data->present_address}}</p>
										<p>Mobile Number: {{$data->mobile}}</p>
										<p>Email: {{$data->email}}</p>
										</div>
										<div class="col-md-3">
											<img src='{{asset("images/resume/$data->profile_photo")}}' alt="{{$data->name}}" class="img-responsive resume_profile_photo">
										</div>
									</div>
									<div class="primaryInformation resume  col-md-12 no-padding">
									<br>
									@if($data->career_objective!=null)
										<div class="panel panel-default">
										  <div class="panel-heading">Career Objectives :</div>
										  <div class="panel-body">
										  	<p>{{$data->career_objective}}</p>
										  </div>
										</div>
									@endif
									@if($data->special_qualification!=null)
										<div class="panel panel-default">
										  <div class="panel-heading">Special Qualification :</div>
										  <div class="panel-body">
										  	<p>{{$data->special_qualification}}</p>
										  </div>
										</div>
									@endif
									@if(count($employments)>0)
										<div class="panel panel-default">
										  <div class="panel-heading">Employment History :</div>
										  <div class="panel-body">
										  	<table class="table table-bordered">
										  		<thead>
										  			<tr>
										  				<th>Organization &amp; Location</th>
										  				<th>Designation</th>
										  				<th width="35%">Responsibilities</th>
										  				<th>Year of Experience</th>
										  			</tr>
										  		</thead>
										  		<tbody>
										  		@foreach($employments as $emp)
										  			<tr>
										  				<td>{{$emp->organization}}<br><small>{{$emp->location}}</small></td>
										  				<td>{{$emp->designation}}</td>
										  				<td>{{$emp->responsibilities}}</td>
										  				<td>{{$emp->experience}}  Year(s) <? echo ($emp->till_now==1)?' , <span class="text-success">Ongoing</span>':''?></td>
										  			</tr>
										  		@endforeach
										  		</tbody>
										  	</table>
										  </div>
										</div>
									@endif
									@if(count($educations)>0)
										<div class="panel panel-default">
										  <div class="panel-heading">Academic Qualification :</div>
										  <div class="panel-body">
										  	<table class="table table-bordered">
										  		<thead>
										  			<tr>
										  				<th>Exam Title</th>
										  				<th>Major/Subject</th>
										  				<th>Name of Institute</th>
										  				<th>Result</th>
										  				<th>Pass Year</th>
										  				<th>Duration</th>
										  			</tr>
										  		</thead>
										  		<tbody>
										  		@foreach($educations as $emp)
										  			<tr>
										  				<td>{{$emp->level_name}}</td>
										  				<td>{{$emp->subject}}</td>
										  				<td>{{$emp->institute}}</td>
										  				<td>{{$emp->result}}</td>
										  				<td>{{$emp->pass_year}}</td>
										  				<td>{{$emp->duration}}</td>
										  			</tr>
										  		@endforeach
										  		</tbody>
										  	</table>
										  </div>
										</div>
									@endif
									@if(count($trainings)>0)
										<div class="panel panel-default">
										  <div class="panel-heading">Training Professional  Summary :</div>
										  <div class="panel-body">
										  	<table class="table table-bordered">
										  		<thead>
										  			<tr>
										  				<th>Course Title</th>
										  				<th>Course Topic</th>
										  				<th>Name of Institute</th>
										  				<th>Location</th>
										  				<th>Year</th>
										  				<th>Duration</th>
										  			</tr>
										  		</thead>
										  		<tbody>
										  		@foreach($trainings as $emp)
										  			<tr>
										  				<td>{{$emp->course_title}}</td>
										  				<td>{{$emp->course_topic}}</td>
										  				<td>{{$emp->organization}}</td>
										  				<td>{{$emp->location}}</td>
										  				<td>{{$emp->year}}</td>
										  				<td>{{$emp->duration}}</td>
										  			</tr>
										  		@endforeach
										  		</tbody>
										  	</table>
										  </div>
										</div>
									@endif
									@if(count($languages)>0)
										<div class="panel panel-default">
										  <div class="panel-heading">Language Proficiency :</div>
										  <div class="panel-body">
										  	<table class="table table-bordered">
										  		<thead>
										  			<tr>
										  				<th>Language</th>
										  				<th>Reading</th>
										  				<th>Writing</th>
										  				<th>Speaking</th>
										  				
										  			</tr>
										  		</thead>
										  		<tbody>
										  		@foreach($languages as $emp)
										  			<tr>
										  				<td>{{$emp->language_name}}</td>
										  				<td>{{$emp->reading}}</td>
										  				<td>{{$emp->writing}}</td>
										  				<td>{{$emp->speaking}}</td>
										  			</tr>
										  		@endforeach
										  		</tbody>
										  	</table>
										  </div>
										</div>
									@endif

										<div class="panel panel-default">
										  <div class="panel-heading">Personal Details :</div>
										  <div class="panel-body">
										   <ul>
										   	<li>
										
												<div class="col-md-6">Father's Name	</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->fathers_name}}</div>
											</li>
											<li>	
										
												<div class="col-md-6">Mother's Name	</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->mothers_name}}</div>
											</li>
											<li>
										
												<div class="col-md-6">Date of Birth	</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->date_of_birth}}</div>
											</li>
											<li>
										
												<div class="col-md-6">Gender			</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->gender}}</div>
											</li>
											<li>
										
												<div class="col-md-6">National Id No.	</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->national_id}}</div>
											</li>
											<li>
										
												<div class="col-md-6">Religion		</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->religion}}</div>
											</li>
											<li>
										
												<div class="col-md-6">Permanent Address</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->permanent_address}}</div>
											</li>
											<li>
												<div class="col-md-6">Current Location</div>
												<div class="col-md-6"> : &nbsp;&nbsp;&nbsp;{{$data->present_address}}</div>
										   	</li>
										   </ul>
										  </div>
										</div>
									</div>
							@endif
							</div><!-- ad-item -->
						</div>
					</div><!-- my-ads -->

					<!-- recommended-cta-->
								
					
				</div><!-- row -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- myads-page -->
@endsection
@section('scripts')
<script type="text/javascript">
	function loadCV(id,post){
		var path='{{Request::path()}}';
		var url='{{URL::to("")}}/'+path+'?id='+id;
		history.pushState(null, '', url);
		$('#loadResume').load('{{URL::to("loadResume")}}/'+id+'/'+post);
		$('.applicants_list li').removeClass('active');
		$('.active'+id).addClass('active');
	}
	function loadApplicatns(link){
		var url='{{URL::to("applicants")}}/'+link;
		window.location=url;
	}
	$('.checkThis').on('click',function(){
		var n = $( "input:checked" ).length;
		if(n == 0){
		    $("#list-btn:visible").fadeOut(); //if there are none checked, hide only visible elements
		  } else {
		    $("#list-btn:hidden").fadeIn(); //otherwise (some are selected) fadeIn - if the div is hidden.
		  }
	});

	//$( "input[type=checkbox]" ).on( "click", countChecked );
</script>
@endsection