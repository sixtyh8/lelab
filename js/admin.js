// Admin JS
$(function(){
	$.fn.editable.defaults.success = function(data) { 
		// alertify log message
		alertify.log("Edit Successful!");
	};

	$.fn.editableform.buttons = '<button type="submit" class="btn btn-primary editable-submit"><i class="icon-ok icon-white"></i> Ok</button><button type="button" id="add-genre-cancel" class="btn editable-cancel"><i class="icon-remove"></i> Cancel</button>';

	// DataTable
	$.extend( $.fn.dataTableExt.oStdClasses, {
    	"sWrapper": "dataTables_wrapper form-inline"
	});
	// Datatable Defaults
	$.extend( $.fn.dataTable.defaults, {
        "aaSorting": [[ 4, "desc" ],[ 0, "desc" ]],
		"aoColumnDefs": [
		  { "bSortable": false, "aTargets": [ 1, 8 ] }
		],
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"sDom": "<'row'<'span6'l><f>r>t<'row'<'span6'i><p>>",
		"sSortAsc": "header headerSortDown",
		"sSortDesc": "header headerSortUp",
		"sSortable": "header",
		"sPaginationType": "bootstrap",
		"bStateSave": true
    });
    
    $('.tooltip').tooltipster();
    $('a.tooltip').on('click', function(e){
    	e.preventDefault();
    });

});

function reloadBlock(block, container){
	var cont = $('div#'+container),
		url = '/admin/actions/'+block+'.php';

	cont.animate({opacity: '0'}, { 
		duration: 400, 
		queue: true, 
		complete: function(){
			$.ajax({
	            type: "GET",
	            url: url,
	            success: function(data){
	            	cont.html(data);
	                $('a.editable').editable();
	                $('table.datatable').dataTable();
	                $('#add-modal .output, #edit-modal .output').html('<div>Upload a Cover</div>');
                    $("#add-modal .upload-button, #edit-modal .upload-button").text('Choose file').removeAttr('disabled').removeClass('disabled');
                    $("#add-modal #file-name, #edit-modal #file-name").empty().hide();
                    $("#add-modal .change-file, #edit-modal .change-file").hide();
                    $('#add-modal .credit-form, #edit-modal .credit-form')[0].reset();
                    $('.tooltip').tooltipster();
	            },
	            error: function(textStatus, errorThrown){
	                console.log(textStatus);
	                console.log(errorThrown);
	            }
	        });
		}
	});
	cont.animate({ opacity: '1' }, { duration: 400, queue: true});
}