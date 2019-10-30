<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medical_checkup_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $photo
 * @property string $description
 * @property integer $order
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $publish
 */
class MedicalCheckupCategory extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medical_checkup_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'order', 'publish'], 'required'],
            [['description'], 'string'],
            [['order', 'created_by', 'updated_by', 'publish'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'photo'], 'string', 'max' => 200],
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
            'photo' => 'Photo',
            'description' => 'Description',
            'order' => 'Order',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'publish' => 'Publish',
        ];
    }
	
	public function formFields()
	{
		return [
			[
				'name'=>'name',
				'type'=>'text',
			],
			[
				'name'=>'photo',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/mcu',
				'isImage'=>true,
				'hint'=>'Ukuran gambar optimal adalah 700x300'
			],
			[
				'name'=>'description',
				'type'=>'richtext',
			],
			[
				'name'=>'order',
				'type'=>'text',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[self::STATUS_UNPUBLISH=>'Unpublish', self::STATUS_PUBLISH=>'Published']
			],
		];
	}
    
	public static function findAllPublished() {
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->orderBy(['order'=>SORT_ASC])->all();
	}
    
}
