@extends('backend.app')
@section('content')

<div class="tab_content">

  <ol class="breadcrumb">
  <li><a href="#">{{$menu->name}}</a></li>
  @if(isset($subMenu))
  <li class="active"><a href="#">{{$subMenu->name}}</a></li>
  @endif
</ol>
  <div class="menu_form left">
      {!! Form::open(array('route' => 'sub-sub-menu.store','class'=>'form-horizontal','files'=>true)) !!}
        <div class="form-group   {{ $errors->has('name') ? 'has-error' : '' }}">
            {{Form::label('name', ' Name', array('class' => 'col-md-12'))}}
            <div class="col-md-12">
                {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Name','required'))}}
            </div>
        </div>
         <div class="form-group  {{ $errors->has('url') ? 'has-error' : '' }}">
            
            {{Form::label('url', 'URL', array('class' => 'col-md-12'))}}
            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-addon">{{URL::to('/')}}/</div>
                    {{Form::text('url','',array('class'=>'form-control','placeholder'=>'URL','required'))}}
                </div>
                @if ($errors->has('url'))
                    <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <input type="hidden" name="fk_sub_menu_id" value="{{$subMenu->id}}">
        <div class="form-group col-md-6">
            {{Form::label('serial_num', 'Serial', array('class' => 'col-md-12'))}}
            <div class="col-md-12">
            <? $max=$max_serial+1; ?>
                {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
            </div>
        </div>
        <div class="form-group col-md-7">
            {{Form::label('status', 'Status', array('class' => 'col-md-12'))}}
            <div class="col-md-12">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    {!! Form::close() !!}
      </div>
          <div class="or">
              -OR-
          </div>
      <div class="menu_form right">
      {!! Form::open(array('route' => 'sub-sub-menu.store','class'=>'form-horizontal','files'=>true)) !!}
            <div class="form-group  {{ $errors->has('page') ? 'has-error' : '' }}">
              {{Form::label('page', 'Select Page', array('class' => 'col-md-12'))}}
                <div class="col-md-12">
                        {{Form::select('page',$page,'null',array('class'=>'form-control','placeholder'=>'-select-','required'))}}
                    @if ($errors->has('page'))
                        <span class="help-block">
                            <strong>{{ $errors->first('page') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <input type="hidden" name="fk_sub_menu_id" value="{{$subMenu->id}}">
            <div class="form-group">
                {{Form::label('serial_num', 'Serial', array('class' => 'col-md-12'))}}
                <div class="col-md-12">
                <? $max=$max_serial+1; ?>
                    {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('status', 'Status', array('class' => 'col-md-12'))}}
                <div class="col-md-12">
                    {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        {!! Form::close() !!}
      </div>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Sub Menu</th>
                    @if(!isset($subMenu))
                    <th>Sub Sub Menu</th>
                    @endif
                    <th>Status</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            @foreach($allData as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td><b>{{$data->name}}</b></td>
                    <td><a href="{{URL::to($data->url)}}" target="_blank">{{URL::to($data->url)}}</a></td>
                    <td><a href="{{url('sub-menu',$menu->id)}}" class="label label-primary" style="color: #fff;">{{$data->sub_menu_name}}</a></td>
                    @if(!isset($subMenu))
                    <td><a href="{{URL::to('sub-sub-menu',$data->id)}}" class="label label-primary" style="color: #fff;">+ Sub Sub Menu</a></td>
                    @endif
                    <td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>

                    <td>
                    <a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-info action_btn"><i class="ion ion-compose"></i></a>
                    <!-- Modal -->
<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Sub Sub Menu : <b> {{$data->name}} </b></h4>
      </div>
        {!! Form::open(array('route' => ['sub-sub-menu.update', $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
        <br>
        <div class="form-group   {{ $errors->has('name') ? 'has-error' : '' }}">
            {{Form::label('name', ' Name', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Name','required'))}}
            </div>
        </div>
         <div class="form-group  {{ $errors->has('url') ? 'has-error' : '' }}">
            
            {{Form::label('url', 'URL', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <div class="input-group">
                    <div class="input-group-addon">{{URL::to('/')}}/</div>
                    {{Form::text('url',$data->url,array('class'=>'form-control','placeholder'=>'URL','required'))}}
                </div>
                @if ($errors->has('url'))
                    <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            {{Form::label('serial_num', 'Serial', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
            <? $max=$max_serial+1; ?>
                {{Form::number('serial_num',$data->serial_num,array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-8">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
            </div>
        </div>
            {{Form::hidden('id',$data->id)}}

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-info" type="submit" value="Save changes">
      </div>
    {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

        {!! Form::open(array('route' => ['sub-sub-menu.destroy',$data->id],'method'=>'DELETE')) !!}
            <button type="submit" class="btn btn-danger action_btn" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
        {{$allData->render()}} 
        </div>
  </div>


@endsection
