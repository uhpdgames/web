<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cache extends MY_Controller
{
	private $html = '';

	function __construct()
	{
		parent::__construct();
	}


	function create()
	{
		$this->data['template'] = 'common/cache';
		$this->load->view('template', $this->data);
	}


	function create_review()
	{
		$this->review(0);
		$this->review(1);
		$this->review(2);
		$this->review(3);
	}

	private function review($stt)
	{

		$offset = 20 *$stt;
		$d = $this->data['d'];
		//$lang = 'vi';
		$review = $d
			->rawQuery
			("select n.tenvi as ten, n.id, n.photo,icon, n.type, TRIM(n.motavi) as mota, p.photo as prod_photo, p.tenkhongdauvi as url
from table_news n
INNER JOIN table_product p on p.id = n.id_list
where n.type = 'review' and n.hienthi > 0 order by n.stt,n.id desc limit {$offset},20;",


			);

		$review = json_encode($review);

		$path = SHAREDPATH . "json/review{$stt}.json";
		@file_put_contents($path, $review);
	}


	function footer()
	{

	}
}
