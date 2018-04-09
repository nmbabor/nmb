@extends('backend.app')
@section('content')

<div class="tab_content">

  <h3 class="box_title work_title">
    <? $url=Request::path() ?>
@if($url=='pending-business')
    All Pending Business Profile
  @else
    All Published Business Profile
  @endif
</h3>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th width="30%">Name</th>
                    <th>Email</th>
                    <th>Approval</th>
                    <th>Approved By</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="1" width="4%">Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            @foreach($business as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td><a href='{{route("manage-business.edit",$data->id)}}'> <h5>{{$data->name}}</h5> </a></td>
                    <td>{{$data->email}}</td>
                    <td>
                    @if($data->is_approved==1)
                    <b class="text-success">Approved</b>
                    @elseif($data->is_approved==3)

                    <b class="text-danger">Deny</b>
                    @else
                    <b class="text-warning">Pending</b>
                    @endif
                        
                    </td>
                    <td>{{$data->approver_name}}</td>
                    <td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>

                    <td>{{date('d-m-y h:i A',strtotime($data->created_at))}}</td>
                    <td> <a href='{{route("manage-business.edit",$data->id)}}' class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i></a></td>
                    <!-- <td>
                   
        {!! Form::open(array('route' => ["manage-business.destroy",$data->id],'method'=>'DELETE')) !!}
            <button type="submit" class="btn btn-xs btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        {!! Form::close() !!}
                    </td> -->

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
        {{$business->render()}} 
        </div>
  </div>


@endsection
