<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "career_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $publish
 */
class CareerCategory extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'career_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'publish'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['order', 'created_by', 'updated_by', 'publish'], 'integer'],
            [['name'], 'string', 'max' => 200],
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
			'order'=>'Order',
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
	
	/**
	 * Mengembalikan daftar opsi yang publish-nya true
	 */
	public static function getOptions()
	{
		$list = self::findAllPublished();
		$result = \yii\helpers\ArrayHelper::map($list, 'id', 'name');
		
		return $result;
	}
	
	/**
	 * Mengambil seluruh data lowongan yang masuk ke kategorinya.
	 */
	public function getVacancies()
	{
		return $this->hasMany(Career::className(), ['career_category_id'=>'id']);
	}
    
}
