
// Add slideDown animation to Bootstrap dropdown when expanding.
$('.dropdown').on('show.bs.dropdown', function() {
  $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
});

// Add slideUp animation to Bootstrap dropdown when collapsing.
$('.dropdown').on('hide.bs.dropdown', function() {
  $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
});

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

//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
	if ($(".navbar").offset().top > 50) {
		$(".navbar-static-top").addClass("top-nav-collapse");
		$(".emergency.container").addClass("hidden-head")
	} else {
		$(".navbar-static-top").removeClass("top-nav-collapse");
		$(".emergency.container").removeClass("hidden-head");
	}
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});