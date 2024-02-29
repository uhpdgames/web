<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StaticPage extends MY_Controller
{
	protected $com = '';

	protected $id = 0;

	function __construct()
	{
		parent::__construct();

		$this->com = $this->uri->segment(1);

		if (empty($this->com)) {
			redirect(site_url());
		}
	}

	public function index()
	{
		$d = $this->data['d'];

		$params = array($this->com);
		$where = "type = ? and hienthi > 0";
		$lang = $this->current_lang;

		$sql = "select id, ten$lang as ten, noidung$lang as noidung from #_static where $where order by ngaytao desc limit 0,1";
		$item = $d->rawQueryOne($sql, $params);

		$title_crumb = !empty($item['ten']) ? $item['ten'] : '';
		$this->data['static'] = $item;
		$this->data['title_crumb'] = $title_crumb;

		$this->data['breadcr'] = create_BreadCrumbs($this->com,getLang('gioithieu'));
		$this->data['template'] = 'page/static/index';
		$this->load->view('template', $this->data);
	}
}
