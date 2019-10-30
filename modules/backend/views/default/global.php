<?php

use app\components\PlainFormHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model app\models\Item */
/* @var $form ActiveForm */
?>

<div class="form">

	<?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]);?>

	<?= $form->errorSummary($model, ['class' => 'callout callout-danger', 'header' => '<h4>Please fix the following errors:</h4>']) ?>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<tr>
					<th>Label</th>
					<th>Isi</th>
				</tr>
			<?php foreach ($formFields as $field): ?>
				<tr>
					<td><?= $field['name']; ?></td>
					<td>
						<?= PlainFormHelper::render($field, $field['value']) ?>
					</td>
				</tr>
			<?php endforeach ?>
				
			</table>
			<?php if (!Yii::$app->request->isAjax) { ?>
				<div class="form-group">
					<?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
				</div>
			<?php } ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
</div>