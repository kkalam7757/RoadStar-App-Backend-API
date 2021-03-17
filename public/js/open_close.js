    // Destroy on anchor
$(document).on('click', 'button#close', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Close ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.

// Destroy on anchor
$(document).on('click', 'button#open', function(e) {
  e.preventDefault();

    swal({
        title         : "Are You Sure",
        text          : "Do You Want To Open ?",
        icon          : "warning",
        buttons       : true,
        dangerMode    : true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              url         : $(this).attr("href"),
              method      : 'POST',
              dataType    : "json",
              success     : function(response) {
                  if (response.success == 200) {

                    swal("Good job!", ""+response.message+"", "success");

                    setInterval(function(){
                      location.reload(true);
                    }, 2000);

                  } // end success if
              } // end success function.
          }); // end ajax .
        } else {
          // Write something here.
        }
    }); // End then.
}); // end Document.