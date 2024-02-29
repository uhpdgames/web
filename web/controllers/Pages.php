<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

class Pages extends MY_Controller
{
	protected $com = '';

	function __construct()
	{
		parent::__construct();
	}

	public function fb()
	{


		$this->data['template'] = 'facebook-privacy-policy';
		$this->load->view('template', $this->data);
	}

	public function view($page = 'static')
	{

		if (!file_exists(SHAREDVIEW . 'sites/' . $page . '.php')) {
			show_404();
		}
		$this->data['template'] = 'sites/' . $page;
		$this->load->view('template', $this->data);
	}

	public function test()
	{
		$this->data['template'] = 'test/review';
		$this->load->view('template', $this->data);
	}
}