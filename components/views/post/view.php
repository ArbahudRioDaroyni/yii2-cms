<?php

use app\components\FormHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model app\models\Item */
/* @var $form ActiveForm */
?>

<div class="form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->errorSummary($model, ['class' => 'callout callout-danger', 'header' => '<h4>Please fix the following errors:</h4>']) ?>

	<div class="row">
		<div class="col-md-12">
			<?php foreach ($formFields as $field): ?>
				<?= FormHelper::render($field, $form, $model, ['readonly' => 'readonly']); ?>
			<?php endforeach ?>

			<?php if (!Yii::$app->request->isAjax) { ?>
				<div class="form-group">
					<?= Html::a('Update', ['update', 'id'=>$model->id], ['class'=>'btn btn-primary']) ?>
				</div>
			<?php } ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
</div>