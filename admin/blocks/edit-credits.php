<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$creditID = $_GET['creditID'];
$obj = new Credit();
$result = $obj->getOneCredit($creditID);

foreach ($result as $credit) {
        // Get genre name
        $genreID = $credit['genre'];
        $genreObj = new Genre();
        $genre = $genreObj->getGenreName($genreID);
?>
<form id="edit-credit-form" action="" method="post" class="form-horizontal credit-form">
    <input type="hidden" name="credit-id" id="credit-id" value="<?php echo $credit['id']; ?>">
    <input type="hidden" name="image-id" id="image-id" value="<?php echo $credit['image']; ?>">
    <input type="hidden" name="existing-engineer-id" id="existing-engineer-id" value="<?php echo $credit['engineer_id']; ?>">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="album-name">Album Name</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" name="album-name" id="album-name" value="<?php echo $credit['album_name']; ?>">
                <span class="help-inline">Album Name can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="artist-name">Artist Name</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" name="artist-name" id="artist-name" value="<?php echo $credit['artist_name']; ?>">
                <span class="help-inline">Artist Name can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="bandcamp-url">Bandcamp Link</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="bandcamp-url" id="bandcamp-url" value="<?php echo $credit['bandcamp_url']; ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="genre">Genre</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="genre" id="genre" value="<?php if($genre){ echo $genre[0]['name']; } ?>">
                <span class="help-inline">Genre can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="year">Year</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" name="year" id="year" value="<?php echo $credit['year']; ?>">
                <span class="help-inline">Year can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="engineer-id">Engineer</label>
            <div class="controls">
                <select name="engineer-id" id="engineer-id">
                <?php include 'engineer-select.php'; ?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="credit">Credit</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" name="credit" id="credit" value="<?php echo $credit['credit']; ?>">
                <span class="help-inline">Credit can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
        	<div class="controls">
            	<label class="checkbox" for="homepage-flag">
                	<input type="checkbox" <?php if($credit['homepage_flag'] == 1){ echo 'checked="checked"'; } ?>" name="homepage-flag" id="homepage-flag" value="1">
					Show in homepage carousel.
				</label>
        	</div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary pull-right" id="form-submit">Save Changes</button>
        <a href="#" class="btn pull-right btn-link" data-dismiss="modal">Cancel</a>
    </fieldset>
</form>

<?php  } ?>