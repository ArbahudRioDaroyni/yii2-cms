<?php

namespace app\components;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii\db\Expression;
use app\models\User;

/**
 * Kelas active record dasar untuk semua active record yang ada
 * Semua model harus ada field publish, created_at, created_by, updated_at, updated_by
 */
abstract class ActiveRecord extends BaseActiveRecord {

	const STATUS_PUBLISH = 10;
	const STATUS_UNPUBLISH = 0;
	
	const YES = 1;
	const NO = 0;
	
	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';
	
	/**
	* Fungsi aturan render form.
	 * Cukup return array berupa nama field di model beberapa atribute.
	 * Di form dia bisa generate form field sendiri. 
	 * By default akan anggap text field. 
	 * Contoh: 
	 * return [
	 *	'name',
	 *	'category_id'=>['label'=>'Category', 'type'=>'select']
	 * ];
	*/
	public abstract function formFields();
	
	public function behaviors() {
		return [
			'timestamp' => [
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
				],
				'value' => new Expression('NOW()'),
			],
			'blameable' => [
				'class' => BlameableBehavior::className(),
				'createdByAttribute' => 'created_by',
				'updatedByAttribute' => 'updated_by',
			],
		];
	}

	/**
	 * @return ActiveQuery
	 */
	public function getCreatedBy() {
		return $this->hasOne(User::className(), ['id' => 'created_by']);
	}

	/**
	 * @return ActiveQuery
	 */
	public function getUpdatedBy() {
		return $this->hasOne(User::className(), ['id' => 'updated_by']);
	}
	
	public static function findAllPublished() {
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->all();
	}
	
	public function getPublishText() {
		return $this->publish == self::STATUS_PUBLISH ? 'Published' : 'Unpublished';
	}
	
	/**
	 * 
	 */
	public function fileRequired($attribute, $params)
	{
		var_dump($_FILES, $_POST);die('#');
	}
	
	public function beforeValidate()
	{
		//Khusus field file, sebelum validasi, harus diset dulu data file sebelumnya.
		//soalnya value dari file field belakangan akan diset secara updateAttributes. Bukan 
		//via save biasa
		$fileFields = $this->getFileFields();
		foreach($fileFields as $file)
		{
			$fieldName = $file['name'];
			$this->$fieldName = isset($this->oldAttributes[$fieldName])? $this->oldAttributes[$fieldName]:'';
		}
		
		return parent::beforeValidate();
	}
	
	/**
	 * Fungsi yang dijalankan sebelum delete record
	 */
	public function beforeDelete()
	{
		//Khusus field yang mengandung gambar, sebelum delete record, harus hapus juga filenya.
		$fileFields = $this->getFileFields();
		foreach($fileFields as $file)
		{
			$file = $file['name'];
			
			//kalau gak ada nilai, berarti gak ada file. Skip
			if(empty($file)){
				continue;
			}
			
			$targetFilePath = str_replace(Yii::getAlias('@web'), Yii::getAlias('@webroot'), $this->$file);
			@unlink($targetFilePath);
		}
		
		return parent::beforeDelete();
	}
	
	/**
	 * Fungsi untuk mengembalikan seluruh data dalam format key=>value
	 * Tujuan utama biasanya digunakan untuk menampilkan dropdown list
	 * @param int $key, nama field untuk key
	 * @param int $value nama field untuk value
	 */
	public static function getAllOptions($value='name', $key='id')
	{
		$result = self::findAllPublished();
		return \yii\helpers\ArrayHelper::map($result, $key, $value);
	}
	
	/**
	 * Fungsi sederhana untuk mengecek apakah formFields() ada yang
	 * mengandung tipe "file". Kalau ada maka return nama-nama fieldnya
	 * Kalau gak ada, maka return array kosong
	 */
	private function getFileFields()
	{
		$formFields = $this->formFields();
		$result = [];
        
		foreach($formFields as $item){
			if($item['type']=='file'){
				$result[] = [
					'name'=>$item['name'],
					'uploadFolder'=> isset($item['uploadFolder'])? $item['uploadFolder']: $this->defaultUploadFolder,
				];
			}
		}
		
		return $result;
	}

	
	/**
	 * Fungsi untuk menghasilkan url (slug, permalink)
	 * Fungsi ini membutuhkan mbstring dinyalakan di PHP.ini. Apabila karena satu hal
	 * tidak bisa menjalankan mbstring, maka solusinya ganti source code menjadi menggunakan replace_special_character.php
	 * Contoh coding lihat di bagian versi bawah
	 * @param string $str
	 * @return string
	 */
	
	public function stringToUrl($str) {
	
		if ($str !== mb_convert_encoding(mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32'))
			$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
	
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i', '`[-]+`'), '-', $str);
		$str = strtolower(trim($str, '-'));
		return $str;
	
	}
}
