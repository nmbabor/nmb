

/*========= Update Mulitple image ===========*/
var abc = 0; //Declaring and defining global increement variable
$(document).ready(function () {
    $(".chosen-select").chosen({
        width: "100%"
    });
//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'photo[]', type: 'file', id: 'files'})
                ));
    });

    $('#package_category').on('change',function(){
        var cat_id= $('#package_category').val();
        var url=$('.url').attr('id');
        var $sub_category=$("#sub_category");
        if(cat_id===null)
        {
            $sub_category.html('');
        }
        else
        {
            $.ajax({
            url: url+"/package-category/"+cat_id,
            type: 'GET',
            success: function(result) {
                var append="";
               
                
                for (var i =0 ; i <result.length ; i++) {
                     if(result[i].length!=0){
                    append=append+"<label class='control-label col-md-3' >"+result[i][0]['category_name']+"</label><div class='col-md-8'><input type='hidden' name='exist_cat[]' value='"+result[i][0]['category_id']+"'><select id='sub_category_select' name='sub_category[]' class='form-control'><option value=''>--select--</option>";
                    var innerLength=result[i].length;
                    for (var j =0 ; j < innerLength ; j++) {
                    append=append+"<option value='"+result[i][j]['sub_id']+"'>"+result[i][j]['sub_name']+"</option>";
                    };
                    append=append+"</select></div></br></br>";
                     }

                    
                };
                $sub_category.html(append);
            

            }
        });
        }
        

    });

//following function will executes on change event of file input to select different file   
$('body').on('change', '#files', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
                
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
               
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
                $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src:'/public/img/x.png', alt: 'X',title: 'Delete'}).click(function() {
                $(this).parent().parent().remove();
                }));

            }
        });


//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":photo").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });

/*============*/
$('img#exist_img').click(function() {
    var exist_val = $(this).prev().val();
    $('<input name="del_photo[]" type="hidden" />').appendTo('#loadDelete').val(exist_val);
    $(this).parent().parent().remove();
    })

/*============*/
  });



function deleteConfirm(){
  var con= confirm("Do you want to delete?");
  if(con){
    return true;
  }else 
  return false;
}
