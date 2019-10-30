<?php
    use yii\helpers\Url;
    use app\models\Lookup;
?>
<footer>
    <div class="container">
        <div class="first row align-items-center">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="address">
                    <p>
                        Rumah Sakit St. Carolus<br/>
                        <?= Lookup::get('address'); ?><br/>
                        <?= Lookup::get('phone-number'); ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4 find-us col-sm-4 col-xs-12">
                <ul class="socmed">
                    <li><span>FIND US</span></li>
                    <li class="socmed-icon"><a href="<?= Lookup::get('facebook-link'); ?>"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="socmed-icon"><a href="<?= Lookup::get('twitter-link'); ?>"><i class="fab fa-twitter"></i></a></li>
                    <li class="socmed-icon"><a href="<?= Lookup::get('instagram-link'); ?>"><i class="fab fa-instagram"></i></a></li>
                    <li class="socmed-icon"><a href="<?= Lookup::get('youtube-link'); ?>"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4 terms col-sm-4 col-xs-12">
                <ul class="terms">
                    <li><a href="<?= Url::to(['page/terms-condition']); ?>">Terms & Condition</a></li>
                    <li><a href="<?= Url::to(['site/sitemap']); ?>">Site Map</a></li>
                </ul>
            </div>
        </div>
        <div class="second row">
            <div class="col-md-6 col-sm-6 col-xs-12 copyright offset-sm-3">
                <p>Copyright <?= date('Y'); ?>. St.Carolus Hospital. All Rights Reserved.</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 powered">
                <p>Powered by <a target="_blank" href="<?= Yii::$app->params['copyrightLink'] ?>"><?= Yii::$app->params['copyright'] ?></a></p>
            </div>
        </div>
    </div>
</footer>