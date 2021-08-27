<?php
if(!isset($_SESSION['admin_id'])){
?>
<script type="text/javascript">
window.location.href =	'login.php';
</script>
<?php } ?>