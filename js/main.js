// JavaScript Document
$(function(){
    // Datatable Defaults
    $.extend( $.fn.dataTable.defaults, {
    	//"aoColumnDefs": [{ "bSearchable": false, "bVisible": false, "aTargets": [ 0 ] }],
    	//"aaSorting": [[ 4, "desc" ],[ 0, "desc" ]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "bJQueryUI": true
    });
    
});