<!-- Content -->
<div id="category-list" class="list"></div>

<script type="text/javascript">
$(function(){
	// Load data with ajax
	$('div#category-list').load('/admin/actions/list-category.php');
});
</script>