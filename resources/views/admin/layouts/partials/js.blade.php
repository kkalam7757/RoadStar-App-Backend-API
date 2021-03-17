<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- datatables -->
<script src="{{ asset('bower_components/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/csrf.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('js/validations.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('dist/js/image_preview.js') }}"></script>
<script src="{{ asset('js/active_deactive.js') }}"></script>
<script src="{{ asset('js/active_sidebar.js') }}"></script>
<script src="{{ asset('js/open_close.js') }}"></script>
<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
   //Date picker
    $(function () {
    $('#datepicker1').datepicker({
      autoclose: true
    })
  });

   //Date picker
    $(function () {
    $('#datepicker2').datepicker({
      autoclose: true
    })
  });
</script>
<script>
$(function(){
    CKEDITOR.replace('editor')

});
</script>
<script>
$(function(){
    $('#example1').DataTable({
        'paging':true,
        'lengthChange':true,
        'searching':true,
        'ordering':true,
        'info':true,
        'autoWidth':true
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#example').DataTable({
        dom:'Bfrtip',
        buttons:['copy','csv','excel','pdf','print']
    });
});
</script>

<script type="text/javascript">
    $(function(){
    var current = location.pathname;
    $('.treeview a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
})
    $(function() {
     var url = window.location;
    const allLinks = document.querySelectorAll('.treeview a');
    const currentLink = [...allLinks].filter(e => {
      return e.href == url;
    });
    
    currentLink[0].classList.add("active")
    currentLink[0].closest(".treeview").style.display="block";
    currentLink[0].closest(".treeview").classList.add("active");
});
    
</script>
<script>
/************Number and dash allowed************/
function dashnumbersonly(e) {
        var unicode = e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=45) { //if the key isn't the backspace key (which we should allow)
            if (unicode<48||unicode>57) //if not a number
            return false //disable key press
        }
    }
/************Numbers only *************/
        function numbersonly(e) {
 var k = event ? event.which : window.event.keyCode;
            if (k == 32) return false;
                var unicode=e.charCode? e.charCode : e.keyCode;

                if (unicode!=8) { //if the key isn't the backspace key (which we should allow)
                    if (unicode<48||unicode>57) //if not a number
                    return false //disable key press
                }
            }
      
/********************Number with decimal***********/

$('.allownumer_decimal').keypress(function(event) {
    if (event.which != 46 && (event.which < 47 || event.which > 59))
    {
        event.preventDefault();
        if ((event.which == 46) && ($(this).indexOf('.') != -1)) {
            event.preventDefault();
        }
    }
});
    /************Alphabet only *************/
        function alphaonly(evt) {
          var keyCode = (evt.which) ? evt.which : evt.keyCode
          if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
          return false;  
        }  

    /************Alpha numeric only *************/   
           function alphanumnotspace(e) {               
            var specialKeys = new Array();
            specialKeys.push(8); //Backspace
            specialKeys.push(9); //Tab
            specialKeys.push(46); //Delete
            specialKeys.push(36); //Home
            specialKeys.push(35); //End
            specialKeys.push(37); //Left
            specialKeys.push(39); //Right
             var k = event ? event.which : window.event.keyCode;
            if (k == 32) return false;
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 32 || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            // document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        } 

        function alphanumeric(e) {               
            var specialKeys = new Array();
            specialKeys.push(8); //Backspace
            specialKeys.push(9); //Tab
            specialKeys.push(46); //Delete
            specialKeys.push(36); //Home
            specialKeys.push(35); //End
            specialKeys.push(37); //Left
            specialKeys.push(39); //Right

            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 32 || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            // document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        } 

         function alphanumericpercent(e) {               
            var specialKeys = new Array();
            specialKeys.push(8); //Backspace
            specialKeys.push(9); //Tab
            specialKeys.push(46); //Delete
            specialKeys.push(36); //Home
            specialKeys.push(35); //End
            specialKeys.push(37); //Left
            specialKeys.push(39); //Right

            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 37 || keyCode == 32 || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            // document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
        
function ValidateEmail(inputText)
{
var mailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
if(inputText.value.match(mailformat))
{
alert("You have entered a valid email address!");    //The pop up alert for a valid email address
document.form1.text1.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");    //The pop up alert for an invalid email address
document.form1.text1.focus();
return false;
}
}



</script>

