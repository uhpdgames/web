<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'Home';

$route['404_override'] = 'Home/Page404';
$route['process'] = 'Home/process';
$route['video'] = 'Home/video';
$route['lien-he'] = 'Home/lienhe';

$route['gio-hang'] = 'Order/index';

$route['review'] = 'News/review';

$route['tin-tuc/(.*)'] = 'News/details';
$route['tin-tuc'] = 'News/sukien';
$route['noi-bo'] = 'News/noibo';
$route['noi-bo/(.*)'] = 'News/noibochitiet';

$route['su-kien'] = 'News/sukien';
$route['su-kien/(.*)'] = 'News/details';

$account = [
	'dang-ky',
	'kich-hoat',
	'dang-nhap',
	'dang-xuat',
	'thong-tin',
	'quen-mat-khau',
	'lich-su-mua-hang',
	'fb_logout',
];

foreach ($account as $ac) {
	$route['account/' . $ac] = 'Account/index';
}

$route['account'] = 'Account/thongtin';

$route['sitemap.xml'] = "Seo/index";
$route['zalo_return'] = 'Api/zalo_return';
$route['momo_return'] = 'Api/momo_return';
$route['momo_ipn'] = 'Api/momo_ipn';
$route['onepay_callback'] = 'Api/onepay_callback';


$slug = ($this->uri->segment(1)) ? $this->uri->segment(1) : false;
if ($slug) {
	require_once SHAREDLIBRARIES . 'class/class.PDODb.php';
	$info_db = array(
		'server-name' => DB_HOST,
		'url' => '/',
		'type' => 'mysql',
		'host' => DB_HOST,
		'username' => DB_USER,
		'password' => DB_PASS,
		'dbname' => DB_NAME,
		'port' => 3306,
		'prefix' => 'table_',
		'charset' => 'utf8'
	);
	$d = new PDODb($info_db);

	$requick = array(
		array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
		array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),
		array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
		array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),
		array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
		//array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
		//array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
		//array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
		//array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
		//array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
		array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
		array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
		//array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),
	);
	//$config_base = MYSITE;

	$all_link = array();
	foreach ($requick as $value) {
		$table = $value['tbl'] ?? '';
		$type = $value['type'] ?? '';
		$com = $value['com'] ?? '';

		$sitemap = null;
		if ($type != '' && $table != 'photo') {
			$sitemap = $d->rawQuery("select tenkhongdauvi as ten, ngaytao from #_$table where type = ? and hienthi > 0", array($type));
		}

		if (!empty($sitemap) && is_array($sitemap) && count($sitemap) > 0) {
			foreach ($sitemap as $vv) {


				switch ($com) {
					case 'san-pham':
					case 'dong':
					case 'thuong-hieu':
						$route['san-pham/' . $vv['ten']] = "Product/index";
						$route[$vv['ten']] = "Product/index";
						break;

					case 'su-kien':
					case 'tin-tuc':
						//$route[$vv['ten']] = 'News/details';
						break;
				}
			}
		}
	}

	$d = new PDODb($info_db);

	$myPages = $d->rawQuery('select url from #_pages where hienthi > 0 and url <>"" ');

	foreach ($myPages as $value) {
		if (
			strpos($value['url'], 'san-pham') !== false
			||
			strpos($value['url'], 'tin-tuc') !== false
			||
			strpos($value['url'], 'noi-bo') !== false
			||
			strpos($value['url'], 'su-kien') !== false
		) {
			continue;
		}

		$route[$value['url']] = "News/index";
	}
}

$route['ckd'] = "Product/index";
$route['san-pham/co-the-toc'] = "Product/index";
$route['san-pham/tot-nhat'] = "Product/index";
$route['san-pham/moi'] = "Product/index";
$route['san-pham'] = "Product/index";
$route['san-pham/khuyen-mai'] = "Product/index";


//todo router page
$route['facebook-privacy-policy.html'] = 'Pages/view/$1';
#$route['pages/(:any)'] = 'pages/view/$1';