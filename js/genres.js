$(function(){
    // Edit in place global setting
    $.fn.editable.defaults.mode = 'inline';

    // Edit in place declaration
    $('a.editable').editable();

    // Delete button action
    $(document).on('click', '.delete-genre', function(e){
        e.preventDefault();
        var href = $(this).attr('href');

        alertify.confirm("Are you sure?", function (e) {
            if (e) {
                $.ajax({
                    type: "GET",
                    url: href,
                    success: function(data) {
                      reloadBlock('list-genres', 'genre-list');
                      alertify.log("Genre deleted!");
                    }  
                });
            } else {
                // user clicked "cancel"
            }
        });
    });

    $(document).on('click', '#add-genre-link', function(e){
        e.preventDefault();
        $(this).hide();
        $('#add-genre').show();
        $('#genre-name').focus().typeahead(
        	{
            	name: 'genre',
				prefetch: '/admin/data/genres.json',
				remote: '/admin/actions/search-genre.php?data=%QUERY'
			}
        );
    });

    $(document).on('submit', '#add-genre-form', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(){
                reloadBlock('list-genres', 'genre-list');
                $('#add-genre').hide();
                $('#genre-name').val('');
                $('#add-genre-link').show();
                alertify.log("Genre added!");
                $('a.editable').editable();
            },
            error: function(textStatus, errorThrown){
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });

    $(document).on('click', '#add-genre-cancel', function(e){
        e.preventDefault();
        $('#add-genre').hide();
        $('#add-genre-link').show();
    });

});