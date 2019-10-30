<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lookup".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $group
 * @property integer $order
 * @property string $type
 * @property string $params
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Lookup extends \yii\db\ActiveRecord
{
	
	const STATUS_PUBLISH = 10;
	const STATUS_UNPUBLISH = 0;
	
	//Menyimpan nilai params key saat ini
	private $_params; 
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value'], 'string'],
            [['order', 'publish', 'created_by', 'updated_by'], 'integer'],
            [['type', 'params', 'created_at', 'updated_at'], 'safe'],
            [['name', 'group'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'group' => 'Group',
            'order' => 'Order',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
	
	public static function get($field)
	{
		$item = self::find()->where(['name'=>$field])->orderBy(["order" => SORT_ASC])->one();
		if(!$item){
			return '';
		}
		return $item->value;
	}
	
	/**
	 * Menampilkan data dalam format array 
	 * agar sesuai dengan FormHelper::render()
	 */
	public static function formArray()
	{
		
		$list = self::find()->where(['publish' => self::STATUS_PUBLISH])->orderBy(["order" => SORT_ASC])->all();
		
		$result = [];
		foreach($list as $item)
		{
			$result[] = [
				'name'=>$item->name,
				'type'=>$item->type?$item->type:'text',
				'value'=>$item->value,
				'params'=>json_decode($item->params, true),
			];
		}
		
		return $result;
	}
	
	/**
	 * Mengambil informasi di field params 
	 * @param type $name
	 * @return type
	 */
	public function getFormattedParams($name)
	{
		//apakah sudah ada cache, kalau gak ada ambil sekarang.
		if(!$this->_params){
			$this->_params = json_decode($this->params, true);
		}
		
		if(!isset($this->_params[$name])){
			return null;
		}
		
		return $this->_params[$name];
	}
	
	/**
	 * Simpan file & upload
	 */
	private function upload()
	{
		$fileInstance = \yii\web\UploadedFile::getInstanceByName($this->name);
		$this->value = $fileInstance;
		
		if(empty($this->value)){
			return;
		}

		//Buat nama filerandom untuk disimpan
		$randomFilename = uniqid().time().'.'.$this->value->extension;
		$uploadFolder = $this->getFormattedParams('target');
		
		//Jika tidak ada target upload folder, biarlah kita yang set agar di folder images/lookup saja.
		if($uploadFolder===null){
			$uploadFolder = '@webroot/images/lookup';
		}
		
		$targetFilePath = Yii::getAlias($uploadFolder).'/'.$randomFilename;
		$targetFileUrl = Yii::getAlias(str_replace('@webroot', '@web', $uploadFolder)).'/'.$randomFilename;
		//Upload file
		$this->value->saveAs($targetFilePath);
			
		//save ke database
		$this->updateAttributes(['value'=>$targetFileUrl]);
	}
	
	private function processUpload()
	{
		$listFields = self::find()->where(['type'=>'file'])->all();
		foreach($listFields as $field){
			$field->upload();
		}
	}
	
	/**
	 * Menyimpan sistem secara umum
	 * @param array $post
	 */
	public function bulkSave($post)
	{
		$errors = [];
		
		foreach($post as $key=>$value)
		{
			$item = self::find()->where(['name'=>$key])->one();
			//kalau gak ada item
			if(!$item) continue;
			
			if($item->type=='file'){
				$item->upload();
			}
			
			$item->value =  $value;
			if (!$item->save()){
				//Kalau gagal save, simpan pesan error
				$errors[$key] = $item->getErrors();
			}
		}
		
		//Cek upload file
		$this->processUpload();
		
		return $errors;
	}
}
