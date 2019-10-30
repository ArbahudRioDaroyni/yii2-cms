<?php

use \app\models\Lookup;
use \app\models\Page;

$baseUrl = Yii::$app->getRequest()->getBaseUrl();
$this->title = 'Pelayanan Kami';
?>

<section id="services">  
	<div class="container services">
		<h4>PELAYANAN KAMI</h4>
		<div class="col-md-12 about-details">
			<strong><?= Lookup::get('service-opening-1'); ?></strong>
			<p><?= Lookup::get('service-opening-2'); ?></p>
		</div>
	</div>
</section>
<div class="row menu-services">
	<div class="container">
		<div class="col-md-12 menu">
			<ul role="tablist" class="nav nav-tabs menu-list">
                <li class="col-md-4"><a data-toggle="tab" role="tab" href="#outpatient" aria-expanded="false">RAWAT JALAN</a></li>
				<li class="col-md-4"><a data-toggle="tab" role="tab" href="#inpatient" aria-expanded="false">RAWAT INAP</a></li>
                <li class="col-md-4"><a data-toggle="tab" role="tab" href="#medical" aria-expanded="false">UJI KESEHATAN</a></li>                                               
				<li class="col-md-4"><a data-toggle="tab" role="tab" href="#hours" aria-expanded="false">LAYANAN 24 JAM</a></li>
				<li class="col-md-4"><a data-toggle="tab" role="tab" href="#excellence" aria-expanded="false">LAYANAN UNGGULAN</a></li>                                                               
				<li class="col-md-4"><a data-toggle="tab" role="tab" href="#alur" aria-expanded="false">ALUR LAYANAN</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row service">
	<div class="tab-content service">

<?php if (isset($pages[PAGE::CAT_OUTPATIENT]) && !empty($pages[PAGE::CAT_OUTPATIENT])): ?>
			<div id="outpatient" class="tab-pane in fade active">
				<section class="col-md-12 outpatient">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="title">
									<h2 class="patient"><span class="tebal">RAWAT JALAN</span></h2>
									<div class="line-bottom"></div>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-md-10 col-md-offset-1">
								<div class="panel-group panel-outpatient" id="accordion" role="tablist" aria-multiselectable="true">
									<?php foreach ($pages[Page::CAT_OUTPATIENT] as $key => $page): ?>
										<div class="panel panel-default" >
											<div class="panel-heading" role="tab" id="heading-<?= $key ?>">
												<h4 class="panel-title putardikit collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $key ?>" aria-expanded="false" aria-controls="collapse-<?= $key?>">
													<img src="<?= $page->icon ?>" alt="">
													<a href="">
														<?= strtoupper($page->title) ?>
													</a>
													<div class="kanan-putar">
														<span class="kanan-btn" id="">
														</span>
														<span class="fa fa-plus "></span>
													</div>

												</h4>

											</div>
											<div id="collapse-<?= $key ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?= $key ?>">
												<div class="panel-body">
													<div class="row">
														<?= $page->getFormattedContent() ?>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		<?php endif; ?>

<?php if (isset($pages[PAGE::CAT_INPATIENT]) && !empty($pages[PAGE::CAT_INPATIENT])): ?>
			<div id="inpatient"  class="tab-pane fade ">
				<section class="inpatient col-md-12">
					<div class="container">
						<div class="row">
							<div class="col-md-12 no-padding row">
								<div class="sidemenu col-md-3">
									<ul class="inpatient">
										<?php foreach ($pages[Page::CAT_INPATIENT] as $key => $page): ?>
											<li <?= $key == 0 ? 'class="active"' : '' ?>><a data-toggle="tab" href="#item-inpatient-<?= $key ?>" aria-expanded="false"><?= $page->title ?></a></li>
	<?php endforeach; ?>
									</ul>
								</div>
								<div class="tab-content inpatient col-md-9">

	<?php foreach ($pages[Page::CAT_INPATIENT] as $key => $page): ?>
										<div id="item-inpatient-<?= $key ?>" class="tab-pane in fade <?= $key == 0 ? 'active' : '' ?>">
											<section class="col-md-9 inpatient item-inpatient-<?= $key ?>">
		<?= $page->getFormattedContent() ?> 
											</section>
										</div>
	<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		<?php endif; ?>

<?php if (isset($pages[PAGE::CAT_FLOW]) && !empty($pages[PAGE::CAT_FLOW])): ?>
			<div id="alur"  class="tab-pane fade ">
				<section class="alur col-md-12">
					<div class="container">
						<div class="row">
							<div class="col-md-12 no-padding row">
								<div class="sidemenu col-md-3">
									<ul class="24-hour">
										<?php foreach ($pages[Page::CAT_FLOW] as $key => $page): ?>
											<li <?= $key == 0 ? 'class="active"' : '' ?>><a data-toggle="tab" href="#item-flow-<?= $key ?>" aria-expanded="false"><?= $page->title ?></a></li>
	<?php endforeach; ?>
									</ul>
								</div>
								<div class="tab-content inpatient">

	<?php foreach ($pages[Page::CAT_FLOW] as $key => $page): ?>
										<div id="item-flow-<?= $key ?>" class="tab-pane in fade <?= $key == 0 ? 'active' : '' ?>">
											<section class="col-md-9 inpatient item-flow-<?= $key ?>">
		<?= $page->getFormattedContent() ?> 
											</section>
										</div>
	<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		<?php endif; ?>

<?php if (isset($pages[PAGE::CAT_24HOUR]) && !empty($pages[PAGE::CAT_24HOUR])): ?>
			<div id="hours"  class="tab-pane fade ">
				<section class="hours col-md-12">
					<div class="container">
						<div class="row">
							<div class="col-md-12 no-padding row">
								<div class="sidemenu col-md-3">
									<ul class="24-hour">
										<?php foreach ($pages[Page::CAT_24HOUR] as $key => $page): ?>
											<li <?= $key == 0 ? 'class="active"' : '' ?>><a data-toggle="tab" href="#item-24hour-<?= $key ?>" aria-expanded="false"><?= $page->title ?></a></li>
	<?php endforeach; ?>
									</ul>
								</div>
								<div class="tab-content inpatient col-md-9">

	<?php foreach ($pages[Page::CAT_24HOUR] as $key => $page): ?>
										<div id="item-24hour-<?= $key ?>" class="tab-pane in fade <?= $key == 0 ? 'active' : '' ?>">
											<section class="col-md-9 inpatient item-24hour-<?= $key ?>">
		<?= $page->getFormattedContent() ?> 
											</section>
										</div>
	<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		<?php endif ?>

		
		<?php // Khusus medical checkup tidak perlu if() soalnya dia memang tidak ambil dari $pages // ?>
		<div id="medical"  class="tab-pane fade ">
			<?= $this->render('service/_medical'); ?>
		</div>

<?php if (isset($pages[PAGE::CAT_CENTRAL_EXCELLENCE]) && !empty($pages[PAGE::CAT_CENTRAL_EXCELLENCE])): ?>
			<div id="excellence"  class="tab-pane fade ">
				<section class="coe col-md-12">
					<div class="container">
						<div class="row">
							<div class="col-md-12 no-padding row">
								<div class="sidemenu col-md-3">
									<ul class="excellence">
										<?php foreach ($pages[Page::CAT_CENTRAL_EXCELLENCE] as $key => $page): ?>
											<li <?= $key == 0 ? 'class="active"' : '' ?>><a data-toggle="tab" id="item-excellence-<?= $key ?>-link" href="#item-excellence-<?= $key ?>" aria-expanded="false"><?= $page->title ?></a></li>
	<?php endforeach; ?>
									</ul>
								</div>
								<div class="tab-content inpatient col-md-9">

	<?php foreach ($pages[Page::CAT_CENTRAL_EXCELLENCE] as $key => $page): ?>
										<div id="item-excellence-<?= $key ?>" class="tab-pane in fade <?= $key == 0 ? 'active' : '' ?>">
											<section class="col-md-9 inpatient item-excellence-<?= $key ?>">
		<?= $page->getFormattedContent() ?> 
											</section>
										</div>
	<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
<?php endif ?>

	</div>
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="fa fa-angle-up"></span></a>


<script>
	function toggleChevron(e) {
		$(e.target)
			.prev('.panel-heading')
			.find("span")
			.toggleClass('fa fa-remove fa fa-plus');
	}
	$('#accordion').on('hidden.bs.collapse', toggleChevron);
	$('#accordion').on('shown.bs.collapse', toggleChevron);

</script>
<script src="<?= $baseUrl ?>/js/slide-up.js"></script>
<script type="text/javascript">
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		var target = $(this).attr('href');

		$(target).css('left', '-' + $(window).width() + 'px');
		var left = $(target).offset().left;
		$(target).css({left: left}).animate({"left": "0px"}, "fast");
	});

	jQuery('.panel-heading h4').click(function() {
		if ($(this).parents('.panel-heading').hasClass('actives')) {
			$(this).parents('.panel-heading').toggleClass('actives');
		} else {
			$('.panel-heading').removeClass('actives');
			$(this).parents('.panel-heading').addClass('actives');
		}
		var header = $(this);
		setTimeout(function(){
			$('html, body').animate({
			scrollTop: header.offset().top
		    }, 900);
		},250);
	});
    
	$(document).ready(function() {
        $('.menu-list li a').click(function(){
            $('.menu-list li').removeClass('active');
            $(this).parent("li").addClass('active');
        });
    
        $('.dropdown-menu.inpatient a').click(function() {
            $('#selected').text($(this).text());
        });
        
		var hash = $.trim(window.location.hash);
		if (hash){
            $('.menu-list a[href$="'+hash+'"]').trigger('click');
        }else{
            $('.menu-list a[href$="#outpatient"]').trigger('click');
        }
		
		//Khusus excellence dari home
		if (hash.indexOf("item-excellence")===1){
			$('.menu-list a[href$="excellence"]').trigger('click');
			$(".sidemenu .excellence a"+hash+"-link").trigger('click');
		}
		$('.container ul.menu-list a').click(function(){
			$('html, body').animate({
				scrollTop: $(".row.service").offset().top - 150
			}, 2000);
		});
	});
</script>
