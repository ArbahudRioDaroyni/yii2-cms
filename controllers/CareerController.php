<?php

namespace app\controllers;

use app\models\Article;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class CareerController extends Controller
{
	
    public function actionIndex()
	{
		$categories = \app\models\CareerCategory::findAllPublished();
		$careerInfo = \app\models\Page::find()->where(['id'=>\app\models\Career::PAGE_ID])->one();
		
		return $this->render('index', [
			'categories' => $categories,
			'careerInfo'=> $careerInfo,
		]);
	}
	


    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
}