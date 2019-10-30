<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use Yii;

class MedicalCheckupCategoryController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\MedicalCheckupCategory');
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
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'order',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}
    
}