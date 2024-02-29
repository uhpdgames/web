<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->data['myckd'] = true;
	}

	public function index()
	{
		//end line
		$data = $this->data;
		$http = getProtocol();
		$arrayDomainSSL = '';
		$this->data['func']->checkHTTP($http, $arrayDomainSSL, $this->data['config_base'], $this->data['config_url']);
		$data['source'] = 'index';
		$this->data['seo']->setSeo('photo:img', MYSITE . 'assets/images/CKD-COS-VIET-NAM.jpg');
		$data['footer'] = $this->load->view('all/footer', $this->data, true);
		$this->load->view('template', $data);
	}

	function process()
	{
		$page = $this->session->flashdata('page');
		$stt = $this->session->flashdata('stt');
		$text = $this->session->flashdata('showtext');
		if (!empty($text)) {
			$this->load->view('common/transfer', array(
				'showtext' => $this->session->flashdata('showtext'),
				'stt' => $stt,
				'page_transfer' => $page == '' ? site_url() : $page,
			));
		} else {
			redirect(site_url());
		}

	}


	public function lienhe()
	{
		$this->load->helper('ckdemail');
		$d = $this->data['d'];
		$setting = $this->data['setting'];
		$lang = $this->current_lang;

		$contact = $this->input->post('submit-contact', true);

		if (!empty($contact)) {

			$testCaptcha = true;
			if ($testCaptcha) {
				$data = array();
				$ten = (isset($_POST['ten']) && $_POST['ten'] != '') ? htmlspecialchars($_POST['ten']) : '';
				$dienthoai = (isset($_POST['dienthoai']) && $_POST['dienthoai'] != '') ? htmlspecialchars($_POST['dienthoai']) : '';
				$diachi = (isset($_POST['diachi']) && $_POST['diachi'] != '') ? htmlspecialchars($_POST['diachi']) : '';
				$email = (isset($_POST['email']) && $_POST['email'] != '') ? htmlspecialchars($_POST['email']) : '';
				$tieude = (isset($_POST['tieude']) && $_POST['tieude'] != '') ? htmlspecialchars($_POST['tieude']) : '';
				$noidung = (isset($_POST['noidung']) && $_POST['noidung'] != '') ? htmlspecialchars($_POST['noidung']) : '';

				$data['ten'] = $ten;
				$data['dienthoai'] = $dienthoai;
				$data['email'] = $email;
				$data['diachi'] = $diachi;
				$data['chude'] = $tieude;
				$data['noidung'] = $noidung;
				$data['ngaytao'] = time();
				$data['stt'] = 1;
				$data['type'] = 'lien-he';

				/* Gán giá trị gửi email */
				$strThongtin = '';

				$infoEmail = $this->infoEmail();


				$strThongtin .= '<b style="font-size:17px;">' . $ten . '</b><br>';
				if ($ten) {
					$strThongtin .= '- Họ tên: <span style="text-transform:capitalize">' . $ten . '</span><br>';
				}
				if ($email) {
					$strThongtin .= '- Email: <a href="mailto:' . $email . '" target="_blank">' . $email . '</a><br>';
				}
				if ($dienthoai) {
					$strThongtin .= '- Điện thoại: ' . $dienthoai . '<br />';
				}
				if ($diachi) {
					$strThongtin .= '- Địa chỉ: ' . $diachi . '<br />';
				}
				if ($tieude) {
					$strThongtin .= '- Chủ đề: ' . $tieude . '<br />';
				}
				if ($noidung) {
					$strThongtin .= '- Nội dung: ' . $noidung . '';
				}


				/* Nội dung gửi email cho admin */

				/* Nội dung gửi email cho khách hàng */

				$contentCustomer = '
            <table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
                <tbody>
                    <tr>
                        <td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
                                <tbody>
                                    <tr>
                                        <td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
                                            <table cellpadding="0" cellspacing="0" style="border-bottom:3px solid ' . $infoEmail['color'] . ';padding-bottom:10px;background-color:#fff" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
                                                            <div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
                                                            <table style="width:100%;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="' . $infoEmail['home'] . '" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">' . $infoEmail['logo'] . '</a>
                                                                        </td>
                                                                        <td style="padding:15px 20px 0 0;text-align:right">' . $infoEmail['social'] . '</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style="background:#fff">
                                        <td align="left" height="auto" style="padding:15px" width="600">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào Quý khách</h1>
                                                            <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Thông tin liên hệ của quý khách đã được tiếp nhận. ' . $infoEmail['company:website'] . ' sẽ phản hồi trong thời gian sớm nhất.</p>
                                                            <h3 style="font-size:13px;font-weight:bold;color:' . $infoEmail['color'] . ';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin liên hệ <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày ' . date('d', $infoEmail['datesend']) . ' tháng ' . date('m', $infoEmail['datesend']) . ' năm ' . date('Y H:i:s', $infoEmail['datesend']) . ']</span></h3>
                                                        </td>
                                                    </tr>
                                                <tr>
                                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding:3px 0px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">' . $strThongtin . '</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px ' . $infoEmail['color'] . ' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:' . $infoEmail['company:email'] . '" style="color:' . $infoEmail['color'] . ';text-decoration:none" target="_blank"> <strong>' . $infoEmail['company:email'] . '</strong> </a>, hoặc gọi về hotline <strong style="color:' . $infoEmail['color'] . '">' . $infoEmail['company:hotline'] . '</strong> ' . $infoEmail['company:worktime'] . '. ' . $infoEmail['company:website'] . ' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;
                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa ' . $infoEmail['company:website'] . ' cảm ơn quý khách.</p>
                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="' . $infoEmail['home'] . '" style="color:' . $infoEmail['color'] . ';text-decoration:none;font-size:14px" target="_blank">' . $infoEmail['company'] . '</a> </strong></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                        <table width="600">
                            <tbody>
                                <tr>
                                    <td>
                                    <p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã liên hệ tại ' . $infoEmail['company:website'] . '.<br>
                                    Để chắc chắn luôn nhận được email thông báo, phản hồi từ ' . $infoEmail['company:website'] . ', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:' . $infoEmail['email'] . '" target="_blank">' . $infoEmail['email'] . '</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
                                    <b>Địa chỉ:</b> ' . $infoEmail['company:address'] . '</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>';;

				/* Send email admin */
				$d->insert('newsletter', $data);

				try{
					$this->sendEmail(
						$email,
						"Thư liên hệ từ " . $setting['ten' . $lang] ?? "",
						$contentCustomer
					);
				}catch (Exception $e){

				}

			} else {
				transfer("Gửi liên hệ thất bại. Vui lòng thử lại sau", site_url(), false);
			}

			redirect('lien-he');
		} else {

			$type = 'lien-he';
			$seolang = $this->data['seolang'];

			/* Lấy bài viết tĩnh */
			$static = $this->data['d']->rawQueryOne("select id, type, ten$this->current_lang as ten, photo, ngaytao, ngaysua, options from #_static where type = ? limit 0,1", array($type));

			/* SEO */
			if (!empty($static)) {
				$seoDB = $this->data['seo']->getSeoDB(0, 'static', 'capnhat', $static['type']);
				$this->data['seo']->setSeo('h1', $static['ten']);
				if (!empty($seoDB['title' . $seolang])) $this->data['seo']->setSeo('title', $seoDB['title' . $seolang]);
				else $this->data['seo']->setSeo('title', $static['ten']);
				if (!empty($seoDB['keywords' . $seolang])) $this->data['seo']->setSeo('keywords', $seoDB['keywords' . $seolang]);
				if (!empty($seoDB['description' . $seolang])) $this->data['seo']->setSeo('description', $seoDB['description' . $seolang]);
				//$this->data['seo']->setSeo('url', getPageURL());
				$img_json_bar = (isset($static['options']) && $static['options'] != '') ? json_decode($static['options'], true) : null;
				if ($img_json_bar == null || ($img_json_bar['p'] != $static['photo'])) {
					//$img_json_bar = getImgSize($static['photo'], UPLOAD_NEWS_L . $static['photo']);
					//	$this->data['seo']->updateSeoDB(json_encode($img_json_bar), 'static', $static['id']);
				}
				if (count($img_json_bar) > 0) {
					//$this->data['seo']->setSeo('photo', MYSITE . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_NEWS_L . $static['photo']);
					$this->data['seo']->setSeo('photo:width', $img_json_bar['w']);
					$this->data['seo']->setSeo('photo:height', $img_json_bar['h']);
					$this->data['seo']->setSeo('photo:type', $img_json_bar['m']);
				}
			}

			$this->data['seo']->setSeo('type', 'object');
			$this->data['source'] = 'contact';
			$this->data['com'] = 'lien-he';
			$this->data['title_crumb'] = getLang('lienhe');
			$this->data['template'] = 'page/contact/index';
			$this->data['type'] = $type;
			$this->data['content'] = get_text($type);
			$this->load->view('template', $this->data);
		}


	}


	public function video()
	{
		$this->data['title_crumb'] = 'VIDEO';
		$this->data['template'] = 'page/video/index';
		$this->load->view('template', $this->data);
	}


	public function Page404()
	{
		$this->load->view('404');
	}

	public function PageOff()
	{
		redirect(site_url());
	}
}
