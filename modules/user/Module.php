<?php

namespace app\modules\user;

use dektrium\user\Module as BaseModule;

/**
 * This is the main module class for the Yii2-user.
 *
 * @property array $modelMap
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Module extends BaseModule
{
	 public function init()
    {
        parent::init();

        \Yii::$app->set('view', 
			[
			'class'=> '\yii\web\View',
            'theme' => [
                'pathMap' => [
                    '@app/views' => [
                        '@app/themes/adminlte',
                        '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app',
                    ],
                ],
            ],
		]);
    }
}
