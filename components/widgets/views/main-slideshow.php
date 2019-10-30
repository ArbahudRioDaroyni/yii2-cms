<section id="main-slider" class="main-slider">
	<div class="slideshow">
        <?php foreach($slides as $slide): ?>
		<div class="slide">
			<img src="<?= $slide->image ?>">
			<div class="text-contain">
                <?php if(!empty($slide->link)): ?>
                    <a href="<?= $slide->link?>">
                        <h2><?= $slide->caption ?></h2>
					</a>
                <?php else: ?>
                    <h2><?= $slide->caption ?></h2>
                <?php endif; ?>
				<h5><?= $slide->description ?></h5>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>