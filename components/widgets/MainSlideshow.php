<?php
namespace app\components\widgets;

use app\models\Slideshow;

class MainSlideshow extends \yii\base\Widget
{
	public function run()
	{
		$slides = Slideshow::findAllPublished();
		return $this->render('main-slideshow', ['slides'=>$slides]);
	}
}