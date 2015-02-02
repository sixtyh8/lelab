<!-- Content -->
<div class="list">
<div id="engineer-list">
<?php include 'actions/list-engineers.php'; ?>
</div>

<a href="#" id="add-engineer-link" class="btn btn-small"><i class="icon-plus-sign"></i> Add Engineer</a>
<span id="add-engineer" class="editable-container editable-inline" style="">
	<div>
		<div class="editableform-loading" style="display: none;"></div>
		<form id="add-engineer-form" class="form-inline editableform" style="" method="post" action="/admin/actions/add-engineer.php">
			<div class="control-group">
				<div>
					<div class="editable-input" style="position: relative;">
						<input type="text" class="input-medium" id="name" name="name" style="padding-right: 24px;">
						<span class="editable-clear-x"></span>
					</div>
					<div class="editable-buttons">
						<button type="submit" class="btn btn-primary editable-submit">
							<i class="icon-ok icon-white"></i> Ok
						</button>
						<button type="button" id="add-engineer-cancel" class="btn editable-cancel">
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
	<p class="muted">The Engineer names added here will automatically be selectable in the <a href="/admin/credits.php?action=add" title="Credits form">Credits form</a>.</p>
</div>