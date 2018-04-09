@extends('backend.app')
@section('content')

<div class="tab_content col-md-12" style="padding-top:0;">
<h3 class="box_title">FAQ</h3>
    <div class="box-body col-md-11">
        {!! Form::open(array('route' => 'manage-faq.store','class'=>'form-horizontal')) !!}
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{Form::label('title', 'Title', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('title','',array('class'=>'form-control','placeholder'=>'Title','required','rows'=>'2'))}}
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-2">
            <? $max=$max_serial+1; ?>
                {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
            </div>
            
        </div>
        <div class="form-group  {{ $errors->has('description') ? 'has-error' : '' }}">
            {{Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-10">
                {{Form::textArea('description',"",array('class'=>'form-control','placeholder'=>'Description'))}}
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            {{Form::label('status', 'Status', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-3">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
            </div>
            
        </div>
            <div class="col-md-2 col-md-offset-2">
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
                    <th>Title</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            @foreach($allData as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$data->title}}</td>
                    <td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
                    <td><a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-info"><i class="ion ion-compose"></i></a>
                    <!-- Modal -->
<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Faq</h4>
      </div>
        {!! Form::open(array('route' => ['manage-faq.update',$data->id],'class'=>'form-horizontal','method'=>'PUT' )) !!}
      <div class="modal-body">
        <div class="form-group">
            {{Form::label('title', 'Title', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-10">
                {{Form::textArea('title',$data->title,array('class'=>'form-control','placeholder'=>'Title','required','rows'=>'2'))}}
                {{Form::hidden('id',$data->id)}}
            </div>
        </div>
        <div class="form-group  {{ $errors->has('description') ? 'has-error' : '' }}">
            {{Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))}}
            <div class="col-md-10">
                {{Form::textArea('description',$data->description,array('class'=>'form-control','placeholder'=>'Description'))}}
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status', array('class' => 'col-md-2 control-label'))}}

            <div class="col-md-3">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
            </div>
            <div class="col-md-3">
            <? $max=$max_serial+1; ?>
                {{Form::number('serial_num',"$data->serial_num",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
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
                        {{Form::open(array('route'=>['manage-faq.destroy',$data->id],'method'=>'DELETE'))}}
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