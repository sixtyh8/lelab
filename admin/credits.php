<?php

$metaTITLE['fr'] = 'Admin - Album Credits';
$metaTITLE['en'] = 'Admin - Album Credits';
$bodyClass = 'admin';

// Section Information
$currentSection = 'credits';
$currentSectionTitle = 'Album Credits';

include 'blocks/header.php';
?>

    
    <!-- Content -->
    <ul class="nav nav-tabs">
      <li class="section-title"><?php echo $currentSectionTitle; ?></li>
      <a href="blocks/add-credits.php" role="button" data-toggle="modal" data-target="#add-modal" class="btn btn-primary pull-right"><i class="icon-plus icon-white"></i> Add Credit</a>
    </ul>

<div class="tab-content">
  	<?php include 'blocks/list-credits.php'; ?>
</div>

<div id="add-modal" class="modal hide fade modal-credit">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Add Credit</h3>
  </div>
  <div class="modal-dynamic-body">
    <div class="modal-body">
      <?php include 'blocks/add-credits.php'; ?>
    </div>
    <?php include 'blocks/upload-image.php'; ?>
  </div>
</div>

<div id="edit-modal" class="modal hide fade modal-credit">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Edit Credit</h3>
  </div>
  <div class="modal-dynamic-body">
    <div class="modal-body"></div>
    <?php include 'blocks/upload-image.php'; ?>
  </div>
</div>

<script src="/admin/js/credits.js"></script>

<?php
include 'blocks/footer.php';
?>