<?php 
use app\models\Csr;
$csrs = Csr::findAllPublished();
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
?>

<div id="csr" class="tab-pane in fade">
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title">
						<h3>
							CORPORATE SOCIAL RESPONSIBILITY
						</h3>
					</div>
				</div>
			</div>
			<div id="csrList">
				<ul style="list-style:none" class="list">
				<?php foreach ($csrs as $key=>$csr): ?>
				<?php //if ($key > 0) echo '<hr/>'  ?>
					<li>
					<div class="namerow row">
						<div class="col-md-6">
							<img src="<?= $csr->image ?>" class="img-responsive" width="600px" height="300px"/>
						</div>
						<div class="col-md-6" style="overflow-y: scroll;max-height: 370px;">
							<h3><?= $csr->title?></h3>
							<?= $csr->description ?>
						</div>
					</div>
					</li>
				<?php endforeach; ?>
				</ul>
				<div style="clear:both">&nbsp;</div>
				<ul class="pagination"></ul>
			</div>
		</div>
	</section>
</div>
<script src="<?= $baseUrl ?>/js/list.min.js"></script>
<script>
var monkeyList = new List('csrList', {
	valueNames: ['name'],
	page: 5,
	pagination: true
});
</script>