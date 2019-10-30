<?php

namespace app\controllers;

use app\models\Article;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
	
    public function actionIndex()
	{
		$searchModel = new \app\models\ArticleSearch();
		$dataProvider = $searchModel->searchActive();

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}
	
	public function actionView($id)
	{
		$model = $this->findModel($id);
        
        return $this->render('view',['model'=>$model]);

	}
	
	/**
	 * Mencari daftar artikel berdasarkan list kata kunci yang diinput
	 * @param string $keyword
	 * @return dataProvider
	 */
	public function actionSearch($keyword)
	{
		$searchModel = new \app\models\ArticleSearch();
		$dataProvider = $searchModel->searchKeyword($keyword);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
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