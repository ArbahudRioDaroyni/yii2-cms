<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class SlideshowController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Slideshow');
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
				'attribute'=>'caption',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'link',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}

}