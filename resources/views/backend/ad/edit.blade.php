@extends('backend.app')
@section('content')

<h3 class="box_title">Edit
 <a href='{{route("manage-ad.index")}}' class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All</a></h3>
    {!! Form::open(array('route' => ['manage-ad.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
<fieldset class="col-md-12">
    <div class="section postdetails">
        <div class="form-group selected-product col-md-12">
            <ul class="select-category list-inline">
                <li>
                    <a>
                        <span class="select no-margin">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                        {{$category->name}}
                    </a>
                </li>/
                <li class="{{(isset($category->last_id))?'':'active'}}">
                    <a>
                        {{$category->sub_category_name}}
                        
                    </a>
                </li>
                @if(isset($category->last_id))
                / <li class="active">
                    <a>{{$category->last_step_category_name}}</a>
                    
                </li>
                @endif
            </ul>
        </div>
        <div class="row form-group {{ $errors->has('fk_division_id') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label"> Location <span class="required">*</span></label>
            <div class="col-sm-5">
            {{Form::select('fk_division_id',$division_town,$data->fk_division_id,['class'=>'form-control','onchange'=>"loadArea(this.value)"])}}
                <div class="help-block with-errors"></div>
                @if ($errors->has('fk_division_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fk_division_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-sm-5">
                <div id="loadArea">
                {{Form::select('fk_area_id',$area,$data->fk_area_id,['class'=>'form-control'])}}
                </div>
                <div class="help-block with-errors"></div>
                    @if ($errors->has('fk_area_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fk_area_id') }}</strong>
                        </span>
                    @endif
            </div>
            
        </div>
        <div class="row form-group {{ $errors->has('address') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label">Specific Address<span class="required"></span></label>
            <div class="col-sm-10">
            {{Form::text('address',$data->address,['class'=>'form-control','placeholder'=>'Specific Address'])}}
                <div class="help-block with-errors"></div>
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row form-group {{ $errors->has('type') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label"> Type of ad <span class="required">*</span></label>
            <div class="col-sm-10 user-type">
            
                <input type="radio" name="type" value="1" id="newsell" required {{($data->type==1)?'checked':''}}> <label for="newsell"> want to sell </label>
                <input type="radio" name="type" value="2" id="newbuy" required {{($data->type==1)?'':'checked'}}> <label for="newbuy">  want to buy</label>
                <div class="help-block with-errors"></div>
                @if ($errors->has('type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row form-group add-title {{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label label-title">Title for your Ad<span class="required">*</span></label>
            <div class="col-sm-10">
            {{Form::text('title',$data->title,['class'=>'form-control','placeholder'=>'Ex: Sony Xperia dual sim 100% brand new','required'])}}
                <div class="help-block with-errors"></div>
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row form-group {{ $errors->has('photo_one') ? ' has-error' : '' }}  {{ $errors->has('photo_two') ? ' has-error' : '' }}  {{ $errors->has('photo_three') ? ' has-error' : '' }}  {{ $errors->has('photo_four') ? ' has-error' : '' }} add-image">
            <label class="col-sm-2 control-label label-title">Photos for your ad </label>
            <div class="col-sm-7">
                <p><span>The first photo is your main photo. Photo size : 600 x 260 px.</span></p>
                <? $path="images/post"; ?>
                <div class="upload-section">
                    <label class="upload-image" for="upload-image-one">
                    @if(file_exists("$path/big/$data->photo_one") and ($data->photo_one!=null))
                        <input type="file" id="upload-image-one" name="photo_one" onchange="loadPhoto(this,'loadImage1')">
                    <img id="loadImage1" class="img-responsive" src='{{asset("$path/big/$data->photo_one")}}'>
                    @else
                    <input class="upload-image-one" type="file" id="upload-image-one" name="photo_one" onchange="loadPhoto(this,'loadImage1')" required>
                    <img id="loadImage1" class="img-responsive" style="display: none">

                    @endif
                    </label>

                    <label class="upload-image" for="upload-image-two">
                        <input type="file" id="upload-image-two" name="photo_two" onchange="loadPhoto(this,'loadImage2')">
                    @if(file_exists("$path/big/$data->photo_two") and ($data->photo_two!=null))
                    <img id="loadImage2" class="img-responsive" src='{{asset("$path/big/$data->photo_two")}}'>
                    @else
                    <img id="loadImage2" class="img-responsive" style="display: none">

                    @endif
                    </label>                                            
                    <label class="upload-image" for="upload-image-three">
                        <input type="file" id="upload-image-three" name="photo_three" onchange="loadPhoto(this,'loadImage3')">
                    @if(file_exists("$path/big/$data->photo_three") and ($data->photo_three!=null))
                    <img id="loadImage3" class="img-responsive" src='{{asset("$path/big/$data->photo_three")}}'>
                    @else
                    <img id="loadImage3" class="img-responsive" style="display: none">

                    @endif
                    </label>                                        

                    <label class="upload-image" for="upload-imagefour">
                        <input type="file" id="upload-imagefour" name="photo_four" onchange="loadPhoto(this,'loadImage4')">
                    @if(file_exists("$path/big/$data->photo_four") and ($data->photo_four!=null))
                    <img id="loadImage4" class="img-responsive" src='{{asset("$path/big/$data->photo_four")}}'>
                    @else
                    <img id="loadImage4" class="img-responsive" style="display: none">

                    @endif
                    </label>
                </div>
                <div id="errorPhoto">
                    
                </div>
                @if ($errors->has('photo_one'))
                    <span class="help-block">
                        <strong>{{ $errors->first('photo_one') }}</strong>
                    </span>
                    <br>
                @endif
                
                @if ($errors->has('photo_two'))
                    <span class="help-block">
                        <strong>{{ $errors->first('photo_two') }}</strong>
                    </span>
                <br>
                @endif
                @if ($errors->has('photo_three'))
                    <span class="help-block">
                        <strong>{{ $errors->first('photo_three') }}</strong>
                    </span>
                <br>
                @endif
                @if ($errors->has('photo_four'))
                    <span class="help-block">
                        <strong>{{ $errors->first('photo_four') }}</strong>
                    </span>
                <br>
                @endif
            </div>
        </div>
        <div class="row form-group {{ $errors->has('condition') ? ' has-error' : '' }} select-condition">
            <label class="col-sm-2 control-label">Condition<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="radio" name="condition" value="2" id="used" required {{($data->condition==2)?'checked':''}}> 
                <label for="used">Used</label>
                <input type="radio" name="condition" value="1" id="new" required {{($data->condition==1)?'checked':''}}> 
                <label for="new">New</label>
                <div class="help-block with-errors"></div>
                @if ($errors->has('condition'))
                    <span class="help-block">
                        <strong>{{ $errors->first('condition') }}</strong>
                    </span>
                @endif
                
            </div>
        </div>
        <div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price">
            <label class="col-sm-2 control-label label-title">Price<span class="required">*</span></label>
            <div class="col-sm-6">
                {{Form::number('price',$data->price,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>'TK'])}}


                <div class="help-block with-errors"></div>
                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-3">
                <div class="checkbox">
                    <div class="form-group {{ $errors->has('is_negotiable') ? ' has-error' : '' }} col-md-12">
                    <label for="negotiable" class="{{($data->is_negotiable==1)?'checked':''}}">
                        <input name="is_negotiable" type="checkbox" value="1" id="negotiable" {{($data->is_negotiable==1)?'checked':''}}>Negotiable
                    </label>
                    <div class="help-block with-errors"></div>
                        @if ($errors->has('is_negotiable'))
                            <span class="help-block">
                                <strong>{{ $errors->first('is_negotiable') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <!-- Brand load by category -->
        @if(count($brand)>0)
        <div class="row form-group  {{ $errors->has('fk_brand_id') ? ' has-error' : '' }} brand-name">
            <label class="col-sm-2 control-label label-title">Brand<span class="required">*</span></label>
            <div class="col-sm-10">
                {{Form::select('fk_brand_id',$brand,$data->fk_brand_id,['class'=>'form-control','placeholder'=>'select brand','required'])}}
                <div class="help-block with-errors"></div>
                @if ($errors->has('fk_brand_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fk_brand_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @endif
    <div class="different">
    @if(count($fields)>0)
        @foreach($fields as $field)
        <div class="row form-group  {{ $errors->has('field_value') ? ' has-error' : '' }} model-name">
            <label class="col-sm-2 control-label label-title">{{$field->title}}<span class="required">{{($field->required!=null)?'*':''}}</span></label>
            {{Form::hidden('fk_post_field_id[]',$field->id)}}
            <div class="col-sm-10">
            <? $value1=explode(',',$field->value);
            $value=array();
                foreach ($value1 as $val) {
                    if($val!=null){
                        $value[$val]=$val;
                    }

                }
             ?>
    @foreach($postField as $fieldValue)
        @if($fieldValue->fk_post_field_id==$field->id)
            @if($field->type=='text')
                {{Form::text('field_value[]',$fieldValue->field_value,['class'=>'form-control','placeholder'=>$field->title,$field->required])}}
            @elseif($field->type=='number')
                {{Form::number('field_value[]',$fieldValue->field_value,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$field->title,$field->required])}}
            @elseif($field->type=='dropdown')
                {{Form::select('field_value[]',$value,$fieldValue->field_value,['class'=>'form-control','placeholder'=>'- select option -',$field->required])}}
            @endif
        @endif
    @endforeach
            <div class="help-block with-errors"></div>
            @if ($errors->has('field_value'))
                    <span class="help-block">
                        <strong>{{ $errors->first('field_value') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @endforeach
    @endif
    @if(count($parts)>0)
        @foreach($parts as $part)
            <div class="row form-group {{ $errors->has('field_value') ? ' has-error' : '' }} model-name">
            <label class="col-sm-2 control-label label-title">{{$part->title}}
            <span class="required">{{($part->required!=null)?'*':''}}</span></label>
            {{Form::hidden('fk_post_field_id[]',$part->id)}}
                <div class="col-sm-7">
                <? $value1=explode(',',$part->value);
                $value=array();
                    foreach ($value1 as $val) {
                        if($val!=null){
                            $value[$val]=$val;
                        }
                    }
                    
                 ?>
        @foreach($extraPart as $ePart)
            @if($ePart['id']==$part->id)
            <?$fieldValue=$ePart['field_value'];?>
                @if($part->type=='text')
                    {{Form::text('field_value[]',$fieldValue,['class'=>'form-control','placeholder'=>$part->title,$part->required])}}
                @elseif($part->type=='number')
                    {{Form::number('field_value[]',$fieldValue,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$part->title,$part->required])}}
                @elseif($part->type=='dropdown')
                    {{Form::select('field_value[]',$value,$fieldValue,['class'=>'form-control','placeholder'=>'- select option -',$part->required])}}
                @endif
            
            @endif

        @endforeach
        
                <div class="help-block with-errors"></div>
                @if ($errors->has('field_value'))
                    <span class="help-block">
                        <strong>{{ $errors->first('field_value') }}</strong>
                    </span>
                @endif
                </div>
                {{Form::hidden('fk_post_field_id[]',$part->id2)}}
                <div class="col-md-2">
                <? $value3=explode(',',$part->value2);
                $value2=array();
                    foreach ($value3 as $val) {
                        if($val!=null){
                            $value2[$val]=$val;
                        }
                    }
                 ?>
        @foreach($extraPart as $ePart)
            @if($ePart['id2']==$part->id2)
                <?$fieldValue2=$ePart['field_value2'];?>
                @if($part->type2=='text')
                    {{Form::text('field_value[]',$fieldValue2,['class'=>'form-control','placeholder'=>$part->title2,$part->required])}}
                @elseif($part->type2=='number')
                    {{Form::number('field_value[]',$fieldValue2,['class'=>'form-control','min'=>'0','step'=>'any','placeholder'=>$part->title2,$part->required2])}}
                @elseif($part->type2=='dropdown')
                    {{Form::select('field_value[]',$value2,$fieldValue2,['class'=>'form-control','placeholder'=>'- select -',$part->required2])}}
                @endif
            
            @endif
        @endforeach
                <span><small>{{$part->title2}}</small></span>
                </div>
            </div>
        @endforeach
    @endif
    </div>
    
        <div class="row form-group  {{ $errors->has('tag') ? ' has-error' : '' }} additional">
            <label class="col-sm-2 control-label label-title">Tags</label>
            <div class="col-sm-10">
                {{Form::textArea('tag',$data->tag,['class'=>'form-control','placeholder'=>'Tag separate by comma ( , )','rows'=>'2'])}}
                <!-- <div class="checkbox">
                    <label for="camera"><input type="checkbox" name="camera" id="camera"> Camera</label>
                    <label for="dual-sim"><input type="checkbox" name="dual-sim" id="dual-sim"> Dual SIM</label>
                    <label for="keyboard"><input type="checkbox" name="keyboard" id="keyboard">  Physical keyboard</label>
                    <label for="3g"><input type="checkbox" name="3g" id="3g"> 3G</label>

                    <label for="gsm"><input type="checkbox" name="gsm" id="gsm"> GSM</label>

                    <label for="screen"><input type="checkbox" name="screen" id="screen"> Touch screen</label>
                </div> -->
                <div class="help-block with-errors"></div>
                @if ($errors->has('tag'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tag') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row form-group  {{ $errors->has('description') ? ' has-error' : '' }} item-description">
            <label class="col-sm-2 control-label label-title">Description<span class="required">*</span></label>
            <div class="col-sm-10">
            {{Form::textArea('description',$data->description,['class'=>'form-control textarea','placeholder'=>'Write few lines about your products or service','rows'=>'15'])}}
                <div class="help-block with-errors"></div>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif  
            </div>
        </div>
        <div class="row form-group  {{ $errors->has('status') ? ' has-error' : '' }} brand-name">
            <label class="col-sm-2 control-label label-title">Status</label>
            <div class="col-sm-4">
                {{Form::select('status',['1'=>'Active','2'=>'Inactive'],$data->status,['class'=>'form-control','required'])}}
                <div class="help-block with-errors"></div>
                @if ($errors->has('status'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        </div>                            
    </div><!-- section -->
    
    <div class="section seller-info col-md-12">
        <h4>Seller Information</h4>
        <div class="col-md-12">
            <label class="label-title">
                <b>Name : </b> {{$userInfo->name}}
            </label>
        </div>
        <div class="col-md-12">
            <label class="label-title">
                <b>Email : </b> {{$userInfo->email}}
            </label>
        </div>
        <div class="col-md-12">
            <label class="label-title">
                <b>Mobile Number : </b>
            </label>
        </div>
        <div class="col-md-12">
            <div class="well">
                <ul class="mobile_number_list">
                
                <? $primarynumber=$userInfo->mobile; ?>
                    <li id="primaryNumber">
                        <div class="number-list">
                            <div class="col-md-9">
                                <span> <i class="fa fa-mobile"></i>  {{$primarynumber}}</span> 
                            @if($userInfo->mobile_verified==1)
                            <span class="verified"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
                            @endif
                            </div>
                        <? $mobileNumber=''; ?>
                        @foreach($mobiles as $mb)
                        @if($primarynumber==$mb->mobile_number)
                            <?$mobileNumber=$mb->mobile_number?>
                        @endif
                        @endforeach
                        <div class="col-md-2">
                            <div class="checkbox">
                            <label for="number" class="{{($primarynumber==$mobileNumber)?'checked':''}}">
                                <input name="mobile_number[]" value="{{$primarynumber}}" type="checkbox" id="number" {{($primarynumber==$mobileNumber)?'checked':''}}>Used
                            </label>
                        </div><!-- section -->
                        </div>
                        </div>
                    </li>
                
                @foreach($numbers as $mobile)
                    <? $mobileNumber=''; ?>
                        @foreach($mobiles as $mb)
                        @if($mobile->mobile==$mb->mobile_number)
                            <?$mobileNumber=$mb->mobile_number?>
                        @endif
                        @endforeach
                    <li id="primaryNumber{{$mobile->id}}">
                        <div class="number-list">
                            <div class="col-md-9">
                                <span> <i class="fa fa-mobile"></i>  {{$mobile->mobile}}</span> 
                                @if($mobile->is_verified==1)
                                <span class="verified"><img src="{{asset('public/img/icon/verified.png')}}" alt="Verified" title="Verified"></span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label for="number{{$mobile->id}}" class="{{($mobile->mobile==$mobileNumber)?'checked':''}}">
                                        <input name="mobile_number[]" value="{{$mobile->mobile}}" type="checkbox" id="number{{$mobile->id}}" {{($mobile->mobile==$mobileNumber)?'checked':''}}>Used
                                    </label>
                                </div><!-- section -->
                            </div>
                        </div>
                    </li>
                @endforeach
                    
                </ul>
                <br>
                @if ($errors->has('mobile_number'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('mobile_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- section -->

        <button type="submit" class="btn btn-warning" id="submit">Update this Ad</button>
        @if($data->is_approved!=1)
        <a href='{{URL::to("manage-ad/create?is_approved=1&id=$data->id")}}' class="btn btn-info pull-right" id="submit">Approve this ad</a>
        @else
        <a href='{{URL::to("manage-ad/create?is_approved=3&id=$data->id")}}' class="btn btn-danger pull-right" id="submit">Deny this ad</a>
        @endif

</fieldset>
{{Form::close()}}

@endsection
@section('script')
<script src="{{asset('public/frontend/js/validator.js')}}"></script>
<script type="text/javascript">
    function loadArea(id){
        $('#loadArea').load('{{URL::to("loadArea")}}/'+id);
    }

    function loadPhoto(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).css('display','block');
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
