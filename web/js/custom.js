$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        $(".selected-name").text($(this).text());
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').fadeIn('200');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).fadeOut('200');
            $('.filter').filter('.'+value).fadeIn('200');
            
        }
		
		//Khusus untuk Filter Schedule
		$(".schedule-panel-content #selected.list-group-item").trigger('click');
    });

});