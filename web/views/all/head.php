<?php
$isIndex = !empty($myckd) ? true : false;
?>
<?php
/*
$this->uri->segment(1); // controller
$this->uri->segment(2); // action
$this->uri->segment(3); // 1stsegment
$this->uri->segment(4); // 2ndsegment
*/
/*$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
echo $controller;
echo $method;
echo $this->uri->uri_string();*/
$current_page = uri_string();

$text_title = 'Chăm sóc da bằng Retinol và collagen tự nhiên chất lượng cao từ Hàn Quốc - CKD VIETNAM';
$text_keywords = 'Chăm sóc da bằng collagen, Serum Collagen, Retinol cho da nhạy cảm';
$text_description = 'Chăm sóc da bằng Retinol trị mụn cùng collagen tự nhiên từ Hàn Quốc. Hỗ trợ tái tạo và cung cấp dưỡng chất, giúp da mịn màng, săn chắc, trẻ trung từ bên trong';

$seo_title = !$current_page ?  $text_title : $seo->getSeo('title');
$seo_keywords = !$current_page ? $text_keywords : $seo->getSeo('keywords');
$seo_description =  !$current_page ? $text_description : $seo->getSeo('description');

$seo_author = $setting['ten' . $lang];

if($seo_title =='') $seo_title = $text_title;
if($seo_keywords =='') $seo_keywords = $text_keywords;
if($seo_description =='') $seo_description = $text_description;
?>

<title><?= $seo_title ?></title>
<link rel="manifest" href="<?= site_url() ?>assets/images/favicon/manifest.json">
<link rel="icon" href="<?= site_url() ?>favicon.ico" type="image/x-icon"/>
<link rel="canonical" href="<?= getCurrentPageURL() ?>"/>
<?php
$meta = array(
	'google-site-verification' => '',
	'robots' => 'index, follow, noodp, noydir, noarchive, max-image-preview:standard,max-video-preview:-1,max-snippet:-1,notranslate',
	'keywords' => $seo_keywords,
	'description' => $seo_description,
	'author' => $seo_author,
	'copyright' => $seo_author . " - [" . $optsetting['email'] . "]",
	'abstract' => $seo_author,
	'revisit-after' => "1 days",
	'resource-type' => "Document",
	'distribution' => "Global",
	'theme-color' => "#ffffff",
	'geo.region' => "VN",
	'geo.placename' => "Hồ Chí Minh",
	'geo.position' => "10.726993;106.707453",
	'ICBM' => "10.726993;106.707453",
	'format-detection' => "telephone=no, email=no, address=no",
	'viewport' => "user-scalable=1, width=device-width, initial-scale=1",
);
echo"\n";
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
foreach ($meta as $name => $content) {
	echo"\n";
	echo '<meta name="' . $name . '" content="' . $content . '"/>';
}
echo"\n";

$seo_w = $seo->getSeo('photo:width');
$seo_h = $seo->getSeo('photo:width');
$seo_i = $seo->getSeo('photo:img');
$seo_u = $seo->getSeo('url');
$seo_price = $seo->getSeo('price:amount');

if($seo_price ==''){
	$seo_price = '1000';
}
if($seo_u ==''){
	$seo_u = MYSITE;
}
if($seo_i ==''){
	$seo_i = MYSITE . 'assets/images/CKD-COS-VIET-NAM.jpg';
}
/*if($seo_i !=''){
	$array = explode('.',$seo_i);
	$extension = end($array);
}else{
	$extension = 'jpg';
}*/

$meta = array(
	'title'=>$seo_title,
	'site_name'=> $seo_author,
	'url'=> $seo_u,
	'type'=> 'website',
	'locale'=>'VN',
	'price:amount'=>$seo_price,
	'price:currency'=>'VND',
	'description'=> $seo_description,
	'image'=> $seo_i,
	'image:alt'=> $seo_title,
	'image:width'=> $seo_w !='' ?$seo_w : "1000",
	'image:height'=> $seo_h !='' ?$seo_w : "1000",
);
foreach ($meta as $name => $content) {
	echo"\n";
	echo '<meta property="og:' . $name . '" content="' . $content . '"/>';
}
echo"\n";
foreach ($meta as $name => $content) {
	echo"\n";
	echo '<meta property="twitter:' . $name . '" content="' . $content . '"/>';
}
echo"\n";
?>
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:creator" content="<?= $seo_author ?>"/>
<meta name="google-signin-client_id" content="63359959323-88e9odjoprlrqqejsrrt7d4gk13093gr.apps.googleusercontent.com">
<meta name="google-signin-scope" content="profile email">
<meta itemprop="name" content="<?=$text_title?>">
<meta itemprop="description" content="<?=$text_description?>">
<meta itemprop="image" content="<?=$seo_i;?>">

<base href="<?= MYSITE ?>"/>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<style type="text/css">a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }</style>
<script type="text/javascript" src="<?= MYSITE ?>assets/js/jquery.min.js?v=<?= time() ?>"></script>

<?php
if(!$isIndex):
?>
<script type="text/javascript" src="<?= MYSITE ?>assets/js/slick.min.js?v=<?= time() ?>"></script>
<?php
endif;
?>

<script type="text/javascript">
	<?=htmlspecialchars_decode($setting['headjs'])?>
	function load_css(url) {
		let link = document.createElement('link');
		link.rel = 'stylesheet';
		link.type = 'text/css';
		link.href = `assets/css/${url}.css`;
		document.body.appendChild(link)
	}
	document.addEventListener('DOMContentLoaded', function () {
		window.addEventListener('load', () => {
			load_css('bootstrap.min');
			load_css('fa');
			load_css('optimizer');
			load_css('style');
			load_css('tuan');
			//load_css('cart');
			load_css('media');
			/*load_css('text.min');*/
		});
	})

	var temp_banner = '';
	var NN_FRAMEWORK = NN_FRAMEWORK || {};
	var CONFIG_BASE = '<?=MYSITE?>';
	var WEBSITE_NAME = '<?=(isset($seo_author) && $seo_author != '') ? addslashes($seo_author) : ''?>';
	var TIMENOW = '<?=date("d/m/Y")?>';
	var SHIP_CART = <?=(isset($config['order']['ship']) && $config['order']['ship'] == true) ? 'true' : 'false'?>;
	var LANG = {
		'no_keywords': '<?=getLang('no_keywords')?>',
		'delete_product_from_cart': '<?=getLang('delete_product_from_cart')?>',
		'no_products_in_cart': '<?=$this->lang->line('no_products_in_cart')?>',
		'wards': '<?=$this->lang->line('wards')?>',
		'back_to_home': '<?=$this->lang->line('back_to_home')?>',
	};
	var empty_image = '';
	var GOTOP = empty_image;

	function site_url() {
		return '<?=MYSITE?>';
	}

	function admin_site_url() {
		return '<?=MYADMIN?>';
	}

	function aff_site_url() {
		return '<?=MYSITE_AFFILIATE?>';
	}

	var $isMobile = '<?=$isMobile?>';

</script>
<!--todo cache image-->
<!--<div class="add-image" data-img="mono">đây là thẻ cache image</div>-->
<!--todo cache data-->
<script type="text/javascript">
	function initImage() {
		var imgDefer = document.querySelectorAll('.img-lazy:not(.img-load)');
		for (let i = 0; i < imgDefer.length; i++) {
			if (imgDefer[i].getAttribute('data-src')) {
				imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
				imgDefer[i].removeAttribute('data-src');
				imgDefer[i].classList.add('img-load');
			}
		}
	}
	window.onload = initImage;
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NDB8BC2L');</script>
<!-- End Google Tag Manager -->
