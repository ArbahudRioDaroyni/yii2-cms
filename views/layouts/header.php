<?php 
use yii\helpers\Url;
use app\models\Lookup;
?>
<header id="header">
	<div class="header-wrapper">
		<div class="container">
			<nav id="nav" class="navbar navbar-expand">
				<a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
					<img src="<?= Lookup::get('logo-image') ?>" alt=""/>
				</a>
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a href="<?= Url::to(['site/about']) ?>" class="nav-link">Tentang Kami</a>
						</li>
						<li class="nav-item">
							<a href="<?= Url::to(['site/service']) ?>" class="nav-link">Pelayanan Kami</a>
						</li>
						<li class="nav-item">
							<a href="<?= Url::to(['article/index']) ?>" class="nav-link">Berita & Artikel</a>
						</li>
						<li class="nav-item">
							<a href="<?= Url::to(['site/contact']) ?>" class="nav-link">Hubungi Kami</a>
						</li>
						<li class="nav-item">
							<a href="<?= Url::to(['career/index']) ?>" class="nav-link">Karir</a>
						</li>
						<li class="nav-item">
							<a href="<?= Url::to(['site/contact']) ?>" class="nav-icon">
								<img src="<?= $baseUrl ?>/images/icon/icon-map-marker.png" alt=""/>
							</a>
						</li>
						<li class="nav-item">
                            <?php if(Yii::$app->controller->id=='site' && Yii::$app->controller->action->id == 'index'): ?>
							<a href="#cari-informasi" class="nav-icon">
								<img src="<?= $baseUrl ?>/images/icon/icon-search.png" alt=""/>
							</a>
                            <?php else: ?>
                            <a href="<?= Url::toRoute(['/search/index']) ?>" class="nav-icon">
								<img src="<?= $baseUrl ?>/images/icon/icon-search.png" alt=""/>
							</a>
                            <?php endif ?>
						</li>
					</ul>
				</div>
			</nav>

		</div>
		<nav id="second-nav" class="navbar navbar-expand">
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a href="<?= Url::to(['doctor/index']) ?>" class="nav-link">Cari Dokter Spesialis &gt;</a>
					</li>
					<li class="nav-item">
						<a href="<?= Url::to(['site/service']) ?>#outpatient" class="nav-link">Daftar Rawat Jalan &gt;</a>
					</li>
					<li class="nav-item">
						<a href="<?= Url::to(['site/service']) ?>#inpatient" class="nav-link">Daftar Rawat Inap &gt;</a>
					</li>
					<li class="nav-item">
						<a href="<?= Url::to(['site/service']) ?>#excellence" class="nav-link">Fasilitas &gt;</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>