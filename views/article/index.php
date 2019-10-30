<?php
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = 'Berita & Artikel';
?>
<section id="articles">  
	<div class="container">
		<h4 class="title text-center">BERITA & ARTIKEL</h4>
	</div>
	<div class="row menu-services">
		<div class="container">
			<div class="col-md-12 menu">
				<ul role="tablist" class="nav nav-tabs menu-list">
					<li class="col-md-6 active"><a href="<?= Url::to(['/article']) ?>">BERITA & ARTIKEL</a></li>
					<li class="col-md-6"><a href="<?= Url::to(['/event']) ?>">KEGIATAN &  PROMOSI</a></li>                                                               
				</ul>
			</div>
		</div>
	</div>
	<div class="article-container">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="patient"><span class="tebal">BERITA & ARTIKEL ST. CAROLUS</span></h2>
					<div class="line-bottom"></div>
				</div>
			</div>
            <?php
            echo ListView::widget( [
                'summary'=>'',
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'options'=>['class'=>'row'],
                'itemOptions' => [
                    'tag' => null
                ],
            ] ); ?>
		</div>
	</div>
</section>

<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="fa fa-angle-up"></span></a>
