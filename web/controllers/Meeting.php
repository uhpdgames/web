<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meeting extends MY_Controller
{
	private $html = '';

	function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

		parent::__construct(); 
	}

	function index()
	{

		$this->session->userdata('item');

		$this->load->view('meeting', $this->data);
	}

	
}
