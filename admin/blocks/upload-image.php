<div class="upload-module">
<div class="progress progressbox active progress-striped">
    <div class="bar"></div>
</div>
<div class="output">
    <div>Upload a Cover</div>
</div>
<form action="<?php echo $_conf['path']['base_url']; ?>admin/actions/upload.php" method="post" enctype="multipart/form-data" class="upload">
    <input name="ImageFile" type="file" class="upload-file" />
    <button type="submit" class="upload-button btn"><i class="icon-file"></i> Choose File</button><button class="change-file btn"><i class="icon-file"></i> Change File</button>
</form>
<div id="file-name">
    <p></p>
</div>
</div>