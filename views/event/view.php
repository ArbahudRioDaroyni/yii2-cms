<?php

use yii\helpers\Html;
use yeesoft\lightbox\Lightbox;
use yii\helpers\Url;
$this->title = $model->title;
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
?>
<section id="articles">  
	<div class="container">
		<h4 class="title text-center">KEGIATAN & PROMOSI</h4>
	</div>
	<div class="row menu-services">
		<div class="container">
			<div class="col-md-12 menu">
				<ul role="tablist" class="nav nav-tabs menu-list">
					<li class="col-md-6"><a href="<?= Url::to(['/article']) ?>">BERITA & ARTIKEL</a></li>
					<li class="col-md-6 active"><a href="<?= Url::to(['/event']) ?>">KEGIATAN & PROMOSI</a></li>                                                               
				</ul>
			</div>
		</div>
	</div>
	<div class="article-container">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="patient"><span class="tebal">ST. CAROLUS KEGIATAN & PROMOSI</span></h2>
					<div class="line-bottom"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<h3 class="side-title"><span class="tebal">KEGIATAN & PROMOSI LAINNYA</span></h3>
					<?php foreach (app\models\Event::getLatest() as $item): ?>
					<div class="side-event">
						<a href="<?= $item->getUrl() ?>">
							<div class="label">
								<span class="month"><?= strtoupper(date('M',strtotime($item->date))) ?></span>
								<span class="date"><?= date('j', strtotime($item->date)) ?></span>
							</div>
							<div class="title"><?= $item->title ?></div>
							<div class="arrow">Baca Selengkapnya</div>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="col-md-9">
					<article class="article-content-wrapper">
						<?= Lightbox::widget([
                            'options' => [
                                'fadeDuration' => '2000',
                            ],
                            'imageOptions' => ['style' => 'width: 100%'],
                            'items' => [
                                [
                                    'thumb' => $model->image,
                                    'image' => $model->image,
                                    'title' => $model->title,
                                ],
                            ],
                        ]);
						?>
						<div class="detail-title">
							<h2 class="title"><?= $model->title?> </h2>
							<span class="date">Post on <?= date('F d, Y', strtotime($model->date)) ?></span>
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

