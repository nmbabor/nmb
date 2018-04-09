<div class="banner">
<? 
$searchCategory=App\Model\Category::where(['status'=>1,'type'=>1])->pluck('name','link');
$division=App\Model\DivisionTown::where('status',1)->where('type',1)->pluck('name','id')->toArray();
$town=App\Model\DivisionTown::where('status',1)->where('type',2)->pluck('name','id')->toArray();
$division_town=array(
    'Town'=>$town,
    'Division'=>$division,
    );
 ?>
	
		<div class="banner-form banner-form-full">
			<form action="<?php echo e(URL::to('search')); ?>">
				<?php echo e(Form::select('area',$division_town,'',['class'=>'form-control','placeholder'=>'Bangladesh','id'=>'area'])); ?>

				<?php echo e(Form::select('cat',$searchCategory,'',['class'=>'form-control','placeholder'=>'All Category','id'=>'searchCategory'])); ?>

			
				<input type="text" class="form-control" value="<?php echo e(isset($name)?$name:''); ?>" name="key" placeholder="Type Your key word" id="searchKey">

				<button type="submit" class="form-control">Search</button>
			</form>
		</div><!-- banner-form -->
</div>

<script src="<?php echo e(asset('public/frontend/js/jquery.min.js')); ?>"></script>
<script type="text/javascript">
	  var path='<?php echo e(URL::to("")); ?>';
	$(document).on('focus','#searchKey',function(){
	  var cat = $('#searchCategory').val();
	  $(this).autocomplete({
	    source: function( request, response ) {
	            $.ajax({
	                url: path+'/search-key',
	                type: "GET",
	                dataType: "json",
	                data: { 
	                    name: request.term,
	                    cat:cat
	                    },
	                success: function( data ) {
	                  //console.log(data);
			           response( $.map( data, function( item ) {
			            return {
			              label: item
			            }
			          }));
			        }
	            });

	      
	    },

	    autoFocus: true ,
	        minLength: 0,             
	  });
	});
	</script>