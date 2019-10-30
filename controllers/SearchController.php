<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\GlobalSearch;
/**
 * SearchController implements the CRUD actions for Search model.
 */
class SearchController extends Controller
{
	
    public function actionIndex()
	{
        $modelSearch = new GlobalSearch();
        $data = $modelSearch->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'modelSearch' => $modelSearch,
            'doctors' => $data[0]->getModels(),
            'articles' => $data[1]->getModels(),
            'pages' => $data[2]->getModels(),
        ]);
    }
    public function actionMore()
	{
        $modelSearch = new GlobalSearch();
        $data = $modelSearch->search(Yii::$app->request->queryParams);
        
        return $this->render('more', [
            'modelSearch' => $modelSearch,
            'doctors' => $data[0],
            'articles' => $data[1],
        ]);
	}
	
}