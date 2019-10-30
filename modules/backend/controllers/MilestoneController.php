<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class MilestoneController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Milestone');
	}
	
	public function indexFields() {
		return [
			[
				'class' => 'kartik\grid\CheckboxColumn',
				'width' => '20px',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'year',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}

}