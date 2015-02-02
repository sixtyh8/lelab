<!-- Content -->
<form id="add-user-form" action="" method="post" class="form-horizontal user-form" autocomplete="off">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="username">Username</label>
            <div class="controls">
                <input type="text" placeholder="Enter username" name="username" id="username" class="required" autocomplete="off">
                <span class="help-inline">Username can't be blank.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="artist-name">Password</label>
            <div class="controls">
                <input type="password" placeholder="Enter password" name="password" id="password" class="required" autocomplete="off">
                <span class="help-inline">Password can't be blank.</span>
            </div>
        </div>
    </fieldset>
    <button type="submit" name="submit" class="btn btn-primary pull-right" id="form-submit">Submit</button>
</form>