<?php

namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\rbac\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
/**
 * Kelas khusus untuk memungkinkan membuat form cukup dengan minimal coding
 * Dengan pakai ini kelas tidak perlu generate view banyak-banyak. Cukup satu kelas 
 * untuk semuanya
 * 
 */
abstract class PostController extends Controller{
	//Nama class model yang menjadi target
	private $modelName;
	private $searchModelName;
	
	public $formView='\app\components\views\form';
	public $indexView='\app\components\views\index';
	
	//Target folder by default. Kamu bisa overwrite target per field dengan cara 
	//tambah parameter 'uploadFolder' saat setting di formFields(). 
	//Harap jangan lupa pasang @webroot 
	public $defaultUploadFolder = '@webroot/upload';
	
	
	public function setModelName($modelName, $searchModelName=null)
	{
		$this->modelName = $modelName;
		if($searchModelName==null){
			$searchModelName = $modelName.'Search';
		}
		$this->searchModelName = $searchModelName;
	}
	
	public function getModelName()
	{
		return $this->modelName;
	}
	
	public function getSearchModelName()
	{
		return $this->searchModelName;
	}
	
	/**
	* Fungsi aturan render form.
	 * Field ini akan ambil dari ActiveRecord. Tapi user bisa override di level Controller. 
	 * Cukup return array berupa nama field di model beberapa atribute maka dia bisa generate sendiri. 
	 * By default akan anggap text field. 
	 * Contoh: 
	 * return [
	 *	'name',
	 *	'category_id'=>['label'=>'Category', 'type'=>'select']
	 * ];
	*/
	public function formFields()
	{
		$modelName = $this->modelName;
		$model = new $modelName;
		
		return $model->formFields();
	}
	
	
	/**
	 * Fungsi untuk render index/gridview
	 * Cukup return array berupa nama field seperti biasanya render GridView.
	 */
	abstract public function indexFields();
	
	
	
	public function actionIndex()
    {    
		$viewFile = '@app/components/views/post/index';
		
		$modelName = $this->modelName;
		$model = new $modelName;
		
		$searchModelName = $this->searchModelName;
        $searchModel = new $searchModelName;
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render($viewFile, [
			'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	 /**
     * Creates a new model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$viewFile = '@app/components/views/post/create';
		
        $request = Yii::$app->request;
        
		$className = $this->modelName;
		$model = new $className;
		
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

    /**
     * Updates an existing Item model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$updateFile = '@app/components/views/post/update';
		$viewFile = '@app/components/views/post/view';
		
        $request = Yii::$app->request;
        $model = $this->findModel($id);   
		
		$formFields = $this->formFields();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update #".$id,
                    'content'=>$this->renderAjax($updateFile, [
						'formFields'=>$formFields,
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) &&  $model->save() && $this->upload($model) ){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Update #".$id,
                    'content'=>$this->renderAjax($viewFile, [
						'formFields'=>$formFields,
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update #".$id,
                    'content'=>$this->renderAjax($updateFile, [
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
            if ($model->load($request->post()) &&  $model->save() && $this->upload($model) ) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render($updateFile, [
					'formFields'=>$formFields,
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Item model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }
	
	/**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
		$viewFile = '@app/components/views/post/view';
		$model = $this->findModel($id);

		$formFields = $this->formFields();

		$footer = Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]);
			
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "#".$id,
                    'content'=>$this->renderAjax($viewFile, [
						'formFields'=>$formFields,
                        'model' => $model,
                    ]),
					'forceReload'=>'#crud-datatable-pjax',
                    'footer'=> $footer
                ];    
        }else{
            return $this->render($viewFile, [
				'formFields'=>$formFields,
                'model' => $model,
            ]);
        }
    }
	
	/**
     * Delete multiple existing item model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }
	
	/**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
		$className = $this->modelName;
		
        if (($model = $className::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	/**
	 * Fungsi sederhana untuk mengecek apakah formFields() ada yang
	 * mengandung tipe "file". Kalau ada maka return nama-nama fieldnya
	 * Kalau gak ada, maka return array kosong
	 */
	protected function getFileFields()
	{
		$formFields = $this->formFields();
		$result = [];
		
		foreach($formFields as $item){
			if(isset($item['type']) && $item['type']=='file'){
				$result[] = [
					'name'=>$item['name'],
					'uploadFolder'=> isset($item['uploadFolder'])? $item['uploadFolder']: $this->defaultUploadFolder,
				];
			}
		}
		
		return $result;
	}
	
	/**
	 * Fungsi mengecek di dalam field apakah ada file yang diupload atau tidak
	 * Kalau ada maka melakukan upload sesuai yang telah ditentukan di formFields()
	 * Fungsi ini paling bagus dipanggil setelah eksekusi $model->save()
	 * @param ActiveRecord $model yang mau disimpan
	 * @return return nama file yang disave
	 */
	protected function upload($model)
	{
		$result = true;
		
		$listFileFields = $this->getFileFields();
		foreach($listFileFields as $item){
			$field = $item['name'];
			$uploadFolder = $item['uploadFolder'];
			
			$fileInstance = UploadedFile::getInstance($model, $field);
			if($fileInstance==null) continue;
				
			$model->$field = $fileInstance;
			
			//Buat nama filerandom untuk disimpan
			$randomFilename = uniqid().time().'.'.$model->$field->extension;
			$targetFilePath = Yii::getAlias($uploadFolder).'/'.$randomFilename;
			$targetFileUrl = Yii::getAlias(str_replace('@webroot', '@web', $uploadFolder)).'/'.$randomFilename;
			
			//Upload file
			$model->$field->saveAs($targetFilePath);
			
			//save ke database
			$model->updateAttributes([$field=>$targetFileUrl]);
		}
		
		return $result;
	}
	
	protected function getActionColumn()
	{
		return 
		[
				'class' => 'kartik\grid\ActionColumn',
						'dropdown' => false,
				'vAlign'=>'middle',
				'urlCreator' => function($action, $model, $key, $index) { 
						return Url::to([$action,'id'=>$key]);
				},
				'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
				'updateOptions'=>['title'=>'Update'],
				'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
								  'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
								  'data-request-method'=>'post',
								  'data-toggle'=>'tooltip',
								  'data-confirm-title'=>'Are you sure?',
								  'data-confirm-message'=>'Are you sure want to delete this item'], 
			];
	}
	
	public function actionDeleteImage()
    {
		$request= Yii::$app->request;
		
		//Kalau bukan POST, dilarang lanjut
		if(!$request->isPost){
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
		$modelClass = $request->post('model');
		$field = $request->post('field');
		$value = $request->post('value');
		
		$model = $modelClass::find()->where(['id'=>$value])->one();
		
		if(!$model){
			die();
		}
		
		
		//Hapus file gambar
		$filePath = Yii::getAlias('@webroot').str_replace(Yii::getAlias('@web'), '',$model->$field);
		if(is_file($filePath) && file_exists($filePath)){
			unlink($filePath);
		}
		
		//Save table
		$model->updateAttributes([$field=>'']);
        
		
        if($request->isAjax){
            
			Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
	}

}
