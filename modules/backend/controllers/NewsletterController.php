<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use app\models\Doctor;
use app\models\Specialization;
use yii\helpers\Url;

class NewsletterController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Newsletter');
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
				'attribute'=>'email',
			],
			$this->getActionColumn(),

		];   
	}

}