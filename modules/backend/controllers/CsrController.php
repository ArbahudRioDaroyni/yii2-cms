<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class CsrController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Csr');
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
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}

}