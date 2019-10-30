<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $doctor->getNameOnly();
$baseUrl = Yii::$app->getRequest()->getBaseUrl();
?>
<div class="row menu-find-doctor">
        <div class="col-md-12 menu">
        <ul role="tablist" class="nav nav-tabs menu-list find-doctor justify-content-center">
            <li class="col-md-4 active"><a  href="<?= Url::to(['/doctor/index']) ?>" aria-expanded="false">TEMUKAN DOKTER KAMI</a></li>
            <li class="col-md-4"><a data-toggle="tab" role="tab" href="#doctor-schedule" aria-expanded="false">JADWAL DOKTER</a></li>                                                              
        </ul>
        </div>
</div>
<div class="container">
<div class="row service">
        <div class="tab-content service">
                <div id="our-doctor" class="tab-pane in fade show active">
                        <section class="col-md-12 outpatient">
                                <div class="row">
                    <div class="col-md-12 padding-60">
                        <h2 class="patient"><span class="tebal">PROFIL <span>DOKTER</span></span></h2>
                        <div class="line-bottom"></div>
                    </div>
                                </div>
				<div class="container">
					<div class="row">
						<div class="col-md-12 profile">
							<div class="content-profile">
								<div class="img-detail">
									<img src="<?= $doctor->getFormattedPhoto() ?>" alt="" class="img-responsive">
									<div class="dokter-titles">
										<h5><?= $doctor->getNameOnly() ?></h5>
										<p><?= $doctor->getReference() ?></p>
									</div>

                                </div>
                                <div class="jadwal-praktek">
                                    <ul class="jadwal-dokter">
                                        <li>
                                            <a data-toggle="tab" role="tab" href="#doctor-schedule" aria-expanded="false"><h5>Lihat Jadwal Praktek</h5></a>
                                        </li>
                                        <?php foreach ($doctor->getScheduleGroupByWeekday() as $weekday => $schedule):
                                                                                    if($schedule)
                                                                                        $schedule
                                                                                ?>
										<li><?= $weekday ?><br/><small>(<?= implode(',', $schedule) ?>)</small> </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="detail-profile">
                                <h4><?= $doctor->name ?></h4>
                                <div class="row riwayat">
                                    <?= $doctor->description ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col-md-12 padding-60">
                            <h2 class="patient"><span class="tebal">DOKTER <span>LAINNYA</span></span></h2>
                            <div class="line-bottom"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-md-12 no-padding">
                            <div class="doctor-filter">

                                <!-- content -->
                                <?php foreach ($listDoctor as $doc): ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12 no-padding doctor filter-doctor filter sp<?= $doctor->specialization_id ?>">

										<a href="<?= $doc->getLink() ?>">
											<div class="img">
												<img src="<?= $doc->getFormattedPhoto() ?>" alt="" class="img-responsive">
											</div>
											<div class="bottom">
												<h5><?= $doc->name ?></h5>
												<div class="link">
													<?= $doc->getReference() ?>
													<!--<img src="../images/arrow-green.png" alt="" class="arrow-green">-->
												</div>
											</div>
										</a>
									</div>
								<?php endforeach ?>
								<!-- end content -->
							</div>

                        </div>
                    </div>
                </div>
                        </section>
        </div>
        <?= $this->render('_doctor-schedule', ['doctor' => $doctor, 'doctorSchedules'=> $doctorSchedules]); ?>
    </div>
</div>
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="fa fa-angle-up"></span></a>         

<script> $('.pilihan a').click(function() {
        $('#selected').text($(this).text());
    });</script>


<script>
    $(document).ready(function() {
        $('.dropdown-menu.find-doctor li a').click(function(e) {

            $('.dropdown-menu.find-doctor li').removeClass('active');

            var $parent = $(this).parent();
            if (!$parent.hasClass('active')) {
                $parent.addClass('active');
            }
            e.preventDefault();
        });
    });
</script>
<script>
    $('.putaran').click(function() {
        $('.putar').toggleClass('rotasi');
    });
    $('.putaran-balik').click(function() {
        $('.putar-balik').toggleClass('rotasi');
    });
    $('.putaran-rj').click(function() {
        $('.putar-rj').toggleClass('rotasi');
    });

</script>

<script src="<?= $baseUrl ?>/js/slide-up.js"></script>
<script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(this).attr('href');

        $(target).css('left', '-' + $(window).width() + 'px');
        var left = $(target).offset().left;
        $(target).css({left: left}).animate({"left": "0px"}, "fast");
    })
</script>
<script>
    jQuery('.panel-heading h4').click(function() {
        $('.panel-heading').removeClass('actives');
        $(this).parents('.panel-heading').addClass('actives');
    });
</script> 
<script type="text/javascript">
    $(document).ready(function() {
        $('#kelas-edukasi').carousel({
            interval: 3000
        })
    });
</script>
<script src="<?= $baseUrl?>/js/filter-div.js"></script>
