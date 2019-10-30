<section id="centrall-of-excellence" class="centrall-of-excellence">
	<div class="container">
		<div class="col-md-12 excellence">
			<h2 class="patient wow fadeInUp" data-wow-offset="100" data-wow-duration="2s"><span class="tebal">Layanan Unggulan</span></h2>
			<?php foreach (app\models\Excellence::findHomepage() as $item): ?>
			<!-- content -->
			<div class="col-md-4 col-sm-6 no-padding content wow fadeInUp"  data-wow-offset="100" data-wow-duration="1s"  data-wow-delay="0.2s">
				<div class="title-img ex<?= $item->id ?>">
					<h4><?= $item->title?></h4>
				</div>
				<p><?= $item->excerpt; ?></p>
				<a href="<?= $item->getLink(); ?>">Baca Selengkapnya</a>
			</div>
			<style>
				.title-img.ex<?= $item->id ?> {
					background-image: url('<?= $item->icon ?>');
				}
				.content:hover .title-img.ex<?= $item->id ?>{
					background-image: url('<?= $item->icon_hover ?>');
				}
			</style>
			<!-- end content -->
			<?php endforeach; ?>		
			<div class="col-md-4 col-sm-6 no-padding content wow fadeInUp"  data-wow-offset="100" data-wow-duration="1s"  data-wow-delay="0.2s">
				<div class="title-img last">
					<h4>Layanan Unggulan Lainnya</h4>
				</div>
				<p>&nbsp;</p>
				<a href="<?= \yii\helpers\Url::to(['site/service']) ?>#excellence">Baca Selengkapnya</a>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(function() {
		var images = [
				<?php foreach (app\models\Excellence::findAllPublished() as $item): //looping guna hover image ke-load ?>
				'<?= $item->icon_hover ?>',
				<?php endforeach; ?>
				''//buat gak error saja
			];
		var d = document.createElement("div");
		d.style.display = 'none';
		document.body.appendChild(d);
		for (var i in images)
		{
			var img = document.createElement("img");
			img.src = images[i];
			d.appendChild(img);
		}
	});
</script>