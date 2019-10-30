<?php
$this->title = 'Tentang Kami';
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
use \app\models\Lookup; ?>		
<div class="container about-us">
	<h4>TENTANG KAMI</h4>
	<div class="col-md-12 about-details">

		<?= Lookup::get('about-us-opening'); ?>
	</div>
</div>
<div class="row menu-about">
	<div class="container">
		<div class="col-md-12 menu">
			<ul role="tablist" class="nav nav-tabs menu-list">
				<li class="col-md-4 active"><a data-toggle="tab" role="tab" href="#vision" aria-expanded="false">VISI & MISI</a></li>
				<li class="col-md-4 "><a data-toggle="tab" role="tab" href="#history" class="reset" aria-expanded="false">SEJARAH</a></li>
				<li class="col-md-4 "><a data-toggle="tab" role="tab" href="#awards" class="reset" id="award" aria-expanded="false">PENGHARGAAN</a></li>
				<li class="col-md-4 "><a data-toggle="tab" role="tab" href="#csr" aria-expanded="false">CSR</a></li>
				<li class="col-md-4 "><a data-toggle="tab" role="tab" href="#indicator" aria-expanded="false">INDIKATOR MUTU</a></li>                                                
				<li class="col-md-4 "><a data-toggle="tab" role="tab" href="#borromeus" aria-expanded="false">GMCB</a></li>                                                
			</ul>
		</div>
	</div>
</div>
<div class="row aboutus">
	<div class="tab-content about">

		<?= $this->render('about/_vision-mission'); ?>

		<?= $this->render('about/_history'); ?>

		<?= $this->render('about/_awards'); ?>

		<?= $this->render('about/_csr'); ?>

		<?= $this->render('about/_borromeus'); ?>
		
		<?= $this->render('about/_indicator'); ?>
	</div>
</div>
<!--		<div class="row space slide-down">

		</div>-->

<script>
	$("ul.dropdown-menu a").click(function(){
		var target = $(this).attr("href");
		window.location = target;
		window.location.reload();
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		var target = $(this).attr('href');

		$(target).css('left', '-' + $(window).width() + 'px');
		var left = $(target).offset().left;
		$(target).css({left: left}).animate({"left": "0px"}, "fast");
		
	});

    $('.menu-list li a').click(function(){
        $('.menu-list li').removeClass('active');
        $(this).parent("li").addClass('active');
    });
    
	$(document).ready(function() {
		
		var hash = $.trim(window.location.hash);
		if (hash) {
            //kalau ada hash, maka buka tab itu
            $('.menu-list a[href$="'+hash+'"]').trigger('click');
        }else{
            //kalau tidak ada hash, by default buka yang visi-misi
            $('.menu-list a[href$="vision"]').trigger('click');
        }
	});
</script>
