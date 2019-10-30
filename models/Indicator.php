<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indicator".
 *
 * @property integer $id
 * @property string $image
 * @property integer $order
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Indicator extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indicator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'publish', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['image'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
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
				'name'=>'image',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/indicator',
				'isImage'=>true,
				'hint'=>'Ukuran gambar optimal adalah 1026x287'
			],
			[
				'name'=>'order',
				'type'=>'text',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[Indicator::STATUS_UNPUBLISH=>'Unpublish', Indicator::STATUS_PUBLISH=>'Published']
			],
		];
	}
    
}
