<?php

namespace app\controllers;

use app\models\Event;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
	
    public function actionIndex()
	{
        $models = Event::findAllPublishedLimited();
		
        return $this->render('index', [
            'models' => $models,
        ]);
	}
	
	public function actionView($id)
	{
		$model = $this->findModel($id);
        
        return $this->render('view',['model'=>$model]);

	}

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
}