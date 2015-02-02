<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$obj = new Engineer();
$result = $obj->listEngineers();

if($result){
?>
    
<option name="choose" value="" selected="selected">Select engineer</option>
<?php foreach ($result as $engi) { ?>
<option name="<?php echo $engi['name']; ?>" value="<?php echo $engi['id']; ?>"><?php echo $engi['name']; ?></option>
<?php } ?>
    
<?php } else { ?>

<span class="help-block">
    There is no engineer in the database,<br />
    please <a href="/admin/engineers.php" title="Add an engineer">add one</a> before entering credits.
</span>

<?php } ?>
