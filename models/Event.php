<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property string $content
 * @property string $image
 * @property integer $promotion
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Event extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'date', 'content','promotion'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['content'], 'string'],
            [['link'], 'unique'],
            [['publish', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['link','image'], 'string', 'max' => 250],
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
            'date' => 'Date',
            'content' => 'Content',
            'image' => 'Image',
            'promotion' => 'Promotion',
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
				'name'=>'link',
				'type'=>'text',
			],
			[
				'name'=>'content',
				'type'=>'richtext',
			],
			[
				'name'=>'date',
				'type'=>'datepicker',
			],
			[
				'name'=>'promotion',
				'type'=>'select',
				'data'=>[self::YES=>'Ya', self::NO=>'Tidak']
			],
			[
				'name'=>'image',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/events',
				'isImage'=>true,
				'hint'=>'Ukuran gambar optimal adalah 825x579'
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[self::STATUS_UNPUBLISH=>'Unpublish', self::STATUS_PUBLISH=>'Published']
			],
		];
	}
	
	public static function findAllPublish()
	{
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->orderBy(['date'=> SORT_ASC])->all();
	}
	
	public static function findAllPublishedLimited() {
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->limit(6)->orderBy(['id'=> SORT_DESC])->all();
	}
	
	/**
	 * Tampilkan untuk halaman home
     * $promo artinya hanya ambil yang statusnya promo
	 */
	public static function findHome($promo = false)
	{
        if($promo==false){
            return self::find()->where(['publish' => self::STATUS_PUBLISH, 'promotion'=>self::NO])->orderBy(['date'=> SORT_ASC])->one();
        }else if ($promo==true){
            return self::find()->where(['publish' => self::STATUS_PUBLISH, 'promotion'=>self::YES])->orderBy(['date'=> SORT_ASC])->one();
        }
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
		return \yii\helpers\Url::to(['event/view','id'=>$this->id]);
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
		return self::find()->where(['publish' => self::STATUS_PUBLISH])->limit(3)->orderBy(['date' => SORT_ASC])->all();
	}
	
	public function beforeSave($insert)
	{
		$this->link = strtolower($this->link);
		$this->link = str_replace(" ", "-", $this->link);
		
		return parent::beforeSave($insert);
	}
    
    public function getExcerpt()
    {
        $string = strip_tags($this->content);
        $desiredWidth = 50;
        
        $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
        $parts_count = count($parts);

        $length = 0;
        $last_part = 0;
        for (; $last_part < $parts_count; ++$last_part) {
            $length += strlen($parts[$last_part]);
            if ($length > $desiredWidth) {
                break;
            }
        }

        return implode(array_slice($parts, 0, $last_part));
    }
}
