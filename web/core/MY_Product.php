<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MY_Product extends MY_Controller
{
	protected $com = 'san-pham';
	protected $mydata;
	public function __construct()
	{
		parent::__construct();

	}

	public function search()
	{
		$keyword = $this->input->get('keyword', true);
		$get_page = $this->input->get('p', true);
		if (empty($get_page)) $get_page = 1;

		$d = $this->data['d'];
		$func = $this->data['func'];
		$lang = $this->current_lang;
		$optsetting = $this->data['optsetting'];

		if (!empty($keyword)) {
			$tukhoa = htmlspecialchars($keyword);
			$tukhoa_khongdau = $func->changeTitle($tukhoa);

			$where = "";
			$where = "type = ? and (REPLACE(ten$lang, 'đ', 'd') LIKE ? or tenkhongdau$lang LIKE ?) and hienthi > 0";
			$params = array("san-pham", "%$tukhoa%", "%$tukhoa_khongdau%");

			$curPage = $get_page;
			$per_page = $optsetting['soluong_sp'];

			$startpoint = ($curPage * $per_page) - $per_page;
			$limit = " limit " . $startpoint . "," . $per_page;
			$sql = "select photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id, moi, mota$lang as mota, soluong from #_product where $where order by stt,id desc $limit";
			$product = $d->rawQuery($sql, $params);
			$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
			$count = $d->rawQueryOne($sqlNum, $params);
			$total = $count['num'];
			$url = $func->getCurrentPageURL();
			$paging = $func->pagination($total, $per_page, $curPage, $url);

			$this->data['product'] = $product;
			$this->data['paging'] = $paging;
		}


		$this->data['template'] = 'page/product/product_layout';
		$this->load->view('template', $this->data);
	}
}
