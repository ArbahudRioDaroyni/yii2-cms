<?php
use app\components\widgets\MainSlideshow;
use app\models\Lookup;
use yii\helpers\Url;

$this->title = 'Beranda';
\Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Rumah Sakit Jakarta Pusat menjadi pilihan terbaik masyarakat. RS. St. Carolus salah satu Rumah Sakit di Jakarta Pusat, Indonesia dengan pelayanan terbaik.',
]);

$this->registerJs("
$(document).ready(function () {
    $('.slideshow').slick({
        infinite: true,
        dots: false,
        autoplay: false,
        pauseOnHover: false,
        pauseOnFocus: false,
        autoplaySpeed: 4000
    });

    ScrollReveal().reveal('.fadeIn',{ interval: 150, viewOffset: {bottom: 150} });
    
    $('.fasilitas-detail').hide();
    $('.fasilitas-slideshow .slide').hide();

    $('.fasilitas-choose a').click(function(){
        var id = $(this).data('id');
        
        $('.fasilitas-detail').hide();
        $('#detail-fc'+id).fadeIn();
        
        $('.fasilitas-slideshow .slide').hide();
        $('#slide-fc'+id).fadeIn();
        
    });
    $('.fasilitas-choose a').first().click();
    
});");

?>

<?= MainSlideshow::widget(); ?>
<section id="purpose" class="purpose-sec">
	<div class="container">
		<div class="purpose-wrap">
			<a href="<?= Url::to(['doctor/index']) ?>" class="btn purpose-button red i-doctor fadeIn">Cari Dokter Spesialis</a>
			<a href="<?= Url::to(['site/service']) ?>#outpatient" class="btn purpose-button tosca i-checkup fadeIn">Daftar Rawat Jalan</a>
			<a href="<?= Url::to(['site/service']) ?>#inpatient" class="btn purpose-button blue i-pregnant fadeIn">Daftar Rawat Inap</a>
			<a href="<?= Url::to(['site/contact']) ?>" class="btn purpose-button green i-emergency fadeIn">Emergency Call</a>
		</div>
	</div>
</section>
<section id="layanan" class="layanan-sec">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-10">
				<div class="layanan-tab-wrapper">
					<a href="<?= Url::to(['site/service']) ?>#excellence" class="active">Layanan Unggulan</a>
					<a href="<?= Url::to(['site/service']) ?>">Layanan Kami</a>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-sm-10">
				<div class="layanan-contain">
					<p><?= Lookup::get('home-service-description')?></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="layanan-icon">
                    <?php foreach($excellences as $excellence): ?>
                        <div class="layanan-icon-item fadeIn">
                            <img src="<?= $excellence->icon ?>" alt=""/>
                            <span><?= $excellence->title ?></span>
                        </div>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="fasilitas" class="fasilitas-sec">
	<div class="fasilitas-container">
		<h3 class="widget-title">Fasilitas</h3>
		<div class="row">
			<div class="col-sm-6 fadeIn">
				<div class="fasilitas-choose">
					<ul>
                        <?php foreach ($facilities as $facility): ?>
						<li><a data-id="<?= $facility->id?>" href="#<?= $facility->id ?>"><?= $facility->name ?></a></li>
                        <?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 fadeIn">
                <?php foreach($facilities as $facility): ?>
				<div class="fasilitas-detail" id="detail-fc<?= $facility->id ?>">
					<h4><?= $facility->name ?></h4>
					<p><?= $facility->excerpt?></p>
					<?php /*<a href="<?= $facility->getUrl() ?>" class="read-more">Learn more &gt;</a> */ ?>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="fasilitas-slide">
		<div class="fasilitas-slideshow"> <!-- akan berubah tergantung dari pilihan fasilitas -->
            <?php foreach($facilities as $facility): ?>
			<div class="slide" id="slide-fc<?= $facility->id ?>">
				<img src="<?= $facility->image ?>" alt=""/>
			</div>
            <?php endforeach; ?>
		</div>
	</div>
</section>
<section id="news" class="news-sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 fadeIn">
				<h3 class="widget-title">Kegiatan Kami</h3>
				<div class="post-wrapper">
					<div class="image-wrapper">
						<img src="<?= $event->image ?>" alt=""/>
					</div>
					<div class="post-title">
                        <a href="<?= $event->getUrl() ?>"><?= $event->title ?></a>
                    </div>
					<div class="post-detail"><?= $event->excerpt ?></div>
					<div class="more-detail"><a href="<?= $event->getUrl() ?>">Lihat Kegiatan</a></div>
				</div>
			</div>
			<div class="col-sm-4 fadeIn">
				<h3 class="widget-title">Promo</h3>
				<div class="post-wrapper">
					<div class="image-wrapper">
						<img src="<?= $promo->image ?>" alt=""/>
					</div>
					<div class="post-title">
                        <a href="<?= $promo->getUrl() ?>"><?= $promo->title ?></a>
                    </div>
					<div class="post-detail"><?= $promo->excerpt ?></div>
					<div class="more-detail"><a href="<?= $promo->getUrl() ?>">Lihat Promo</a></div>
				</div>
			</div>
			<div class="col-sm-4 fadeIn">
				<h3 class="widget-title">Berita & Artikel</h3>
				<div class="post-wrapper">
					<div class="image-wrapper">
						<img src="<?= $article->featured_image ?>" alt=""/>
					</div>
					<div class="post-title">
                        <a href="<?= $article->getUrl() ?>">
                            <?= $article->title ?>
                        </a>
                    </div>
					<div class="post-detail"><?= $article->excerpt ?></div>
					<div class="more-detail"><a href="<?= $article->getUrl() ?>">Lihat Artikel</a></div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="cari-informasi" class="search-sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-7 offset-sm-5">
				<div class="search-wrapper">
					<h2 class="title fadeIn">Cari Informasi Kesehatan</h2>
					<p class="fadeIn">Temukan Informasi mengenai penyakit, gejala, spesialisasi, artikel kesehatan di sini</p>
					<form class="fadeIn" action="<?= Url::toRoute(['search/index']) ?>">
						<input name="GlobalSearch[globalSearch]" type="text" placeholder="Ketik gejala, penyakit, spesialis"/>
						<input type="submit" value=""/>
					</form>

					<h3 class="sub-title fadeIn">Saran Topik</h3>
					<ul class="topik fadeIn">
                        <?php foreach($searchKeywords as $keyword): ?>
						<li><a href="<?= $keyword->resultUrl() ?>"><?= $keyword->keyword ?></a></li>
                        <?php endforeach ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>