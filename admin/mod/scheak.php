<?php 
if(!isset($_SESSION['user']))
{
?>
<script type="text/javascript">
window.location.href = "?p=admin_login";
</script>
<?php } ?>