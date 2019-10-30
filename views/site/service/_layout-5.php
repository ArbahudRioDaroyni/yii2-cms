<div class="col-md-12 service-content layout-5 row">
	<?= $model->content ?>
	
	<?php if($model->hasImage()): ?>
	<div class="full">
		<?= $this->render('_image',$_params_); ?>
	</div>
	<?php endif;?>
</div>