<?php

use yii\web\View;


/* @var $this View */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Item', 'url' => ['index']];
?>
<div class="create">

    <?= $this->render('_form', [
        'model' => $model,
		'formFields'=>$formFields,
    ]) ?>

</div>