<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Email extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');

	}

	function index()
	{

		$arrayEmail = array(
			"dataEmail" => array(
				"name" => 'KENJI DANG',
				"email" => 'kenji.vn14@gmail.com'
			)
		);
		$message= 'đây là nội dung test';


		//qq($check);

	}

}
