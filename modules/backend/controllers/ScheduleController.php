<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\Html;


class ScheduleController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Schedule');
	}
	
	/**
	 * 
	 * @param int $id ID dokter
	 * @return type
	 */
	public function actionIndex($id=null)
    {    
		if($id===null){
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
		$modelName = $this->modelName;
		$model = new $modelName;
		
		$searchModelName = $this->searchModelName;
        $searchModel = new $searchModelName;
		
		$data = Yii::$app->request->queryParams;
		$data['ScheduleSearch']['doctor_id'] = $id;
        $dataProvider = $searchModel->search($data);

        return $this->render('index', [
			'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'doctorId'=>$id,
        ]);
    }
	
	public function actionCreate($id=null)
    {
		$viewFile = '@app/components/views/post/create';
		
        $request = Yii::$app->request;
        
		$className = $this->modelName;
		$model = new $className;
		$model->doctor_id = $id;
		
		$formFields = $this->formFields();
		
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){

                return [
                    'title'=> "Create",
                    'content'=>$this->renderAjax($viewFile, [
						'formFields'=>$formFields,
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save() && $this->upload($model) ){
				
				return [
					'forceReload'=>'#crud-datatable-pjax',
					'title'=> "Create",
					'content'=>'<span class="text-success">Create success</span>',
					'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
							Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

				];         
			}else{           
				return [
					'title'=> "Create",
					'content'=>$this->renderAjax($viewFile, [
						'formFields'=>$formFields,
						'model' => $model,
					]),
					'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
								Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

				];   
			}
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save() && $this->upload($model)) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render($viewFile, [
					'formFields'=>$formFields,
                    'model' => $model,
                ]);
            }
        }
       
    }


	public function indexFields() {
		return [
			[
				'class' => 'kartik\grid\CheckboxColumn',
				'width' => '20px',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'weekday',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'start_time',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'end_time',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}

}