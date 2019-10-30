<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slideshow".
 *
 * @property integer $id
 * @property string $title
 * @property string $caption
 * @property string $description
 * @property string $link
 * @property string $image
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Slideshow extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slideshow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'caption', 'description', 'publish'], 'required'],
            [['id', 'publish', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'caption', 'link'], 'string', 'max' => 200],
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
            'caption' => 'Caption',
            'description' => 'Description',
            'link' => 'Link',
			'image'=>'Image',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
	public function formFields()
	{
		return [
			[
				'name'=>'title',
				'type'=>'text',
			],
			[
				'name'=>'caption',
				'type'=>'text',
			],
			[
				'name'=>'description',
				'type'=>'textarea',
			],
			[
				'name'=>'link',
				'type'=>'text',
			],
			[
				'name'=>'image',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/slide',
				'isImage'=>true,
				'hint'=>'Ukuran gambar yang optimal adalah 1920x562 pixel',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[Doctor::STATUS_UNPUBLISH=>'Unpublish', Doctor::STATUS_PUBLISH=>'Published']
			],
		];
	}
    
	/**
	 * Fungsi untuk menampilkan link dari sistem
	 * @return string
	 */
	public function getLink()
	{
		if(empty($this->link)){
			return '#';
		}
		
		return $this->link;
	}
}
