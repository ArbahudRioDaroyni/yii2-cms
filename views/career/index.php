<?php

use app\models\Lookup;
use app\models\Page;
use yii\helpers\Url;

$this->title = 'Karir';
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
?>

<section id="services">  
	<div class="container services">
		<h4>KESEMPATAN BERKARIR</h4>
	</div>
</section>
<div class="row menu-career">
	<div class="container">
		<div class="col-md-12 menu">
			<ul role="tablist" class="nav nav-tabs menu-list career justify-content-center">
				<li class="active col-md-4"><a data-toggle="tab" role="tab" href="#vacancy" aria-expanded="false">LOWONGAN</a></li>
				<li class="col-md-4"><a data-toggle="tab" role="tab" href="#info" aria-expanded="false">PROSES SELEKSI</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row service">
	<div class="tab-content career">

		<div id="vacancy" class="tab-pane in fade active">
			<section class="col-md-12 info">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<span class="tab-title">PROSES SELEKSI</span>
							<div class="line-bottom"></div>
							<div class="opening">
								<?= Lookup::get('career-opening') ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="panel-group panel-general panel-info-career" id="accordion" role="tablist" aria-multiselectable="true">
								<?php foreach ($categories as $key => $category): ?>
									<div class="panel panel-default" >
										<div class="panel-heading" role="tab" id="heading-<?= $key ?>">
											<h4 class="panel-title putardikit collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $key ?>" aria-expanded="false" aria-controls="collapse-<?= $key ?>">
												<a>
													<?= strtoupper($category->name) ?>
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
													<?php foreach ($category->vacancies as $vacancy):?>
														<div class="vacancy-row">
															<h5><?= $vacancy->title ?> <a data-id="<?= $vacancy->id ?>" class="button" href="<?= Url::to('@web/proposal/index') ?>" >Kirim</a></h5>
															<p>Kualifikasi </p>
															<?= $vacancy->qualification ?>
														</div>
													<?php endforeach ?>

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

		<div id="info"  class="tab-pane in fade ">
			<section class="vacancy col-md-12">
				<div class="container">
					<div class="row">
						<div class="col-md-12 no-padding">
							<span class="tab-title">Proses Seleksi</span>
							<h2><?= $careerInfo->title ?></h2>
							<?= $careerInfo->content ?>
							<img src="<?= $careerInfo->featured_image?>" />
						</div>
					</div>
				</div>
			</section>
		</div>

	</div>
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="fa fa-angle-up"></span></a>

<script>
	function toggleChevron(e) {
		$(e.target)
			.prev('.panel-heading')
			.find("span")
			.toggleClass('fa fa-minus fa fa-plus');
	}
	$('#accordion').on('hidden.bs.collapse', toggleChevron);
	$('#accordion').on('shown.bs.collapse', toggleChevron);

</script>
<script src="<?= $baseUrl ?>/js/slide-up.js"></script>
<script>
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		var target = $(this).attr('href');

		$(target).css('left', '-' + $(window).width() + 'px');
		var left = $(target).offset().left;
		$(target).css({left: left}).animate({"left": "0px"}, "fast");
	})

	//Kalau klik tempat lain, maka kotak button apply akan hilang semuanya. (kecuali tombol Apply sendiri)
	jQuery("*").not('button-apply').click(function() {
		jQuery(".info-apply").hide();
	});

	//Memunculkan kotak informasi
	jQuery('.button-apply').click(function() {
		var id = jQuery(this).data("id");
		var target = jQuery("#info-apply-" + id);
		jQuery(".info-apply").hide();
		target.fadeIn();
		return false;
	});

	jQuery('.panel-heading h4').click(function() {
		if ($(this).parents('.panel-heading').hasClass('actives')) {
			$(this).parents('.panel-heading').toggleClass('actives');
		} else {
			$('.panel-heading').removeClass('actives');
			$(this).parents('.panel-heading').addClass('actives');
		}
	});
    
    $(document).ready(function(){
        $('.menu-list li a').click(function(){
            $('.menu-list li').removeClass('active');
            $(this).parent("li").addClass('active');
        });
        $('.menu-list a[href$="#vacancy"]').trigger('click');
    });
    
</script> 