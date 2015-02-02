<?php

$metaTITLE['fr'] = 'Admin - Album Genres';
$metaTITLE['en'] = 'Admin - Album Genres';
$bodyClass = 'admin';

// Section Information
$currentSection = 'genres';
$currentSectionTitle = 'Album Genres';

include 'blocks/header.php';
?>
<ul class="nav nav-tabs">
    <li class="section-title"><?php echo $currentSectionTitle; ?></li>
</ul>
<!-- Content -->
<div class="tab-content">
    <div class="tab-pane active" id="list">
        <?php include $_SERVER['DOCUMENT_ROOT']."/admin/blocks/list-genres.php"; ?>
    </div>
</div>
<!-- Content -->

<script src="/admin/js/genres.js"></script>

<?php
include 'blocks/footer.php';
?>