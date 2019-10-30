<?php 
use app\models\Schedule;
$detect = new \Detection\MobileDetect;
?>
<div id="doctor-schedule" >
    <section class="inpatient col-md-12">
        <div class="row">
            <div class="col-md-12 dokter-schedule">

                <div class="row schedule-menu">
                    <h2><span>JADWAL DOKTER</span></h2>
                    <div class="line-bottom"></div>
                    
                    <?php /** sementara matikan dulu fungsi filter spesialisasi
                    <div class="col-md-3 col-xs-12 col-md-of no-padding schedule-panel-content">

                        <div id="MainMenu">
                            <div class="list-group panel schedule-panel">
								<a id="dLabel" role="button" data-toggle="collapse" class="list-group-item list-group-item-success top putaranfind-doctor" data-target="#scheduleMenuDropdown">
									<span id="selected">SPECIALITY</span>
									<span class="fa fa-angle-down putar"></span>
								</a>
								<?php if($detect->isMobile()): ?>
									<ul class="dropdown-menu multi-level find-doctor form-control collapse" role="menu" aria-labelledby="dropdownMenu" id="scheduleMenuDropdown">
										<li class="noMenu"><a class="filter-button" data-filter="all">Semua Departemen</a></li>
									<?php foreach ($specializations as $id=>$specialization): ?>
										<li<?php if( !isset($specialization['children'])) : ?> class="noMenu"<?php endif; ?> data-toggle="collapse" data-target="#sc<?= $id ?>">
											<a class="filter-button" data-filter="sp<?= $id ?>"><?= $specialization['name'] ?></a>
											<?php if( isset($specialization['children'])) : ?><i class="fa fa-angle-down"></i><?php endif; ?>
										</li>
										<?php if( isset($specialization['children'])) : ?>
										<div class="sub-menu collapse" id="sc<?= $id ?>" style="list-style: none">
											<?php $count = $id + 1; ?>
											<?php foreach ($specialization['children'] as $childId => $child): ?>
											<li style="background-color:#f9f9f9" class="noMenu">
												<a class="filter-button" data-filter="sp<?= $child['id'] ?>"><?= $child['name'] ?></a>
											</li>
											<?php $count++; ?>
											<?php endforeach; ?>
										</div>
										<?php endif; ?>
									<?php endforeach; ?>
                                </ul>
								<?php else: ?>
                                <div class="collapse pilihan" id="demo3">
                                    <a id="all" class="filter-button list-group-item active btn" data-filter="all" >Semua Departemen</a>
									<?php foreach ($specializations as $id => $specialization): ?>
									<li class="">
										<a class="filter-button list-group-item btn" data-filter="sp<?= $id ?>"><?= $specialization['name'] ?></a>
                                        <?php if (isset($specialization['children'])) : ?>
                                            <i class="fa fa-angle-right"></i>
											<ul>
                                                <?php foreach ($specialization['children'] as $childId => $child): ?>
												<li class="">
													<a class="filter-button list-group-item btn" data-filter="sp<?= $child['id'] ?>"><?= $child['name'] ?></a>
												</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</li>
									<?php endforeach; ?>
								<?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div> */ ?>
                </div>  
                <div class="row schedule-content" id="parent">
					<?php if($detect->isMobile()): ?>
					<style>
						.jadwal-dokter > .table-responsive > tbody > tr > td .top{
							text-align: center;
							border-top:1px solid #ccc;
						}
						.jadwal-dokter > .table-responsive > tbody > tr > td .top:last-child{
							border-bottom:1px solid #ccc;
						}
						.jadwal-dokter > .table-responsive > tbody > tr > td .top:nth-last-child(2){
							border-bottom:1px solid #ccc;
						}
						.jadwal-dokter > .table-responsive > tbody > tr > td .top:nth-child(odd){
							float:left;
						}
						.jadwal-dokter > .table-responsive > tbody > tr > td .top:nth-child(even){
							width: 100px;
						}
						span.zero{
							vertical-align: top !important;
						}
						.noBorder{border-top: 0px !important}
						div.keterangan{
							float: left;width: 20px;height: 10px;margin-left: 20px; border: 1px solid rgba(0, 0, 0, .2);
						}
						span.keterangan{
							font-size: 8px;float:left;
						}
					</style>
					<?php
						foreach ($doctorSchedules as $key => $schedule):
						$specialization = \app\models\Specialization::find()->where(['id' => $key])->one();
						if(!$schedule) continue;
						?>
					<div class="col-md-12 no-padding jadwal-dokter filter sp<?= $key ?>">
                        <table class="doctor-schedule table table-responsive">
							<thead>
                                <tr>
                                    <th class="spec-title">
                                        <?= $specialization->name ?><br>
										<div class="keterangan bpjs"></div><span class="keterangan"> BPJS</span>
										<div class="keterangan umumbpjs"></div><span class="keterangan"> UMUM BPJS</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($schedule as $doctorName => $data): ?>
                                <tr>
                                    <td class="nama-dokter"><?= $doctorName ?></td>
								</tr>
								<tr>
                                    <td>
                                <?php foreach ($data as $shifts): ?>
											<?php for($key=Schedule::SHIFT_MORNING;$key<=Schedule::SHIFT_NIGHT; $key++):
												if(!isset($shifts[$key])) {
													$shiftLabel = $key==Schedule::SHIFT_MORNING?'top':'bottom';
													continue;
												}
												$time = $shifts[$key];
												$typeLabel = ($time['type'] == Schedule::TYPE_BPJS ? 'bpjs' : ($time['type'] == Schedule::TYPE_UMUM_BPJS ? 'umumbpjs' : ''));

												$startTime = date('H', strtotime($time['start']));
												$startMin = date('i', strtotime($time['start']));
												if(!empty($time['end'])){
													$endTime = date('H', strtotime($time['end']));
													$endMin = date('i', strtotime($time['end']));
												}else{
													$endTime = "Selesai";
													$endMin = "00";
												}
											?>
												<?php if($key == Schedule::SHIFT_MORNING){ ?>
													<div class="top <?= $typeLabel ?>">
														<?= $time['weekday']; ?>
														<?php if ($time['notes']): ?>
														<small>&nbsp;</small>
														<?php endif ?>
													</div>
													<div class="top <?= $typeLabel ?>">
												<?php }else{
													if(empty($shifts[Schedule::SHIFT_MORNING])){ ?>
													<div class="top <?= $typeLabel ?>">
														<?= $time['weekday']; ?>
														<?php if ($time['notes']): ?>
														<small>&nbsp;</small>
														<?php endif ?>
													</div>
													<div class="top <?= $typeLabel ?>">
												<?php }else{?>
													<div class="top noBorder <?= $typeLabel ?>">
														&nbsp;
													</div>
													<div class="top noBorder <?= $typeLabel ?>">
												<?php
													}
												}
												?>
												<span><?= $startTime ?>
													<?php if($startMin!='00'): ?>
													<span class="zero"><?= $startMin ?></span>
													<?php endif ?>
												</span> - 
												<span><?= $endTime ?>
													<?php if($endMin!='00'): ?>
													<span class="zero"><?= $endMin ?></span>
													<?php endif; ?>
												</span>
												<?php if ($time['notes']): ?>
												<small><?= '(' . strtoupper($time['notes'] . ')') ?></small>
												<?php endif; ?>
											</div>
										<?php endfor ?>
                                    <?php endforeach; ?>
									</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
						</table>
					</div>
					<?php endforeach; else:
					foreach ($doctorSchedules as $key => $schedule):
						$specialization = \app\models\Specialization::find()->where(['id' => $key])->one();
						if(!$schedule) continue;
						?>
						<style>
							div.keterangan{
								float: right;width: 20px;height: 10px;margin-left: 5px; padding: 0px !important; border: 1px solid rgba(0, 0, 0, .2);
							}
							span.keterangan{
								font-size: 8px;float:right; margin-left: 5px; padding: 0px !important;
							}
						</style>
                        <div class="col-md-12 no-padding jadwal-dokter filter sp<?= $key ?>">
                        <table class="table table-responsive doctor-schedule">
                            <thead>
                                <tr>
                                    <th class="spec-title">
                                        <?= $specialization->name ?>
                                    </th>
									<th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
								</tr>
                            </thead>
                            <tbody>
                                <?php foreach ($schedule as $doctorName => $data): ?>
                                <tr>
                                    <td class="nama-dokter"><?= $doctorName ?></td>
                                    
                                <?php foreach ($data as $shifts):
                                    if (!$shifts): //Kalau tidak ada jadwal di hari itu langsung skip saja ?>
                                    <td>
                                        <div class="top"> - </div>
                                        <div class="bottom"> - </div>
                                    </td>
                                    <?php continue; endif; ?>
                                    <td>
                                    <?php for($key=Schedule::SHIFT_MORNING;$key<=Schedule::SHIFT_NIGHT; $key++): 
                                        
                                        //Kalau tidak ada jadwal di shift itu langsung skip
                                        if(!isset($shifts[$key])) {
                                            $shiftLabel = $key==Schedule::SHIFT_MORNING?'top':'bottom';
                                            echo "<div class='$shiftLabel'>-</div>";
                                            continue;
                                        }
                                        $time = $shifts[$key];
                                    ?>
                                    <?php
                                        $startTime = date('H', strtotime($time['start']));
                                        $startMin = date('i', strtotime($time['start']));
                                        if(!empty($time['end'])){
                                            $endTime = date('H', strtotime($time['end']));
                                            $endMin = date('i', strtotime($time['end']));
                                        }else{
                                            $endTime = "Selesai";
                                            $endMin = "00";
                                        }
                                        $shiftLabel = $key==Schedule::SHIFT_MORNING?'top':'bottom';
										$typeLabel = ($time['type'] == Schedule::TYPE_BPJS ? 'bpjs' : ($time['type'] == Schedule::TYPE_UMUM_BPJS ? 'umumbpjs' : ''));
                                    ?>
                                        <div class="<?= $shiftLabel ?><?= $time['notes']?' has-note':'' ?> <?= $typeLabel ?>">
                                                <span><?= $startTime ?>
                                                    <?php if($startMin!='00'): ?>
                                                    <span class="zero"><?= $startMin ?></span>
                                                    <?php endif ?>
                                                </span> - 
                                                <span><?= $endTime ?>
                                                    <?php if($endMin!='00'): ?>
                                                        <span class="zero"><?= $endMin ?></span>
                                                    <?php endif; ?>
                                                </span>
                                            <?php if ($time['notes']): ?>
                                            <small><?= '(' . strtoupper($time['notes'] . ')') ?></small>
                                            <?php endif ?>
                                        </div>
                                    <?php endfor ?>
                                    </td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
								<tr>
									<td colspan="7">
										<div class="keterangan bpjs"></div><span class="keterangan">&nbsp; BPJS &nbsp;</span>
										<div class="keterangan umumbpjs"></div><span class="keterangan">&nbsp; UMUM BPJS &nbsp;</span>
									</td>
								</tr>
                            </tbody>
                        </table>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>  
    </section>
</div>
