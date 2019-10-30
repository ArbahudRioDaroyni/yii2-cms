<?php
namespace app\models;

use \yii\helpers\ArrayHelper;

/**
 * This is the model class for table "specialization".
 *
 * @property integer $id
 * @property string $name
 * @property integer $publish
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Specialization extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'publish'], 'required'],
            [['publish', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','parent_id','order'], 'safe'],
            [['name'], 'string', 'max' => 250],
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
            'publish' => 'Publish',
			'parent_id' => 'Specialization',
			'order' => 'Order',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
	
	public static function findAllPublished() {
		return self::find()->where('publish = '.self::STATUS_PUBLISH)->orderBy(["parent_id"=>SORT_ASC, "order" => SORT_ASC])->all();
	}
	public static function findAllCorePublished() {
		return self::find()->where('publish = '.self::STATUS_PUBLISH. ' AND parent_id IS NULL')->all();
	}
	
	/**
	 * Fungsi mencari daftar spesialisasi dalam bentuk tree
	 * Id sebagai key, dan value sebagai kumpulan nama
	 * Formatnya seperti ini: 
	 * [ 
	 *	1 => ['name'=>Gigi],
	 *	2 => ['name'=>Bedah, 'children'=>[
	 *		3 => ['name'=>Bedah Otak]
	 *		4 => ['name'=>Bedah jantung]
	 *	]],
	 *	5 => ['name'=>Lambung],
	 * ]
	 * 
	 * Perhatian! Coding di bawah ini hanya berfungsi untuk satu level spesialisasi
	 * kalau nanti kedepannya ada lebih dari satu level, kita harus ganti cara. (Mungkin
	 * harus pakai cara rekursif)
	 */
	public static function getDataTree(){
		$all = self::findAllPublished();
		
		$result = [];
		foreach($all as $item){
			if($item->parent_id==null){
				$result[$item->id] = ['name'=>$item->name];
			}else{
				$result[$item->parent_id]['children'][] = ['name'=>$item->name,'id'=>$item->id];
			}
		}
		
		return $result;
	}
	
	/**
	 * Mengembalikan daftar opsi yang publish-nya true
	 */
	public static function getOptions()
	{
		$list = self::findAllCorePublished();
		array_unshift($list, $list[] = ['name'=>'---- Specialization ----']);
		$result = ArrayHelper::map($list, 'id', 'name');
		return $result;
	}
	
	public static function getOptionsAll()
	{
		$list = self::findAllPublished();
		array_unshift($list, $list[] = ['name'=>'---- Specialization ----']);
		$result = ArrayHelper::map($list, 'id', 'name');
		return $result;
	}

	public function formFields() {
		return [
			[
				'name'=>'name',
				'type'=>'text',
			],
			[
				'name'=>'parent_id',
				'type'=>'select',
				'data'=>Specialization::getOptions(),
				'hint'=>'Masuk ke dalam sub Spesialisasi (Kosongkan jika ini spesialisasi inti)'
			],
			[
				'name'=>'order',
				'type'=>'text',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[Doctor::STATUS_UNPUBLISH=>'Unpublish', Doctor::STATUS_PUBLISH=>'Published']
			],
		];
	}

}
