
$(window).load(function() {

if($(window).scrollTop() >= 130 || window.screen.height >= 918){
	runCircle();
}

$(window).scroll(function(){
	if($(window).scrollTop() >= 130){
		runCircle();
	}
});
	
function runCircle(){
	var hT = $('.pie-title-center').offset().top,
		hH = $('.pie-title-center').outerHeight(),
		wH = $(window).height(),
		wS = $(this).scrollTop();
	if (wS > (hT + hH - wH)) {
		$('#demo-pie-1').pieChart({
			barColor: '#066a65',
			trackColor: '#eee',
			lineCap: 'square',
			size: 160,
			barsize: '4',
			animate: {
				duration: 4000,
				enabled: true
			},
			lineWidth: 11,
			onStep: function(from, to, percent) {
				$(this.element).find('.pie-value').text(Math.round(percent * -1.33352) + '');
			}
		});

		$('#demo-pie-2').pieChart({
			barColor: '#066a65',
			trackColor: '#eee',
			size: 160,
			lineCap: 'butt',
			lineWidth: 11,
			animate: {
				duration: 4000,
				enabled: true
			},
			onStep: function(from, to, percent) {
				$(this.element).find('.pie-value').text(Math.round(percent * -1.33352) + '');
			}
		});

		$('#demo-pie-3').pieChart({
			barColor: '#066a65',
			trackColor: '#eee',
			size: 160,
			lineCap: 'square',
			lineWidth: 11,
			animate: {
				duration: 4000,
				enabled: true
			},
			onStep: function(from, to, percent) {
				$(this.element).find('.pie-value').text(Math.round(percent / 25 * -1) + 'X');
			}
		});

		$('#demo-pie-4').pieChart({
			barColor: '#066a65',
			trackColor: '#eee',
			lineCap: 'square',
			size: 160,
			lineWidth: 11,
			rotate: 0,
			first: 5,
			speed: 200,
			max: 5,
			goal: 0,
			animate: {
				duration: 4000,
				enabled: true
			},
			onStep: function(from, to, percent) {
				$(this.element).find('.pie-value').text(Math.round(percent) + '%');
			}
		});
	}
}
});