<?php

	$msg="";
	$err_msg="";
	$row = array();


	if(isset($_POST['submit'])){
		
		$r = mysqli_query($con, "select subject from newsletter") or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($r);
		
		$subject	=	htmlentities(mysqli_real_escape_string($con, $_POST['subject']));
		$body		=	$_POST['editor1'];
		$dt			=	date('Y-m-d');
		
		if(mysqli_num_rows($r) == 0){
			
			$sql="insert into newsletter(id,subject,body,date) values('','$subject','$body','$dt')";
			$result=mysqli_query($con, $sql);
			
			if($result){  	$msg="e-voucher has been added successfully."; }
			else{ $err_msg="Sorry, e-voucher has not been saved successfully."; }	
		
		}else{
			
			$sql="UPDATE  `newsletter` SET  `body` =  '$body' , `subject` =  '$subject'";
			$result=mysqli_query($con, $sql);
			
			if($result){ $msg="e-voucher has been updated successfully."; }
			else{ $err_msg="Sorry, e-voucher has not been update successfully."; }	
			
		}
	}
	
	$r = mysqli_query($con, "select * from newsletter") or die(mysqli_error($con));
	$row = mysqli_fetch_assoc($r);
	
?>
<!DOCTYPE html>
	<html>
		<head>
        <meta charset="utf-8">
        <title>A Simple Page with CKEditor</title>
        <!-- Make sure the path to CKEditor is correct. -->
		<link rel="stylesheet" href="https://capitolmarketingdeals.com/admin/manage/style.css" />
        <script src="../ckeditor.js"></script>
		<style type="text/css">
			.msg {
				    height: 25px;
					padding-top: 9px;
					padding-left: 20px;
					margin-left: 40px;
					margin-bottom: 50px;
					background: #73CE87;
					border-radius: 5px;
					color: #fff;
					font-weight:bold;
			}
			.err_msg {
				    height: 25px;
					padding-top: 9px;
					padding-left: 20px;
					margin-left: 40px;
					margin-bottom: 50px;
					background: #B74747;
					border-radius: 5px;
					color: #f0f0f0;
					font-weight:bold;
			}
			
			.btn {
				display: inline-block;
				padding: 6px 12px;
				margin-bottom: 0;
				font-size: 14px;
				font-weight: 400;
				line-height: 1.42857143;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				background-image: none;
				border: 1px solid transparent;
				border-radius: 4px;
			}
			
			.btn-primary {
				color: #fff;
				background-color: #337ab7;
				border-color: #2e6da4;
				margin-top: 20px;
			}
			
		</style>
		</head>
    <body>
	<?php if(isset($msg) && !empty($msg)){?> 
			<div class="msg"><?php echo $msg; ?></div>

	<?php } ?>
	<?php if(isset($err_msg) && !empty($err_msg)){?> 
			<div class="err_msg"><?php echo $err_msg; ?></div>
	<?php } ?>
	<h3> Add E-Voucher  </h3>
		<form method="post" action="">
		<table>
		<tr><td><strong>Subject:</strong></td><td><input type="text" name="subject" value="<?php if(isset($row["subject"])) echo $row["subject"];?>"></td></tr>
		<tr><td><strong>Message Body:</strong></td>
			<td>
				<textarea name="editor1" id="editor1" rows="15" cols="80">
                <?php if(isset($row["body"])) echo $row["body"];?>
				</textarea>
			</td>
		</tr>
		<tr><td></td><td><input type="submit" class="btn btn-primary" id="submit-button" value="update evoucher" name="submit"></td></tr>
		</table>  
        </form>
    </body>
	</html>


<!------------------------------------------------------->

<script>  
	CKEDITOR.config.extraAllowedContent = 'div(*)';
	CKEDITOR.config.allowedContent = true;
	CKEDITOR.replace( 'editor1' ); 
	CKEDITOR.disableAutoInline = true;
</script>


