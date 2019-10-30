<?php
namespace app\modules\backend\controllers;

use app\components\PostController;

class TestimonialController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Testimonial');
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
				'attribute'=>'content',
			],
			$this->getActionColumn(),

		];   
	}

}