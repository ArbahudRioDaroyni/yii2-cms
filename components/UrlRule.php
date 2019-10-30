<?php

namespace app\components;

use yii\web\UrlRuleInterface;
// use yii\base\Object;
use yii\base\BaseObject;

// class UrlRule extends Object implements UrlRuleInterface {
// Change class Object to BaseObject
class UrlRule extends BaseObject implements UrlRuleInterface {

	public function createUrl($manager, $route, $params) {
		
		switch($route){
			//Untuk article, harus pakai nama slug-nya
			case 'article/view':
				$article= \app\models\Article::find()->where(['id'=>$params['id']])->one();
				if(empty($article))
					return false;
				return 'article/'.$article->link;
				
			//Untuk event/view, harus pakai nama slug-nya
			case 'event/view':
				$event= \app\models\Event::find()->where(['id'=>$params['id']])->one();
				if(empty($event))
					return false;
				return 'event/'.$event->link;
		}
		
		return false;
	}

	public function parseRequest($manager, $request) {
		$pathInfo = $request->getPathInfo();
		
		//Baca rule untuk article
		if (preg_match('%^article/([\w-]+)?$%', $pathInfo, $matches)) {
			$article = \app\models\Article::findByLink($matches[1]);
			if(empty($article)) return false;
			return ['article/view',['id'=>$article->id]];
		}
		
		//Baca rule untuk event
		if (preg_match('%^event/([\w-]+)?$%', $pathInfo, $matches)) {
			$event = \app\models\Event::findByLink($matches[1]);
			if(empty($event)) return false;
			return ['event/view',['id'=>$event->id]];
		}
		
		return false;
	}

}
