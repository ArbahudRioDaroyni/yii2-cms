<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Url;

$this->title = 'Hubungi Kami';
$this->params['breadcrumbs'][] = $this->title;

$urlNewsletter = Url::to(['site/newsletter']); 
$this->registerJs("
    jQuery('#submitNewsletter').on('click', function(event){
        var email = jQuery('#newsletter-email').val();
        var token = jQuery('#newsletter-csrf').val();
        var to ={'email': email, '_csrf': token }
        jQuery.post('$urlNewsletter', to, function(data){
            jQuery('#newsletter-message').addClass(data.status).text(data.message).fadeIn();
            
            //set 5 detik hilang
            setTimeout(function(){
                jQuery('#newsletter-message').fadeOut().removeClass(data.status);
            }, 5000);
        });
		event.preventDefault()
	});
");
?>

<section id="service">
    <div class="container services">
		<h4>HUBUNGI KAMI</h4>
	</div>
</section>
<section class="map-wrapper">
    <div class="googleMap row">
        <div class="col-md-12">
            <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=rumah sakit saint carolus jalan salemba raya paseban kota jakarta pusat daerah khusus ibukota jakarta, &amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <?= $this->render('_contact') ?>
        </div>
    </div>
</div>