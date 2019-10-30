<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use kartik\file\FileInput
?>
<style>
    .file-thumbnail-footer,
    .file-upload-indicator,
    .file-actions,
    .fileinput-upload,
    .fileinput-cancel,
    .fileinput-remove {
    display: none;
}
</style>
<section id="proposal">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	<div class="proposal-container">
		<div class="container">
			<div class="panel panel-common">
				<div class="panel-heading">
					<div class="panel-title">PROPOSAL PENGAJUAN LAMARAN</div>
				</div>
				<div class="row panel-body">
					<div class="col-md-4 col-xs-12">
						<div class="panel panel-common">
							<div class="panel-heading">
								<div class="panel-title">Data File</div>
							</div>
							<div class="panel-body">
								<?= $form->field($model, 'diploma_file')->fileInput() ?>
								<?= $form->field($model, 'transcript_file')->fileInput() ?>
                                <?= $form->field($model, 'ktp_file')->widget(FileInput::classname(), ['options' => ['accept' => '@web/image/upload/*']]) ?>
                                <?= $form->field($model, 'photo')->widget(FileInput::classname(), ['options' => ['accept' => '@web/image/upload/*']]) ?>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-xs-12">
						<div class="panel panel-common">
							<div class="panel-heading">
								<div class="panel-title">Data Pribadi</div>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-xs-12">
										<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
										<?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>
										<?= $form->field($model, 'birth_date')->widget(\yii\jui\DatePicker::classname(), ['dateFormat' => 'dd-MM-yyyy','options' => ['class' => 'form-control']] ) ?>
										<?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>
										<?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
                                        <?= $form->field($model, 'address')->textarea() ?>
										<?= $form->field($model, 'ktp')->textInput(['maxlength' => true]) ?>
									</div>
									<div class="col-md-6 col-xs-12">
										<?= $form->field($model, 'sex')->dropDownList(\app\models\Proposal::getSex(),
												['prompt'=>'Pilih Jenis Kelamin']
											);?>
										<?= $form->field($model, 'married_status')->dropDownList(\app\models\Proposal::getStatusMaried(),
												['prompt'=>'Pilih Status Menikah']
											);?>
										<?= $form->field($model, 'nation')->dropDownList(\app\models\Proposal::getStatusNation(),
												['prompt'=>'Pilih Status Kewarganegaraan']
											);?>
										<?= $form->field($model, 'religion')->dropDownList(\app\models\Proposal::getReligion(),
												['prompt'=>'Pilih Agama']
											);?>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-common">
							<div class="panel-heading">
								<div class="panel-title">Data Proposal Pengajuan Lamaran</div>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-xs-12">
										<div class="panel panel-common">
											<div class="panel-heading">
												<div class="panel-title">Data Pendidikan</div>
											</div>
											<div class="panel-body">
												<?= $form->field($model, 'last_education')->dropDownList(\app\models\Proposal::getEducation(),
												['prompt'=>'Pilih Pendidikan Terakhir']
											);?>
												<?= $form->field($model, 'major')->textInput(['maxlength' => true]) ?>
												<?= $form->field($model, 'univ_name')->textInput(['maxlength' => true]) ?>
                                                <?= $form->field($model, 'accreditation')->dropDownList(\app\models\Proposal::getAccreditation(),['prompt'=>'Pilih Akreditasi']);?>
												<?= $form->field($model, 'ipk')->textInput(['maxlength' => true]) ?>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<div class="panel panel-common">
											<div class="panel-heading">
												<div class="panel-title">Data Kontak</div>
											</div>
											<div class="panel-body">
												<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
												<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
												<?= $form->field($model, 'socmed')->textInput(['maxlength' => true]) ?>
											</div>
										</div>
									</div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="panel panel-common">
											<div class="panel-heading">
												<div class="panel-title">Data Pengajuan Pendapatan</div>
											</div>
											<div class="panel-body">
												<?= $form->field($model, 'skill')->textarea(['maxlength' => true]) ?>
                                                <p>
                                                    Contoh :<br>
                                                    - Mampu mengoperasikan Microsoft Excel<br>
                                                    - Kursus Design Grafis Adobe Photoshop
                                                </p>
                                                <br>
												<?= $form->field($model, 'experience')->textarea(['maxlength' => true]) ?>
												<p>
                                                    Contoh :<br>
                                                    2011 – 2012 : PT Bussan Auto Finance sebagai Administrator<br>
                                                    2012 – 2016 : PT Central Santosa Finance sebagai Administrator
                                                </p>
                                                <br>
                                                <?= $form->field($model, 'salary_expect')->input('number', ['maxlength' => true]) ?>
											</div>
										</div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<?= Html::submitButton($model->isNewRecord ? 'Kirim Lamaran' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-info', 'id' => 'submit-button', 'disabled'=>true]) ?>
                    <span class='uncomplete' style="color: red">Data belum lengkap</span>
				</div>
			</div>
		</div>
	</div>
	<?php ActiveForm::end() ?>
</section>

<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="fa fa-angle-up"></span></a>

<script>
    $(".form-group > :input").keyup(function() {
        var $emptyTextFields = $('.form-group input[type="text"]').filter(function() {
            return $.trim(this.value) === "";
        });
        var $emptyFileFields = $('.form-group input[type="file"]').filter(function() {
            return $.trim(this.value) === "";
        });
        var $emptyNumberFields = $('.form-group input[type="number"]').filter(function() {
            return $.trim(this.value) === "";
        });
        var $emptySelectFields = $('.form-group select').filter(function() {
            return $.trim(this.value) === "";
        });
        var $emptyTextareaFields = $('.form-group textarea').filter(function() {
            return $.trim(this.value) === "";
        });
        
        var allField = parseInt($emptyTextFields.length) + parseInt($emptyFileFields.length) + parseInt($emptyNumberFields.length) + parseInt($emptySelectFields.length) + parseInt($emptyTextareaFields.length);
        
        if (!allField) {
            $('#submit-button').removeAttr('disabled');
            $('.uncomplete').remove();
            console.log(allField);
        }
        else {
            $('#submit-button').attr( "disabled", "disabled" );
            console.log(allField);
        }
    });
    
</script>