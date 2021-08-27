<?php
session_start();
//session_unregister('userid');
unset($_SESSION['userid']);
//echo $_REQUEST[$_SESSION['userId']];
?>
<script type="text/javascript">
window.location.href =	'index.php';
</script>