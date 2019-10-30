<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "milestone".
 *
 * @property integer $id
 * @property integer $year
 * @property string $image
 * @property string $description
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Milestone extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'milestone';
    }
	
	public function formFields() {
		return [
			[
				'name'=>'year',
				'type'=>'text',
			],
			[
				'name'=>'description',
				'type'=>'textarea',
			],
			[
				'name'=>'image',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/milestone',
				'isImage'=>true,
				'hint'=>'Ukuran gambar yang optimal adalah 130x93 pixel',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[self::STATUS_UNPUBLISH=>'Unpublish', self::STATUS_PUBLISH=>'Published']
			],
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'description', 'publish'], 'required'],
            [['year', 'publish', 'created_by', 'updated_by'], 'integer'],
			[['image'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['image'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'image' => 'Image',
            'description' => 'Description',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
	
	public static function findAllPublished() {
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->orderBy(['year'=> SORT_ASC])->all();
	}
    
    
}
