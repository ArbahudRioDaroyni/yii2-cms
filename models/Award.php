<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "award".
 *
 * @property integer $id
 * @property integer $year
 * @property string $description
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Award extends \app\components\ActiveRecord
{
	
	public function formFields() {
		return [
			[
				'name'=>'year',
				'type'=>'text',
			],
			[
				'name'=>'description',
				'type'=>'richtext',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[Award::STATUS_UNPUBLISH=>'Unpublish', Award::STATUS_PUBLISH=>'Published']
			],
		];
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'award';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'description', 'publish'], 'required'],
            [['year', 'publish', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
