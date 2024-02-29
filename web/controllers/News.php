<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends MY_Controller
{
	protected $com = '';
	protected $id = 0;

	function __construct()
	{
		parent::__construct();

		$com = $this->uri->segment(2);
		$details = $this->uri->segment(1);

		if($details == 'noi-bo'){
			$this->com = 'noi-bo';
		//	$this->noibo();
		}

		if ($com == NULL) $com = $details;

		if ($com == 'bai-viet') {
			$com = 'brand';
		} elseif ($com == 'gioi-thieu') {
			$com = 'static';
		}else if($com=='cam-nang'){
			$com = 'tin-tuc';
		}else if($com=='tin-tuc'){
			$com = 'tin-tuc';
		}
		$this->router = $com;

		$sluglang = $this->data['sluglang'];
		//$this->mydata = $this->data;

		//$this->mydata['template'] = !empty($com) ? "page/news/news_detail" : "page/news/news";
		$requick = array(
			/* Sản phẩm */
			array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
			array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),

			array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
			array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
			array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),

			array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
			array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
		);

		foreach ($requick as $v) {
			$url_tbl = (isset($v['tbl']) && $v['tbl'] != '') ? $v['tbl'] : '';
			//$url_tbltag = (isset($v['tbltag']) && $v['tbltag'] != '') ? $v['tbltag'] : '';
			$url_type = (isset($v['type']) && $v['type'] != '') ? @$v['type'] : '';
			$url_field = (isset($v['field']) && $v['field'] != '') ? @$v['field'] : '';
			$url_com = (isset($v['com']) && $v['com'] != '') ? @$v['com'] : '';

			if ($url_tbl != '' && $url_tbl != 'static' && $url_tbl != 'photo') {
				$row = $this->data['d']->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi > 0 limit 0,1", array($com, $url_type));

				if (isset($row['id']) && $row['id'] > 0) {
					$_GET[$url_field] = $row['id'];

					$this->id = $row['id'];

					$com = $url_com;
					$this->com = $com;

					$this->session->set_flashdata('idEntry', $this->id);

					break;
				}
			}
		}



		$this->data['template'] = !empty($this->uri->segment(2)) ? "page/news/news_detail" : "page/news/news";
	}

	function index()
	{

		$slug= ($this->uri->segment(1)) ? $this->uri->segment(1) : false;

		if(empty($slug)){
			redirect(MYSITE);
		}


		$url = ENDPOINT_CKD_API. "fetch?select=seo_title,seo_keyword,seo_description,url,csspath,jspath,name,contentvi,description&url={$slug}&website=ckd&hienthi=1&data=1";


		$get_data = callAPI('GET', $url);
		$response = json_decode($get_data, true);


		$this->data['items'] = $response;

		$seo = $this->data['seo'];
		$seo->setSeo('title', @$response['seo_title']);
		$seo->setSeo('description', @$response['seo_description']);
		$seo->setSeo('keywords', @$response['seo_keyword']);
		$seo->setSeo('photo:img', 'https://ckdvietnam.com/assets/images/CKD-COS-VIET-NAM.jpg');

		$this->data['template'] = "page/news/baiviet";
		$this->load->view('template', $this->data);


		//http://localhost/erp/api/fetch?select=name,contentvi&code=bai_viet_thuong_hieu&website=ckd

		//	$this->dataTwig['footers'] = (array)@json_decode(file_get_contents($url));
		//return $this->twig->render('index2.html', $this->dataTwig);

	}

	public function sukien()
	{

		$this->com = $this->uri->segment(1);
		if($this->router){
			//	$this->com = $this->router;
		}

		$this->id = $this->session->flashdata('idEntry');

		if (empty($this->com)) {
			redirect(site_url(), 'refresh');
		} else {
			if ($this->com == 'bai-viet') {
				$this->com = 'brand';
			}
			if ($this->com == 'cam-nang') {
				$this->com = 'tin-tuc';
			}
		}

		$func = $this->data['func'];
		$d = $this->data['d'];
		$optsetting = $this->data['optsetting'];
		$per_page = $optsetting['soluong_tin'];

		$curPage = !empty($_REQUEST['p']) ? $_REQUEST['p'] : 1;
		$url = $func->getCurrentPageURL();
		$lang = $this->current_lang;

		$removeStr = str_replace('-', '', $this->com);
		$title_crumb = getLang($removeStr);

		$params = array($this->com);
		$where = "type = ? and hienthi > 0 ";

		if ($this->uri->segment(1) == 'cam-nang') {
			$where .= ' and id_list = 7';
		}


		$isBrand = $this->uri->segment(1) == 'brand' && $this->data['isMobile'];

		$this->data['fullpage'] = false;

		$select = '';
		if ($this->id) {
			$params = array($this->id);
			$where = "id = ? and hienthi > 0";
			$select = 'noidung' . $lang . ' as noidung,';
			$this->data['template'] = "page/news/baiviet";
			if ($this->com != 'brand') $this->data['fullpage'] = 'fullpage';

		}

		if($isBrand){
			$this->data['isBrand'] = 1;
			$this->data['image'] = MYSITE . 'assets/images/brand.png';
		}

		$startpoint = ($curPage * $per_page) - $per_page;

		$limit = " limit " . $startpoint . "," . $per_page;

		$sql = "select het_han, $select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by ngaytao desc $limit";
		$item = $d->rawQuery($sql, $params);
		$sqlNum = "select count(*) as 'num' from #_news where $where";

		$count = $d->rawQueryOne($sqlNum, $params);

		$per_page = @$optsetting['soluong_tin'];
		$total = @$count['num'];


		$paging = $func->pagination($total, $per_page, $curPage, $url);

		if (empty($title_crumb) && !empty($item[0]['ten'])) {
			$title_crumb = $item[0]['ten'];
		}
		$this->data['router'] = $this->com;
		$this->data['item'] = $item;
		$this->data['title_crumb'] = $title_crumb;
		$this->data['paging'] = $paging;


		$params = array($this->com);

		$where = " noibat = 1 and type = ? and hienthi > 0";

		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by ngaytao desc limit 0,10";
		$news = $d->rawQuery($sql, $params);

		$this->data['news'] = $news; //$news

		$this->data['breadcr'] = create_BreadCrumbs($this->com, $title_crumb);

		//su-kien
		#var_dump($this->com);
		$this->load->view('template', $this->data);
	}
	public function details()
	{
		$func = $this->data['func'];
		$d = $this->data['d'];
		$optsetting = $this->data['optsetting'];

		$lang = $this->current_lang;

		$params = array($this->id, $this->com);
		$where = " id = ? and type = ? and hienthi > 0";

		$sql = "select options2, photo, id, ten$lang as ten, tenkhongdauvi, noidung$lang as noidung, ngaytao, mota$lang as mota from #_news where $where order by ngaytao desc";
		$item = $d->rawQueryOne($sql, $params);

		$title_crumb = @$item['ten'];
		$noidung = @$item['noidung'];

		$type = $this->uri->segment(1) ?? 'su-kien';
		$params = array($type);
		$where = " noibat = 1 and type = ? and hienthi > 0";

		$sql = "select options2, id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by ngaytao desc limit 0,10";
		$news = $d->rawQuery($sql, $params);

		$this->data['news'] = $news; //$news
		$this->data['router'] = $this->com;
		$this->data['type'] = $item;
		$this->data['row_detail'] = $item;
		$this->data['type'] = $this->com;
		$this->data['id'] = $this->id;
		$this->data['noidung'] = $noidung;
		$this->data['title_crumb'] = $title_crumb;
		$this->data['template'] = 'page/news/news_detail';

		$breadcr = $this->data['breadcr'];

		$seo = $this->data['seo'];

		$images = array();
		if(!empty($item['noidung'])) preg_match_all('~src="\K[^"]+~', htmlspecialchars_decode($item['noidung']), $images);
		$seo->setSeo('images', $images[0] ?? array());
		$seo->setSeo('datePublished', date("c", $item['ngaytao'] ));

		$seo->setSeo('title', $item['ten']);
		$seo->setSeo('description', $item['mota']);
		$seo->setSeo('photo:img', MYSITE . UPLOAD_NEWS_L . $item['photo']);

		$removeStr = str_replace('-', '', $this->com);
		$title_crumb_link = getLang($removeStr);
		$breadcr->setBreadCrumbs($this->com, $title_crumb_link);
		$breadcr->setBreadCrumbs($this->com .'/' .$item['tenkhongdauvi'], $title_crumb);
		$this->data['breadcr'] = $breadcr->getBreadCrumbs();
		$this->load->view('template', $this->data);
	}
	public function review()
	{
		$d = $this->data['d'];
		$func = $this->data['func'];
		$lang = $this->current_lang;
		$optsetting = $this->data['optsetting'];

		$this->data['source'] = 'news';
		$this->data['template'] = 'page/news/review';


		$this->data['type'] = 'review';


		$curPage = !empty($_REQUEST['p']) ? (int)$this->input->get('p', true) : 1;
		$per_page = $optsetting['soluong_tin'];

		$startpoint = ($curPage * $per_page) - $per_page;
		$params = array('review');

		$where = "type = ? and hienthi > 0";
		$limit = " limit " . $startpoint . "," . $per_page;

		$sql = "select options2, id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql, $params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum, $params);

		$url = $func->getCurrentPageURL();
		$total = $count['num'];


		$paging = $func->pagination($total, $per_page, $curPage, $url);

		$this->data['paging'] = $paging;
		$this->data['news'] = $news;
		$this->data['noidung_cap'] = '';
		$this->data['title_crumb'] = 'REVIEW';

		$this->load->view('template', $this->data);
	}


	public function noibo(){
		$this->com = 'noi-bo';
		//$list = https://admin.ckdvietnam.com/api?code=news

		$url = ENDPOINT_CKD_API . "fetch?code=news&select=*&data=0";
		$get_data = @callAPI('GET', $url);
		$response = @json_decode($get_data, true);

		$this->data['breadcr'] = create_BreadCrumbs($this->com, 'Tin tức nội bộ');

		$this->data['template'] = 'page/news/tintuc';
		$this->data['router'] = $this->com;
		$this->data['title_crumb'] = 'Tin tức nội bộ';

		$this->data['paging']= '';

		$this->data['news'] = $response;
		$this->data['item'] = $response;


		$this->load->view('template', $this->data);
	}

	public function noibochitiet(){
		$com = $this->uri->segment(2);
		//$details = $this->uri->segment(1);
		$this->com = 'noi-bo';

     	#	$url = ENDPOINT_CKD_API . "fetch?url=".$com;

		#var_dump($url);
		#$get_data = @callAPI('GET', $url);
		#$response = @json_decode($get_data, true);

		$id = $this->input->get('details');


		$d = $this->data['d'];


		$sql = "select id, name as ten, url as tenkhongdauvi, image as photo, description as mota, contentvi as noidung from #_pages where id = ?";

		$news = $d->rawQueryOne($sql, array($id));


		$this->id = $news['id'];
		$title_crumb = @$news['ten'];
		$noidung = @$news['noidung'];

		$item = 'noi-bo';

		$where = ' noibat = 1 and type = ? and hienthi > 0';
		$type = 'tin-tuc';
		$params = array($type);

		$row_detail = [
			'ten' =>	$news['ten'],
			'noidung' =>	$news['noidung'],
		];

		$lang = $this->current_lang;

		$sql = "select options2, id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota, id_list,icon from #_news where $where order by ngaytao desc limit 0,10";
		$news = $d->rawQuery($sql, $params);

		$this->data['news'] = $news; //$news

		$this->data['router'] = $this->com;
		$this->data['type'] = $item;
		$this->data['row_detail'] = $row_detail;
		$this->data['type'] = $this->com;
		$this->data['id'] = $this->id;
		$this->data['noidung'] = $noidung;
		$this->data['title_crumb'] = $title_crumb;
		$this->data['template'] = 'page/news/tintuc_chitiet';
		$this->data['paging'] = '';


		$this->data['breadcr'] = create_BreadCrumbs($this->com, 'Tin tức nội bộ');

		$breadcr = $this->data['breadcr'];

		#$seo = $this->data['seo'];
		$seo = $this->data['seo'];

		$images = array();
		if(!empty($item['noidung'])) preg_match_all('~src="\K[^"]+~', htmlspecialchars_decode($item['noidung']), $images);
		$seo->setSeo('images', $images[0] ?? array());
#		$seo->setSeo('datePublished', date("c", $item['ngaytao'] ));

	//	$seo->setSeo('title', $item['ten']);
	//	$seo->setSeo('description', $item['mota']);
		//$seo->setSeo('photo:img', MYSITE . UPLOAD_NEWS_L . $item['photo']);

		$removeStr = str_replace('-', '', $this->com);
		$title_crumb_link = getLang($removeStr);
		#$breadcr->setBreadCrumbs($this->com, $title_crumb_link);
		#$breadcr->setBreadCrumbs($this->com .'/' .$item['tenkhongdauvi'], $title_crumb);
	//	$this->data['breadcr'] = $breadcr->getBreadCrumbs();
		$this->data['breadcr'] = '';
		$this->load->view('template', $this->data);

	}
}
