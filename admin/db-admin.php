<?php

$metaTITLE['fr'] = 'Admin - Album Genres';
$metaTITLE['en'] = 'Admin - Album Genres';
$bodyClass = 'admin';

// Section Information
$currentSection = 'db';
$currentSectionTitle = 'DB - Admin';

include 'blocks/header.php';
?>
<ul class="nav nav-tabs">
    <li class="section-title"><?php echo $currentSectionTitle; ?></li>
</ul>
<!-- Content -->
<div class="tab-content">
    <div class="tab-pane active" id="list">
        <form id="add-column" action="/admin/actions/db-add-column.php" method="post">
            <input type="text" id="column-name" placeholder="Column Name">
            <select id="column-type">
                <option value="INTEGER">INTEGER</option>
                <option value="TEXT">TEXT</option>
                <option value="REAL">REAL</option>
                <option value="NUMERIC">NUMERIC</option>
            </select>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</div>
<!-- Content -->

<script>

$(function(){
    $('form#add-column').on('submit', function(e){

        e.preventDefault();

        var data = $(this).serialize(),
            url = $(this).attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(){
                alertify.log("Column added!");
            }, 
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log("textStatus: " + textStatus);
                console.log("errorThrown: " + errorThrown);
            }
        })
    });
});

</script>

<?php
include 'blocks/footer.php';
?>