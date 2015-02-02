<?php

$metaTITLE['fr'] = 'Admin - Categories';
$metaTITLE['en'] = 'Admin - Categories';
$bodyClass = 'admin';

// Section Information
$currentSection = 'categories';
$currentSectionTitle = 'Categories';

include 'blocks/header.php';
?>

<!-- Content -->
<div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="#"><?php echo $currentSectionTitle; ?></a>
    <!-- Content -->
    <ul class="nav">
      <li class="active">
          <a href="#list" data-toggle="tab">Edit/Remove</a>
      </li>
      <li>
          <a href="#add" data-toggle="tab">Add</a>
      </li>
    </ul>
  </div>
</div>

  <ul class="nav nav-tabs">
  	<li class="active">
  		<a href="#add" data-toggle="tab">Add</a>
  	</li>
    <li>
  		<a href="#list" data-toggle="tab">Edit/Remove</a>
  	</li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="add">
    	<?php include 'blocks/add-categories.php'; ?>
    </div>
    <div class="tab-pane" id="list">
    	<?php include 'blocks/list-categories.php'; ?>
    </div>
  </div>


<script type="text/javascript">

$(function(){
  $('a[data-toggle="tab"]').on('show', function(e) {
    //console.log(e.target); // activated tab
    //e.relatedTarget // previous tab
  });

  $("#form-submit").click(function() {  
    // validate and process form here 
    var categoryName = $('#category-name').val();
    var categoryParent = $('#category-parent').val();
    var dataString = 'categoryName=' + categoryName + '&categoryParent=' + categoryParent;
    var data = $('#add-category-form').serialize();

    $.ajax({  
      type: "POST",
      url: "<?php echo $_conf['path']['base_url']; ?>admin/actions/add-category.php",
      data: data,
      success: function() {
        $('div.alert').remove();
        $('input#category-name').val('');
        $('select#category-parent').children('option').eq(0).attr('selected', 'selected');
        reloadBlock('list', 'list-categories');
        $('.tab-content').append('<div class="alert alert-success">Category added. <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }  
    });  
    return false;
  });

  // Delete category entry
  $('.delete-category').live('click', function(e){
    var href = $(this).attr('href');
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: href,
        success: function() {
          $('div.alert').remove();
          reloadBlock('list', 'list-categories');
          $('.tab-content').append('<div class="alert alert-success fade in">Category deleted. <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }  
    });
  });

});
</script>

<?php
include 'blocks/footer.php';
?>