<?php

$metaTITLE['fr'] = 'Admin - Manage Users';
$metaTITLE['en'] = 'Admin - Manage Users';
$bodyClass = 'admin';

// Section Information
$currentSection = 'users';
$currentSectionTitle = 'Users';

include 'blocks/header.php';
?>

<!-- Content -->
<div class="tabbable tabs-left">
  <ul class="nav nav-tabs">
    <li class="active">
        <a href="#list" data-toggle="tab">Edit/Remove</a>
    </li>
    <li>
      <a href="#add" data-toggle="tab">Add</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="list">
        <?php include 'blocks/list-users.php'; ?>
    </div>
    <div class="tab-pane" id="add">
      <?php include 'blocks/add-users.php'; ?>
    </div>
  </div>
</div>

<?php
include 'blocks/footer.php';
?>