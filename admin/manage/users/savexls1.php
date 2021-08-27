<?php


$my_excel_content = file_get_contents("https://pypvouchers.com/admin/manage/users/user_xls.php");
		$my_excel_filename = "/home/cmattox/public_html/pypvouchers.com/admin/manage/users/pyp".md5(session_id().microtime(TRUE)).".xls";
		file_put_contents($my_excel_filename,$my_excel_content);
//goUrl("manage/users/user_xls.php");	
		
		?>
<script type="text/javascript">
window.location.href="https://pypvouchers.com/admin/manage/users/user_xls.php";
window.location.href="https://pypvouchers.com/admin/admin_index.php?p=viewuser";
</script>