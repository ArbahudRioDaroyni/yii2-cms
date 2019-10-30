<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $layout
 * @property string $icon
 * @property string $featured_image
 * @property string $alternate_image_1
 * @property string $alternate_image_2
 * @property integer $publish
 * @property string $tags
 * @property integer $page_category_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Page extends \app\components\ActiveRecord
{
	const LAYOUT_ONE = 1; //layout gambar di atas. 
	const LAYOUT_TWO = 2; //layout gambar di kiri
	const LAYOUT_THREE = 3;  //layout gambar di kanan
	const LAYOUT_FOUR = 4;  //layout gambar di bawah
	const LAYOUT_FIVE = 5;  //layout gambar di bawah tetapi ukuran bebas tidak dibatasi
	
	const CAT_GENERAL = 1;
	const CAT_OUTPATIENT = 2;
	const CAT_INPATIENT = 3;
	const CAT_FLOW = 4;
	const CAT_24HOUR = 5;
	const CAT_MEDICAL_CHECKUP = 6;
	const CAT_CENTRAL_EXCELLENCE = 7;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }
	
	public function formFields() {
		return [
			[
				'name'=>'page_category_id',
				'type'=>'hidden',
			],
			[
				'name'=>'title',
				'type'=>'text',
			],
			[
				'name'=>'layout',
				'type'=>'select',
				'data'=>\app\models\Page::getLayoutOptions(),
				'hint'=>'Layout 1: Gambar di atas <br/>Layout 2: Gambar di kanan<br/>Layout 3: Gambar di kiri.<br/> Layout 4: Gambar di bawah<br/>Layout 5: Gambar di bawah dan berukuran bebas (tidak harus 860x400)',
			],
			[
				'name'=>'content',
				'type'=>'richtext',
				'options'=>[
					'preset' => 'full',
					'clientOptions' => ['format_tags'=>'p;h1;h2;h3;h4;h5;h6;div'],
					],
			],
			[
				'name'=>'featured_image',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/page',
				'isImage'=>true,
				'hint'=>'Ukuran gambar yang optimal adalah lebar minimal 860x400 pixel untuk Layout 1, atau 330x495 pixel untuk Layout 2 dan 3',
			],
			[
				'name'=>'alternate_image_1',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/page',
				'isImage'=>true,
				'hint'=>'Ukuran gambar yang optimal adalah lebar minimal 860x400 pixel untuk Layout 1, atau 330x495 pixel untuk Layout 2 dan 3',
			],
			[
				'name'=>'alternate_image_2',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/page',
				'isImage'=>true,
				'hint'=>'Ukuran gambar yang optimal adalah lebar minimal 890 pixel.',
			],
			[
				'name'=>'icon',
				'type'=>'file',
				'uploadFolder'=>'@webroot/images/icon',
				'isImage'=>true,
				'hint'=>'Ukuran icon yang optimal adalah 31x31 pixel.',
			],
			[
				'name'=>'order',
				'type'=>'text',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[Page::STATUS_UNPUBLISH=>'Unpublish', Page::STATUS_PUBLISH=>'Published']
			],
		];
	}


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'layout', 'publish', 'page_category_id'], 'required'],
            [['content'], 'string'],
            [['page_category_id', 'layout', 'publish', 'created_by', 'updated_by','order'], 'integer'],
			[['icon','featured_image','alternate_image_1','alternate_image_2'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],
            [['slug', 'tags', 'created_at', 'updated_at'], 'safe'],
            [['title', 'icon', 'featured_image'], 'string', 'max' => 500],
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
            'content' => 'Content',
            'layout' => 'Layout',
            'icon' => 'Icon',
            'featured_image' => 'Featured Image',
            'alternate_image_1' => 'Alternate Image 1',
            'alternate_image_2' => 'Alternate Image 2',
            'publish' => 'Publish',
			'page_category_id'=> 'Page Category',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
	
	public static function getLayoutOptions()
	{
		return [
			self::LAYOUT_ONE => 'Layout 1',
			self::LAYOUT_TWO => 'Layout 2',
			self::LAYOUT_THREE => 'Layout 3',
			self::LAYOUT_FOUR => 'Layout 4',
		];
	}
    
	public function getLayoutText()
	{
		$layoutOptions = self::getLayoutOptions();
		return isset($layoutOptions[$this->layout])?$layoutOptions[$this->layout]:'-';
	}
	
	/**
	 * Fungsi menampilkan data.
	 * @param type $category nilai kategori, kalau gak ada, berarti muncul semua.
	 */
	public static function findAllCategory($category=null)
	{
		if ($category == null){
			return self::findAllPublished();
		}
		
		return self::find()
				->where(['publish'=>self::STATUS_PUBLISH, 'page_category_id'=>$category])
				->orderBy(['order'=>SORT_ASC])
				->all();
	}
	
	public function beforeSave($insert)
	{
		if(empty($this->slug)){
			return $this->slug = $this->generateSlug();
		}
		
		return parent::beforeSave($insert);
	}
    
	
	/**
	 * Fungsi generate slug berdasarkan nama title
	 */
	public function generateSlug()
	{
		return strtolower(str_replace(' ','-', $this->title));
	}
	
	/**
	 * Menampilkan konten sesuai layout
	 * @return type
	 */
	public function getFormattedContent()
	{
		$layoutName = $this->getLayoutName();
		return Yii::$app->view->render('@app/views/site/service/'.$layoutName, ['model'=>$this]);
	}
	
	public function getLayoutName()
	{
		return '_layout-'.$this->layout;
	}
	
	public static function listServicePages()
	{
		return [
				self::CAT_OUTPATIENT,
				self::CAT_INPATIENT,
				self::CAT_FLOW,
				self::CAT_24HOUR,
				self::CAT_MEDICAL_CHECKUP,
				self::CAT_CENTRAL_EXCELLENCE,
		];
	}
	
	/**
	 * Fungsi untuk mengecek, perlukah tampilkan gambar ?
	 */
	public function hasImage()
	{
		//Sekarang rule-nya gampang, kalau gak ada featured_image, maka dianggap 
		//gak ada gambar.
		if(empty($this->featured_image)){
			return false;
		}
		return true;
	}
	
	/**
	 * Fungsi sederhana untuk mengecek apakah punya gambar lebih dari satu. 
	 * Kita ceknya di alternate_image
	 * Kalau ada value di alternate_image, maka return true. 
	 */
	public function hasMoreImages()
	{
		//Kalau featured image gak ada, langsung dianggap gak ada more image
		//biarpun dia upload dua alternate image. Featured image adalah keharusan
		if(empty($this->featured_image)){
			return false;
		}
		
		if(!empty($this->alternate_image_1)){
			return true;
		}
		
		if(!empty($this->alternate_image_2)){
			return true;
		}
		
		return false;
	}
	
	/**
	 * Mengambil gambar featured_images, alternate_image_1 dan alternate_image_2 dalam 
	 * format array biasa
	 */
	public function getImages()
	{
		$result = [];
		!empty($this->featured_image) ? $result[] = $this->featured_image : "";
		!empty($this->alternate_image_1) ? $result[] = $this->alternate_image_1 : "";
		!empty($this->alternate_image_2) ? $result[] = $this->alternate_image_2 : "";
		return $result;
	}
	
	public static function findAllPublished() {
		return self::find()
				->where(['publish' => self::STATUS_PUBLISH])
				->orderBy(['order'=>SORT_ASC])
				->all();
	}
    
    public function getExcerpt()
    {
        return substr(strip_tags($this->content), 0, 200);
    }
    
    public function getUrl()
	{
		return \yii\helpers\Url::to(['page/view','id'=>$this->id]);
	}
}
