<div align="right"><a href="javascript:history.go(-1)">« Go Back </a></div>
<style type="text/css">
.preview_bannner {
	width: 190px;
	height: 165px;
	border: solid 1px #DEDEDE;
	float: left;
	margin-left: 8px;
	margin-top: 9px;
}
</style>
<?php
$mes = $_GET['mes'];
if($mes == 'del')
{ $mes = "Banner Image has been Deleted Successfully"; }
if($mes !=""){ ?>
<div id="ErrorMsg2"><?php echo $mes;?></div>
<?php }?>
<h1>Manage Banner Images</h1>
<h2>Here You Can Manage Your Banners</h2>
<form name="banner" id="banner" method="POST" enctype="multipart/form-data" action="?p=bannerUploading">
  <strong> Upload Banner Image:&nbsp;</strong>
  <input type="file" class="modal btn" name="bannerImg" id="bannerImg" />
  <div id="preview"></div>
</form>
<?php 
$ban_query = mysqli_query($con, 'SELECT * FROM `bannerImages` ORDER BY `id` DESC');
if($_GET['b_id']){
	$ban_unlink = mysqli_query($con, "SELECT * FROM `bannerImages` WHERE `id` = '".$_GET['b_id']."'");
	$ban_img    = mysqli_fetch_array($ban_unlink);
	$row_unlink = $ban_img['bannerImages'];
	unlink("../images/".$row_unlink);
	unlink("../images/thumb_".$row_unlink);
	mysqli_query($con, "DELETE FROM `bannerImages` where `id` = '".$_GET['b_id']."'");
?>
<script type="text/javascript">
window.location.href='?p=manageBanners&mes=del';
</script>
<?php } ?>
<form id="form1" method="post" enctype="multipart/form-data" action=''>
<div class="AltRowOne" style="height: 600px; width: 985px;">
  <?php while($row = mysqli_fetch_array($ban_query)){
	list($width, $height) = getimagesize('../images/'.$row['bannerImages']);  
	  ?>
  <div class='preview_bannner'> <img  src=<?php if($width <= 960 && $height <= 300){ ?>"../images/<?php echo $row['bannerImages'].'"'; }else{?>"../images/thumb_<?php echo $row['bannerImages'].'"'; } ?> width="155" height="150" style="margin-left: 7px; margin-top: 8px;">
    <div style="float: right;"><a href='?p=manageBanners&b_id=<?php echo $row['id'];?>' class='delete' onclick="return confirm('Do You Want To Delete This Banner Image');"><img src='../images/cross.png' width='20' height='20' border="0"/></a></div>
  </div>
  <?php }?>
  </div>
</form>
<br />
