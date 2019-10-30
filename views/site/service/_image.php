<?php if($model->hasMoreImages()): ?>
	<?php $uniqid = uniqid(); ?>
		<div id="carousel-<?= $uniqid ?>" class="carousel slide visible-md visible-sm visible-xs visible-lg"> 
			<!-- Wrapper for slides -->
			<div class="carousel-inner kelas-edukasi"> 
				<?php foreach($model->getImages() as $key=>$item): ?>
				<!-- Slide -->
				<div class="item <?= ($key===0)?'active':'' ?>">
					<div class="row">
						<div class="col-xs-12 no-padding"> 
							<img src="<?= $item ?>" alt=""/>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php foreach($model->getImages() as $key=>$item): ?>
				<li data-target="#carousel-<?= $uniqid ?>" data-slide-to="<?= $key?>" <?= $key===0?'class="active"':''?>></li>
				<?php endforeach; ?>
			</ol>

		</div>
<?php else: ?>
	<?php if($model->featured_image): ?>
		<img src="<?= $model->featured_image ?>" />
	<?php endif; ?>
<?php endif; ?>





