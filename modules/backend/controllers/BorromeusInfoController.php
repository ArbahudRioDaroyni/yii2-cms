<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class BorromeusInfoController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\BorromeusInfo');
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
				'attribute'=>'value',
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
	
	public function actionIndex()
    {    
		$modelName = $this->modelName;
		$model = new $modelName;
		
		$searchModelName = $this->searchModelName;
        $searchModel = new $searchModelName;
		
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
			'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	

}