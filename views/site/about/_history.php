<?php
use app\models\Milestone;

$milestones = Milestone::findAllPublished();
const MAX_ITEM_PER_ROW = 3;

$baseUrl = Yii::$app->request->baseUrl;
?>
<div id="history" class="tab-pane fade">
	<section class="history clearfix">
		<div class="content container milestone">
			<h3>MILESTONE</h3>
			
			<?php
				$row = 0;
				$totalMilestone = count($milestones); //jumlah milestone
				$total = ceil($totalMilestone/3) * 3;
				$forward = null; //penanda counter maju atau mundur
				for($counter=0; $counter< $total; $counter++):
					//kalau row genap maka maju
					if($row%2==0){
						$index = $counter;
						$forward = true;
					}else{
						//kalau tidak maka jalan mundur
						$index = (($row+1)*MAX_ITEM_PER_ROW)-($counter%MAX_ITEM_PER_ROW)-1;
						$forward = false;
					}
					
					//Pastikan milestone index $index apakah ada objek atau tidak.
					if(isset($milestones[$index])){
						$milestone = $milestones[$index];
					}else{
						$milestone = null;
					}
					//echo $row.'#'.$counter.'#'.$num;//DEBUG
				?>
				<?php
					//Untuk setiap tiga milestone, berikan 1 baris div row
					if($counter% MAX_ITEM_PER_ROW ==0) echo '<div class="row">'; 
				?>
			
					<?php if($milestone != null): ?>
			
					<div class="box col-md-4 no-padding satu wow fadeInLeft"  data-wow-delay="<?= $index/2 ?>s"  data-wow-offset="200" data-wow-duration="2s">
						<div class="history-animate row">
							<div class="col-md-6 milestone-content">
								<h3><?= $milestone->year ?></h3>
							</div>
							<div class="col-md-6 milestone-content">
								<div class="image">
									<?php if ($milestone->image): ?>
										<img src="<?= $milestone->image ?>" />
									<?php endif; ?>
								</div>
								<div class="bottom">

								</div>
							</div>
							<div class="col-md-12 no-padding line-circle">
								<img src="<?= $baseUrl?>/images/ellipse.png" alt="">
								<div class="garis"></div>
								<p class="history-desc"><?= $milestone->description ?></p>
							</div>
						</div>
					</div>
			
					<?php else: ?>
					<div class="box col-md-4 no-padding satu" style="visibility:hidden">
					</div>
			
					<?php endif; ?>
			
				<?php
					//Untuk setiap tiga milestone, berikan 1 baris div row
					//coding ini menutup div row, sekalian $row ditambah 1.
					if($counter% MAX_ITEM_PER_ROW==MAX_ITEM_PER_ROW-1) { echo '</div><!-- end of row-->'; $row++; } 
				?>
				
			<?php endfor; ?>

		</div>
	</section>
</div>
