<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{
	protected $com = 'san-pham';

	function __construct()
	{
		parent::__construct();


		$ref_code = getRequest('ref_code');
		$ref_uid = getRequest('ref_uid');
		$this->session->set_userdata('ref_code', $ref_code);
		$this->session->set_userdata('ref_uid', $ref_uid);
	}

	public function index()
	{

		$details = $this->uri->segment(2);
		$cate = $this->uri->segment(1);


		$this->data['url'] = $cate;

		if ($cate != 'san-pham') {
			$details = $this->uri->segment(1);
		}

		$sluglang = $this->sluglang;

		$requick = array(

			array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
			array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),
			array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
			array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),
			array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
			array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
			array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
		);


		foreach ($requick as $v) {
			$url_tbl = (isset($v['tbl']) && $v['tbl'] != '') ? $v['tbl'] : '';
			//$url_tbltag = (isset($v['tbltag']) && $v['tbltag'] != '') ? $v['tbltag'] : '';
			$url_type = (isset($v['type']) && $v['type'] != '') ? $v['type'] : '';
			$url_field = (isset($v['field']) && $v['field'] != '') ? $v['field'] : '';
			$url_com = (isset($v['com']) && $v['com'] != '') ? $v['com'] : '';

			if ($url_tbl != '' && $url_tbl != 'static' && $url_tbl != 'photo') {
				$row = $this->data['d']->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi > 0 limit 0,1", array($details, $url_type));

				if (isset($row['id']) && $row['id'] > 0) {
					$_GET[$url_field] = $row['id'];
					$details = $url_com;

					break;
				}
			}
		}


		$this->data['source'] = 'product';
		$this->data['title_crumb'] = getLang('sanpham');
		$this->data['breadcr'] = '';


		//request
		@$id = htmlspecialchars(getRequest('id'));
		@$idl = htmlspecialchars(getRequest('idl'));
		@$idc = htmlspecialchars(getRequest('idc'));
		@$idi = htmlspecialchars(getRequest('idi'));
		@$ids = htmlspecialchars(getRequest('ids'));
		@$idb = htmlspecialchars(getRequest('idb'));
		@$id_thuonghieu = htmlspecialchars(getRequest('id_thuonghieu'));
		@$id_dong = htmlspecialchars(getRequest('id_dong'));
		@$isPromotion = htmlspecialchars(getRequest('khuyen_mai'));


		$this->data['id'] = !empty($id) ? $id : '';
		$this->data['idl'] = !empty($idl) ? $idl : '';
		$this->data['idc'] = !empty($idc) ? $idc : '';
		$this->data['idi'] = !empty($idi) ? $idi : '';
		$this->data['ids'] = !empty($ids) ? $ids : '';
		$this->data['idb'] = !empty($idb) ? $idb : '';
		$this->data['id_thuonghieu'] = !empty($id_thuonghieu) ? $id_thuonghieu : '';
		$this->data['id_dong'] = !empty($id_dong) ? $id_dong : '';
		$this->data['isPromotion'] = !empty($isPromotion) ? $isPromotion : '';
		$this->data['lang'] = $this->current_lang;


		$data = $this->data;
		$d = $data['d'];
		$lang = $this->current_lang;
		$type = $this->com;
		$seo = $data['seo'];

		$seolang = $data['seolang'];
		$func = $data['func'];
		$config_base = site_url();

		$optsetting = $data['optsetting'];
		$title_crumb = $data['title_crumb'];

		$this->data['template'] = isset($_GET['id']) ? "page/product/product_detail" : "page/product/product";

		if ($id != '') {

			/* Lấy sản phẩm detail */
			$row_detail = $d->rawQueryOne("select khuyenmai, id_thuonghieu, nhaplieu_daban, gift, thetich, hethang, type, id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, mota$lang as mota, noidung$lang as noidung,noidungthanhphan$lang as noidungthanhphan, masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia, soluong from #_product where id = ? and type = ? and hienthi > 0 $isPromotion limit 0,1", array($id, $type));

			$images = array();
			preg_match_all('~src="\K[^"]+~', htmlspecialchars_decode($row_detail['noidung']), $images);
			$seo->setSeo('images', $images[0] ?? array());
			$seo->setSeo('price:amount', $row_detail['gia']);

			if (isset($_POST['submit-contact'])) {
				if (true) {
					$data = array();

					if (isset($_FILES["file"])) {
						$file_name = $func->uploadName($_FILES["file"]["name"]);
						if ($photo = $func->uploadImage("file", 'jpg|png|gif|JPG|PNG|GIF|WEBP|webp', UPLOAD_PRODUCT_L, $file_name)) {
							$data['photo'] = $photo;
						}
					}
					$data['link_video'] = (isset($_POST['link_video']) && $_POST['link_video'] != '') ? htmlspecialchars($_POST['link_video']) : 0;
					$data['tenvi'] = (isset($_POST['tenvi']) && $_POST['tenvi'] != '') ? htmlspecialchars($_POST['tenvi']) : '';
					$data['motavi'] = (isset($_POST['motavi']) && $_POST['motavi'] != '') ? htmlspecialchars($_POST['motavi']) : '';
					$data['ngaytao'] = time();
					$data['stt'] = 1;
					$data['hienthi'] = 1;
					$data['kind'] = 'man';
					$data['com'] = 'product';
					$data['type'] = $type;
					$data['val'] = 'video';
					$data['id_photo'] = $id;
					$data['id_member'] = $_SESSION[$this->data['login_member']]['id'];

					if ($d->insert('gallery', $data)) {
						transfer("Gửi đánh giá thành công. Xin cảm ơn.", getCurrentPageURL());
					} else {
						transfer("Gửi đánh giá thất bại. Vui lòng thử lại sau.", getCurrentPageURL(), false);
					}
				}
			}

			/* Cập nhật lượt xem */
			$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
			$d->where('id', $row_detail['id']);
			$d->update('product', $data_luotxem);

			/* Lấy tags */
			if ($row_detail['id_tags']) $pro_tags = $d->rawQuery("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_tags where id in (" . $row_detail['id_tags'] . ") and type='" . $type . "'");

			/* Lấy thương hiệu */
			$pro_brand = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_product_brand where id = ? and type = ? and hienthi > 0", array($row_detail['id_brand'], $type));

			/* Lấy màu */
			if ($row_detail['id_mau']) $mau = $d->rawQuery("select loaihienthi, photo, mau, id from #_product_mau where type='" . $type . "' and find_in_set(id,'" . $row_detail['id_mau'] . "') and hienthi > 0 order by stt,id desc");

			/* Lấy size */
			if ($row_detail['id_size']) $size = $d->rawQuery("select id, ten$lang as ten from #_product_size where type='" . $type . "' and find_in_set(id,'" . $row_detail['id_size'] . "') and hienthi > 0 order by stt,id desc");

			/* Lấy cấp 1 */
			$pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_list'], $type));

			/* Lấy cấp 2 */
			$pro_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_cat'], $type));

			/* Lấy cấp 3 */
			$pro_item = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_item where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_item'], $type));

			/* Lấy cấp 4 */
			$pro_sub = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_sub where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_sub'], $type));

			/* Lấy hình ảnh con */
			$hinhanhsp = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc", array($row_detail['id'], $type, $type));

			/* Lấy sản phẩm cùng loại */
			$where = "id <> '" . $id . "' and id_list = '" . $row_detail['id_list'] . "' and type = '" . $type . "' and hienthi > 0";

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$seoDB = $seo->getSeoDB($row_detail['id'], 'product', 'man', $row_detail['type']);
			$seo->setSeo('h1', $row_detail['ten']);
			if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
			else $seo->setSeo('title', $row_detail['ten']);
			if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
			if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
			$seo->setSeo('url', $func->getPageURL());
			$img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'], true) : null;
			if ($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo'])) {
				$img_json_bar = $func->getImgSize($row_detail['photo'], UPLOAD_PRODUCT_L . $row_detail['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar), 'product', $row_detail['id']);
			}
			if (is_array($img_json_bar) && count($img_json_bar) > 0) {
				$seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $row_detail['photo']);
				$seo->setSeo('photo:width', $img_json_bar['w']);
				$seo->setSeo('photo:height', $img_json_bar['h']);
				$seo->setSeo('photo:type', $img_json_bar['m']);
			}

			/* breadCrumbs */
			$breadcr = new BreadCrumbs();
 			$breadcr->setBreadCrumbs($this->com, 'Sản phẩm');
 		    $breadcr->setBreadCrumbs('san-pham/' . $pro_list[$sluglang], $pro_list['ten']);
			$breadcr->setBreadCrumbs('san-pham/' . $row_detail[$sluglang], mb_substr($row_detail['ten'], 0, 100) . '...');
			$breadcrumbs = $breadcr->getBreadCrumbs();


			$curPage = !empty($_REQUEST['p']) ? $_REQUEST['p'] : 1;
			#if ($id > 0) $per_page = $optsetting['soluong_tin'];
			#else $per_page = $optsetting['soluong_tin'];

			$per_page = 5;

			$startpoint = ($curPage * $per_page) - $per_page;
			$limit_danhgia = " limit " . $startpoint . "," . $per_page;

			$where_danhgia = "id_photo = ? and com='product' and kind='man' and link_video > 0 and photo<>'' and hienthi > 0";
			$params_danhgia = array($row_detail['id']);
			$sqlNum = "select count(*) as 'num' from #_gallery where $where_danhgia";
			$count = $d->rawQueryOne($sqlNum, $params_danhgia);
			$total = $count['num'];
			$this->data['count_danhgia'] = @$total;
			$url = getCurrentPageURL();
			$paging_danhgia = $func->pagination($total, $per_page, $curPage, $url, '#box_binhluan');

			$this->data['paging_danhgia'] = $paging_danhgia;
			$danhgia = $d->rawQuery("select ngaytao, id,tenvi,motavi, photo, link_video, id_member from #_gallery where $where_danhgia order by ngaytao desc $limit_danhgia", $params_danhgia);

			$trungbinh = $d->rawQueryOne("select avg(link_video) as tb from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc", array($row_detail['id'], $type, 'video'));


			$sao1 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='1' order by stt,id desc", array($row_detail['id'], $type, 'video'));

			$sao2 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='2' order by stt,id desc", array($row_detail['id'], $type, 'video'));

			$sao3 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='3' order by stt,id desc", array($row_detail['id'], $type, 'video'));

			$sao4 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='4' order by stt,id desc", array($row_detail['id'], $type, 'video'));

			$sao5 = $d->rawQueryOne("select count(id) as dem from #_gallery where photo<>'' and id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and link_video='5' order by stt,id desc", array($row_detail['id'], $type, 'video'));

			$this->data['title_crumb'] = '';
			$this->data['title_cat'] = $row_detail['ten'];

		} else if ($id_dong != '') {
			/* Lấy cấp 1 detail */
			$row_detail = $d->rawQueryOne("select id,type, ten$lang as ten, tenkhongdauvi, tenkhongdauen, noidung$lang as noidung, photo, options from #_news where id = ? and type = ? and hienthi > 0 limit 0,1", array($id_dong, 'dong'));

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$title_cat = $row_detail['ten'];
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
			$noidung_cap = $row_detail['noidung'];

			$seoDB = $seo->getSeoDB($row_detail['id'], 'news', 'man', $row_detail['type']);
			$seo->setSeo('h1', $row_detail['ten']);
			if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
			else $seo->setSeo('title', $row_detail['ten']);
			if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
			if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
			$seo->setSeo('url', $func->getPageURL());
			$img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'], true) : null;
			if ($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo'])) {
				$img_json_bar = $func->getImgSize($row_detail['photo'], UPLOAD_NEWS_L . $row_detail['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar), 'news', $row_detail['id']);
			}
			if (is_array($img_json_bar) && count($img_json_bar) > 0) {
				$seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_NEWS_L . $row_detail['photo']);
				$seo->setSeo('photo:width', $img_json_bar['w']);
				$seo->setSeo('photo:height', $img_json_bar['h']);
				$seo->setSeo('photo:type', $img_json_bar['m']);
			}

			/* Lấy sản phẩm */

			$where = "khuyenmai = 0 and id_dong = '" . $id_dong . "' and type = '" . $type . "' and hienthi > 0";
			//$params = array($id_dong,$type);

			/* breadCrumbs */
			/*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($details,$title_crumb);
			if($row_detail != null) $breadcr->setBreadCrumbs($row_detail[$sluglang],$pro_list['ten']);
			$breadcrumbs = $breadcr->getBreadCrumbs();*/
			$this->data['title_crumb'] = $title_cat;
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
		} else if ($id_thuonghieu != '') {
			/* Lấy cấp 1 detail */
			$row_detail = $d->rawQueryOne("select id,type, ten$lang as ten, tenkhongdauvi, tenkhongdauen, noidung$lang as noidung, photo, options from #_news where id = ? and type = ? and hienthi > 0 limit 0,1", array($id_thuonghieu, 'thuong-hieu'));

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$title_cat = $row_detail['ten'];
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
			$noidung_cap = $row_detail['noidung'];

			$seoDB = $seo->getSeoDB($row_detail['id'], 'news', 'man', $row_detail['type']);
			$seo->setSeo('h1', $row_detail['ten']);
			if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
			else $seo->setSeo('title', $row_detail['ten']);
			if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
			if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
			$seo->setSeo('url', $func->getPageURL());
			$img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'], true) : null;
			if ($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo'])) {
				$img_json_bar = $func->getImgSize($row_detail['photo'], UPLOAD_NEWS_L . $row_detail['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar), 'news', $row_detail['id']);
			}
			if (is_array($img_json_bar) && count($img_json_bar) > 0) {
				$seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_NEWS_L . $row_detail['photo']);
				$seo->setSeo('photo:width', $img_json_bar['w']);
				$seo->setSeo('photo:height', $img_json_bar['h']);
				$seo->setSeo('photo:type', $img_json_bar['m']);
			}

			/* Lấy sản phẩm */
			$where = "khuyenmai = 0 and id_thuonghieu = '" . $id_thuonghieu . "' and type = '" . $type . "' and hienthi > 0";
			//$params = array($id_thuonghieu,$type);

			/* breadCrumbs */
			/*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($details,$title_crumb);
			if($row_detail != null) $breadcr->setBreadCrumbs($row_detail[$sluglang],$pro_list['ten']);
			$breadcrumbs = $breadcr->getBreadCrumbs();*/
			$this->data['title_crumb'] = $title_cat;
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
		} else if ($idl != '') {
			/* Lấy cấp 1 detail */
			$pro_list = $d->rawQueryOne("select id, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_list where id = ? and type = ? limit 0,1", array($idl, $type));

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$title_cat = $pro_list['ten'];
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
			$noidung_cap = $pro_list['noidung'];

			$seoDB = $seo->getSeoDB($pro_list['id'], 'product', 'man_list', $pro_list['type']);
			$seo->setSeo('h1', $pro_list['ten']);
			if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
			else $seo->setSeo('title', $pro_list['ten']);
			if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
			if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
			$seo->setSeo('url', $func->getPageURL());
			$img_json_bar = (isset($pro_list['options']) && $pro_list['options'] != '') ? json_decode($pro_list['options'], true) : null;
			if ($img_json_bar == null || ($img_json_bar['p'] != $pro_list['photo'])) {
				$img_json_bar = $func->getImgSize($pro_list['photo'], UPLOAD_PRODUCT_L . $pro_list['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar), 'product_list', $pro_list['id']);
			}
			if (is_array($img_json_bar) && count($img_json_bar) > 0) {
				$seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_list['photo']);
				$seo->setSeo('photo:width', $img_json_bar['w']);
				$seo->setSeo('photo:height', $img_json_bar['h']);
				$seo->setSeo('photo:type', $img_json_bar['m']);
			}

			/* Lấy sản phẩm */
			$where = "khuyenmai = 0 and id_list = '" . $idl . "' and type = '" . $type . "' and hienthi > 0  order by stt, id desc";

			/* breadCrumbs */
			/*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($details,$title_crumb);
			if($pro_list != null) $breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten']);
			$breadcrumbs = $breadcr->getBreadCrumbs();*/
			$this->data['title_crumb'] = $title_cat;
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
		} else if ($idc != '') {
			/* Lấy cấp 2 detail */
			$pro_cat = $d->rawQueryOne("select id, id_list, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_cat where id = ? and type = ? limit 0,1", array($idc, $type));

			/* Lấy cấp 1 */
			$pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_cat['id_list'], $type));

			/* Lấy sản phẩm */
			$where = "khuyenmai = 0 and id_cat = ? and type = ? and hienthi > 0  order by stt, id desc";
			$params = array($idc, $type);

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$title_cat = $pro_cat['ten'];
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
			$noidung_cap = $pro_cat['noidung'];

			$seoDB = $seo->getSeoDB($pro_cat['id'], 'product', 'man_cat', $pro_cat['type']);
			$seo->setSeo('h1', $pro_cat['ten']);
			if (!empty($seoDB['title' . $seolang])) $seo->setSeo('title', $seoDB['title' . $seolang]);
			else $seo->setSeo('title', $pro_cat['ten']);
			if (!empty($seoDB['keywords' . $seolang])) $seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
			if (!empty($seoDB['description' . $seolang])) $seo->setSeo('description', $seoDB['description' . $seolang]);
			$seo->setSeo('url', $func->getPageURL());
			$img_json_bar = (isset($pro_cat['options']) && $pro_cat['options'] != '') ? json_decode($pro_cat['options'], true) : null;
			if ($img_json_bar == null || ($img_json_bar['p'] != $pro_cat['photo'])) {
				$img_json_bar = $func->getImgSize($pro_cat['photo'], UPLOAD_PRODUCT_L . $pro_cat['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar), 'product_cat', $pro_cat['id']);
			}
			if (is_array($img_json_bar) && count($img_json_bar) > 0) {
				$seo->setSeo('photo', $config_base . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_cat['photo']);
				$seo->setSeo('photo:width', $img_json_bar['w']);
				$seo->setSeo('photo:height', $img_json_bar['h']);
				$seo->setSeo('photo:type', $img_json_bar['m']);
			}

			/* breadCrumbs */
			/*if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($details,$title_crumb);
			if($pro_list != null) $breadcr->setBreadCrumbs($pro_list[$sluglang],$pro_list['ten']);
			if($pro_cat != null) $breadcr->setBreadCrumbs($pro_cat[$sluglang],$pro_cat['ten']);
			$breadcrumbs = $breadcr->getBreadCrumbs();*/
			$this->data['title_crumb'] = $title_cat;
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
		} else if ($idi != '') {
			/* Lấy cấp 3 detail */
			$pro_item = $d->rawQueryOne("select id, id_list, id_cat, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_item where id = ? and type = ? limit 0,1", array($idi, $type));

			/* Lấy cấp 1 */
			$pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_item['id_list'], $type));

			/* Lấy cấp 2 */
			$pro_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1", array($pro_item['id_list'], $pro_item['id_cat'], $type));

			/* Lấy sản phẩm */
			$where = "khuyenmai = 0 and id_item = ? and type = ? and hienthi > 0";
			$params = array($idi, $type);

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$title_cat = $pro_item['ten'];
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
			$noidung_cap = $pro_item['noidung'];

			$this->data['title_crumb'] = $title_cat;
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);

		} else if ($ids != '') {
			/* Lấy cấp 4 */
			$pro_sub = $d->rawQueryOne("select id, id_list, id_cat, id_item, ten$lang as ten,noidung$lang as noidung, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_sub where id = ? and type = ? limit 0,1", array($ids, $type));

			/* Lấy cấp 1 */
			$pro_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $type));

			/* Lấy cấp 2 */
			$pro_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $pro_sub['id_cat'], $type));

			/* Lấy cấp 3 */
			$pro_item = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product_item where id_list = ? and id_cat = ? and id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $pro_sub['id_cat'], $pro_sub['id_item'], $type));

			/* Lấy sản phẩm */
			$where = "khuyenmai = 0 and id_sub = ? and type = ? and hienthi > 0";
			$params = array($ids, $type);

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$title_cat = $pro_sub['ten'];
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);
			$noidung_cap = $pro_sub['noidung'];


		} else if ($idb != '') {
			/* Lấy brand detail */
			$pro_brand = $d->rawQueryOne("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id, type, photo, options from #_product_brand where id = ? and type = ? limit 0,1", array($idb, $type));

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			$title_cat = $pro_brand['ten'];
			$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_cat);


			/* Lấy sản phẩm */
			$where = "khuyenmai = 0 and id_brand = '" . $pro_brand['id'] . "' and type = '" . $type . "' and hienthi > 0";

		} else if ($details == 'khuyen-mai') {


			$row_detail = $d->rawQueryOne("select nhaplieu_daban, gift, thetich, hethang, type, id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, mota$lang as mota, noidung$lang as noidung,noidungthanhphan$lang as noidungthanhphan, masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia, soluong from #_product where type = ? and hienthi > 0  and khuyenmai = 1", array($type));


			//https://ckdvietnam.com/admin/index.php?com=product&act=man&type=san-pham&khuyenmai=1

			/* SEO */
			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);


			/* Lấy tất cả sản phẩm */


			$where = "type = '" . $type . "' and hienthi > 0 and khuyenmai = 1 order by stt, id desc";

			/* breadCrumbs */

		} else if ($details == 'tot-nhat') {
			/* SEO */

			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			/* Lấy tất cả sản phẩm */
			$where = "khuyenmai = 0 and type = '" . $type . "' and hienthi > 0 and noibat > 0  order by stt, id desc";

			/* breadCrumbs */

		} else if ($details == 'moi') {
			/* SEO */

			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			/* Lấy tất cả sản phẩm */
			$where = "khuyenmai = 0 and type = '" . $type . "' and hienthi > 0 and moi > 0  order by stt, id desc";

			/* breadCrumbs */

		} else if ($details == 'khuyen-mai') {


			/* Lấy tất cả sản phẩm */
			$where = "type = '" . $type . "' and hienthi > 0 and banchay > 0  order by stt, id desc";


		} else {


			/* SEO */

			if (!empty($row_detail['photo'])) $seo->setSeo('photo:img', MYSITE . UPLOAD_PRODUCT_L . $row_detail['photo']);

			/* Lấy tất cả sản phẩm */
			$where = "khuyenmai = 0 and type = '" . $type . "' and hienthi > 0 order by stt, id desc";

			/* breadCrumbs */

		}

		$sosp = $optsetting['soluong_sp'] ?? 10;
		//$where = " $where";
		$dem = $d->rawQueryOne("SELECT count(id) AS numrows FROM #_product where $where");

		$solan_max = ceil($dem['numrows'] / $sosp);


		$this->data['noidung_cap'] = !empty($noidung_cap) ? $noidung_cap : '';
		$this->data['pro_brand'] = !empty($pro_brand) ? $pro_brand : '';
		$this->data['row_detail'] = !empty($row_detail) ? $row_detail : '';
		//var_dump($where);die;
		$this->data['where'] = $where;
		$this->data['sosp'] = $sosp;
		$this->data['dem'] = $dem;
		$this->data['solan_max'] = $solan_max;
		//$this->data['title_cat'] = !empty($title_cat) ? $title_cat : '';
		//$this->data['title_crumb'] = $title_crumb;


		$sluglang_cat = $this->uri->segment(2);

		$pro_cat = $d->rawQueryOne("select photo from #_product_list where tenkhongdau$lang = ? and  type = ? limit 0,1",

			array($sluglang_cat, $this->com));

		$this->data['pro_cat'] = !empty($pro_cat) ? $pro_cat : '';


		if ($this->data['template'] != 'page/product/product') {
			$this->data['danhgia'] = !empty($danhgia) ? $danhgia : '';
			$this->data['trungbinh'] = !empty($trungbinh) ? $trungbinh : '';
			$this->data['sao1'] = !empty($sao1) ? $sao1 : '';
			$this->data['sao2'] = !empty($sao2) ? $sao2 : '';
			$this->data['sao3'] = !empty($sao3) ? $sao3 : '';
			$this->data['sao4'] = !empty($sao4) ? $sao4 : '';
			$this->data['sao5'] = !empty($sao5) ? $sao5 : '';
			$this->data['mau'] = !empty($mau) ? $mau : '';
			$this->data['size'] = !empty($size) ? $size : '';
			$this->data['pro_tags'] = !empty($pro_tags) ? $pro_tags : '';
			$this->data['pro_list'] = !empty($pro_list) ? $pro_list : '';
			$this->data['pro_item'] = !empty($pro_item) ? $pro_item : '';
			$this->data['pro_sub'] = !empty($pro_sub) ? $pro_sub : '';
			$this->data['hinhanhsp'] = !empty($hinhanhsp) ? $hinhanhsp : '';
			$this->data['active'] = true;//$config['order']['active']
			$this->data['breadcr'] = !empty($breadcrumbs) ? $breadcrumbs : '';


			$detect = new MobileDetect();

			$isMobile = $detect->isMobile();

			if ($isMobile) {

				$this->data['template'] = 'page/product/product_detail_mb';
				$this->load->view('product_details', $this->data);
			} else {
				$this->data['template'] = 'page/product/product_detail';
				$this->load->view('template', $this->data);
			}

		} else {

			$lan = 0;
			$sql_sp = "hethang, photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id, moi, mota$lang as mota, soluong";
			$sosp = $optsetting['soluong_spk'] ?? 10;
			$lan2 = $lan * $sosp;
			// limit $lan2,$sosp
			$product = $d->rawQuery("select $sql_sp from #_product where $where");


			//todo breack up
			//ww(getLang('totnhat'));

			if ($product) {
				$this->data['template'] = 'page/product/my_product';
				$this->data['html'] =  get_product($product, $sluglang);
			}


			$this->load->view('template', $this->data);

		}



	}


}
