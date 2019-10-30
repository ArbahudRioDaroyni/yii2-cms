<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Lookup;

app\assets\AppAsset::register($this);
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
$detect = new \Detection\MobileDetect;
?><?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="">
		<title><?= Html::encode($this->title) ?> | RS. St. Caroslus - Rumah Sakit di Jakarta Pusat</title>
                <meta name="google-site-verification" content="W0fTEN5PHoI9dEssQ3PTnWEesckRYbYa6yGAazHXL4g" />
		<?php $this->head() ?>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:400,400i,600,600i,700,700i" rel="stylesheet">
	</head>
	<body id="page-top" class="page-<?= Yii::$app->controller->id?>-<?= Yii::$app->controller->action->id?>" data-spy="scroll" data-target=".navbar-fixed-top">
		<?php $this->beginBody() ?>
		<?= $this->render(
			'header.php',
			['baseUrl' => $baseUrl]
		) ?>
		<?= $content ?>
		<?= $this->render(
			'footer.php',
			['baseUrl' => $baseUrl]
		) ?>
		<?php $this->endBody() ?>
                <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126750184-1"></script>
		<script type="text/javascript">
			//Semua elemen kalau sudah terload tampilan loading
			//akan hilang
			$(window).load(function () {
				// Animate loader off screen
				$(".se-pre-con").fadeOut("slow");
				;
			});

			//Untuk jaga-jaga, lewat 2 detik, tampilan loading 
			//akan hilang juga
			setTimeout(function () {
				$(".se-pre-con").fadeOut("slow");
			}, 3000);
			<?php if($detect->isMobile()): ?>
			$('.scroll-top img').click(function(){
				//$(window).scrollTop(0);
				$("html, body").animate({ scrollTop: 0 }, 1000);
			});
			<?php endif;?>
                <!-- Global site tag (gtag.js) - Google Analytics -->
               window.dataLayer = window.dataLayer || [];
               function gtag(){dataLayer.push(arguments);}
               gtag('js', new Date());

               gtag('config', 'UA-126750184-1');
               
			$(window).scroll(function () {
				if ($(window).scrollTop() >= 450 && $('#page-top').hasClass('page-site-index')) {
					$('#header').addClass('spawn-nav');
				}
				else {
					$('#header').removeClass('spawn-nav');
				}
			});
			
		</script>
	</body>
</html>
<?php $this->endPage() ?>
