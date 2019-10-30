<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "search_keyword".
 *
 * @property integer $id
 * @property string $keyword
 * @property integer $order
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $publish
 */
class SearchKeyword extends \app\components\ActiveRecord
{
    const HOME_LIMIT = 10; //jumlah yang ditampilkan di homepage
    
    public function formFields()
    {
        return [
            [
                'name'=>'keyword',
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
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'search_keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword', 'order', 'created_at', 'created_by', 'publish'], 'required'],
            [['order', 'created_by', 'updated_by', 'publish'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['keyword'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Keyword',
            'order' => 'Order',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'publish' => 'Publish',
        ];
    }
    
    public static function findHome() {
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->orderBy(['created_at'=> SORT_DESC])->limit(self::HOME_LIMIT)->all();
	}
    
    public function resultUrl()
    {
        return \yii\helpers\Url::toRoute(['search/index','GlobalSearch[globalSearch]'=>$this->keyword]);
    }
}
