<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use yii\helpers\Url;

class FilterController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Filter');
	}

	public function indexFields() {
		return [
			[
				'class' => 'kartik\grid\CheckboxColumn',
				'width' => '20px',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'name',
			],
			$this->getActionColumn(),

		];   
	}

}