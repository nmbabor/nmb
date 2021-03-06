@extends('backend.app')
@section('content')

<!--mini statistics start-->
<div class="row">
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon orange"><i class="fa fa-gavel"></i></span>
            <div class="mini-stat-info">
                <span><? echo $allData['total_service'] ?></span>
                Total Page
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon tar"><i class="fa fa-tag"></i></span>
            <div class="mini-stat-info">
                <span><? echo $allData['total_work'] ?></span>
               Total Work
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
            <div class="mini-stat-info">
                <span><? echo $allData['total_news'] ?></span>
                Total News
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
            <div class="mini-stat-info">
                <span><? echo $allData['total_blog'] ?></span>
                Total Blog
            </div>
        </div>
    </div>
</div>
<!--mini statistics end-->
<div class="row">
    <div class="col-md-6">
        <!--notification start-->
        <section class="panel">
            <header class="panel-heading">
                Recent Page <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-cog"></a>
                <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
            <? foreach ($allData['service'] as $service) {?>
               
                <div class="alert alert-info clearfix">
                    <span class="alert-icon"><i class="fa fa-dot-circle-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender"><span><a href='{{URL::to("service/$service->id")}}'>{{$service->name}}</a></span> </li>
                            <li class="pull-right notification-time"><a href='{{URL::to("service/$service->id/edit")}}'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                        </ul>
                        <p>
                            {{$service->title}}
                        </p>
                    </div>
                </div>
           <? } ?>
            </div>
        </section>
        <!--notification end-->
    </div>
    <div class="col-md-6">
        <!--todolist start-->
        <section class="panel">
            <header class="panel-heading">
                Recent Works <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-cog"></a>
                <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
                <ul class="to-do-list" id="sortable-todo">
                @foreach($allData['work'] as $work)
                    <li class="clearfix">
                        <span class="drag-marker">
                        <i></i>
                        </span>
                        <div class="todo-check pull-left">
                            <input type="checkbox" value="None" id="todo-checks"/>
                            <label for="todo-check"></label>
                        </div>
                        <p class="todo-title">{{$work->title}}</p>
                        <div class="todo-actionlist pull-right clearfix">
                            <a href='{{URL::to("works/$work->id/edit")}}' class="todo-edit"><i class="ico-pencil"></i></a>
                        </div>
                    </li>
                @endforeach
                </ul>
                <div class="todo-action-bar">
                    <div class="row">
                        
                        <div class="col-xs-4 btn-add-task">
                            <a href='{{URL::to("works/create")}}' class="btn btn-default btn-primary"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--todolist end-->
    </div>
</div>
@endsection

