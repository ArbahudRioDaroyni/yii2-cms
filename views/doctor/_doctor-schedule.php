<?php
use app\models\Schedule;
?>
<div id="doctor-schedule"  class="tab-pane fade ">
	<section class="inpatient col-md-12">
		<div class="row">
			<div class="col-md-12 dokter-schedule padding-60">
				<div class="row schedule-menu">
					<h2><span>SCHEDULE</span></h2>
					<div class="line-bottom"></div>
				</div> 
				<div class="row schedule-content" id="parent">
					<div class="row schedule-content" id="parent">
						<div class="container jadwal-dokter">
							<style>
								div.keterangan{
									float: right;width: 20px;height: 10px;margin-left: 5px; padding: 0px !important; border: 1px solid rgba(0, 0, 0, .2);
								}
								span.keterangan{
									font-size: 8px;float:right; margin-left: 5px; padding: 0px !important;
								}
							</style>
							<table class="table table-responsive">
								<thead>
									<tr>
										<th class="spec-title">
											<?= $doctor->specialization->name ?>
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
									<tr>
										<?php foreach ($doctorSchedules as $doctorName => $data):?>
										<td class="nama-dokter"><?= $doctor->name ?></td>
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
											<div class="<?= $shiftLabel ?> <?= $time['notes']?'has-note':'' ?> <?= $typeLabel ?>">
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
										<?php endforeach; ?>
									</tr>
									<tr>
										<td colspan="7">
											<div class="keterangan bpjs"></div><span class="keterangan">&nbsp; BPJS &nbsp;</span>
											<div class="keterangan umumbpjs"></div><span class="keterangan">&nbsp; UMUM BPJS &nbsp;</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</section>
</div>