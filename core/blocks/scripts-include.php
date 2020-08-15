<script src="js/jquery.min.js"></script>
<script defer src="js/scripts.min.js"></script>
<script>
  var currentUrl = window.location.href;
  var newUrl = currentUrl.split('#')[0];
</script>
<?php require_once(BLOCKS .'auth-ajax.php'); ?>
<?php require_once(BLOCKS .'signup-ajax.php'); ?>