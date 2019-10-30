<section class="medical col-md-12">
	<div class="container">
		<div class="row">
			<div class="col-md-12 no-padding row">
				<div class="sidemenu col-md-3">
					<ul class="medical">
						<?php foreach(\app\models\MedicalCheckupCategory::findAllPublished() as $item): ?>
						<li class="<?= $item->id==1?'active':''?>">
							<a data-toggle="tab" href="#medical<?= $item->id ?>" aria-expanded="false">
								<?= $item->name ?>
							</a>
						</li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="tab-content col-md-9 no-padding">
				<?php 
				$categories = \app\models\MedicalCheckupCategory::findAllPublished();
				foreach($categories as $category): ?>
					
					<div id="medical<?= $category->id?>" class="tab-pane fade <?= $category->id==1?'in active':''?>">
						
						<div class="row">
							<div class="col-md-12">
								<img src="<?= $category->photo ?>"/>
							</div>
							<div class="col-md-12">
								<div class="title">
									<h2 class="mcu"><span class="tebal"><?= $category->name ?></span></h2>
									<div class="line-bottom"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 description">
								<?= $category->description ?>
							</div>
						</div>
						
						
						<section class="col-md-12 no-padding medical">
					<?php 
					$medical = \app\models\MedicalCheckup::findAllPublishedByCategory($category->id);
					$count =0;
					foreach($medical as $key=>$item): ?>
							<?php if($count%2==0) echo '<div class="row">'; ?>
							
							<div class="mcu-box <?= $item->color?>">
								<div class="title">
									<h3><?= $item->title ?></h3>
									<?php if(!empty($item->requirement) && $item->requirement != '-'): ?>
									<h4><?= $item->requirement ?></h4>
									<?php endif; ?>
								</div>
								<div class="mcu-content">
									<?= $item->description ?>
								</div>
								<div class="mcu-price">
									TARIF <span><?= $item->price ?></span>
								</div>
							</div>
							<?php if($count%2==1) echo '</div>'; ?>
					<?php $count++; endforeach; ?>
						</section>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>