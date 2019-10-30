<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="global-seacrh">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <p>Silahkan masukkan kata kunci yang ingin kamu cari. Contohnya "Diabetes", "Sakit kepala"
        atau apapun untuk memulai pencarian. </p>
    <?= $form->field($model, 'globalSearch')->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
