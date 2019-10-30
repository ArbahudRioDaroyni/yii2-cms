<?php
$this->title = 'Kegiatan & Promosi';
use yii\helpers\Url;
?>
<section id="events">  
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
	<div class="event-container">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="patient"><span class="tebal">ST. CAROLUS KEGIATAN & PROMOSI</span></h2>
					<div class="line-bottom"></div>
				</div>
			</div>
			<div class="row">
				<?php foreach ($models as $model): ?>
				<div class="col-md-4">
					<div class="event-box">
						<div class="image">
							<a href="<?= $model->getUrl()?>"><img src="<?= $model->image ?>" alt=""/></a>
						</div>
						<div class="event-box-content">
							<div class="title">
								<a href="<?= $model->getUrl()?>"><?= $model->title ?></a>
							</div>
							<div class="date">
								Event time on <?= date('F j, Y', strtotime($model->date)); ?>
							</div>
							<a href="<?= $model->getUrl(); ?>">Baca Selengkapnya <img src="images/arrow-black.png" alt=""> </a>
						</div>
						<?php if($model->promotion): ?>
							<div class="promo-label">
								<span class="p1">Visit</span>
								<span class="p2">Now</span>
							</div>
						<?php else: ?>
							<div class="event-label">
								<span class="month"><?= strtoupper(date('M',strtotime($model->date))) ?></span>
								<span class="date"><?= date('j', strtotime($model->date)) ?></span>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="fa fa-angle-up"></span></a>
