<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use app\models\Doctor;
use app\models\Specialization;
use yii\helpers\Url;

class ArticleController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Article');
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
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'created_at',
			],
			$this->getActionColumn(),

		];   
	}

}