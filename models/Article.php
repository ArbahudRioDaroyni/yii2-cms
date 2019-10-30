<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $excerpt
 * @property string $content
 * @property string $featured_image
 * @property integer $publish
 * @property string $tags
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Article extends \app\components\ActiveRecord
{
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
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
				'hint'=>'Mohon isi dengan huruf kecil dan pakai tanda setrip untuk pemisah. Contoh: seminar-tentang-demam',
			],
			[
				'name'=>'excerpt',
				'type'=>'textarea',
			],
                        [
                                'name'=>'meta_description',
				'type'=>'textarea',
                        ],
			[
				'name'=>'content',
				'type'=>'richtext',
			],
			[
				'name'=>'featured_image',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/article',
				'isImage'=>true,
				'hint'=>'Ukuran gambar optimal 1066 x 720 pixel'
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
            [['title', 'content'], 'required'],
            [['content','meta_description'], 'string'],
            [['link'], 'unique'],
            [['publish', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'excerpt'], 'string', 'max' => 500],
            [['link', 'featured_image'], 'string', 'max' => 200],
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
            'featured_image' => 'Featured Image',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
	public static function findAllPublished() {
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->orderBy(['created_at'=> SORT_DESC])->all();
	}
	
	public static function findHome() {
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->orderBy(['created_at'=> SORT_DESC])->one();
	}
    
	public function beforeValidate()
	{
		//Kalau link kosong, harus dikasih slug sendiri
		if(empty($this->link)){
			$this->link = $this->stringToUrl($this->title);
		}
		
		return parent::beforeValidate();
	}

	public function getUrl()
	{
		return \yii\helpers\Url::to(['article/view','id'=>$this->id]);
	}
	
	/**
	 * Mencari suatu model berdasarkan link yang dikasih
	 * @param type $link
	 */
	public static function findByLink($link)
	{
		$model = self::find()->where(['link'=>$link])->one();
		return $model;
	}
	
	public static function getLatest()
	{
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->limit(5)->orderBy(['id' => SORT_DESC])->all();
	}
	
	public function beforeSave($insert)
	{
		$this->link = strtolower($this->link);
		$this->link = str_replace(" ", "-", $this->link);
		
		return parent::beforeSave($insert);
	}
}
