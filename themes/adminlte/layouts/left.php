<?php
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
?>
<aside class="main-sidebar">

    <section class="sidebar">
		<?= Nav::widget([
			'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
		]);
		?>

    </section>

</aside>