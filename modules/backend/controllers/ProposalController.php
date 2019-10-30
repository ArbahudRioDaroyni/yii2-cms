<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use app\models\Proposal;
use yii\helpers\Url;

class ProposalController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Proposal');
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
				'attribute'=>'birth_place',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'birth_date',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'address',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'ktp',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'sex',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'married_status',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'nation',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'religion',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'last_education',
				'value'=>function($data){
					return Proposal::getEducation()[$data->last_education];
				},
				'filter'=>Proposal::getEducation(),
			],
						[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'major',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'univ_name',
			],
						[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'accreditation',
				'hidden' => true,
			],
						[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'ipk',
			],
						[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'phone',
				'hidden' => true,
			],
						[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'email',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'socmed',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'skill',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'experience',
				'hidden' => true,
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'salary_expect',
				'hidden' => true,
			],
			$this->getActionColumn(),

		];   
	}

}