
<div class="form-group">
	{{Form::label('sub_category_id', 'Sub Category* :', array('class' => 'col-md-2 control-label'))}}
	<div class="col-md-10">
		{{Form::select('sub_category_id[]',$subCategory,'', ['class' => 'form-control select','data-placeholder'=>'Select Sub Category','multiple','required'])}}
	</div>
</div>


<script type="text/javascript">
    $(".select").chosen({});
       
</script>