(function($) {

	/**
	 * for anchor scrolling
	 */
	document.querySelectorAll('a[data-role="anchor"]').forEach(anchor => {
	    anchor.addEventListener('click', function (e) {
	        e.preventDefault();

	        /*document.querySelector(this.getAttribute('href')).scrollIntoView({
	            behavior: 'smooth'
	        });*/
	        $('html, body').animate({
		        scrollTop: $($.attr(this, 'href')).offset().top-25
		    }, 500);
	    });
	});

	/**
	 * for getting scroll position
	 */
	/*$(window).scroll(function() {
		// find out carousal ends boundary
		var $navbar = $('.navbar'),
			$homeCarousal = $('#home-carousal'),
			offset = $homeCarousal.offset(),
			height = $homeCarousal.outerHeight();

		if ($(window).scrollTop() > offset.top+height-25) {
	    	$navbar.addClass('navbar-inverse');
	    	$navbar.removeClass('navbar-default');
		} else {
			$navbar.addClass('navbar-default');
			$navbar.removeClass('navbar-inverse');
		}
	});*/

})(jQuery);