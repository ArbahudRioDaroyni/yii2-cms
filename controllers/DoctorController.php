<?php

namespace app\controllers;

use app\models\Doctor;
use app\models\Schedule;
use app\models\Specialization;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * DoctorController implements the CRUD actions for Doctor model.
 */
class DoctorController extends Controller
{
	
    public function actionIndex()
	{
        $doctors = Doctor::findAllPublished();
		$specializations = Specialization::getDataTree();
		$scheduleModel= new Schedule;
		$doctorSchedules = $scheduleModel->doctorSchedule();
		
        return $this->render('index', [
            'doctors' => $doctors,
			'specializations' => $specializations,
			'doctorSchedules'=> $doctorSchedules,
            'selectedSpecialization'=>null, //specialization tidak ada, karena di index gak cari spesialisasi
            'selectedAlphabet'=>'', //alfabet terpilih tidak ada, karena index gak ada cari alphabet
        ]);
	}
    
    public function actionByAlphabet($alphabet)
	{
        $doctors = Doctor::findByAlphabet($alphabet);
		$specializations = Specialization::getDataTree();
		$scheduleModel= new Schedule;
		$doctorSchedules = $scheduleModel->doctorSchedule();
		
        return $this->render('index', [
            'doctors' => $doctors,
			'specializations' => $specializations,
			'doctorSchedules'=> $doctorSchedules,
            'selectedSpecialization'=>null,
            'selectedAlphabet'=>$alphabet,
        ]);
	}
    
    /**
     * 
     * @param int $id ID Spesialisasi
     * @return type
     */
    public function actionBySpecialization($id)
	{
        $doctors = Doctor::findBySpecialization($id);
        $selectedSpecialization = Specialization::find()->where(['id'=>$id])->one();
		$specializations = Specialization::getDataTree();
		$scheduleModel= new Schedule;
		$doctorSchedules = $scheduleModel->doctorSchedule();
		
        return $this->render('index', [
            'doctors' => $doctors,
			'specializations' => $specializations,
			'doctorSchedules'=> $doctorSchedules,
            'selectedSpecialization'=>$selectedSpecialization,
            'selectedAlphabet'=>'',
        ]);
	}
    
    public function actionSchedule()
    {
        $specializations = Specialization::getDataTree();
        $scheduleModel= new Schedule;
        $doctorSchedules = $scheduleModel->doctorSchedule();
        return $this->render('schedule', [
			'specializations' => $specializations,
			'doctorSchedules'=> $doctorSchedules,
            'selectedAlphabet'=>'',
        ]);
        
    }
	
	public function actionView($id)
	{
		$doctor = $this->findModel($id);
        $listDoctor = Doctor::findOthers($doctor->specialization_id, $doctor->id);
		$scheduleModel = Schedule::find()->where(['doctor_id' => $doctor->id])->one();
		if($scheduleModel){
			$doctorSchedules = $scheduleModel->doctorScheduleOne();
		}else{
			$doctorSchedules = [];
		}
        
        return $this->render('view',[
			'doctor'=>$doctor, 
			'listDoctor'=>$listDoctor,
			'doctorSchedules'=> $doctorSchedules,
		]);

	}

    /**
     * Finds the Doctor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Doctor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doctor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
//    public function schedule()
//    {
//        return $this->render('_schedule');
//    }
    
}