<?php
use yii\helpers\Url;
?>  

<div class="doctor-card-wrapper row">
    <div class="article-box">
        <div class="article-image">
            <a href="<?= $model->getUrl() ?>"><img src="<?= $model->featured_image?>" alt=""/></a>
        </div>
        <div class="article-content">
            <div class="article-title">
                <a href="<?= $model->getUrl() ?>"><?= $model->title?></a>
            </div>
            <div class="article-desc">
                <?= $model->excerpt ?>
            </div>
            <div class="article-date">
                Post on <?= date('F j, Y', strtotime($model->created_at)); ?>
            </div>
        </div>
    </div>
</div>