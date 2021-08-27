<?php
//session_unregister('admin_id');

unset($_SESSION['admin_id']);
?>
<script type="text/javascript">
window.location.href =	'login.php';
</script>