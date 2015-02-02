<!-- Content -->
<div id="credit-form-container">
 <div class="content">
 <form id="add-credit-form" action="" method="post" class="form-horizontal credit-form">
    <input type="hidden" name="image-id" id="image-id" value="" />
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="album-name">Album Name</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="album-name" id="album-name">
                <span class="help-inline">Album Name can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="artist-name">Artist Name</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="artist-name" id="artist-name">
                <span class="help-inline">Artist Name can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="bandcamp-url">Bandcamp Link</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="bandcamp-url" id="bandcamp-url">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="genre">Genre</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="genre" id="genre">
                <span class="help-inline">Genre can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="year">Year</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="year" id="year">
                <span class="help-inline">Year can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="engineer-id">Engineer</label>
            <div class="controls">
                <select name="engineer-id" id="engineer-id" autocomplete="off">
                <?php include 'engineer-select.php'; ?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="credit">Credit</label>
            <div class="controls">
                <input type="text" placeholder="Type something…" autocomplete="off" name="credit" id="credit" value="Mastering">
                <span class="help-inline">Credit can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
        	<div class="controls">
            	<label class="checkbox" for="homepage-flag">
                	<input type="checkbox" checked="checked" name="homepage-flag" id="homepage-flag" value="1">
					Show in homepage carousel.
				</label>
        	</div>
        </div>

        <div id="credit-2-container" class="hidden">
            <div class="control-group">
                <label class="control-label" for="engineer-id2">Engineer</label>
                <div class="controls">
                    <select name="engineer-id2" id="engineer-id2" autocomplete="off">
                    <?php include 'engineer-select.php'; ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="credit2">Credit</label>
                <div class="controls">
                    <input type="text" placeholder="Type something…" autocomplete="off" name="credit2" id="credit2">
                </div>
            </div>
        </div>
        <div id="credit-3-container" class="hidden">
            <div class="control-group">
                <label class="control-label" for="engineer-id3">Engineer</label>
                <div class="controls">
                    <select name="engineer-id3" id="engineer-id3" autocomplete="off">
                    <?php include 'engineer-select.php'; ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="credit3">Credit</label>
                <div class="controls">
                    <input type="text" placeholder="Type something…" name="credit3" id="credit3" autocomplete="off">
                </div>
            </div>
        </div>
        <div id="credit-4-container" class="hidden">
            <div class="control-group">
                <label class="control-label" for="engineer-id4">Engineer</label>
                <div class="controls">
                    <select name="engineer-id4" id="engineer-id4" autocomplete="off">
                    <?php include 'engineer-select.php'; ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="credit4">Credit</label>
                <div class="controls">
                    <input type="text" placeholder="Type something…" name="credit4" id="credit4" autocomplete="off">
                </div>
            </div>
        </div>
        <div id="credit-5-container" class="hidden">
            <div class="control-group">
                <label class="control-label" for="engineer-id5">Engineer</label>
                <div class="controls">
                    <select name="engineer-id5" id="engineer-id5">
                    <?php include 'engineer-select.php'; ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="credit5">Credit</label>
                <div class="controls">
                    <input type="text" placeholder="Type something…" name="credit5" id="credit5" autocomplete="off">
                </div>
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary pull-right" id="form-submit">Submit</button>
    </fieldset>
</form>
</div>
</div>
<!--
<div class="notes">
    <h5 class="label label-info">Notes</h5>
    <p class="muted">The Genres are taken from the Genres database and can be modified in the <a href="/admin/genres.php" title="Genre tool">Genre tool.</a></p>
    <p class="muted">The Engineers list is taken from the Engineers database and can be modified in the <a href="/admin/engineers.php" title="Engineer tool">Engineer tool</a></p>
</div>
-->