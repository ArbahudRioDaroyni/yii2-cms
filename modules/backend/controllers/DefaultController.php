<?php

namespace app\modules\backend\controllers;

use app\models\Lookup;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	/**
	 * Daftar lookup untuk menampilkan daftar
	 */
	public function actionGlobal()
	{
		$model = new Lookup;
		
		if ($post = Yii::$app->request->post()){
			$model->bulkSave($post);
		} 
		
		$formFields = Lookup::formArray();
		return $this->render('global', ['formFields'=>$formFields, 'model'=>$model]);
	}
}
