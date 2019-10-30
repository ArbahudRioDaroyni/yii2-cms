<?php
use yii\helpers\Html;
use yii\helpers\Url;
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
?>
<?= Html::csrfMetaTags() ?>
<div id="contact-form">
	<div class="title contact">
		<h4 class="gold">Kirimkan pesan kepada kami</h4>
        <p>Apabila ada masukan, pertanyaan atau tanggapan untuk kami, silahkan kirimkan pesan melalui sini. Kami akan
            menanggapi secepatnya. Terima kasih </p>
	</div>
	<div class="contact-form-container">
		<form class="row form-contact no-padding" method="POST"> 
			<div class="form-group col-md-6">
				<label for="name">Name <span>(required)</span> </label>
				<input type="text" class="form-control col-md-5" id="name" name="ContactForm[name]" placeholder="">
			</div>
			<div class="form-group col-md-6">
				<label for="email">Email <span>(required)</span> </label>
				<input type="email" class="form-control col-md-5" id="email" name="ContactForm[email]" placeholder="">
			</div>
			<div class="form-group col-md-12">
				<label for="subject">Subject <span>(required)</span> </label>
				<input type="subject" class="form-control" id="subject" name="ContactForm[subject]" placeholder="">
			</div>
			<div class="form-group col-md-12">
				<label for="message">Message Here <span>(required)</span> </label>
				<textarea class="form-control" rows="3" name="ContactForm[body]"></textarea>
			</div>
			<div class="form-group col-md-12">
				<a id="contact-submit" href="" class="btn btn-primary">Send</a>
				<div id="contact-message" style="display:none"></div>
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		var onSubmit = false;
		$("#contact-submit").click(function(){
			//console.log("test");
			if(onSubmit) return;
			
			onSubmit = true;
			
			var dataString = $("#contact-form form").serialize();
			//console.log(dataString);
// 			$.post( "<?= $baseUrl ?>/site/ajax-contact",function( data ) {
// 				  alert( "Data Loaded: " + data );
// 			});
            $.ajax({
                method: "POST",
                url: "<?= $baseUrl ?>/site/ajax-contact",
                data: dataString
            })
            .done(function( msg ) {
                $("#contact-message").text("Terima Kasih telah mengirim pesan kepada kami").fadeIn();
            });
			
			onSubmit = false;
			
			return false;
		});
	});
</script>