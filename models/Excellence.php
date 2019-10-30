<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "excellence".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $excerpt
 * @property string $content
 * @property string $icon
 * @property string $icon_hover
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Excellence extends \app\components\ActiveRecord
{
	//Jumlah excellence yang ditampilkan di homepage
	const HOMEPAGE_TOTAL = 4;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'excellence';
    }

	
	public function formFields()
	{
		return [
			[
				'name'=>'title',
				'type'=>'text',
			],
			[
				'name'=>'link',
				'type'=>'text',
			],
			[
				'name'=>'excerpt',
				'type'=>'textarea',
			],
			[
				'name'=>'content',
				'type'=>'richtext',
			],
			[
				'name'=>'icon',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/excellence',
				'isImage'=>true,
				'hint'=>'Ukuran gambar yang optimal adalah 49x49 pixel',
			],
			[
				'name'=>'icon_hover',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/excellence',
				'isImage'=>true,
				'hint'=>'Ukuran gambar yang optimal adalah 49x49 pixel',
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
            [['title', 'content', 'publish'], 'required'],
            [['content'], 'string'],
            [['publish', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'link', 'icon', 'icon_hover'], 'string', 'max' => 200],
            [['excerpt'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'link' => 'Link',
            'excerpt' => 'Excerpt',
            'content' => 'Content',
            'icon' => 'Icon',
            'icon_hover' => 'Icon Hover',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
	public function getLink()
	{
		return $this->link;
	}
	
	public static function findHomepage()
	{
		return self::find()->where(['publish'=>self::STATUS_PUBLISH])->limit(self::HOMEPAGE_TOTAL)->all();
	}
}
