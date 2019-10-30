<div class="col-md-12 service-content layout-1" >
	<?php if($model->hasImage()): ?>
	<div>
		<?= $this->render('_image',$_params_); ?>
	</div>
	<?php endif; ?>
	<?= $model->content ?>
</div>