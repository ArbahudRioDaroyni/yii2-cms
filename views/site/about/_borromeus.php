<?php

use \app\models\Lookup;

$baseUrl = Yii::$app->getRequest()->getBaseUrl();
?>
<style>
	.table{
		border: 1px solid #9cc0e0; background: #d9eeff;
	}
	.table td{
		border-top: 1px solid #9cc0e0 !important;
		border-bottom: 1px solid #9cc0e0 !important;
	}
	.table tr:first-child{
		background: #bfdefa;
	}
	.white-section{
		font-size: 11px;
		padding: 40px 10px !important;
	}
	strong{
		font-size: 20px;
	}
</style>
<div id="borromeus" class="tab-pane in fade">
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<h2>
							<span class="tebal">Gedung Medik St Carolus Borromeus</span>
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="primary-image">
						<img src="<?= Lookup::get('borromeus-banner'); ?>" alt="Soft Opening Oktober 2017" class="img-responsive"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<h3><?= Lookup::get('borromeus-main-title'); ?></h3>
					<?= Lookup::get('borromeus-main-description'); ?>
				</div>
				<div class="col-md-4">
					<div class="white-section">
						<img src="../../web/images/logo4-02.png" alt="logo" />
						<table class="table">
							<tr>
								<td colspan="3"><strong>FASILITAS</strong></td>
							</tr>
							<?php 
								$borromeusInfo = app\models\BorromeusInfo::findAllPublished(); 
								foreach($borromeusInfo as $item): ?>
							<tr>
								<td><b><?= $item->name ?></b></td>
								<td>:</td>
								<td><?= $item->value ?></td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<?php for($i=1; $i<=3; $i++): ?>
				<div class="col-md-4">
					<div class="facility">
						<div class="image">
							<img src="<?= Lookup::get('borromeus-sub-image-'.$i); ?>" class="img-responsive"/>
						</div>
						<div class="text">
							<h3><?= Lookup::get('borromeus-sub-title-'.$i); ?></h3>
							<p><?= Lookup::get('borromeus-sub-description-'.$i); ?></p>
						</div>
					</div>
				</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>
</div>