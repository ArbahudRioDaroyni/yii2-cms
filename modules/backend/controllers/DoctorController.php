<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use app\models\Doctor;
use app\models\Specialization;
use yii\helpers\Url;

class DoctorController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Doctor');
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
				'label'=>'specialization',
				'attribute'=>'specialization.name',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'value'=>function($data){
					return \yii\helpers\Html::a('Schedule', ['schedule/index','id'=>$data->id]);
				},
				'format'=>'raw',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}

}