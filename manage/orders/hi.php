<?php
//include("../../../includes/myconn.php");
require_once('../../../includes/myconn.php');

if($_POST['id'])
{
$id=mysqli_escape_String($con, $_POST['id']);
$firstname=mysqli_escape_String($con, $_POST['firstname']);
$sql = "update members set points='$firstname' where id='$id'";
//$sql = "update members set points='$point' where id='$id'";
//echo $sql;
mysqli_query($con, $sql);
}
?>