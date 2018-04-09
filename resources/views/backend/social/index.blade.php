@extends('backend.app')
@section('content')

<div class="tab_content col-md-12" style="padding-top:0;">
<h3 class="box_title">Social Links</h3>
    <div class="box-body col-md-10">
        {!! Form::open(array('route' => 'social-links.store','class'=>'form-horizontal')) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{Form::label('name', 'Name', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-6">
                {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Name','required'))}}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
            <div class="col-md-2">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
            </div>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('link') ? 'has-error' : '' }}">
            {{Form::label('link', 'URL', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('link',"",array('class'=>'form-control','placeholder'=>'URL (with http://)'))}}
                @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('icon_class') ? 'has-error' : '' }}">
            {{Form::label('icon_class', 'Icon Class', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-6">
                {{Form::text('icon_class',"",array('class'=>'form-control','placeholder'=>'Ex: fa fa-facebook'))}}
                @if ($errors->has('icon_class'))
                    <span class="help-block">
                        <strong>{{ $errors->first('icon_class') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-2">
            <? $max=$max_serial+1; ?>
                {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
            </div>
        </div>
            <div class="col-md-2 col-md-offset-3">
                {{Form::submit('Submit',array('class'=>'btn btn-info'))}}
            </div>
            
        {!! Form::close() !!}
    </div>
    <hr class="col-md-12">
    <div class="col-md-12">
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            @foreach($allData as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$data->name}}</td>
                    <td><a href='{{URL::to("$data->link")}}' target="_blank">{{$data->link}}</a></td>
                    <td><i class="{{$data->icon_class}}"></i></td>
                    <td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
                    <td><a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-info"><i class="ion ion-compose"></i></a>
                    <!-- Modal -->
<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Social Link</h4>
      </div>
        {!! Form::open(array('route' => ['social-links.update',$data->id],'class'=>'form-horizontal','method'=>'PUT' )) !!}
      <div class="modal-body">
        <div class="form-group">
            {{Form::label('name', 'Name', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-9">
                {{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Name','required'))}}
                {{Form::hidden('id',$data->id)}}
            </div>
        </div>
        
        <div class="form-group  {{ $errors->has('link') ? 'has-error' : '' }}">
            {{Form::label('link', 'URL', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-9">
                {{Form::text('link',"$data->link",array('class'=>'form-control','placeholder'=>'URL (with http://)'))}}
                @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('icon_class') ? 'has-error' : '' }}">
            {{Form::label('icon_class', 'Icon Class', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-6">
                {{Form::text('icon_class',"$data->icon_class",array('class'=>'form-control','placeholder'=>'Ex: fa fa-facebook'))}}
                @if ($errors->has('icon_class'))
                    <span class="help-block">
                        <strong>{{ $errors->first('icon_class') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-3">
            <? $max=$max_serial+1; ?>
                {{Form::number('serial_num',"$data->serial_num",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('name', 'Status', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-3">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
            </div>
        </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{Form::submit('Save changes',array('class'=>'btn btn-info'))}}
      </div>
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

                    </td>
                    <td>
                        {{Form::open(array('route'=>['social-links.destroy',$data->id],'method'=>'DELETE'))}}
                            <button type="submit" class="btn btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
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
</div>

@endsection

<script type="text/javascript">

function deleteConfirm(){
  var con= confirm("Do you want to delete?");
  if(con){
    return true;
  }else 
  return false;
}
</script>