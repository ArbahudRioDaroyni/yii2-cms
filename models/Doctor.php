<?php

namespace app\models;

use yii\helpers\Url;
use Yii;
use yii\db\Expression;
use app\models\Schedule;

/**
 * This is the model class for table "doctor".
 *
 * @property integer $id
 * @property string $name
 * @property string $real_name
 * @property string $initial
 * @property integer $specialization_id
 * @property string $consultation
 * @property string $photo
 * @property string $educations
 * @property string $fellowship
 * @property string $workshop
 * @property integer $publish
 * @property string $tags
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Doctor extends \app\components\ActiveRecord
{
    const MAX_OTHERS = 4; //jumlah dokter yang muncul di halaman homepage/bawah detail dokter
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'real_name', 'initial', 'publish'], 'required'],
            //[['photo'], 'fileRequired','on'=>self::SCENARIO_CREATE],
            [['photo'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],
            [['specialization_id', 'publish', 'created_by', 'updated_by'], 'integer'],
            [['educations', 'fellowship', 'workshop','description'], 'string'],
            [['tags', 'created_at', 'updated_at'], 'safe'],
            [['consultation'], 'string', 'max' => 200],
            [['name', 'real_name', 'photo'], 'string', 'max' => 250],
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
			'real_name' => 'Real Name',
            'specialization_id' => 'Specialization ID',
            'consultation'=>'Consultation',
            'photo' => 'Photo',
            'educations' => 'Educations',
            'fellowship' => 'Fellowship',
            'workshop' => 'Workshop',
            'publish' => 'Publish',
            'tags' => 'Tags',
            'description' => 'Description',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
	
	public function getSchedules()
	{
		return $this->hasMany(Schedule::className(), ['doctor_id'=>'id'])->where(['publish' => Schedule::PUBLISH])->orderBy(['weekday' => SORT_ASC]);
	}
	
	
	public function getLink()
	{
		return Url::to(['/doctor/view','id'=>$this->id]);
	}
    
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specialization_id']);
    }
    
    public function formFields() {
        return [
            [
                'name'=>'name',
                'type'=>'text',
            ],
			[
                'name'=>'real_name',
                'type'=>'text',
            ],
            [
                'name'=>'initial',
                'type'=>'text',
                'hint'=>'Inisial nama dokter. Dipakai saat mencari nama dokter secara alfabet'
            ],
            [
                'name'=>'specialization_id',
                'type'=>'select',
                'data'=>Specialization::getOptionsAll(),
            ],
            [
                'name'=>'consultation',
                'type'=>'text',
            ],
            [
                'name'=>'tags',
                'type'=>'text',
            ],
            [
                'name'=>'photo',
                'type'=>'file',
                'uploadFolder'=>'@webroot/images/doctors',
                'isImage'=>true,
                'hint'=>'Ukuran gambar optimal adalah 480x720'
            ],
            [
                'name'=>'description',
                'type'=>'richtext',
            ],
            [
                'name'=>'publish',
                'type'=>'select',
                'data'=>[Doctor::STATUS_UNPUBLISH=>'Unpublish', Doctor::STATUS_PUBLISH=>'Published']
            ],
        ];
    }
    
    /**
     * Mencari data dokter lain secara random
     * @param int $specialization kalau diisi maka hanya ambil dokter yang satu spesialisasi
     * @param int $exclude itu adalah dokter id yang ingin diexclude. 
     */
    public static function findOthers($specialization=null, $exclude=null)
    {
        $result = self::find()
                ->where('publish = '.self::STATUS_PUBLISH);
		
		if($specialization == null ){
			$uniq = self::find()->select("specialization_id")->distinct()->all();
			//SELECT DISTINCT `layout` FROM `page`
			foreach($uniq as $row){
				$result->orWhere(['specialization_id'=>$row->specialization_id]);
			}
		}
        if($specialization!==null){
            $result->andWhere(['specialization_id'=>$specialization]);
        }
        
        if($exclude!==null){
            $result->andWhere('id <> :id', [':id'=>$exclude]);
        }
        
        return $result->orderBy(new Expression('rand()'))
                ->limit(self::MAX_OTHERS)
                ->all();
    }
    
    public static function findByAlphabet($alphabet)
    {
        return self::find()->where(['publish'=>self::STATUS_PUBLISH, 'initial'=>$alphabet])->all();
    }
    
    public static function findBySpecialization($specializationId)
    {
        return self::find()->where(['publish'=>self::STATUS_PUBLISH, 'specialization_id'=>$specializationId])->all();
    }
    
    public function getNameOnly()
    {
        $docName = explode(',', $this->name); 
        $name = $docName[0];
        return $name;
    }
    
	public function getFormattedPhoto()
	{
	    if(empty($this->photo)){
	        return Url::to(['/images/doctors/default-doctor.jpg']);
	    }
	    
	    //TODO: ini hanya berlaku di server project
		//silahkan diubah saat pindah di LIVE
	    $photoPath = \Yii::$app->basePath. str_replace('carolus/dinamis/','',$this->photo);
		//untuk on live
		//$photoPath = \Yii::$app->basePath. str_replace('~projectc/carolus/','',$this->photo);

	    return file_exists($photoPath) ? $this->photo : Url::to(['/images/doctors/default-doctor.jpg']);
	}
    /**
     * Fungsi ini khusus untuk dipanggil di halaman view dokter
     * yang menampilkan jadwal praktek secara singkat.
     * @return string
     */
    public function getScheduleGroupByWeekday()
    {
        $result = [];
        foreach ($this->schedules as $schedule)
        {
                    if(empty($schedule->end_time)){
                        $result[$schedule->getWeekDayName()][] = date('H:i',strtotime($schedule->start_time)) .'-selesai';
                    }else{
                        $result[$schedule->getWeekDayName()][] = date('H:i',strtotime($schedule->start_time)) .'-'.date('H:i', strtotime($schedule->end_time));
                    }
        }
        
        return $result;
    }
    
    /**
     * Mengambil nama spesialisasi dan nama konsultasi
     * Contoh hasilnya seperti ini: 
     * Entrogastrologi - Konsultan Pencernaan Dalam
     */
    public function getReference()
    {
		$string = '';
		if($this->specialization){
			$string .= '<span class="spec">'.$this->specialization->name.'</span>';
		}
		
        if($this->consultation){
            $string .= '<span class="cons">'. $this->consultation . '</span>';
        }
        
        return $string;
    }
    
    public function getShortDescription()
    {
        return substr(strip_tags($this->educations), 0, 200).'...';
    }
	
}