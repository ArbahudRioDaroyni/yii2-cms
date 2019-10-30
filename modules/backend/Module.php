<?php

namespace app\modules\backend;

/**
 * backend module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\backend\controllers';

    /**
     * @inheritdoc
     */
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
