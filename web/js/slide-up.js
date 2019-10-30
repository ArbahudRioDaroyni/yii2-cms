var clicked =true;
    $('#contactbtn').on('click', function(){
        if(clicked) {
            clicked = false;
            $('.slide-up').css("display", "block").animate({height: '400px'}, "6000", "linear");
//            $('.hidden-slide').css("visibility", "hidden");
//            $('footer').css("margin-top","0");
	    $(this).removeClass('closed');
        }
        else {
            clicked = true;
            $('.slide-up').css("display","none").animate({height: '0px'}, "6000", 'linear');
//            $('footer').css("margin-top","-49px");
//            $('.hidden-slide').css("visibility", "visible");
	    $(this).addClass('closed');
        }
    })