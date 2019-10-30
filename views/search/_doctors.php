<?php
use yii\helpers\Url;
?>  

<div class="doctor-card">
    <div class="left">
        <div class="doctor-image">
            <img src="<?= $model->getFormattedPhoto() ?>" alt=""/>
        </div>
        <div class="doctor-focus">
            <strong>FOKUS AREA:</strong><br/>
            <span><?= $model->specialization->name ?></span>
        </div>
        <div class="doctor-schedule">
            <a href="<?= Url::toRoute(['doctor/view','id'=>$model->id]) ?> ">Lihat Jadwal</a>
        </div>
    </div>
    <div class="right">
        <div class="doctor-name">
            <span><?= $model->name ?></span>
        </div>
        <div class="doctor-specialist">
            <span><?= $model->specialization->name ?></span>
        </div>
        <div class="doctor-achievement">
            <?= $model->educations ?>
        </div>
    </div>
</div>