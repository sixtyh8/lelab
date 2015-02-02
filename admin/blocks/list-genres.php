<!-- Content -->
<div class="list">
<div id="genre-list">
<?php include 'actions/list-genres.php'; ?>
</div>

<a href="#" id="add-genre-link" class="btn btn-small"><i class="icon-plus-sign"></i> Add Genre</a>
<span id="add-genre" class="editable-container editable-inline" style="">
	<div>
		<div class="editableform-loading" style="display: none;"></div>
		<form id="add-genre-form" class="form-inline editableform" style="" method="post" action="/admin/actions/add-genre.php">
			<div class="control-group">
				<div>
					<div class="editable-input" style="position: relative;">
						<input type="text" class="input-medium" id="genre-name" name="genre-name" style="padding-right: 24px;">
						<span class="editable-clear-x"></span>
					</div>
					<div class="editable-buttons">
						<button type="submit" class="btn btn-primary editable-submit">
							<i class="icon-ok icon-white"></i> Ok
						</button>
						<button type="button" id="add-genre-cancel" class="btn editable-cancel">
							<i class="icon-remove"></i> Cancel
						</button>
					</div>
				</div>
				<div class="editable-error-block help-block" style="display: none;"></div>
			</div>
		</form>
	</div>
</span>
</div>

<div class="notes">
	<h5 class="label label-info">Notes</h5>
	<p class="muted">The Genres added here will automatically appear as suggestions when typing in the Genre field of the <a href="/admin/credits.php?action=add" title="Credits form">Credits form</a>.</p>
	<p class="muted">Editing Genre names will automatically update for all the credits that are associated with that Genre.</p>
</div>