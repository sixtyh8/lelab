$(function(){
    // Edit in place global setting
    $.fn.editable.defaults.mode = 'inline';

    // Edit in place declaration
    $('a.editable').editable();

    // Delete button action
    $(document).on('click', '.delete-engineer', function(e){
        e.preventDefault();
        var href = $(this).attr('href');

        alertify.confirm("Are you sure?", function (e) {
            if (e) {
                $.ajax({
                    type: "GET",
                    url: href,
                    success: function(data) {
                      reloadBlock('list-engineers', 'engineer-list');
                      alertify.log("Engineer deleted!");
                    }  
                });
            } else {
                // user clicked "cancel"
            }
        });
    });

    $(document).on('click', '#add-engineer-link', function(e){
        e.preventDefault();
        $(this).hide();
        $('#add-engineer').show();
        $('#name').focus();
    });

    $(document).on('submit', '#add-engineer-form', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(){
                reloadBlock('list-engineers', 'engineer-list');
                $('#add-engineer').hide();
                $('#name').val('');
                $('#add-engineer-link').show();
                alertify.log("Engineer added!");
                $('a.editable').editable();
            },
            error: function(textStatus, errorThrown){
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });

    $(document).on('click', '#add-engineer-cancel', function(e){
        e.preventDefault();
        $('#add-genre').hide();
        $('#add-genre-link').show();
    });

});