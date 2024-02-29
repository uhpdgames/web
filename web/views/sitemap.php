<?php header('Content-type: text/xml'); ?>

<?php '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?= base_url();?></loc>
		<priority>1.0</priority>
	</url>

	<?php
	foreach($requick as $value)
	{
		createSitemap($d, $value['com'],$value['type'],$value['field'],$value['tbl'],"c","weekly","1","vi","stt,id",@$value['menu']);
	}

	?>


</urlset>
