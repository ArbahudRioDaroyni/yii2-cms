<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property string $id
 * @property string $doctor_id
 * @property integer $weekday
 * @property string $start_time
 * @property string $end_time
 * @property string $notes
 * @property integer $publish
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Schedule extends \app\components\ActiveRecord
{
	const WEEKDAY_MONDAY = 1; //Senin dimulai dari angka 1
	
	const NOON_LIMIT = 12;  //batas shift di jam 12. Jadi 13 dan keatas adalah shift malam
	
	//Shift doctor hanya ada 2.
	const SHIFT_MORNING = 0;
	const SHIFT_NIGHT = 1;
	const TYPE_UMUM = 10;
	const TYPE_BPJS = 20;
	const TYPE_UMUM_BPJS = 30;
	const PUBLISH = 10;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'weekday', 'start_time', 'publish'], 'required'],
            [['doctor_id', 'weekday', 'publish', 'created_at', 'created_by', 'updated_at', 'updated_by','type'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['notes'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_id' => 'Doctor ID',
            'weekday' => 'Weekday',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'notes' => 'Notes',
			'type' => 'Type',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
        
    public static function listSchedule($doctorId)
    {
        $schedule = Schedule::find()->where(['doctor_id'=>$doctorId, 'publish' => Schedule::PUBLISH])->orderBy(['weekday'=>SORT_ASC, 'start_time'=>SORT_ASC])->all();
        $arr=[];
        
        for($i=1;$i<=6;$i++)
        {
            $arr[$i]='';
        }
        
		//Sebagai info, diatas jam 12 dianggap shift pagi, dan di bawah 12 dianggap shift malam.
		//kadang kala ada kemungkinan satu shift yang sama bisa sampai dua.
		//Kalau sudah begitu, mending shift yang padat itu kita pindahkan dia ke shift lain yang kosong saja. 
		//Contohnya ada dua jam di shift pagi. Maka mending pindahkan jam yang lebih siang ke shift malam
		//atau sebaliknya di shift malam ada dua jadwal. Mending satu shift yang pagian kita pindahkan ke shift pagi saja
		//soalnya kalau gak dipindahkan, jadi gak muncul jadwalnya. kalau kejadian dua jam di satu shift yang sama.
		
		//tampilkan dulu normalnya.
        foreach($schedule as $data)
        {
			$weekday = $data['weekday'];
			$arr[$weekday] = [
                'start'=>$data['start_time'],
                'end'=>$data['end_time'], 
                'notes'=>$data['notes'],
                'weekday'=>$data->getWeekDayName(),
                'type'=>$data['type'],
            ];
        }

		//looping satu per satu hari. 
		//Kalau $arr cuman ada satu, dan dia di shift malam, maka pindahkan ke shift malam saja.
		for($weekday=1; $weekday<=6; $weekday++){
			if(is_array($arr[$weekday]) && count($arr[$weekday])==1){
				if ($arr[$weekday][0]['start'] > self::NOON_LIMIT){
					$arr[$weekday][self::SHIFT_NIGHT] = $arr[$weekday][0];
					unset($arr[$weekday][0]);//hilangkan yang weekday
				}
			}
		}

		
        return $arr;
        
    }
    
    public static function listDoctor($specialId)
    {
        return $doctor = Doctor::find()->where(['specialization_id'=>$specialId,'publish' => Doctor::STATUS_PUBLISH])->orderBy(['real_name' => SORT_ASC])->all();
    }
    
    public static function listSpecialization()
    {
        return $specialization = Specialization::find()->orderBy(['name' => SORT_ASC])->all();
    }
    
	/**
	 * Menampilkan jadwal seluruh dokter
	 * @return type
	 */
    public function doctorSchedule()
    {
        $result=[];
        foreach($this->listSpecialization() as $special)
        {
            $doctorArr=[];
            foreach($this->listDoctor($special->id) as $doctor)
            {
                
                $scheduleArr=[];
                foreach($this->listSchedule($doctor->id) as $schedule)
                {
                    $scheduleArr[]=$schedule;
                }
                $doctorArr[$doctor->name]=$scheduleArr;
            }
            $result[$special->id]=$doctorArr;
        }
        return $result;
    }
	
	public function doctorScheduleOne()
    {
        $result=[];
		$scheduleArr=[];
		foreach($this->listSchedule($this->doctor_id) as $schedule)
		{
			$scheduleArr[]=$schedule;
		}
		$result[$this->doctor_id]=$scheduleArr;
        return $result;
    }

	public function formFields() {
		return [
			[
				'name'=>'doctor_id',
				'type'=>'hidden',
			],
			[
				'name'=>'weekday',
				'type'=>'select',
				'data'=>[self::WEEKDAY_MONDAY=>'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
			],
			[
				'name'=>'start_time',
				'type'=>'text',
				'hint'=>'Contoh: 08:00',
			],
			[
				'name'=>'end_time',
				'type'=>'text',
				'hint'=>'Contoh: 12:00 kosongkan untuk diisi "selesai"',
			],
			[
				'name'=>'type',
				'type'=>'select',
				'data'=>self::getListType(),
			],
			[
				'name'=>'notes',
				'type'=>'textarea',
			],
			[
				'name'=>'publish',
				'type'=>'select',
				'data'=>[Schedule::STATUS_UNPUBLISH=>'Unpublish', Schedule::STATUS_PUBLISH=>'Published']
			],
		];
	}
	
	public function getWeekDayName()
	{
		$dayName = [self::WEEKDAY_MONDAY=>'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
		return $dayName[$this->weekday];
	}
	
	public function getListType(){
		return [
			self::TYPE_UMUM => "Umum",
			self::TYPE_BPJS => "BPJS",
			self::TYPE_UMUM_BPJS => "Umum dan BPJS"
		];
	}
}
