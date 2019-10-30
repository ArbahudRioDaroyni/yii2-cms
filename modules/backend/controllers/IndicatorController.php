<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class IndicatorController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Indicator');
	}

	public function indexFields() {
		return [
			[
				'class' => 'kartik\grid\CheckboxColumn',
				'width' => '20px',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'id',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}

}