<?php
use app\models\Indicator;

$indicators = Indicator::findAllPublished();
$baseUrl = Yii::$app->request->baseUrl;
?>
<div id="indicator" class="tab-pane fade">
	<section class="indicator clearfix">
		<div class="content container indicator">
			<h3>INDIKATOR MUTU</h3>

			<?php foreach($indicators as $indicator): ?>
				<div class="row">
					<div class="box col-md-12 no-padding satu wow fadeInTop" data-wow-delay="0.5s"  data-wow-offset="200" data-wow-duration="2s">
						<img src="<?= $indicator->image ?>" />
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
</div>