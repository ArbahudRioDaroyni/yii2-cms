<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class CareerController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Career');
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
				'attribute'=>'career_category_id',
				'value'=> function($data){return $data->category->name;}
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'created_at',
			],
			$this->getActionColumn(),

		];   
	}

}