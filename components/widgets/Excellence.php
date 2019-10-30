<?php
namespace app\components\widgets;

use app\models\Excellence as ExcellenceModel;

class Excellence extends \yii\base\Widget
{
	public function run()
	{
		$items = ExcellenceModel::findAllPublished();
		return $this->render('excellence', ['items'=>$items]);
	}
}