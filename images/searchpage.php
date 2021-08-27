<!DOCTYPE html>
<html lang="en">
<head>
    <title>More</title>
    <base href="<?PHP echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <link rel="stylesheet" href="css/style.css">
    <link type="text/css" href="css/search.css" rel="stylesheet">
    <script src="js/jquery-1.6.4.min.js"></script>
    <script src="js/cufon-yui.js"></script>
    <script src="js/Franklin_Gothic_Medium_400.font.js"></script>
    <script src="js/Franklin_Gothic_Medium_italic_400.font.js"></script>
    <script src="js/cufon-replace.js"></script>
    <script src="js/script.js"></script>
	<!--[if lt IE 8]>
  		<div class='aligncenter'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg"border="0"></a></div>  
 	<![endif]-->
    <!--[if lt IE 9]>
   		<script src="js/html5.js"></script>
  		<link rel="stylesheet" href="css/ie.css"> 
	<![endif]-->
    
<?PHP echo (isset($head_html)) ? $head_html : '';?>
<script type='text/javascript'>
$(document).ready(function(){
	$(".result-remarks").expander({
		slicePoint:       90,  // default is 100
	});
	$(".sbuttons").button();
	setTimeout(function() {$("#message").hide('blind', {}, 1000)}, 2000);
	$("#sortorder").val("<?PHP echo $sortorder; ?>");
	change_formaction();
	$("#city-name").change(function(){
		//var action = $(this).val();
		//$("#search-form").attr("action", "search/" + action);
		$("#zipcode").val("all");
		change_formaction();
		$("#searchbutton").click();
	});
	$("#zipcode").change(function(){
		//var action = $(this).val();
		//$("#search-form").attr("action", "search/" + action);
		$("#city-name").val("all");
		change_formaction();
		$("#searchbutton").click();
	});
	$("#sortorder").change(function(){
		change_formaction();
		$("#searchbutton").click();
	});
	$(".pagenum a").click(function(){
		var action = $(this).attr('href');
		$("#search-form").attr("action", action);
		$("#searchbutton").click();
		//alert(action);
		return false;
	});
	$('.menuitem')
		.css( {backgroundPosition: "0 30px"} )
		.mouseover(function(){
			$(this).stop().animate({backgroundPosition:"(0px 90px)"}, {duration:700})
		})
		.mouseout(function(){
			$(this).stop().animate({backgroundPosition:"(0px 30px)"}, {duration:500, complete:function(){
				$(this).css({backgroundPosition: "0px 30px"})
			}})
		})	
<?PHP
echo (isset($document_ready_js_code)) ? "\t".$document_ready_js_code."\n" : '';
?>
$.collapsible(".module .header");
update_compare_div();
});

function change_formaction(){

	var action1="";
	var action2="";
	var action3="";
	var action="";
	
	action1 = $("#city-name").val();
	action2 = $("#zipcode").val();
	action3 = $("#sortorder").val();
	
	action="search/all/";
	if ((action1=="all") && (action2=="all")){
		action="search/all/";
	}
	if ((action1!="all") && (action2=="all")){
		action="search/"+action1+"/";
	}
	if ((action2!="all") && (action1=="all")){
		action="search/"+action2+"/";
	}
	
	action=action+action3;
	
	$("#search-form").attr("action", action);
}
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10344193-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>		
</head>
<body>
<!--==============================header=================================-->
<header>
    <div class="main">
        <h1><a href="index.html">Real Estate</a></h1>
        <div class="slogan">Your Perfect Partner for Your New View on Life</div>
       <div class="clear"></div>
    </div>
</header>
<nav>
    <ul class="sf-menu">
        <li class="current"><a href="index.html">Home</a><ul>
                <li><a href="more.html">Who We Are</a></li>
                <li><a href="more.html">News</a></li>
                <li><a href="more.html">Features</a></li>
            </ul>
        </li>
        <li><a href="index-1.html">About</a></li>
        <li><a href="index-3.html">Search</a></li>
        <li><a href="buyers.html">Buyers</a></li>
        <li><a href="selling.html">Sellers</a></li>
        <li><a href="index-6.html">Investors</a></li>
        <li><a href="more.html">Buyers Guide</a></li>
        <li><a href="index-7.html">Contact Us</a></li>
    </ul>
    <div class="clear"></div>
</nav>
<!--==============================content================================-->

<DIV id='search-location'>
	<DIV class='pad5 ca dilb w600'>Filter by City :&nbsp;
		<SELECT id='city-name' name="city-name" class="w200">
		<option value="all">All Areas</option>
		<?PHP
			echo marketarea_dropdown($value_city);
			echo("<OPTION value=''>----------------------------------------</OPTION>\n");
			echo city_dropdown($value_city);

		?>
		</SELECT>
		&nbsp;or&nbsp;ZIP Code&nbsp;:&nbsp;
		<SELECT id='zipcode' name="zipcode" class="w200">
		<option value="all">All ZIP codes</option>
		<?PHP
			echo zipcode_dropdown($value_zipcode);
		?>
		</SELECT>
	</DIV>
	<DIV class='pad5 ca dilb w300'>Sort by :&nbsp;
		<SELECT id='sortorder' name="sortorder" class="w200">
			<option value="sortbyvalue/desc">Price (Highest first)</option>
			<option value="sortbyvalue/asc">Price (Lowest first)</option>
			<option value="sortbyarea/desc">Area (Largest first)</option>
			<option value="sortbyarea/asc">Area (Smallest first)</option>
			<option value="sortbyage/desc">Newest built</option>
			<option value="sortbyage/asc">Oldest built</option>
		</SELECT>
	</DIV>
</DIV>


<DIV id='content'>
<DIV id='search-options' class='pad3'><!-- left side search options div start -->
<?php
$attributes = array('class' => 'search-form', 'id' => 'search-form');
//echo validation_errors('<div class="error">','</div>'); 
echo form_open("search/$form_action",$attributes);
?>
	<DIV class='ui-widget-content ui-corner-all'><!-- search button div start-->
		<DIV class='ui-state-default pad5'>Search</DIV>
		<DIV class='pad5'>
			<?PHP echo $filters; ?>
		</DIV>
		<DIV class='ca pad-v-5'>
			<INPUT type='submit' value='Reset' class='w70 sbuttons' name='resetbutton' id=='resetbutton'>
			<INPUT type='submit' value='Search' class='w70 sbuttons' name='searchbutton' id='searchbutton'>
		</DIV>
	</DIV><!-- search button div end -->	
	<!-- <DIV class='ui-widget-content ui-corner-all mar-t-5 pr'><!-- area filter and sort start ->
		<DIV class='ui-state-default pad5 header'>Area filter and sorting</DIV>
		<DIV class='w200 pr cl-lr h20 pad5'>
			<DIV class='dilb w30 fl-l'>City</DIV>
			<SELECT id='city-name' name="city-name" class="w150 dilb fl-l">
			<option value="all">All Cities</option>
			<?PHP
				//echo city_dropdown($value_city);
			?>
			</SELECT>
		</DIV>
		<DIV class='w100p ca'>- or -</DIV>
		<DIV class='w200 pr clr-lr h20 pad5'>
			<DIV class='dilb w30 fl-l'>ZIP</DIV>
			<SELECT id='zipcode' name="zipcode" class="w150 dilb fl-l">
			<option value="all">All ZIP codes</option>
			<?PHP
				//echo zipcode_dropdown($value_zipcode);
			?>
			</SELECT>
		</DIV>
		<DIV class='w150 pad5 ma'><HR></DIV>
		<DIV class='w200 pr clr-lr h20 pad5'>
			<DIV class='dilb w30 fl-l'>Sort</DIV>
			<SELECT id='sortorder' name="sortorder" class="w150">
			<option value="sortbyvalue/asc">Price (Highest first)</option>
			<option value="sortbyvalue/desc">Price (Lowest first)</option>
			<option value="sortbyarea/asc">Area (Largest first)</option>
			<option value="sortbyarea/desc">Area (Smallest first)</option>
			</SELECT>
		</DIV>		
	</DIV> -->
	<!-- area filter and sort end -->	
	<DIV class='ui-widget-content ui-corner-all mar-t-5 module'><!-- price range div start -->
		<DIV class='ui-state-default pad5 header'>Price Range</DIV>
		<DIV>
			<?PHP
			for($i=1;$i<=9;$i++){
				$r1=$i*100;
				$r2=($i+1)*100;
				$r1=$r1."k";
				$r2=$r2."k";
				if($i==9){
					$r2="1 Million";
				}
				$value=$value_range[$i];
				echo("		<P class='mar0'>
							<label for='range$i' class='cb-label'>$r1 - $r2</label>
							<INPUT type='checkbox' $value id='range$i' class='search-cb' name='range$i'>
						</P>");

			}
			?>		
			<P class='mar0'>
				<label for='range10' class='cb-label'>1 - 5 Million</label>
				<INPUT type='checkbox' <?PHP echo $value_range[10]; ?> id='range10' class='search-cb' name='range10'>
			</P>
			<P class='mar0'>
				<label for='range11' class='cb-label'>5 - 10 Million</label>
				<INPUT type='checkbox' <?PHP echo $value_range[11]; ?> id='range11' class='search-cb' name='range11'>
			</P>
			<P class='mar0'>
				<label for='range12' class='cb-label'>Above 10 Million</label>
				<INPUT type='checkbox' <?PHP echo $value_range[12]; ?> id='range12' class='search-cb' name='range12'>
			</P>
		</DIV>
	</DIV><!-- price range div end -->
	<DIV class='ui-widget-content ui-corner-all mar-t-5 module'><!-- area filter start-->
		<DIV class='ui-state-default pad5 header'>Area</DIV>
		<DIV>
			<P class='mar0'>
				<label for='area0' class='cb-label'>< 1000 Sq. ft.</label>
				<INPUT type='checkbox' id='area0'  <?PHP echo $value_area[0]; ?> class='search-cb' name='area0'>
			</P>
			<?PHP
			for($i=1;$i<=9;$i++){
				$value=$value_area[$i];
				$r1=$i*1000;
				$r2=($i+1)*1000;
				$r2=$r2." Sq. ft.";
				echo("		<P class='mar0'>
							<label for='area$i' class='cb-label'>$r1 - $r2</label>
							<INPUT type='checkbox' $value id='area$i' class='search-cb' name='area$i'>
						</P>");

			}
			?>		
			<P class='mar0'>
				<label for='area10' class='cb-label'>> 10,000 Sq. ft.</label>
				<INPUT type='checkbox' <?PHP echo $value_area[10]; ?> id='area10' class='search-cb' name='area10'>
			</P>
		</DIV>
	</DIV><!-- area filter end -->
	<DIV class='ui-widget-content ui-corner-all mar-t-5 module'><!-- property type filter start -->
		<DIV class='ui-state-default pad5 header'>Property Type</DIV>
		<DIV>
			<P class='mar0'>
				<label for='type1' class='cb-label'>Detached (Home)</label>
				<INPUT type='checkbox' <?PHP echo $value_type[1]; ?> id='type1' class='search-cb' name='type1'>
			</P>
			<P class='mar0'>
				<label for='type2' class='cb-label'>Townhome</label>
				<INPUT type='checkbox' <?PHP echo $value_type[2]; ?> id='type2' class='search-cb' name='type2'>
			</P>
			<P class='mar0'>
				<label for='type3' class='cb-label'>Attached (Condo)</label>
				<INPUT type='checkbox' <?PHP echo $value_type[3]; ?> id='type3' class='search-cb' name='type3'>
			</P>
			<!--
			<P class='mar0'>
				<label for='type4' class='cb-label'>Property Type 4</label>
				<INPUT type='checkbox' <?PHP echo $value_type[4]; ?> id='type4' class='search-cb' name='type4'>
			</P>
			<P class='mar0'>
				<label for='type5' class='cb-label'>Property Type 5</label>
				<INPUT type='checkbox' <?PHP echo $value_type[5]; ?> id='type5' class='search-cb' name='type5'>
			</P>
			-->
		</DIV>
	</DIV><!-- property type filter end -->
	<DIV class='ui-widget-content ui-corner-all mar-t-5 module'><!-- bedooms filter start -->
		<DIV class='ui-state-default pad5 header'>Bedrooms</DIV>
		<DIV>
			<?PHP
			for($i=1;$i<=5;$i++){
				$value=$value_bed[$i];
				echo("		<P class='mar0'>
							<label for='bed$i' class='cb-label'>$i</label>
							<INPUT type='checkbox' $value id='bed$i' class='search-cb' name='bed$i'>
						</P>");

			}
			?>		
			<P class='mar0'>
				<label for='bed6' class='cb-label'>> 5</label>
				<INPUT type='checkbox' <?PHP echo $value_bed[6]; ?> id='bed6' class='search-cb' name='bed6'>
			</P>
		</DIV>
	</DIV><!-- bedrooms filter end -->
	<DIV class='ui-widget-content ui-corner-all mar-t-5 module'><!-- bath filter start -->
		<DIV class='ui-state-default pad5 header'>Baths</DIV>
		<DIV>
			<?PHP
			for($i=1;$i<=5;$i++){
				$value=$value_bath[$i];
				echo("		<P class='mar0'>
							<label for='bath$i' class='cb-label'>$i</label>
							<INPUT type='checkbox' $value id='bath$i' class='search-cb' name='bath$i'>
						</P>");

			}
			?>		
			<P class='mar0'>
				<label for='bath6' class='cb-label'>> 5</label>
				<INPUT type='checkbox' <?PHP echo $value_bath[6]; ?> id='bath6' class='search-cb' name='bath6'>
			</P>
		</DIV>
	</DIV><!-- bath filter end -->
	<DIV class='ui-widget-content ui-corner-all mar-t-5 module'><!-- age start-->
		<DIV class='ui-state-default pad5 header'>Construction year</DIV>
		<DIV>
			<P class='mar0'>
				<label for='parking' class='cb-label'>up to 1980</label>
				<INPUT type='checkbox' <?PHP echo $age_1; ?> id='age_1' class='search-cb' name='age_1'>
			</P>
			<P class='mar0'>
				<label for='parking' class='cb-label'>1981-1999</label>
				<INPUT type='checkbox' <?PHP echo $age_2; ?> id='age_2' class='search-cb' name='age_2'>
			</P>
			<P class='mar0'>
				<label for='parking' class='cb-label'>2000-2010</label>
				<INPUT type='checkbox' <?PHP echo $age_3; ?> id='age_3' class='search-cb' name='age_3'>
			</P>
			<P class='mar0'>
				<label for='parking' class='cb-label'>2011 onwards</label>
				<INPUT type='checkbox' <?PHP echo $age_4; ?> id='age_4' class='search-cb' name='age_4'>
			</P>
		</DIV>
	</DIV><!-- filter age end-->		
	<DIV class='ui-widget-content ui-corner-all mar-t-5 module'><!-- filter facilities start-->
		<DIV class='ui-state-default pad5 header'>Facilities</DIV>
		<DIV>
			<P class='mar0'>
				<label for='parking' class='cb-label'>Parking</label>
				<INPUT type='checkbox' <?PHP echo $value_parking; ?> id='parking' class='search-cb' name='parking'>
			</P>
			<P class='mar0'>
				<label for='pool' class='cb-label'>Swimming Pool</label>
				<INPUT type='checkbox' <?PHP echo $value_pool; ?> id='pool' class='search-cb' name='pool'>
			</P>
			<P class='mar0'>
				<label for='tennis' class='cb-label'>Tennis Court</label>
				<INPUT type='checkbox' <?PHP echo $value_tennis; ?> id='tennis' class='search-cb' name='tennis'>
			</P>
		</DIV>
	</DIV><!-- filter facilities end-->		
	<INPUT type='hidden' name='searchtype' value='advanced'>
<?PHP
// Close the Form
echo form_close();
?>
</DIV><!-- left side search options div end -->
<DIV id='search-results'>
	<DIV id='compare'>
	Selected properties for comparision.<BR>
	<DIV class='compare-item ui-state-active ui-corner-all' id='compare1'></DIV>
	<DIV class='compare-item ui-state-active ui-corner-all' id='compare2'></DIV>
	<DIV class='compare-item ui-state-active ui-corner-all' id='compare3'></DIV>
	<DIV class='compare-item ui-state-active ui-corner-all' id='compare4'></DIV>
	<DIV class='compare-item ui-state-active ui-corner-all' id='compare5'></DIV>
	</DIV>
	<?PHP // echo $dbg; ?>
	<?PHP // print_r($filter); ?>
	<?PHP // echo $value_city."<BR>".$filter; ?>

	<DIV id='pages'>
		<DIV class='ca'><?PHP echo $record_range; ?></DIV>
		<?PHP echo $pagination; ?>
	</DIV>
	<?PHP echo $result; ?>
	<DIV id='pages'>
		<?PHP echo $pagination; ?>
	</DIV>
</DIV>
<DIV class='h20 w99p'></DIV>
<DIV id='markets'><p>© 2009 SANDICOR, Inc. The information being provided is for the personal, non-commercial use of consumers having a good faith interest in purchasing or leasing listed properties of the type displayed to them. Any use of search facilities of data on this site, other than by a consumer looking to purchase or lease real estate, is prohibited. Information Deemed Reliable But Not Guaranteed.</p>
</DIV>
</DIV>
	<div class="container_24">
    	<div class="wrapper">
        	<article class="grid_3 suffix_1">
            	<h6>company</h6>
                <ul>
                	<li><a href="index-1.html">About Us</a></li>
                	<li><a href="more.html">Services</a></li>
                	<li><a href="more.html">Presentation</a></li>
                	<li><a href="more.html">Clients</a></li>
                </ul>
            </article>
        	<article class="grid_3 suffix_1">
            	<h6>properties</h6>
                <ul>
                	<li><a href="more.html">Market Area</a></li>
                	<li><a href="more.html"> City</a></li>
                	<li><a href="more.html">Zip Code</a></li>
                    <li><a href="more.html">Neighborhood</a></li>
                    <li><a href="more.html">Condo Complex</a></li>
                </ul>
            </article>
        	<article class="grid_3 suffix_1">
            	<h6>Advice</h6>
                <ul>
                	<li><a href="more.html">FAQs</a></li>
                	<li><a href="more.html">Support</a></li>
                </ul>
            </article>
        	<article class="grid_3 suffix_1">
            	<h6>For clients</h6>
                <ul>
                	<li><a href="more.html">Sign Up</a></li>
                	<li><a href="more.html">Forums</a></li>
                	<li><a href="more.html">Promotions</a></li>
                </ul>
            </article>
            <article class="grid_6 prefix_1">
            	<h6>Beach Break Properties</h6>
                3603 Promontory Street<br>
                San Diego, CA 92109<br>
                Phone: (858) 224.3670<br>
                
       </div>
    </div>
</aside>
<!--==============================footer=================================-->
<footer>
    <div class="fright"><!-- {%FOOTER_LINK} --></div>
	Real Estate&copy; 2012 : <a href="index-8.html">Privacy Policy</a>
</footer>
<script>Cufon.now()</script>
</body>
</html>