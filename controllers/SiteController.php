<?php

namespace app\controllers;

use app\models\Article;
use app\models\ContactForm;
use app\models\Doctor;
use app\models\Event;
use app\models\Page;
use app\models\Testimonial;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\helpers\Url;

use const YII_ENV_TEST;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$event = Event::findHome();
        $promo = Event::findHome($promo=true);
		$article = Article::findHome();
        $facilities = \app\models\Facility::findHome();
        $excellences = \app\models\Excellence::findHomepage();
		$searchKeywords = \app\models\SearchKeyword::findHome();
        
        return $this->render('index', [
			'event'=>$event,
            'promo'=>$promo,
			'article'=>$article,
            'excellences'=>$excellences,
            'searchKeywords'=>$searchKeywords,
            'facilities'=>$facilities,
		]);
    }

    
    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

	/**
	 * Halaman khusus untuk kirim eamil secara ajax
	 */
	public function actionAjaxContact()
	{
	    $request = Yii::$app->request;
	    $post = $request->POST();
	    $body = ("Dari: ".$post['ContactForm']['name']."(".$post['ContactForm']['email'].")<br><br>");
		$body .= $post['ContactForm']['body'];
	    Yii::$app->mailer->compose()
			->setFrom(["no-reply@rscarolus.or.id" => "RS. St.Carolus"])
			->setTo(Yii::$app->params['marketingEmail'])
			->setSubject($post['ContactForm']['subject'])
			->setTextBody($body) //pilih salah satu antara textBody
			//->setHtmlBody('<b>HTML content</b>') //atau htmlBody
			->send();
	}
	
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionTentangMedical()
    {
        return $this->render('tentang-medical/index');
    }
	
	public function actionService()
	{
		$list = Page::listServicePages();
		$pages = [];
		foreach($list as $item){
			$pages[$item] = Page::findAllCategory($item);
		}
		
		return $this->render('service', ['pages'=>$pages]);
	}
        
	public function actionSitemap()
	{
		$this->layout = false;
	Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
		Yii::$app->response->headers->add('Content-Type', 'text/xml'); 

		$sites = [
			[
				'name'=>'Tentang Kami',
				'url'=>Url::to('site/about'),
			],
			[
				'name'=>'Pelayanan Kami',
				'url'=>Url::to('site/service'),
			],
			[
				'name'=>'Berita & Artikel',
				'url'=>Url::to('article/index'),
			],
			[
				'name'=>'Kegiatan & Promosi',
				'url'=>Url::to('event/index'),
			],
			[
				'name'=>'Karir',
				'url'=>Url::to('career/index'),
			],
			[
				'name'=>'Dokter Kami',
				'url'=>Url::to('doctor/index'),
			]
		];

		$articles = Article::findAllPublished();
		$events = Event::findAllPublish();
		$doctors = Doctor::findAllPublished();

		$ret = [
			'sites'=>$sites,
			'articles' => $articles,
			'events' => $events,
			'doctors' => $doctors,
	];

	return $this->render('sitemap', $ret);
	}

	public function actionError()
	{
		Yii::$app->response->redirect('/', 301)->send();
		return Yii::$app->end();
	}
	
	public function actionNewsletter(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                
		$request = Yii::$app->request;
		if($request->isAjax && $request->isPost){
			$email = $request->post()['email'];
			$find = \app\models\Newsletter::find()->where(['email' => $email])->count();
			
            //Artinya terdaftar
			if($find > 0){
				return ['status'=>'error', 'message'=>'Anda sudah terdaftar'];
			}
			
            //Insert ke sistem
			$model = new \app\models\Newsletter;
			$model->email = $email;
			$model->save();
            return ['status'=>'success', 'message'=>'Email Anda telah didaftarkan ke dalam sistem kami'];
		}
        
		throw new NotFoundHttpException('The requested page does not exist.');
		
	}
}
