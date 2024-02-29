<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Api2 extends RestController
{
	// public function __construct()
	// 	{
	// 		parent::__construct();

	// 		#header('Access-Control-Allow-Origin: *');
	// 		#header("Content-type: application/json; charset=utf-8");

	// 		$this->data['api'] = true;
	// 		$this->data['token_key'] = 'ckdcosvietnam';

	// 		$this->data['table_name'] = '';
	// 		$this->data['id_details'] = '';

	// 		if(@getRequest('token_key') != $this->data['token_key']){
	// 			exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP');
	// 		}
	// 	}



	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->database();
		//		$key = $this->head('APIKEY');
		//		var_dump(mySetting('API_KEY'));
		#if (mySetting('API_KEY') != '8qKXKHhSLIt21UQVO7lt1tyPQiokwBe63MjHho7azHtty6QlSqQD') {
		#exit('Bạn không có quyền truy cập');
		#}
	}

	function fetch_get()
	{
		//endpoint: http://localhost/erp/api | https://admin.ckdvietnam.com/api


		//http://localhost/erp/api/{code}

		$id = $this->get('id');

		$url = $this->get('url');
		$code = $this->get('code');
		$cate = $this->get('cate');
		$name = $this->get('name');
		$select = $this->get('select');
		$description = $this->get('description');

		$data = $this->get('data');

		$where = "hienthi > 0";

		if ($code && $where != '') {
			$where .= " and code ='{$code}'";
		}
		if ($url && $where != '') {
			$where .= " and url ='{$url}'";
		}
		if ($cate && $where != '') {
			$where .= " and cate ='{$cate}'";
		}
		if ($id && $where != '') {
			$where .= " and id ='{$id}'";
		}
		if ($name && $where != '') {
			$where .= " and name ='{$name}'";
		}
		if ($description && $description != '') {
			$where .= " and description ='{$description}'";
		}
		//http://localhost/erp/api/fetch?select=id&code=ctv-menu&data=1
		$items = get_data2('pages', $where, $select, $data);

		$this->response($items, 200);
	}

	function index_get()
	{
		//endpoint: http://localhost/erp/api | https://admin.ckdvietnam.com/api

		//http://localhost/erp/api/{code}



		$id = $this->get('id');
		$code = $this->get('code');
		$cate = $this->get('cate');
		$name = $this->get('name');

		//$field = $this->get('field');


		$where = "";

		if ($code) {
			$where = "code ='{$code}'";
		}
		if ($cate) {
			$where = "cate ='{$cate}'";
		}
		if ($id) {
			$where = "id ='{$id}'";
		}
		if ($name) {
			$where = "name ='{$name}'";
		}


		if ($where != '') {
			$where .= " and hienthi > 0";
		} else {
			$where = 'hienthi > 0';
		}

		/*if($field ==''){
			$field = '**';
		}*/

		//	$items = get_data('pages', $where, $field);

		#$d = $this->data['d'];

		$items = get_data('pages', $where, '**');

		$this->response($items, 200);
	}

	function twig_get()
	{
		$twig = new Twig();

		//?arr[]=1&arr[]=2&arr[]=3&arr[]=4

		$file = @$this->get('file');
		$json = @$this->get('json');

		$data = @json_decode($json, true) ?? ['name' => 'sddsd'];

		$twig->render($file, $data);
	}

	function tab_get()
	{
		$id = $this->get('id');

		$url = $this->get('url');

		$data = $this->get('data');
		$key = $this->get('key');
		$select = $this->get('select');
		$tab = $this->get('table');
		$where = $this->get('where');
		$order_by = $this->get('order_by');
		$limit = $this->get('limit');
		$offset = $this->get('offset');

		$mykey = mySetting('API_KEY');

		//if($key != $mykey) exit('AM DIE!');
		if (empty($select) || $select == '') $select = '*';


		$sql = "select {$select} from #_{$tab}";
		if ($where) {
			$sql .= " where {$where}";
		}
		if ($order_by) {
			$sql .= " ORDER BY {$order_by}";
		}

		if ($limit && $offset) {
			$sql .= " LIMIT {$limit} OFFSET {$offset}";
		}

		$d = $this->data['d'];


		if ($data) {
			$items = $d->rawQueryOne($sql);
		} else {
			$items = $d->rawQuery($sql);
		}


		$this->response($items, 200);
	}

	/*
		public function index_post()
		{
			//Web service of type POST method
			$this->response(["Hello World"], REST_Controller::HTTP_OK);

			$data = [

			];

			//todo insert
			$insert = true;
			if ($insert) {
				$this->response([
					'status' => true,
					'message' => 'new insert'
				], RestController::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'error insert'
				], RestController::HTTP_BAD_REQUEST);
			}

		}

		function index_put($id = 0)
		{

			echo 'put';
		}

		function index_del($id = 0)
		{

			echo 'del';
		}


		*/
}
