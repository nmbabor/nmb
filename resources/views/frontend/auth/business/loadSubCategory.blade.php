<div class="form-group{{ $errors->has('fk_sub_category_id') ? ' has-error' : '' }}">
	<label class="col-sm-3 control-label">Sub Category</label>
	<div class="col-sm-9">
		
		{{Form::select('fk_sub_category_id',$subCat,'',['class'=>'form-control','placeholder'=>'Select sub Category','required'])}}
		<div class="help-block with-errors"></div>
		 @if ($errors->has('fk_sub_category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('fk_sub_category_id') }}</strong>
            </span>
        @endif
	</div>
	
</div>