<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
//<![CDATA[
function dothat() {
   var div = document.getElementById('fileuploads');
	var field = div.getElementsByTagName('input')[0];
	
	div.appendChild(document.createElement("br"));
	div.appendChild(field.cloneNode(false));
}
//]]>
</script>
</head>

<body>
<form action="" method="post">
	<div id="fileuploads">
		<input type="file" name="fileField" id="fileField" />
	</div>
	<input type="button" name="addmore" id="addmore" value="Add More" onClick="dothat();" />
	<input type="submit" name="button" id="button" value="Submit" />
</form>
</body>
</html>