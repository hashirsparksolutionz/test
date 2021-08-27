</div>
	<!--QUICK ICONS-->
</div>

					</div>
			</div>
			
			<!-- End Content -->
		</section>
		
<hr />
</div>
<?php mysqli_close($con); ?>
		<!-- Begin Status Module -->
	<div id="status" class="navbar navbar-fixed-bottom hidden-phone">
		<div class="btn-toolbar">
			<div class="btn-group pull-right">
				<p>&copy; Capitol Marketing Concepts</p>
			</div><div class="btn-group divider">
	</div><div class="btn-group backloggedin-users"></div><div class="btn-group divider">
	</div><div class="btn-group logout"><a href="?p=logout"><i class="icon-minus-sign"></i> Log out</a></div>
		</div>
	</div>
	<!-- End Status Module -->
    		<script>
		(function($){
			// fix sub nav on scroll
			var $win = $(window)
			  , $nav = $('.subhead')
			  , navTop = $('.subhead').length && $('.subhead').offset().top - 40			  , isFixed = 0

			processScroll()

			// hack sad times - holdover until rewrite for 2.1
			$nav.on('click', function () {
				if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10)
			})

			$win.on('scroll', processScroll)

			function processScroll() {
				var i, scrollTop = $win.scrollTop()
				if (scrollTop >= navTop && !isFixed) {
					isFixed = 1
					$nav.addClass('subhead-fixed')
				} else if (scrollTop <= navTop && isFixed) {
					isFixed = 0
					$nav.removeClass('subhead-fixed')
				}
			}
		})(jQuery);
	</script>
	</body>
</html>
