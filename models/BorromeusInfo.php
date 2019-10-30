<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "borromeus_info".
 *
 * @property integer $id
 * @property string $name
 * @property integer $order
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class BorromeusInfo extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'borromeus_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'order', 'publish','value'], 'required'],
            [['order', 'publish', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 500],
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
            'order' => 'Order',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
	public function formFields() {
		return [
			[
				'name'=>'name',
				'type'=>'text',
			],
			[
				'name'=>'value',
				'type'=>'text',
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
		return self::find()
				->where(['publish' => self::STATUS_PUBLISH])
				->orderBy(['order'=>SORT_ASC])
				->all();
	}
    
}
