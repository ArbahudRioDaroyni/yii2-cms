<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use Yii;

class MedicalCheckupController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\MedicalCheckup');
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
				'attribute'=>'requirement',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'category_id',
				'value'=>function($data){
					return $data->category->name;
				},
				'filter'=>\app\models\MedicalCheckupCategory::getAllOptions(),
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}
    
    public function actionMedical()
    {
        $this->redirect(array('page/update?id=35'));
    }
}