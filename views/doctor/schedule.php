<?php

use yii\helpers\Url;
$this->title = 'Dokter Spesialis Kami';
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
$detect = new \Detection\MobileDetect;
?>

<section id="find-doctor-header" class="fdh-sec">
	<div class="fd-title">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>Find a Doctor</h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="#" class="schedule-button">Jadwal Dokter</a>
				</div>
			</div>
		</div>
	</div>
	<div class="fd-menu">
		<div class="container">
			<p>Pilih Spesialisasi, kondisi kesehatan atau nama dokter </p>
            <div class="row">
                <div class="box box-specialization col-md-5">
                    <div class="dropdown no-padding">
                        <?php if($detect->isMobile()): ?>
                        <a id="dLabel" role="button" data-toggle="collapse" class="btn btn-default find-doctor form-control" data-target="#doctorMenuDropdown">
                            <span id="selected">PILIH SPESIALISASI</span>
                            <span class="icon fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu multi-level find-doctor form-control collapse" role="menu" aria-labelledby="dropdownMenu" id="doctorMenuDropdown">
                            <li class="noMenu"><a href="<?= Url::toRoute(['doctor/index']) ?>" class="filter-button" data-filter="all">Semua Departemen</a></li>
                                <?php foreach ($specializations as $id=>$specialization): ?>
                                    <li<?php if( !isset($specialization['children'])) : ?> class="noMenu"<?php endif; ?> data-toggle="collapse" data-target="#mn<?= $id ?>">
                                        <a class="filter-button" data-filter="sp<?= $id ?>"><?= $specialization['name'] ?></a>
                                        <?php if( isset($specialization['children'])) : ?><i class="fa fa-angle-down"></i><?php endif; ?>
                                    </li>
                                    <?php if( isset($specialization['children'])) : ?>
                                    <div class="sub-menu collapse" id="mn<?= $id ?>" style="list-style: none">
                                        <?php $count = $id + 1; ?>
                                        <?php foreach ($specialization['children'] as $childId => $child): ?>
                                        <li style="background-color:#f9f9f9" class="noMenu">
                                            <a href="<?= Url::toRoute(['doctor/by-specialization','id'=>$child['id']]) ?>" class="filter-button" data-filter="sp<?= $child['id'] ?>"><?= $child['name'] ?></a>
                                        </li>
                                        <?php $count++; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                        <?php else: ?>
                        <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-default find-doctor form-control" data-target="#" href="/page.html">
                            <span><img src="<?= $baseUrl?>/images/icon/icon-stethoscope.png" /></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span id="selected">PILIH SPESIALISASI</span>
                            <span class="icon fa fa-angle-down rightmost"></span>
                        </a>
                        <ul class="dropdown-menu multi-level find-doctor form-control" role="menu" aria-labelledby="dropdownMenu">
                            <li><a href="<?= Url::toRoute(['doctor/index']) ?>" class="filter-button" data-filter="all">Semua Departemen</a></li>
                                <?php foreach ($specializations as $id=>$specialization): ?>
                                    <li class="">
                                        <a class="filter-button" data-filter="sp<?= $id ?>"><?= $specialization['name'] ?></a>
                                    <?php if( isset($specialization['children'])) : ?>
                                        <i class="fa fa-angle-right"></i>
                                        <ul>
                                        <?php $count = $id + 1; ?>
                                        <?php foreach ($specialization['children'] as $childId => $child): ?>
                                            <li class="">
                                                <a href="<?= Url::toRoute(['doctor/by-specialization','id'=>$child['id']]) ?>" class="filter-button" data-filter="sp<?= $child['id'] ?>"><?= $child['name'] ?></a>
                                            </li>
                                        <?php $count++; ?>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="box box-search col-md-5">
                    <div class="input find-doctor doctor-filter" id="doc-list">
                        <span><img src="<?= $baseUrl?>/images/icon/icon-doctor.png" /></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="searchDoctor" id="searchDoctor" placeholder="NAMA DOKTER" />
                        <span class="icon fa fa-angle-down rightmost"></span>
                    </div><div class="submit find-doctor">
                        <img src="<?= $baseUrl ?>/images/icon/icon-search.png" />
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>
<section id="find-doctor-center" class="fdc-sec">
	<div class="container">
		<div class="alphabet-sec">
			<span>Cari Dokter berdasarkan Alphabet</span>
			<div class="alphabet-wrapper">
                <?php for($i=ord('a');$i<=ord('z');$i++): ?>
                <a <?= $selectedAlphabet==chr($i)?'class="active"':"" ?> href="<?= Url::toRoute(['doctor/by-alphabet','alphabet'=>chr($i)]) ?>">
                    <?= chr($i) ?>
                </a>
                <?php endfor; ?>
			</div>
		</div>
		<div class="result-notif">
            <p>Kami menemukan <strong id="doctor-count"></strong> dokter spesialisasi <span class="doctor_specialization"></span></p>
		</div>
		<div class="doctor-card-sec">
			<h3>Departemen <span class="doctor_specialization"></span> </h3>
			<div class="doctor-card-wrapper">
                <?= $this->render('_schedule', $_params_); ?>
			</div>
		</div>
	</div>
</section>