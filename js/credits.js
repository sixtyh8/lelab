// Credits JS
$(function(){

		// Read the image name and extract the artist and album names
		function autofillFields(file){
			console.log(file);
			var fileArray = file.split('-');
			var artistName = $.trim(fileArray[1]);
			var albumName = $.trim(fileArray[2].split('.')[0]);
			$('input#artist-name').val(artistName);
			$('input#album-name').val(albumName);
		}
		
        // Form submit
        $(document).on('submit', ".credit-form", function(e) {

            e.preventDefault();

            var nbErrors = 0;

            $(this).children('.required').each(function(){
              if(this.val() == ""){
                this.next('span.help-inline').show().parents('.control-group').addClass('error');
                nbErrors += 1;
              }
            });

            if(nbErrors == 0){

                // validate and process form here
                var formID = $(this).attr('id'), url, actionVerb, modalID;
                var data = $(this).serialize();

                if(formID == 'add-credit-form'){
                    modalID = '#add-modal';
                    url = '/admin/actions/add-credit.php';
                    actionVerb = 'Added';
                } else if (formID == 'edit-credit-form'){
                    modalID = '#edit-modal';
                    url = '/admin/actions/edit-credit.php';
                    actionVerb = 'Edited';
                }

                $.ajax({  
                    type: "POST",
                    url: url,
                    data: data,
                    cache:false,
                    success: function(data, textStatus, jqXHR) {
                        reloadBlock('list-credit', 'credit-list');
                        alertify.log("Credit "+ actionVerb +"!");
                        $(modalID).modal('hide').delay(4000);
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(jqXHR);
                        console.log("textStatus: " + textStatus);
                        console.log("errorThrown: " + errorThrown);
                    }
                });
            }
        });

        // Error messages - Focus
        $(document).on('focus', '.required', function(){
            $(this).next('span.help-inline').hide().parents('.control-group').removeClass('error');
        });
        // Error messages - Blur
        $(document).on('blur', '.required', function(){
            if($(this).val() == ""){
                $(this).next('span.help-inline').show().parents('.control-group').addClass('error');
            }
        });

        // Delete credit entry
        $(document).on('click', 'div#credit-list .delete-credit', function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            alertify.confirm("Are you sure?", function(e) {
                if(e){
                    $.ajax({
                        type: "GET",
                        url: href,
                        success: function(data) {
                          reloadBlock('list-credit', 'credit-list');
                          alertify.log("Credit deleted!");
                        }  
                    });
                }
            });
        });

          $(document).on('click', '.edit-credit', function(e){
            var href = $(this).attr('href');
            e.preventDefault();
            
            $.ajax({
              type:"GET",
              url:href,
              cache:false,
              success:function(data){
                $('#edit-modal .modal-body').html(data);
              }
            });

            $('#edit-modal').modal('show');
          });

          $(".upload-button").text("Choose file");

          $(document).on('click', ".upload-button", function(){
              if($(this).prev(".upload-file").val()){
                  return true;
              }

              $(this).prev(".upload-file").click();
              return false;
          });

          
            
          $("#edit-modal .upload-button").text('Change Image').removeAttr('disabled').removeClass('disabled');

          $("#add-modal").on('shown', function(){
          
          	// Genres autocomplete
  	        $('input#genre').typeahead({
  	          	  name: 'genre',
  	              prefetch: '/admin/data/genres.json',
  	              remote: '/admin/actions/search-genre.php?data=%QUERY'
  	        });
  	        
  	        var today = new Date();
  	        var currentYear = today.getFullYear();
  	        
  	        $('input#year').val(currentYear);
	        
            //elements
            var progressbox     = $('#add-modal .progressbox');
            var progressbar     = $('#add-modal .bar');
            var submitbutton    = $("#add-modal .upload-button");
            var myform          = $("#add-modal .upload");
            var output          = $("#add-modal .output");
            var completed       = '0%';
            var imageField      = $('#add-modal form.credit-form input#image-id');

            $(myform).ajaxForm({
              dataType: 'json',
              beforeSend: function() { //before sending form
                submitbutton.attr('disabled', ''); // disable upload button
                progressbox.fadeIn(); //show progressbar
                progressbar.width(completed); //initial value 0% of progressbar
              },
              uploadProgress: function(event, position, total, percentComplete) { //on progress
                progressbar.width(percentComplete + '%') //update progressbar percent complete
              },
              success: function(data) { // on complete
              	console.log(data);
                output.html('<img src="/img/credits/'+data.image+'" height="150" width="150" />'); //update element with received data
                imageField.val(data.imageID);
                $("#add-modal .upload").resetForm();  // reset form
                submitbutton.removeAttr('disabled'); //enable submit button
                progressbox.fadeOut(); // hide progressbar
                submitbutton.text('Change File');
                //$("#add-modal #file-name").empty().hide();
                $("#add-modal .change-file").hide();
              },
              error: function(event){
                console.log(event);
              }
            });
          });
          
          $(document).on('change', ".upload-file", function(){
              var file = $(this).val();
              if(file){
                  // fix on webkit, and IE
                  file = file.substr(file.lastIndexOf("\\")+1);
                  autofillFields(file);
                  $("#file-name p").html(file);
                  $(".upload-button").text("Upload file").addClass('btn-primary');
                  $("button.change-file").show().on('click', function(e){
                    e.preventDefault();
                    $("#add-modal .upload").resetForm();
                    $(".upload-button").text("Choose file").removeClass("btn-primary");
                    $(this).hide();
                    //$("#file-name p").html('');

                    $(this).prev(".upload-file").trigger('click');
                  });

              }
          });

          $('#edit-modal').on('shown', function(){
              // Select the right engineer in the select box
            if($('#edit-modal #existing-engineer-id').val() != ""){
                var selectedEngi = $('#edit-modal #existing-engineer-id').val();
                $('#edit-modal select#engineer-id').val(selectedEngi);
            }
            
            // Genres autocomplete
  	        $('input#genre').typeahead({
  	          	  name: 'genre',
  	              prefetch: '/admin/data/genres.json',
  	              remote: '/admin/actions/search-genre.php?data=%QUERY'
  	        });

            //elements
            var progressbox     = $('#edit-modal .progressbox');
            var progressbar     = $('#edit-modal .bar');
            var submitbutton    = $("#edit-modal .upload-button");
            var myform          = $("#edit-modal .upload");
            var output          = $("#edit-modal .output");
            var completed       = '0%';
            var imageField      = $('#edit-modal form.credit-form input#image-id');

            $(myform).ajaxForm({
              dataType: 'json',
              beforeSend: function() { //before sending form
                submitbutton.attr('disabled', ''); // disable upload button
                progressbox.fadeIn(); //show progressbar
                progressbar.width(completed); //initial value 0% of progressbar
              },
              uploadProgress: function(event, position, total, percentComplete) { //on progress
                progressbar.width(percentComplete + '%') //update progressbar percent complete
              },
              success: function(data) { // on complete
                output.html('<img src="/img/credits/'+data.image+'" height="150" width="150" />'); //update element with received data
                imageField.val(data.imageID);
                $("#add-modal .upload").resetForm();  // reset form
                submitbutton.removeAttr('disabled'); //enable submit button
                progressbox.fadeOut(); // hide progressbar
                submitbutton.text('Change File');
                //$("#edit-modal #file-name").empty().hide();
                $("#edit-modal .change-file").hide();
              },
              error: function(event){
                console.log(event);
              }
            });

            // Add the right image to the edit modal
            if($('#edit-modal #image-id').val() != ""){
              var image = $('#edit-modal #image-id').val();
              $('#edit-modal .progressbox .bar').animate({width: "99%"}, 800);
              $('#edit-modal .progressbox').fadeIn();
              $.ajax({
                type: "GET",
                data: {imageID: image},
                dataType: "json",
                url: "/admin/actions/get-image-name.php",
                success: function(data){
                    $('#edit-modal .output').animate({ opacity: '0.10' }, 
                        {   duration: 500, 
                            queue: true,
                            complete: function() {
                                $(this).html('<img src="/img/credits/'+data[0].thumb_name+'" height="150" width="150" />');
                                $('#edit-modal .progressbox').fadeOut();
                            }
                        }
                    );
                    $('#edit-modal .output').animate({ opacity: '1' }, { 
                        duration: 500, 
                        queue: true, 
                        complete: function(){
                            $('#edit-modal .progressbox .bar').width("0%");
                        } 
                    });
                },
                error: function(errorThrown){
                    console.log("error");
                    console.log(errorThrown);
                }
              });
            }
          });
		  
          $('table.datatable').dataTable();
});