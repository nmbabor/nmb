</section>
<script src="{{asset('public/backend/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('public/backend/js/jquery-migrate.js')}}"></script>
<script src="{{asset('public/backend/bs3/js/bootstrap.min.js')}}"></script>
<script class="include" type="text/javascript" src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('public/backend/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--Easy Pie Chart-->
<script src="{{asset('public/backend/js/easypiechart/jquery.easypiechart.js')}}"></script>
<!--Sparkline Chart-->
<script src="{{asset('public/backend/js/sparkline/jquery.sparkline.js')}}"></script>
<!--jQuery Flot Chart-->
<script src="{{asset('public/backend/js/flot-chart/jquery.flot.js')}}"></script>
<script src="{{asset('public/backend/js/flot-chart/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('public/backend/js/flot-chart/jquery.flot.resize.js')}}"></script>
<script src="{{asset('public/backend/js/flot-chart/jquery.flot.pie.resize.js')}}"></script>

<script type="text/javascript" src="{{asset('public/backend/js/data-tables/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/js/data-tables/DT_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/js/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript" src="{{asset('public/backend/plugin/chosen/chosen.jquery.min.js')}}"></script>
<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
<!--common script init for all pages-->


<script src="{{asset('public/backend/js/advanced-form.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/custom.js')}}"></script>

<!--script for this page only-->
<script src="{{asset('public/backend/js/table-editable.js')}}"></script>
<script src="{{asset('public/backend/js/dynamic_table_init.js')}}"></script>
<script src="{{asset('public/frontend/js/validator.js')}}"></script>
<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('public/backend/plugin/tagbox/js/tag-it.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/tinymce/tinymce.min.js')}}"></script>
    <script>
    tinymce.init({
      selector: '.textarea',
      menubar: false,
      plugins:'link',
      toolbar: 'bold italic backcolor  | alignleft aligncenter alignright alignjustify | link | removeformat',
    });
    $(document).ready(function() {
        $(function(){

            $('#tagbox').tagit({
                allowSpaces: true,
                singleField: true,
                singleFieldNode: $('#tagboxField')
            });

            
        });
    });
</script>