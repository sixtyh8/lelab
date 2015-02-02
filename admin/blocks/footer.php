</div>
</div>
</div>
</div>
<?php if($showModal){ ?>
<script>
    $(function(){
        // Show the tab sepcified in the URL
        $('#<?php echo $showModal; ?>-modal').modal('show');
    });
</script>
<?php } ?>
</body>
</html>