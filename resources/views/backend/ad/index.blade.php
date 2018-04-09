@extends('backend.app')
@section('content')

<div class="tab_content">

  <h3 class="box_title work_title">
    <?
    $url=Request::path();
    ?>
    @if($url=='manage-ad')
    All Pending Post
    @elseif($url=='published-ad')
    All Published Post
    @elseif($url=='published-jobs')
    All Published Jsbs
    @elseif($url=='unpublished-jobs')
    All Pending Jsbs
    @endif
 <a href='{{url("ad-post")}}' class="btn btn-default pull-right"> <i class="ion ion-plus"></i> Add new</a></h3>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th width="30%">Title</th>
                    <th>Category</th>
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Approved By</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2" width="4%">Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            @foreach($adPost as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td><a href='{{route("manage-ad.edit",$data->id)}}'> <h5>{{$data->title}}</h5> </a></td>
                    <td>{{$data->cat_name}}</td>
                    <td>{{$data->creator}}</td>
                    <td>{{$data->type_name}}</td>
                    <td>{{$data->approver_name}}</td>
                    <td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>

                    <td>{{date('d-m-y h:i A',strtotime($data->created_at))}}</td>
                    <td> <a href='{{route("manage-ad.edit",$data->id)}}' class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td>
                   
        {!! Form::open(array('route' => ["manage-ad.destroy",$data->id],'method'=>'DELETE')) !!}
            <button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
        {{$adPost->render()}} 
        </div>
  </div>


@endsection
