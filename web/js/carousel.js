$(document).ready( function() {
    $('.carousel').carousel({
    	interval:   4000
	});
	
	var clickEvent = false;
	$('.carousel').on('click', '.nav a', function() {
			clickEvent = true;
			$('.nav li').removeClass('active');
			$(this).parent().addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.carousel .nav').children().length -1;
			var current = $('.carousel .nav li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.carousel .nav li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
});