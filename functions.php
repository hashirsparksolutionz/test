<?php
$themename = "Under construction Theme";
$shortname = "suct";

// theme options
$options = array (
 array(
     "name" => "<strong>Social links title</strong>",
	 "desc" =>"Enter your social-links title:",
	 "id" => "social_text",
	"type" => "textarea",
	"options" => array(
	"rows" => "1",
	"cols" => "25") ,
	"std" => "You may find me below:" ),
   

 array(    
    "name" => "<strong>Twitter Account</strong>",
    "desc" => "Enter your Twitter username:",
    "id" => "twitter_account",
    "default" => "ourtuts"),
	
  array(    
    "name" => "<strong>Flickr ID</strong>",
    "desc" => "Enter your Flickr ID:",
    "id" => "flickr_account",
    "default" => "36354012@N03"),

 array(    
    "name" => "<strong>Facebook Page</strong>",
    "desc" => "Enter your Facebook page link:",
    "id" => "facebook_account",
    "default" => "Madalin-Tudose/1829406718"),

 array(    
    "name" => "<strong>Youtube Page</strong>",
    "desc" => "Enter your Youtube page link:",
    "id" => "youtube_account",
    "default" => ""),

 array(    
    "name" => "<strong>Feedburner ID</strong>",
    "desc" => "Enter your Feedburner ID to activate the subscription form:",
    "id" => "feedburner_id",
    "default" => "ourtutsfeed"),
	
array(
     "name" => "<strong>E-mail subscriptions title</strong>",
	 "desc" =>"Enter your title:",
	 "id" => "email_text",
	"type" => "textarea",
	"options" => array(
	"rows" => "2",
	"cols" => "25") ,
	"std" => "Type your email id to get the updates!"),
array(
     "name" => "<strong>About Us title</strong>",
	 "desc" =>"Enter the 'About us' title:",
	 "id" => "about_us_title",
	"type" => "textarea",
	"options" => array(
	"rows" => "1",
	"cols" => "25"),
	"std" => "About me:"  ),
   
array(
     "name" => "<strong>About Us text</strong>",
	 "desc" =>"Enter your description:",
	 "id" => "about_us_text",
	"type" => "textarea",
	"options" => array(
	"rows" => "7",
	"cols" => "25"),
	"std" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi."  ),
 array(
     "name" => "<strong>Countdown title</strong>",
	 "desc" =>"Enter the title of the countdown (ex: 'Site in Maintainance' or 'Site under Construction' ",
	 "id" => "time_title",
	"type" => "textarea",
	"options" => array(
	"rows" => "1",
	"cols" => "30"),
	"std" => "Site under Construction" ),  
 array(
     "name" => "<strong>Countdown text</strong>",
	 "desc" =>"Enter a short line like 'Estimated time remaining before launch' or anyting else",
	 "id" => "time_before",
	"type" => "textarea",
	"options" => array(
	"rows" => "2",
	"cols" => "30"),
	"std" => "Estimated time remaining before launch:" ),
	
	 array( "name" => "Select year",  
	 "desc" =>"<strong>Choose the date for the countdown:</strong>",
	 "id" => "year",  
     "type" => "select",  
     "options" => array("2010", "2011", "2012","2013"),  
     "std" => "2010"),  
	
	 array( "name" => "Select Month",  
    "desc" => "Select month",  
     "id" => "month",  
     "type" => "select",  
     "options" => array("January", "February", "March" , "April" , "May" , "June" , "July" , "August" , "September" , "October" , "November","December"),  
     "std" => "May"),  

	 array( "name" => "Select day",  
     "id" => "day",  
     "type" => "select",  
     "options" => array("01", "02", "03","04", "05", "06","07", "08", "09","10", "11", "12", "13","14", "15", "16","17", "18","19", "20", "21","22", "23","24", "25","26", "27", "28","29", "30", "31",),  
     "std" => "01"), 

 array(
     "name" => "<strong>Logo URL</strong>",
	 "desc" =>"Enter your URL adress of your Logo Image.For example: http://www.ourtuts.com/logo.jpg",
	 "id" => "logo_url",
	"type" => "textarea",
	"options" => array(
	"rows" => "1",
	"cols" => "30"),
	"std" => "http://www.ourtuts.com/logo.png"),   
	
 array(    
    "name" => "<strong>Contact Information: E-mail</strong>",
    "desc" => "Enter your e-mail where you may be contacted:",
    "id" => "email_contact",
    "default" => "office@mysite.com"),
 array(    
    "name" => "<strong>Contact Information: Phone</strong>",
    "desc" => "Enter your phone:",
    "id" => "phone_contact",
    "default" => "555-2432-222"),
 array(
	 "id" => "analytics_code",
	"type" => "textarea",
	"options" => array(
	"rows" => "9",
	"cols" => "44") ),   
);

function suc_options() {
global $themename, $shortname, $options;
 if(isset($_GET['page']))
if ( $_GET['page'] == basename(__FILE__) ) {
	if (isset($_REQUEST['action'])) {
	if ( 'theme_save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=functions.php&saved=true");
die;
 
} 
}
else if (isset($_REQUEST['action'])) { if( 'theme_reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=functions.php&reset=true");
die;
 }
}
}
  
    add_menu_page($themename." Settings", "Theme Settings", 'edit_themes', basename(__FILE__), 'suc_admin');

}

function suc_admin() {
    global $options;
	?>
<?php theme_options_css(); ?>

<div class="wrap">
  <h2 class="alignleft">"Under Construction Theme" Settings</h2>
  <br clear="all" />
  
  
  <?php 
  	//Check if settings saved!
	if(isset($_REQUEST['saved'])) {
  	if ( $_REQUEST['saved'] ) {
  ?>
  		<div class="updated fade"><p><strong>Settings Saved</strong></p></div>
  <?php } } ?>

<form method="post" id="myForm">
<div id="poststuff" style="clear:both;width:780px;">
 
 <div class="stuffbox">
  <h3>Header settings:</h3>
  <div class="inside">
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
	   
	      
	 case "logo_url": 
              $ta_options = $value['options'];?>

		<tr>
			<th scope="row"><?php echo __($value['name']); ?><br /><?php echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>
            <?php break;
 case "email_contact": ?>
        <tr>
        <th scope="row"><?php echo $value['name']; ?><br /><?php echo $value['desc']; ?></th>
        <td>
         <input name="<?php echo $value['id']; ?>" 
         		id="<?php echo $value['id']; ?>" type="text" 
         		value="<?php get_option($value['id'])?printf(get_option($value['id'])): printf($value['default']) ?>" />
        </td>
        </tr>

      

      <?php break;
	   case "phone_contact": ?>
        <tr>
        <th scope="row"><?php echo $value['name']; ?><br /><?php echo $value['desc']; ?></th>
        <td>
         <input name="<?php echo $value['id']; ?>" 
         		id="<?php echo $value['id']; ?>" type="text" 
         		value="<?php get_option($value['id'])?printf(get_option($value['id'])): printf($value['default']) ?>" />
        </td>
        </tr>

      

      <?php break;
	   
		}
	}
	?>
   </table>
  </div>
 </div>  
 </div>


<div id="poststuff" style="clear:both;width:780px;">
 
 <div class="stuffbox">
  <h3>CountDown settings:</h3>
  <div class="inside">
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
	case "time_title": 
              $ta_options = $value['options'];?>

		<tr>
			<th scope="row"><?php echo __($value['name']); ?><br /><?php echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>
            <?php break;?> 
          


 
     
          
          <?php
case "year" :  
?>



<tr>
          


   <th scope="row">  
<?php echo $value['name']; ?></th> 
  <td>     
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">  
<?php foreach ($value['options'] as $option) { ?>  
         <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>  
 </select>  </td>
   
 </tr>
 <?php break;
 
  case "time_before": ?>
       <tr>
			<th scope="row"><?php echo __($value['name']); ?><br /><?php echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>
 <?php  
 break;      		  
 
 
		  
	 case "month" :  
?>  
  <tr>
<th scope="row">  
     <?php echo $value['name']; ?></th> 
  <td>     
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">  
<?php foreach ($value['options'] as $option) { ?>  
         <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>  
 </select>  </td>
   </tr>
 
 <?php  
 break;  
 
	 case "day" :  
?>  
  <tr>
<th scope="row">  
     <?php echo $value['name']; ?></th> 
  <td>     
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">  
<?php foreach ($value['options'] as $option) { ?>  
         <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>  
 </select>  </td>
   </tr>
 
 <?php  
 break;  

	   

  
	  
		}
	}
	?>
   </table>
  </div>
 </div>  
 </div>



<div class="left_side">

<div id="poststuff" class="metabox-holder">
 
 <div class="stuffbox">
  <h3>Social Links Settings (First slide)</h3>
  <div class="inside">
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
	   
	          case "social_text": 
              $ta_options = $value['options'];?>

		<tr>
			<th scope="row"><?php echo __($value['name']); ?><br /><?php echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>

      <?php break;
	
        case "flickr_account": ?>
        <tr>
        <th scope="row"><?php echo $value['name']; ?><br /><?php echo $value['desc']; ?></th>
        <td>
         <input name="<?php echo $value['id']; ?>" 
         		id="<?php echo $value['id']; ?>" type="text" 
         		value="<?php get_option($value['id'])?printf(get_option($value['id'])): printf($value['default']) ?>" />
        </td>
        </tr>

      <?php break;
        case "twitter_account": ?>
        <tr>
        <th scope="row"><?php echo $value['name']; ?><br /><?php echo $value['desc']; ?></th>
        <td>
         <input name="<?php echo $value['id']; ?>" 
         		id="<?php echo $value['id']; ?>" type="text" 
         		value="<?php get_option($value['id'])?printf(get_option($value['id'])): printf($value['default']) ?>" />
        </td>
        </tr>

      <?php break;
	  
	   case "facebook_account": ?>
        <tr>
        <th scope="row"><?php echo $value['name']; ?><br /><?php echo $value['desc']; ?></th>
        <td>
         <input name="<?php echo $value['id']; ?>" 
         		id="<?php echo $value['id']; ?>" type="text" 
         		value="<?php get_option($value['id'])?printf(get_option($value['id'])): printf($value['default']) ?>" />
        </td>
        </tr>

      <?php break;
		
	   case "youtube_account": ?>
        <tr>
        <th scope="row"><?php echo $value['name']; ?><br /><?php echo $value['desc']; ?></th>
        <td>
         <input name="<?php echo $value['id']; ?>" 
         		id="<?php echo $value['id']; ?>" type="text" 
         		value="<?php get_option($value['id'])?printf(get_option($value['id'])): printf($value['default']) ?>" />
        </td>
        </tr>

      <?php break;
		}
	}
	?>
   </table>
  </div>
 </div>  
 </div>

<div id="poststuff" class="metabox-holder">

<div class="stuffbox">
  <h3>E-mail subscriptions Settings (Second Slide)</h3>
  <div class="inside">
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
        case "feedburner_id": ?>
        <tr>
        <th scope="row"><?php echo $value['name']; ?><br /><?php echo $value['desc']; ?></th>
        <td>
         <input name="<?php echo $value['id']; ?>" 
         		id="<?php echo $value['id']; ?>" type="text" 
         		value="<?php get_option($value['id'])?printf(get_option($value['id'])): printf($value['default']) ?>" />
        </td>
        </tr>

      <?php break;
	  
	          case "email_text": 
              $ta_options = $value['options'];?>

		<tr>
			<th scope="row"><?php echo __($value['name']); ?><br /><?php echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>
        <tr>Note:The e-mail form works only with your Feedburner ID:</tr>

      <?php break;
		}
	}
	?>
   </table>
  </div>
 
</div>
</div>


				</div><!--end left side-->

<div id="poststuff" class="metabox-holder">

<div class="stuffbox">
  <h3>About Us Settings (Third Slide)</h3>
  <div class="inside">
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
	          case "about_us_title": 
              $ta_options = $value['options'];?>

		<tr>
			<th scope="row"><?php echo __($value['name']); ?><br /><?php echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>

      <?php break;
	   case "about_us_text": 
              $ta_options = $value['options'];?>

		<tr>
			<th scope="row"><?php echo __($value['name']); ?><br /><?php echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>

      <?php break;
		}
	}
	?>
   </table>
  </div>
 
</div>



</div>

<div id="poststuff" class="metabox-holder">

<div class="stuffbox">
  <h3>Analytics/Stat Tracker Code</h3>
			<div class="inside">
				
              <p>Enter your analytics/stat tracker code :<br />
				
                <?php
     foreach ($options as $value) {
      switch ( $value['id'] ) {
         case "analytics_code": 
              $ta_options = $value['options'];?>

		<tr>
			
			<th scope="row"><?php if(isset($value['name'])) echo __($value['name']); ?><br /><?php if(isset($value['desc'])) echo $value['desc']; ?></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])));
									}?></textarea><br /></td>
		</tr>


      <?php break;
                	}
	}
	?>
                
                </p>
            </div>
		</div>

</div>
<br style="clear:both" />
<input name="theme_save" type="submit" class="button-primary" value="Save changes"/>
<input type="hidden" name="action" value="theme_save"/>
</form>

<form method="post">
<input name="theme_reset" type="submit" class="button-primary" value="Reset" />
<input type="hidden" name="action" value="theme_reset"/>
</form>


</div>
<?php
}

add_action('admin_menu', 'suc_options');


// add CSS if necessary
function theme_options_css() {
echo <<<CSS

<style type="text/css">
	
	.metabox-holder { 
		width: 375px;  float: left;
		margin: 0; padding: 0 30px 0 0;
		
	}
	.metabox-holder .postbox .inside {
		padding: 0 10px;
	}
	.button-primary	{
		float:left;
		margin-right:10px;
	}
	.left_side	{
		float:left;
		width:375px;
		margin-right:30px;
	}
</style>

CSS;
}
?>
