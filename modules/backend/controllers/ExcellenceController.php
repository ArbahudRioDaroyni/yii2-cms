<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class ExcellenceController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Excellence');
	}

	public function indexFields() {
		return [
			[
				'class' => 'kartik\grid\CheckboxColumn',
				'width' => '20px',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'title',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'link',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}

}