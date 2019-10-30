<?php
namespace app\modules\backend\controllers;

use app\components\PostController;
use app\models\Page;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class PageController extends PostController{
	
	public function init()
	{
		parent::init();
		$this->setModelName('\app\models\Page');
	}
	
	public function indexFields() {
		return [
			[
				'class' => 'kartik\grid\CheckboxColumn',
				'width' => '20px',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'title',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'layoutText',
			],
			[
				'class'=>'\kartik\grid\DataColumn',
				'attribute'=>'publishText',
			],
			$this->getActionColumn(),

		];   
	}
	
	/**
	 * List items berdasarkan category id
	 * @param int $categoryId
	 * @return type
	 */
	public function index($categoryId)
    {    
		$modelName = $this->modelName;
		$model = new $modelName;
		
		$searchModelName = $this->searchModelName;
        $searchModel = new $searchModelName;
		
		//Ambil nilai dari inputan user
		$get = Yii::$app->request->queryParams;
		//Ambil list pages berdasarkan kategori id
		$get['PageSearch']['page_category_id'] = $categoryId;
        $dataProvider = $searchModel->search($get);
        return $this->render('index', [
			'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'categoryId'=>$categoryId,
        ]);
    }
	
	 /**
     * Creates a new model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
	  * @param int $categoryId
     * @return mixed
     */
    public function actionCreate($categoryId=Page::CAT_GENERAL)
    {
		$viewFile = '@app/components/views/post/create';
		
        $request = Yii::$app->request;
        
		$className = $this->modelName;
		$model = new $className;
		
		$model->page_category_id = $categoryId;
		
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
						'categoryId'=>$categoryId
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
						'categoryId'=>$categoryId,
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
					'categoryId'=> $categoryId
                ]);
            }
        }
       
    }
	
	public function actionOutpatient()
	{
		return $this->index(Page::CAT_OUTPATIENT);
	}
	
	public function actionInpatient()
	{
		return $this->index(Page::CAT_INPATIENT);
	}
	
	public function actionHour()
	{
		return $this->index(Page::CAT_24HOUR);
	}
	
	public function actionCentralExcellence()
	{
		return $this->index(Page::CAT_CENTRAL_EXCELLENCE);
	}
	
	public function actionFlow()
	{
		return $this->index(Page::CAT_FLOW);
	}
	
	public function actionMedical()
	{
		return $this->index(Page::CAT_MEDICAL_CHECKUP);
	}
	
	public function actionGeneral()
	{
		return $this->index(Page::CAT_GENERAL);
	}
	
	
	

}