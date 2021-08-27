<div class="shape-featured">
  <div class="text-haead">Products</div>
</div>
<?php 
		$counter = 1;
		$ProductQuery			 =	mysqli_query($con,"SELECT * FROM products order by id DESC LIMIT 9");
		while($ProductQueryrows	 =	mysqli_fetch_assoc($ProductQuery)){
			if($ProductQueryrows['image']!=''){
		$images					 =  explode('@',$ProductQueryrows['image']);
			}
			//echo $counter;
		?>
        <div style="float: left; margin-left: 5px;">
<div class="left-shape1" style="margin-top: 10px;">
  <div><a href="?p=ProductDetail&id=<?php echo $ProductQueryrows['id']; ?>">
  <script type="text/javascript" language="javascript">
	$(document).ready(function(){
	$('#fade_up_<?php echo $counter;?>').cycle();
	});
  </script>
  <div id="fade_up_<?php echo $counter;?>">
    <?php if($ProductQueryrows['image']!=''){ for($y=0;$y<count($images);$y++){ ?>
  <img src="images/<?php echo $images[$y]; ?>" alt="." border="0" class="img1-laptop" />
  <?php }}else{?>
  <img src="images/no_image.jpg" alt="." border="0" class="img1-laptop"/>
  <?php }?>
  </div>
  
  </a></div>
  <div class="text1-jang"><strong>Product: </strong><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
  <?php echo $ProductQueryrows['name']; ?></span></div>
  <div class="text1-rate" style="font-size: 12px;"><strong>Price:</strong> <?php echo  "$".$ProductQueryrows['points']; ?></div>
  <div style="margin-top:10px;">
  <input type="submit" class="btn" onclick="window.location.href='?p=ProductDetail&id=<?php echo $ProductQueryrows['id']; ?>'" name="button" id="button" value="Add To Cart">
  </div>
</div>
</div>
<?php  $counter++; } ?>
<div style="float:right;font-size: 12px;font-weight: bold;margin-top: 15px;width: 116px; margin-bottom:15px;">
<a href="?p=Products" class="cont-a">View All Products »</a>
</div>
<!--<div style="clear:both"></div>-->