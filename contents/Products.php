
<div class="shape-featured">
  <div class="text-haead"> Products</div>
</div>
<?php 
		$counter = 1;
		$ProductQuery			=	mysqli_query($con, "SELECT * FROM products order by id desc");
		while($ProductQueryrows	=	mysqli_fetch_assoc($ProductQuery))
		{
			if($ProductQueryrows['image'])
			{
		    $images	=   explode('@',$ProductQueryrows['image']);		
		    }
			//echo $counter;
		?>
        <div style="float: left; margin-left: 5px;">
<div class="left-shape1" style="margin-top: 10px;">
  <div><a href="?p=ProductDetail&id=<?php echo $ProductQueryrows['id']; ?>">
  <div id="fade_up_<?php echo $counter;?>">
  <?php if($ProductQueryrows['image']){ for($h=0;$h<count($images);$h++){ ?>
  <img src="images/thumb_<?php echo $images[$h]; ?>" alt="." border="0" class="img1-laptop" />
  <?php } 
  }else{?>
  <img src="images/no_image.jpg" alt="." border="0" class="img1-laptop"/>
  <?php }?>
  </div>
  </a></div>
  <div class="text1-jang"><strong>Name:</strong><?php echo $ProductQueryrows['name']; ?></div>
  <div class="text1-rate" style="font-size: 12px;"><strong>Price:</strong> <?php echo "$".$ProductQueryrows['points']; ?></div>
  <input type="submit" class="btn" onclick="window.location.href='?p=ProductDetail&id=<?php echo $ProductQueryrows['id']; ?>'" name="button" id="button" value="Add To Cart">
  
</div>
</div>
<?php  $counter++; } ?>
<!--<div style="clear:both"></div>-->
