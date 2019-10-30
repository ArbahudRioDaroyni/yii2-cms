<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "proposal".
 *
 * @property string $id
 * @property string $name
 * @property string $birth_place
 * @property string $birth_date
 * @property string $address
 * @property string $ktp
 * @property integer $sex
 * @property integer $married_status
 * @property integer $nation
 * @property integer $religion
 * @property integer $last_education
 * @property string $major
 * @property string $univ_name
 * @property string $accreditation
 * @property string $ipk
 * @property string $phone
 * @property string $email
 * @property string $socmed
 * @property string $skill
 * @property string $experience
 * @property string $salary_expect
 * @property string $diploma_file
 * @property string $transcript_file
 * @property string $ktp_file
 * @property string $photo
 */
class Proposal extends ActiveRecord
{
    /**
     * @inheritdoc
     */
	
	const	MARIED_STATUS_YES = 1,
			MARIED_STATUS_YES_TEXT = "Sudah Menikah",
			MARIED_STATUS_NO = 0,
			MARIED_STATUS_NO_TEXT = "Belum Menikah";
	
	const	NATION_STATUS_WNI = 1,
			NATION_STATUS_WNI_TEXT = "WNI",
			NATION_STATUS_WNA = 2,
			NATION_STATUS_WNA_TEXT = "WNA";
	
	CONST	SEX_STATUS_MEN = 1,
			SEX_STATUS_MEN_TEXT = "Laki-laki",
			SEX_STATUS_WOMEN = 2,
			SEX_STATUS_WOMEN_TEXT = "Perempuan";
	
	CONST	REGION_STATUS_ISLAM = 1,
			REGION_STATUS_ISLAM_TEXT = "Islam",
			REGION_STATUS_KRISTEN = 2,
			REGION_STATUS_KRISTEN_TEXT = "Kristen",
			REGION_STATUS_KATOLIK = 3,
			REGION_STATUS_KATOLIK_TEXT = "Katolik",
			REGION_STATUS_HINDU = 4,
			REGION_STATUS_HINDU_TEXT = "Hindu",
			REGION_STATUS_BUDDHA = 5,
			REGION_STATUS_BUDDHA_TEXT = "Buddha",
			REGION_STATUS_KONGHUCU = 6,
			REGION_STATUS_KONGHUCU_TEXT = "Konghucu";
	
	CONST	REGION_STATUS_SMA = 3,
			REGION_STATUS_SMA_TEXT = "Sekolah Menengah Atas/Sekolah Menengah Kejuruan",
			REGION_STATUS_D3 = 4,
			REGION_STATUS_D3_TEXT = "Diploma",
			REGION_STATUS_S1 = 5,
			REGION_STATUS_S1_TEXT = "Sarjana S1",
			REGION_STATUS_S2 = 6,
			REGION_STATUS_S2_TEXT = "Magister S2",
			REGION_STATUS_S3 = 7,
			REGION_STATUS_S3_TEXT = "Doktor S3";
    
    CONST   ACCREDITATION_A = 'A',
            ACCREDITATION_B = 'B';
	
    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'skill', 'experience'], 'string'],
            [['sex', 'married_status', 'nation', 'religion', 'last_education'], 'integer'],
			[['name','sex','married_status','nation','religion','last_education','birth_place','birth_date','ktp','major','univ_name','accreditation','phone'],'required'],
            [['salary_expect'], 'number'],
            [['name', 'socmed'], 'string', 'max' => 100],
            [['birth_place', 'birth_date', 'ktp', 'major', 'univ_name', 'accreditation', 'ipk', 'phone', 'email', 'height', 'weight'], 'string', 'max' => 100],
			[['diploma_file', 'transcript_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, doc, jpg, png, bmp', 'maxSize'=>1024 * 1024 * 2],
			[['ktp_file', 'photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'mimeTypes' => 'image/jpeg, image/png', 'maxSize'=>1024 * 1024 * 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama Lengkap',
            'birth_place' => 'Tempat Lahir',
            'birth_date' => 'Tanggal Lahir',
            'height' => 'Tinggi Badan (cm)',
            'weight' => 'Berat Badan (kg)',
            'address' => 'Alamat Domisili',
            'ktp' => 'Nomor KTP',
            'sex' => 'Jenis Kelamin',
            'married_status' => 'Status Menikah',
            'nation' => 'Kewarganegaraan',
            'religion' => 'Agama',
            'last_education' => 'Pendidikan Terakhir',
            'major' => 'Jurusan',
            'univ_name' => 'Nama Sekolah/Universitas',
            'accreditation' => 'Akreditasi',
            'ipk' => 'IPK',
            'phone' => 'Nomor Telepon',
            'email' => 'E-mail',
            'socmed' => 'Sosial Media (Link Facebook atau Twitter)',
            'skill' => 'Kemampuan/Kursus',
            'experience' => 'Pengalaman Kerja',
            'salary_expect' => 'Pendapatan yang diharapkan (dalam Rp)',
            'diploma_file' => 'Ijazah',
            'transcript_file' => 'Transkrip Nilai',
            'ktp_file' => 'KTP',
            'photo' => 'Pas Foto',
        ];
    }

	public function formFields() {
		return [
            [
                'name'=>'name',
                'type'=>'text',
            ],
            [
                'name'=>'birth_place',
                'type'=>'text',
            ],
			[
                'name'=>'birth_date',
                'type'=>'text',
            ],
			[
                'name'=>'height',
                'type'=>'text',
            ],
			[
                'name'=>'weight',
                'type'=>'text',
            ],
			[
                'name'=>'address',
                'type'=>'text',
            ],
			[
                'name'=>'ktp',
                'type'=>'text',
            ],
			[
                'name'=>'sex',
				'type'=>'select',
                'data'=>[Proposal::getSex()]
            ],
			[
                'name'=>'married_status',
                'type'=>'select',
                'data'=>[Proposal::getStatusMaried()]
            ],
			[
                'name'=>'nation',
                'type'=>'select',
                'data'=>[Proposal::getStatusNation()]
            ],
			[
                'name'=>'religion',
                'type'=>'select',
                'data'=>[Proposal::getReligion()]
            ],
			[
                'name'=>'last_education',
                'type'=>'select',
                'data'=>[Proposal::getEducation()]
            ],
			[
                'name'=>'major',
                'type'=>'text',
            ],
			[
                'name'=>'univ_name',
                'type'=>'text',
            ],
			[
                'name'=>'accreditation',
                'type'=>'text',
            ],
			[
                'name'=>'ipk',
                'type'=>'text',
            ],
			
            [
                'name'=>'phone',
                'type'=>'text',
            ],
            [
                'name'=>'email',
                'type'=>'text',
            ],
			[
                'name'=>'socmed',
                'type'=>'text',
            ],
			[
                'name'=>'skill',
                'type'=>'textarea',
            ],
			[
                'name'=>'experience',
                'type'=>'textarea',
            ],
			[
                'name'=>'salary_expect',
                'type'=>'text',
            ],
			[
                'name'=>'diploma_file',
                'type'=>'file',
                'uploadFolder'=>'@webroot/images/upload',
                'isImage'=>false,
                'hint'=>'PDF Ijazah'
            ],
			[
                'name'=>'transcript_file',
                'type'=>'file',
                'uploadFolder'=>'@webroot/images/upload',
                'isImage'=>false,
                'hint'=>'PDF Transkrip Nilai'
            ],
			[
                'name'=>'ktp_file',
                'type'=>'file',
                'uploadFolder'=>'@webroot/images/upload',
                'isImage'=>true,
                'hint'=>'Foto KTP pelamar'
            ],
			[
                'name'=>'photo',
                'type'=>'file',
                'uploadFolder'=>'@webroot/images/upload',
                'isImage'=>true,
                'hint'=>'Foto Pelamar'
            ],
        ];
	}
    
    public function beforeSave($insert) 
    {
        if(!empty($this->birth_date))
        {
            $this->birth_date = date('Y-m-d', strtotime($this->birth_date));
        }
        
        return parent::beforeSave($insert);
    }
	
	public static function getStatusMaried(){
		return[
			self::MARIED_STATUS_YES => self::MARIED_STATUS_YES_TEXT,
			self::MARIED_STATUS_NO => self::MARIED_STATUS_NO_TEXT,
		];
	}
	
	public static function getStatusNation(){
		return[
			self::NATION_STATUS_WNI => self::NATION_STATUS_WNI_TEXT,
			self::NATION_STATUS_WNA => self::NATION_STATUS_WNA_TEXT,
		];
	}
	
	public static function getSex(){
		return[
			self::SEX_STATUS_MEN => self::SEX_STATUS_MEN_TEXT,
			self::SEX_STATUS_WOMEN => self::SEX_STATUS_WOMEN_TEXT,
		];
	}
	
	public static function getReligion(){
		return[
			self::REGION_STATUS_ISLAM => self::REGION_STATUS_ISLAM_TEXT,
			self::REGION_STATUS_KRISTEN => self::REGION_STATUS_KRISTEN_TEXT,
			self::REGION_STATUS_KATOLIK => self::REGION_STATUS_KATOLIK_TEXT,
			self::REGION_STATUS_HINDU => self::REGION_STATUS_HINDU_TEXT,
			self::REGION_STATUS_BUDDHA => self::REGION_STATUS_BUDDHA_TEXT,
			self::REGION_STATUS_KONGHUCU => self::REGION_STATUS_KONGHUCU_TEXT,
		];
	}
	public static function getEducation(){
		return[
			self::REGION_STATUS_SMA => self::REGION_STATUS_SMA_TEXT,
			self::REGION_STATUS_D3 => self::REGION_STATUS_D3_TEXT,
			self::REGION_STATUS_S1 => self::REGION_STATUS_S1_TEXT,
			self::REGION_STATUS_S2 => self::REGION_STATUS_S2_TEXT,
			self::REGION_STATUS_S3 => self::REGION_STATUS_S3_TEXT,

		];
	}
	public static function getAccreditation(){
		return[
            self::ACCREDITATION_A => 'A',
            self::ACCREDITATION_B => 'B',
		];
	}
	public function getCategory()
	{
		return $this->hasOne(CareerCategory::className(), ['id' => 'career_category_id']);
	}
    
    public function uploadSave($field)
    {
        if($this->validate())
        {
            if(!empty($this->$field))
            {   
                $this->$field->saveAs('images/upload/' . $this->$field->baseName . ' ' . date('is') . '.' . $this->$field->extension, false);
                $this->$field->name = Url::to('@web/images/upload/') . $this->$field->baseName . ' ' . date('is') . '.'. $this->$field->extension;                
                $this->save();
            }
        }
        else{
            return false;
        }
    }
    
    public function allField()
    {
        $allField = ['diploma_file', 'transcript_file', 'ktp_file', 'photo'];
        
        return $allField;
    }
    
    public function uploadField()
    {
        $allField = $this->allField();
        
        foreach($allField as $field)
        {
            $this->$field = UploadedFile::getInstance($this, $field);
            $this->uploadSave($field);                
        }                    
    }
    
    public function checkFieldUploaded()
    {
        $allField = $this->allField();
        
        foreach($allField as $field)
        {
            if(!empty($this['original'][$field]) && empty($this->$field))
            {
                $this->$field = $this['original'][$field];
                $this->save();
            }                
        }         
    }
    
    public function sendMail()
    {
        Yii::$app->mailer->compose()
        ->setFrom('no-reply@carolus.or.id')
        ->setTo(Yii::$app->params['hrEmail'])
        ->setSubject('Pelamar Baru')
        ->setHtmlBody('Hi Admin, <br /><br /> Anda memiliki satu pelamar baru silahkan buka sistem kami atau klik <a href="'.Url::toRoute('/backend/proposal/index', true).'">disini</a>')
        ->send();
    }
    
}
