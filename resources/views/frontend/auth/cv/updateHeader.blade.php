
<? $url=Request::path(); ?>
<div class="col-md-12">
	<h1 class="page-title"><i class="fa fa-pencil"></i> Edit Resume <a href="{{URL::to('resume')}}" class="btn btn-info btn-sm pull-right">View Resume</a></h1>	
	<hr>
</div>
<ul class="nav nav-tabs">
    <li class="{{($url=='resume/edit')?'active':''}}"><a href='{{URL::to("resume/edit")}}' ><i class="fa fa-user"></i> Personal</a></li>

    <li class="{{($url=='resume/objective/edit')?'active':''}}"><a href='{{URL::to("resume/objective/edit")}}'><i class="fa fa-cog" aria-hidden="true"></i> Objectives</a></li>

    <li class="{{($url=='resume-education')?'active':''}}"><a href='{{URL::to("resume-education")}}'><i class="fa fa-graduation-cap" aria-hidden="true"></i> Education</a></li>

    <li class="{{($url=='resume-employment')?'active':''}}"><a href='{{URL::to("resume-employment")}}' ><i class="fa fa-briefcase" aria-hidden="true"></i> Employment</a></li>

    <li class="{{($url=='resume-training')?'active':''}}"><a href='{{URL::to("resume-training")}}' ><i class="fa fa-laptop" aria-hidden="true"></i> Training</a></li>

    <li class="{{($url=='resume-language')?'active':''}}"><a href='{{URL::to("resume-language")}}' ><i class="fa fa-cogs" aria-hidden="true"></i> Language</a></li>
 </ul>