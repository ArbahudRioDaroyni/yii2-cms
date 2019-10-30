<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medical_checkup".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $requirement
 * @property string $description
 * @property string $price
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class MedicalCheckup extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medical_checkup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'requirement', 'description', 'price'], 'required'],
            [['publish', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['color','price', 'title', 'requirement'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'color'=>'Color',
            'category_id' => 'Category',
            'title' => 'Title',
            'requirement' => 'Requirement',
            'description' => 'Description',
            'price' => 'Price',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
	/**
	 * Daftar warna sudah fix
	 */
	public static function getColorOptions()
	{
		return [
			'' => 'Grey',
			'blue' => 'Blue',
			'red' => 'Red',

		];
	}
	
	public function formFields()
	{
		return [
			[
				'name'=>'category_id',
				'type'=>'select',
				'data'=> MedicalCheckupCategory::getAllOptions(),
			],
			[
				'name'=>'title',
				'type'=>'text',
			],
			[
				'name'=>'color',
				'type'=>'select',
				'data'=> self::getColorOptions(),
			],
			[
				'name'=>'requirement',
				'type'=>'text',
			],
			[
				'name'=>'price',
				'type'=>'text',
			],
			[
				'name'=>'description',
				'type'=>'richtext',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[self::STATUS_UNPUBLISH=>'Unpublish', self::STATUS_PUBLISH=>'Published']
			],
		];
	}
	
	public function getCategory()
	{
		return $this->hasOne(MedicalCheckupCategory::className(), ['id' => 'category_id']);
	}
    
	public static function findAllPublishedByCategory($category_id)
	{
		return self::find()->where(['publish' => self::STATUS_PUBLISH, 'category_id'=>$category_id])->all();
	}
}
