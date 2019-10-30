<?php
use \app\models\Lookup;
$awards = \app\models\Award::findAllPublished();

$baseUrl = Yii::$app->request->baseUrl;
?>
<div id="awards" class="tab-pane fade">
	<section class="awards col-md-12">
		<div class="col-md-12 content awards-content">
			<div class="container">
				<div class="row">
					<div class="col-md-12 awards-detail">
						<p><?= Lookup::get('award-opening'); ?></p>
						<div class="col-md-10 col-md-offset-1 content-awards">
							<?php foreach ($awards as $key => $award): ?>
								<div class="row wow fadeIn"   data-wow-duration="2s" <?= ($key != 0) ? 'data-wow-delay="1s"' : '' ?> data-wow-offset="200">
									<div class="col-md-1">
										<img src="<?= $baseUrl?>/images/awards-icon.png" alt="">                                                                            
									</div>
									<div class="timeline-centered <?= ($key == 0) ? "first":""?> col-md-11">
										<span class="year"><?= $award->year ?></span>
										<div class="line-bottom"></div>
										<div class="timeline-entry">
											<div class="timeline-entry-inner">
												<div class="timeline-icon bg-success"></div>
												<div class="timeline-label">
													<?= $award->description ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>