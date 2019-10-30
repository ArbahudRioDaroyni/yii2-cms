<?php
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = 'Pencarian';
?>
<style>
.container-more{
	width: 100%;
	text-align: right;
	height: auto;
}
.more{
    line-height: 30px;
    border: 1px solid transparent;
    text-align: center;
    color: #098b7a;
    transition: all 0.2s ease-in-out;
    text-transform: uppercase;
    padding: 8px;
}
.more:hover, .more:active{
    background: #098b7a;
    color: #fff;
    border-color: #000;
    text-decoration: none;
}
</style>
<section id="find-doctor-header" class="fdh-sec">
	<div class="fd-title">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>Cari Gejala / Kata Kunci</h1>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="find-doctor-center" class="fdc-sec">
	<div class="container" style="max-width:1180px;">
		<?php Pjax::begin(); ?>
		<?php echo $this->render('_search', ['model' => $modelSearch]); ?>
		<div class="doctor-card-sec">
			<h3>Dokter</h3>
            <div class="result-notif">
                <p>Kami menemukan <strong><?= count($doctors) ?></strong> dokter spesialisasi</p>
            </div>
			<div class="doctor-card-wrapper">
			<?php foreach ($doctors as $value):  ?>
				<div class="doctor-card">
					<div class="left">
						<div class="doctor-image">
							<img src="<?= $value->getFormattedPhoto() ?>" alt=""/>
						</div>
						<div class="doctor-focus">
							<strong>FOKUS AREA:</strong><br/>
							<span><?= $value->specialization->name ?></span>
						</div>
						<div class="doctor-schedule">
							<a href="<?= Url::toRoute(['doctor/view','id'=>$value->id]) ?> ">Lihat Jadwal</a>
						</div>
					</div>
					<div class="right">
						<div class="doctor-grey">
							<div class="doctor-name">
								<span><?= $value->name ?></span>
							</div>
							<div class="doctor-specialist">
								<span><?= $value->specialization->name ?></span>
							</div>
						</div>
						<div class="doctor-achievement">
							<?= $value->educations ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
		<!-- LINK VIEW MORE DOCTOR -->
		<div class="container-more">
			<?php if (isset($_GET['GlobalSearch']['globalSearch'])) { ?>
				<a class="more" href="<?= Url::toRoute(['search/more',
					'GlobalSearch[globalSearch]'=>$_GET['GlobalSearch']['globalSearch'],
					'category'=>'doctors'
				]) ?>">more...</a>
			<?php } ?>
		</div>
		<!-- ./LINK VIEW MORE DOCTOR -->
		<div class="doctor-card-sec">
			<h3>Artikel Klinis</h3>
			<div class="doctor-card-wrapper">
			<?php foreach ($articles as $article):  ?>
                <div class="article-box">
                    <div class="article-image">
                        <a href="<?= $article->getUrl() ?>"><img src="<?= $article->featured_image?>" alt=""/></a>
                    </div>
                    <div class="article-content">
                        <div class="article-title">
                            <a href="<?= $article->getUrl() ?>"><?= $article->title?></a>
                        </div>
                        <div class="article-desc">
                            <?= $article->excerpt ?>
                        </div>
                        <div class="article-date">
                            Post on <?= date('F j, Y', strtotime($article->created_at)); ?>
                        </div>
                    </div>
                </div>
			<?php endforeach;  ?>
			</div>
		</div>
        <!-- LINK VIEW MORE ARTICLES -->
		<div class="container-more">
			<?php if (isset($_GET['GlobalSearch']['globalSearch'])) { ?>
				<a class="more" href="<?= Url::toRoute(['search/more',
					'GlobalSearch[globalSearch]'=>$_GET['GlobalSearch']['globalSearch'],
					'category'=>'articles'
				]) ?>">more...</a>
			<?php } ?>
		</div>
		<!-- ./LINK VIEW MORE ARTICLES -->
        <?php /**
         * Ini adalah pencarian Page (halaman khusus) Sementara jangan dulu karena ada
         * halaman khusus sebetulnya adalah subpage yang tidak seharusnya bisa dibuka secara langsung.
		<div class="doctor-card-sec">
			<h3>Halaman Situs</h3>
			<div class="doctor-card-wrapper">
			<?php foreach ($pages as $value):  ?>
                <div class="page-card">
                    <h4><a href="<?= $value->getUrl() ?>"><?= $value->title ?></a></h4>
                    <span><?= $value->excerpt ?>...</span>
                </div>
			<?php endforeach; ?>
			</div>
		</div>
         * 
         */?>
        
		<?php Pjax::end(); ?>
	</div>
</section>
