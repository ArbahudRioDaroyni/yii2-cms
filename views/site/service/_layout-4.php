<div class="col-md-12 service-content layout-4 row">
	<?= $model->content ?>
	
	<?php if($model->hasImage()): ?>
	<div class="top">
		<?= $this->render('_image',$_params_); ?>
	</div>
	<?php endif;?>
</div>