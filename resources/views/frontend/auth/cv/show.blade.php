@extends('frontend.app')
@section('content')
<section id="main" class="clearfix  ad-profile-page">
	<div class="container">
	
		<div class="breadcrumb-section">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li>Resume</li>
			</ol><!-- breadcrumb -->						
		</div><!-- banner -->
			@include('frontend.profile.profileHeader')			
		

		<div class="profile">
			<div class="row">
				<div class="col-sm-10">
					<div class="business-section">
						<!-- profile-details -->
						<div class="profile-details section">
							<div class="business-profile">
								<div class="business-details">
									<div class="user_resume col-md-12">
										<h1 class="page-title">View Resume <span class="pull-right"><a href='{{URL::to("resume/edit")}}' class="bnt btn-sm btn-info"><i class="fa fa-pencil-square"></i> Edit</a></span></h1>
										<hr>
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
								</div>
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
@endsection
@section('scripts')
	<script type="text/javascript">
		function loadSubCat(id){
			$('#loadSubCategory').load('{{URL::to("loadSubCategory")}}/'+id);
		}
	</script>

	<script type="text/javascript">
		
	function deleteConfirm(id){
		$('#adDelete'+id).css('display','block');
		$('#adPostInfo'+id).css('display','none');
	}
	function deleteCancel(id){
		$('#adDelete'+id).css('display','none');
		$('#adPostInfo'+id).css('display','block');
	}
	</script>
@endsection