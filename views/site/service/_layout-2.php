<div class="col-md-12 service-content layout-2 row">
	<?php if($model->hasImage()): ?>
	<div class="col-md-5 pull-right"><?= $this->render('_image',$_params_); ?></div>
	<?php endif;?>
	<div class="col-md-7" style="max-height: 520px; overflow-y: scroll;"><?= $model->content ?></div>
</div>