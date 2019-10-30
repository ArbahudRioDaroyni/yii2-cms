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
					<a href="<?= Url::toRoute(['doctor/schedule']) ?>" class="schedule-button">Jadwal Dokter</a>
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
                            <?php if($selectedSpecialization != null): ?>
                            <span id="selected"><?= $selectedSpecialization->name ?></span>
                            <?php else: ?>
                            <span id="selected">PILIH SPESIALISASI</span>
                            <?php endif; ?>
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
                            <?php if($selectedSpecialization != null): ?>
                            <span id="selected"><?= $selectedSpecialization->name ?></span>
                            <?php else: ?>
                            <span id="selected">PILIH SPESIALISASI</span>
                            <?php endif; ?>
                            <span class="icon fa fa-angle-down rightmost"></span>
                        </a>
                        <ul class="dropdown-menu multi-level find-doctor form-control" role="menu" aria-labelledby="dropdownMenu">
                            <li><a href="<?= Url::toRoute(['doctor/index']) ?>" class="filter-button" data-filter="all">Semua Departemen</a></li>
                                <?php foreach ($specializations as $id=>$specialization): ?>
                                    <li class="">
                                        
                                    <?php if( isset($specialization['children'])) : ?>
                                        <a class="filter-button" data-filter="sp<?= $id ?>"><?= $specialization['name'] ?></a>
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
                                    <?php else: ?>
                                        <a href="<?= Url::toRoute(['doctor/by-specialization','id'=>$id]) ?>" class="filter-button" data-filter="sp<?= $id ?>"><?= $specialization['name'] ?></a>
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
                        <ul class="dropdown-menu multi-level find-doctor find-doctor-name form-control" role="menu" aria-labelledby="dropdownMenu">
                            <?php foreach ($doctors as $doctor): ?>
                            <li data-name="<?= strtolower($doctor->name) ?>">
                                    <a href="<?= Url::toRoute(['doctor/view','id'=>$doctor->id]) ?>" class="filter-button" data-filter="dn<?= $doctor->id ?>">
                                <?= $doctor->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
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
            <p>Kami menemukan <strong id="doctor-count"><?= count($doctors) ?></strong> dokter spesialisasi <span class="doctor_specialization"></span></p>
		</div>
		<div class="doctor-card-sec">
			<h3>Departemen <span class="doctor_specialization"></span> </h3>
			<div class="doctor-card-wrapper">
                <?php foreach ($doctors as $doctor): ?>
				<div class="doctor-card filter-doctor filter doctor" data-name="<?= strtolower($doctor->name) ?>">
					<div class="left">
						<div class="doctor-image">
							<img src="<?= $doctor->getFormattedPhoto() ?>" alt=""/>
						</div>
						<div class="doctor-focus">
							<strong>FOKUS AREA:</strong><br/>
                            <?php if(isset($doctor->specialization->name)): ?>
                                <span><?= $doctor->specialization->name ?></span>
                            <?php endif; ?>
						</div>
						<div class="doctor-schedule">
							<a href="<?= $doctor->getLink() ?> ">Lihat Jadwal</a>
						</div>
					</div>
					<div class="right">
						<div class="doctor-grey">
							<div class="doctor-name">
								<a href="<?= $doctor->getLink() ?> ">
									<span><?= $doctor->name ?></span>
								</a>
							</div>
							<div class="doctor-specialist">
								<?php if(isset($doctor->specialization->name)): ?>
									<span><?= $doctor->specialization->name ?></span>
								<?php endif; ?>
							</div>
						</div>
						<div class="doctor-achievement">
							<?= $doctor->getShortDescription() ?>
						</div>
					</div>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<script>
    $(document).ready(function() {
        
        $('.dropdown-menu.find-doctor li').click(function(e) {
            var href = $(this).children("a").first().attr('href');
            window.location = href;
        });
        
        $('.dropdown-menu.find-doctor li a').click(function(e) {
            var value = $(this).attr("data-filter");
            //alert(value);
            $('.dropdown-menu.find-doctor li').removeClass('active');

            var $parent = $(this).parent();
            if (!$parent.hasClass('active')) {
                $parent.addClass('active');
            }

            $("#real").hide();
            $(".doctor-filter li .filter").each(function(){
                $(this).attr("style","");
            });
            if(value == "all"){
                $("#doc-list ul").html("");
                var html = $(".doctor-filter ul").html();
                $("#doc-list ul").html(html);
            }else{
                $("#doc-list ul").html("");
                $(".doctor-filter li ." + value).each(function(){
                    //alert($(this).attr("data-name"));
                    var html = $(this).closest("li").html();
                    $("#doc-list ul").append("<li>" + html + "</li>");
                });
            }
            $("#searchDoctor").css("visibility","hidden");
            $("#doc-list").show();
            var monkeyList = new List('doc-list', {
                valueNames: ['name'],
                page: 20,
                pagination: true
            });
        });

        $('#searchDoctor').keyup(function(){
            var doctorName = $('#searchDoctor').val().toLowerCase();
            if(doctorName.length>0){
                //filter dokter yang di list result
                $(".doctor.filter-doctor").hide();
                $('.doctor.filter-doctor[data-name*="'+doctorName+'"]').fadeIn();
                $("#doctor-count").text($('.doctor.filter-doctor[data-name*="'+doctorName+'"]').length);
                //filter nama dokter di dropdown menu
                $("ul.dropdown-menu.find-doctor-name").show();
                $("ul.dropdown-menu.find-doctor-name li").hide();
                $('ul.dropdown-menu.find-doctor-name li[data-name*="'+doctorName+'"]').show();
            }else{
                $("#doctor-count").text($('.doctor.filter-doctor').length);
                $(".doctor.filter-doctor").show();
            }
        });
        
        $(".filter-button").click(function(){
            var value = $(this).attr('data-filter');
            $(".selected-name").text($(this).text());
            if(value == "all")
            {
                $('.filter').fadeIn('200');
            }
            else
            {
                $(".filter").not('.'+value).fadeOut('200');
                $('.filter').filter('.'+value).fadeIn('200');

            }

            //Khusus untuk Filter Schedule
            $(".schedule-panel-content #selected.list-group-item").trigger('click');
        });
    });
</script>