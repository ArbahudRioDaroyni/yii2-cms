<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "career".
 *
 * @property integer $id
 * @property string $title
 * @property string $qualification
 * @property integer $career_category_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $publish
 */
class Career extends \app\components\ActiveRecord
{
	const PAGE_ID = 11;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'career';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'qualification', 'career_category_id', 'publish'], 'required'],
            [['qualification'], 'string'],
            [['career_category_id', 'created_by', 'updated_by', 'publish'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 500],
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
            'qualification' => 'Qualification',
            'career_category_id' => 'Career Category ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'publish' => 'Publish',
        ];
    }
	
	public function getCategory()
	{
		return $this->hasOne(CareerCategory::className(), ['id' => 'career_category_id']);
	}
	
	public function formFields()
	{
		return [
			[
				'name'=>'title',
				'type'=>'text',
			],
			[
				'name'=>'career_category_id',
				'type'=>'select',
				'data'=>CareerCategory::getOptions()
			],
			[
				'name'=>'qualification',
				'type'=>'richtext',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[self::STATUS_UNPUBLISH=>'Unpublish', self::STATUS_PUBLISH=>'Published']
			],
		];
	}
    
	/**
	 * Mengembalikan URL mailto sesuai nama 
	 */
	public function getMailTo($email)
	{
		return 'mailto:'.$email.'?subject=Lamar Pekerjaan | '.$this->title;
	}
    
	public function getDestinationText(){
		$destination = Lookup::get('career-destination');
		preg_match("/\[.*\]/", $destination, $final);
		$replace = $final[0];
		$replace = str_replace("[", "", $replace);
		$replace = str_replace("]", "", $replace);
		$destination = str_replace($final[0], '<a href="'.$this->getMailTo($replace).'">'.$replace.'</a>', $destination);
		
		return $destination;
	}
}
