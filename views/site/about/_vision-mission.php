<?php 
use \app\models\Lookup;
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
?>
<div id="vision" class="tab-pane in fade active">
	<section class="vision-mission">
		<div class="container">
			<div class="col-md-12 content">
				<h4>VISI</h4>
				<p><?= Lookup::get('vision'); ?></p>
			</div>
			<div class="col-md-12 content">
				<h4>MISI</h4>
				<?= Lookup::get('mission'); ?>
			</div>
		</div>
	</section>
	<section class="i-care-2 wow fadeInUp">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<span class="explanation">Nilai Keutamaan</span>
						<h4>I-CARE</h4>
					</div>
					<div class="images text-center"><img src="<?= Lookup::get('i-care-logo'); ?>" alt="I-Care Nilai Keutamaan Carolus"/></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-1">
					<div class="detail">
						<h5><?= Lookup::get('i-care-title-1'); ?></h5>
						<p>
							<?= Lookup::get('i-care-desc-1'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-2">
					<div class="detail">
						<h5><?= Lookup::get('i-care-title-2'); ?></h5>
						<p>
							<?= Lookup::get('i-care-desc-2'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-2">
					<div class="detail">
						<h5><?= Lookup::get('i-care-title-3'); ?></h5>
						<p>
							<?= Lookup::get('i-care-desc-3'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-2">
					<div class="detail">
						<h5><?= Lookup::get('i-care-title-4'); ?></h5>
						<p>
							<?= Lookup::get('i-care-desc-4'); ?>
						</p>
					</div>
				</div>
				<div class="col-md-2">
					<div class="detail">
						<h5><?= Lookup::get('i-care-title-5'); ?></h5>
						<p>
							<?= Lookup::get('i-care-desc-5'); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>