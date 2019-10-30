<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facility".
 *
 * @property integer $id
 * @property string $name
 * @property string $excerpt
 * @property string $description
 * @property string $image
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $publish
 */
class Facility extends \app\components\ActiveRecord
{
    const HOMEPAGE_TOTAL = 5;
    
    public function formFields()
    {
        return [
            [
                'name'=>'name',
                'type'=>'text'
            ],
            [
                'name'=>'excerpt',
                'type'=>'textarea',
            ],
            [
                'name'=>'description',
                'type'=>'richtext',
            ],
            [
                'name'=>'image',
                'type'=>'file',
                'isImage'=>true,
                'uploadFolder'=>'@webroot/images/facility',
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
    public static function tableName()
    {
        return 'facility';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'excerpt', 'description', 'publish'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'publish'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['excerpt'], 'string', 'max' => 500],
            [['image'], 'string', 'max' => 300],
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
            'excerpt' => 'Excerpt',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'publish' => 'Publish',
        ];
    }
    
    public static function findHome()
	{
		return self::find()->where(['publish'=>self::STATUS_PUBLISH])->limit(self::HOMEPAGE_TOTAL)->all();
	}
    
}
