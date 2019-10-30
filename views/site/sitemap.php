<?php use yii\helpers\Url; ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
	 
<?php foreach ($sites as $item): ?>
  <url>
    <loc><?= Url::base(true).'/'.$item['url'] ?></loc>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach ?>

<?php foreach ($articles as $item): ?>
  <url>
    <loc><?= Url::base(true).$item->getUrl() ?></loc>
    <changefreq>daily</changefreq>
    <priority>0.6</priority>
  </url>
  <?php endforeach ?>

 <?php foreach ($events as $item): ?>
  <url>
    <loc><?= Url::base(true).$item->getUrl() ?></loc>
    <changefreq>daily</changefreq>
    <priority>0.6</priority>
  </url>
  <?php endforeach ?>

  <?php foreach ($doctors as $item): ?>
  <url>
    <loc><?= Url::base(true).$item->getLink() ?></loc>
    <changefreq>daily</changefreq>
    <priority>0.6</priority>
  </url>
  <?php endforeach ?>
	  
	
</urlset>