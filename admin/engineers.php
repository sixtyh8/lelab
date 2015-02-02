<?php

$metaTITLE['fr'] = 'Admin - Manage Engineers';
$metaTITLE['en'] = 'Admin - Manage Engineers';
$bodyClass = 'admin';

// Section Information
$currentSection = 'engineers';
$currentSectionTitle = 'Engineers';

include 'blocks/header.php';
?>
<!-- Content -->
    <ul class="nav nav-tabs">
      <li class="section-title"><?php echo $currentSectionTitle; ?></li>
    </ul>

<!-- Content -->
  <div class="tab-content">
    <div class="tab-pane active" id="list">
      <?php include $_SERVER['DOCUMENT_ROOT']."/admin/blocks/list-engineers.php"; ?>
    </div>
  </div>
<!-- Content -->

<script src="/admin/js/engineers.js"></script>

<?php
include 'blocks/footer.php';
?>