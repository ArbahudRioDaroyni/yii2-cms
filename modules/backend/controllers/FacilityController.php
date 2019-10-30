<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use yii\helpers\Url;

class FacilityController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Facility');
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
				'attribute'=>'excerpt',
			],
			$this->getActionColumn(),

		];   
	}

}