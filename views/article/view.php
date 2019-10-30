<?php
use yii\helpers\Url;
$this->title = $model->title;
\Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
?>

<section id="articles">  
	<div class="container">
		<h4 class="title text-center">BERITA & ARTIKEL - KEGIATAN & PROMOSI </h4>
	</div>
	<div class="row menu-services">
		<div class="container">
			<div class="col-md-12 menu">
				<ul role="tablist" class="nav nav-tabs menu-list">
					<li class="col-md-6 active"><a href="<?= Url::to(['/article']) ?>">BERITA & ARTIKEL</a></li>
					<li class="col-md-6"><a href="<?= Url::to(['/event']) ?>">KEGIATAN &  PROMOSI </a></li>                                                               
				</ul>
			</div>
		</div>
	</div>
	<div class="article-container">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="patient"><span class="tebal">ST. CAROLUS BERITA & ARTIKEL</span></h2>
					<div class="line-bottom"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<h3 class="side-title"><span class="tebal">BERITA & ARTIKEL LAINNYA </span></h3>
					<?php foreach (\app\models\Article::getLatest() as $item): ?>
					<div class="side-article">
						<a href="<?= $item->getUrl()?>">
							<div class="title"><?= $item->title?></div>
							<div class="date"><?= date('j M Y', strtotime($item->created_at)) ?></div>
<!--							<div class="arrow">Read More <img src="images/arrow-black.png" alt=""></div>-->
						</a>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="col-md-9">
					<article class="article-content-wrapper">
						<div class="image">
							<img src="<?= $model->featured_image ?>" alt=""/>
						</div>
						<div class="detail-title">
							<h1 class="title"><?= $model->title?></h1>
							<h4 class="sub-title"><?= $model->excerpt ?></h4>
							<span class="date">Post on <?= date('d F, Y', strtotime($item->created_at)) ?></span>
						</div>
						<div class="detail-text">
							<?= $model->content ?>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</section>


	<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="fa fa-angle-up"></span></a>

