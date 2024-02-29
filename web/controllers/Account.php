<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Google\Client as GoogleClient;
use Google\Service\Oauth2;

class Account extends MY_Controller
{
	public $isLogin;
	private $d;

	public $gg;

	function __construct()
	{
		parent::__construct();

		$this->voucher = new EGiftVoucherSystem();

		$this->d = $this->data['d'];

		$this->isLogin = $this->session->userdata('isLogin');

		$this->fb_init();

		//	$this->gg_dangky();
	}

	function index()
	{

		$action = $this->uri->segment(2);

		if (empty($action)) {
			redirect('account');
		}

		if (!empty($action)) {
			switch ($action) {
				case 'dang-nhap':
					$title_crumb = getLang('dangnhap');
					$template = "page/account/dangnhap";
					if ($this->isLogin) transfer("Trang không tồn tại", '', false);
					if (isset($_POST['dangnhap'])) $this->login();
					break;

				case 'dang-ky':
					$title_crumb = getLang('dangky');
					$template = "page/account/dangky";
					$this->data['fb'] = $this->facebook;
					if ($this->isLogin) transfer("Trang không tồn tại", '', false);
					$uidfb = getRequest('uidfb');
					$isdangky = getRequest('dangky');
					if (!empty($uidfb)) $this->fb_dangky();
					if (!empty($isdangky)) $this->signup();
					break;

				case 'quen-mat-khau':
					$title_crumb = getLang('quenmatkhau');
					$template = "page/account/quenmatkhau";
					if ($this->isLogin) transfer("Trang không tồn tại", '', false);
					if (isset($_POST['quenmatkhau'])) $this->doimatkhau_user();
					break;

				case 'kich-hoat':
					$title_crumb = getLang('kichhoat');
					$template = "page/account/kichhoat";
					if ($this->isLogin) transfer("Trang không tồn tại", '', false);
					if (isset($_POST['kichhoat'])) $this->active_user();
					break;

				case 'thong-tin':
					if (!$this->isLogin) transfer("Trang không tồn tại", '', false);
					$template = "page/account/thongtin";
					$title_crumb = getLang('capnhatthongtin');
					$this->info_user();
					break;

				case 'dang-xuat':
					if (!$this->isLogin) transfer("Trang không tồn tại", '', false);
					$this->logout();
					break;
				case 'lich-su-mua-hang':
					if (!$this->isLogin) transfer("Trang không tồn tại", '', false);
					$template = "page/account/lichsu";
					$title_crumb = getLang('lichsu');
					$this->lichsu_user();
					break;

				default:
					$this->load->view('404');
					exit();
			}
		}


		$this->data['title_crumb'] = $title_crumb;
		$this->data['template'] = $template;

		$this->load->view('template', $this->data);
	}

	function dangky()
	{
		$this->data['template'] = 'page/account/dangky';
		$this->load->view('template', $this->data);
	}

	function dangnhap()
	{
		$this->data['template'] = 'page/account/dangnhap';
		$this->load->view('template', $this->data);
	}

	function logout()
	{
		$this->isLogin = false;
		set_cookie('login_member_id', "", -1, '/');
		set_cookie('login_member_session', "", -1, '/');
		$this->session->sess_destroy();


		redirect(site_url(), 'refresh');
	}


	function thongtin()
	{
		$this->data['template'] = 'page/account/info';
		$this->load->view('template', $this->data);
	}

	function thongtin_process()
	{

		$d = $this->data['d'];

		$iduser = $this->isLogin ?? 0;

		$password = getRequest('password');
		$passwordMD5 = md5($password);
		$new_password = getRequest('new-password');
		$new_passwordMD5 = md5($new_password);
		$new_password_confirm = getRequest('new-password-confirm');

		if ($password && $new_password && $new_password_confirm) {
			$row = $d->rawQueryOne("select id from #_member where id = ? and password = ? limit 0,1", array($iduser, $passwordMD5));

			if (!isset($row['id'])) transfer("Mật khẩu cũ không chính xác", "", false);
			if (!$new_password || ($new_password != $new_password_confirm)) transfer("Thông tin mật khẩu mới không chính xác", "", false);

			$data['password'] = $new_passwordMD5;
		}

		$data['ten'] = getRequest('ten');
		$data['diachi'] = getRequest('diachi'); //(isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
		$data['dienthoai'] = getRequest('dienthoai'); //(isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
		$data['email'] = getRequest('email'); //(isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$data['ngaysinh'] = getRequest('ngaysinh'); //(isset($_POST['ngaysinh'])) ? strtotime(str_replace("/", "-", htmlspecialchars($_POST['ngaysinh']))) : 0;
		$data['gioitinh'] = getRequest('gioitinh'); //(isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
		$data['city'] = getRequest('city');
		$data['district'] = getRequest('district');
		$data['wards'] = getRequest('wards');



		$d->where('id', $iduser);
		$d->update('member', $data);

		#$d->rawQuery("delete from #_news where id_user = ? and type = ?", array($iduser, 'user'));

		// foreach ($_POST['diachi2'] as $k => $v) {
		// 	if ($_POST['diachi2'][$k] != '') {
		// 		$data2 = null;
		// 		$data2['id_user'] = $iduser;
		// 		$data2['tenvi'] = $_POST['diachi2'][$k];
		// 		$data2['type'] = 'user';
		// 		$data2['hienthi'] = 1;
		// 		$this->d->insert('news', $data2);
		// 	}
		// }

		if ($password && $new_password && $new_password_confirm) {
			//$this->session->unset_userdata($this->session_member);
			//$this->session->unset_userdata('isLogin');
			$this->session->sess_destroy();

			set_cookie('login_member_id', "", -1, '/');
			set_cookie('login_member_session', "", -1, '/');

			redirect(MYSITE . "account/dang-nhap");
			//transfer("Cập nhật thông tin thành công", MYSITE . "account/dang-nhap");
		}
		#	redirect(MYSITE . "account/thong-tin");
		transfer("Cập nhật thông tin thành công", MYSITE . "account/thong-tin");
	}


	function signup()
	{

		#$username = getRequest('username');

		$password = getRequest('password');
		$repassword = getRequest('repassword');
		$email = getRequest('email');
		$maxacnhan = digitalRandom(0, 3, 6);

		#if ($password != $repassword) transfer("Xác nhận mật khẩu không trùng khớp", MYSITE . "account/dang-ky", false);

		/* Kiểm tra tên đăng ký */
		$row = $this->d->rawQueryOne("select id from #_member where email = ? limit 0,1", array($email));
		if (isset($row['id']) && $row['id'] > 0) {
			transfer("Tên đăng nhập đã tồn tại", MYSITE . "account/dang-ky", false);
		}

		/* Kiểm tra email đăng ký */
		/*$row = $this->d->rawQueryOne("select id from #_member where email = ? limit 0,1", array($email));
		if (isset($row['id']) && $row['id'] > 0) {
			transfer("Tên đăng nhập đã tồn tại", MYSITE . "account/dang-ky", false);
		}*/

		$data['ten'] = getRequest('ten');

		$data['password'] = md5($password);
		$data['email'] = trim($email);
		$data['username'] = trim($email);

		#$data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
		#$data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
		#$data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
		#$data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/", "-", $_POST['ngaysinh'])) : 0;

		$data['maxacnhan'] = $maxacnhan;
		$data['hienthi'] = 1;

		#$data['city'] = getRequest('city');
		#$data['district'] = getRequest('district');
		#$data['wards'] = getRequest('wards');


		if ($uid = $this->d->insert('member', $data)) {
			//TODO SEND EMAIL
			if (!empty($uid)) {
				$this->send_active_user($uid);
			}
			if ($this->setVoucher($uid)) {
				transfer("Đăng ký thành viên thành công. Vui lòng kiểm tra email: " . $data['email'] . " để kích hoạt tài khoản", MYSITE . "account/dang-nhap");
			}

			transfer("Đăng ký thành viên thành công. Vui lòng kiểm tra email: " . $data['email'] . " để kích hoạt tài khoản", MYSITE . "account/dang-nhap");
		} else {

			transfer("Đăng ký thành viên thất bại. Vui lòng thử lại sau.", MYSITE, false);
		}
	}


	private function my_account_exits($row, $gg_login = false)
	{
		if (empty($row)) {
			transfer("Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website", MYSITE . "account/dang-nhap", false);
		}

		if ($gg_login == false) {
			$password = getRequest('password');
			$passwordMD5 = md5($password);

			if ($passwordMD5 != $row['password']) {
				transfer("Tên đăng nhập hoặc mật khẩu không chính xác. Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website", MYSITE . "account/dang-nhap", false);
			}
		}

		if (isset($row['id']) && $row['id'] > 0) {
			/* Tạo login session */
			$id_user = $row['id'] ?? 0;
			$lastlogin = time();
			$login_session = md5('CKDCOSVIETNAM' . $lastlogin);
			if ($id_user > 0) $this->d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));
			/* Lưu session login */
			$_sess_login = $row;
			$_sess_login['active'] = true;
			$_sess_login['login_session'] = $login_session;
			$_sess_login['ref_nick'] = $row['ref_nick'] > 0;

			if ($id_user > 0)  $voucher = $this->d->rawQueryOne("select id as id_voucher,code as magiamgia,start_date,end_date,discount_amount,discount_percentage,is_one_time_use,is_combinable,used_date from #_coupons where type = ? and uid = ? and deleted = 0 limit 0,1", array('register', $id_user));
			else {
				$voucher = array();
			}
			if (is_array($voucher) && count($voucher)) {
				$_sess_login['voucher'] = $voucher;
			}

			$this->isLogin = $id_user;
			$this->session->set_userdata($this->session_member, $_sess_login);
			$this->session->set_userdata('isLogin', $this->isLogin);

			/* Nhớ mật khẩu */
			set_cookie('login_member_id', "", -1, '/');
			set_cookie('login_member_session', "", -1, '/');

			$time_expiry = time() + 3600 * 24;
			set_cookie('login_member_id', $row['id'], $time_expiry, '/');
			set_cookie('login_member_session', $login_session, $time_expiry, '/');

			transfer("Đăng nhập thành công", MYSITE . "account/thong-tin");
		}

		return  false;
	}

	function login()
	{


		$email = getRequest('email');
		$password = getRequest('password');
		$passwordMD5 = md5($password);
		$remember = getRequest('remember-user');

		//if (!$username) transfer("Chưa nhập tên tài khoản", 'account/dang-nhap', false);
		//if (!$password) transfer("Chưa nhập mật khẩu", 'account/dang-nhap', false);

		$row = $this->d->rawQueryOne("select ngaysinh,gioitinh,ref_nick, id, password, username, dienthoai, diachi, email, ten from #_member where email = ? and hienthi > 0 limit 0,1", array($email));

		$this->my_account_exits($row, false);
	}

	function info_user()
	{

		$d = $this->data['d'];

		$iduser = $this->isLogin ?? 0;


		//todo show setVoucher($uid);
		if ($iduser > 0) {

			//$uid_Voucher = new EGiftVoucherUser($this->d, $iduser);

			//$my_Voucher = $uid_Voucher->getVoucher();

			//if (is_array($my_Voucher) && count($my_Voucher)) {
			//  $this->data['row_detail'] = $my_Voucher;
			/* foreach ($my_Voucher as $voucher){

			 }*/
			//}


			$row_detail = $this->d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi from #_member where id = ? limit 0,1", array($iduser));

			$voucher = $this->d->rawQueryOne("select id as id_voucher,code as magiamgia,start_date,end_date,discount_amount,discount_percentage,is_one_time_use,is_combinable,used_date from #_coupons where type = ? and uid = ? and deleted = 0 limit 0,1", array('register', $iduser));


			$this->data['row_detail'] = $row_detail;
			$this->data['voucher'] = $voucher; //@$this->userInfo['voucher'];

			$user_dc = $this->d->rawQuery("select tenvi from #_news where id_user='" . $iduser . "' and type = ? and hienthi > 0", array('user'));
			$this->data['user_dc'] = $user_dc;
		} else {
			redirect(MYSITE . "account/dang-nhap");
		}
	}

	function lichsu_user()
	{


		$iduser = $this->userInfo['id'] ?? 0;

		if ($iduser) {
			$order = $this->d->rawQuery("select * from #_order where id_user='" . $iduser . "' order by id desc");
			//$func->dump($donhang);
			$this->data['order'] = $order;
		} else {
			transfer("Trang không tồn tại", MYSITE, false);
		}
	}

	function send_active_user($uid)
	{
		$setting = $this->data['setting'];
		$optsetting = $this->data['optsetting'];

		$infoEmail = $this->infoEmail();


		$lang = $this->current_lang;

		/* Lấy thông tin người dùng */
		$row = $this->d->rawQueryOne("select id, maxacnhan, username, password, ten, email, dienthoai, diachi from #_member where id = ? limit 0,1", array($uid));

		/* Gán giá trị gửi email */
		$iduser = @$row['id'] ?? '';
		$maxacnhan = @$row['maxacnhan'] ?? '';
		$tendangnhap = @$row['username'] ?? '';
		$matkhau = @$row['password'] ?? '';
		$tennguoidung = @$row['ten'] ?? '';
		$emailnguoidung = @$row['email'] ?? '';
		$dienthoainguoidung = @$row['dienthoai'] ?? '';
		$diachinguoidung = @$row['diachi'] ?? '';
		$linkkichhoat = MYSITE . "account/kich-hoat?id=" . $iduser;

		/* Thông tin đăng ký */
		$thongtindangky = '<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span >Username: ' . $tendangnhap . '</span><br>Mật khẩu: *******' . substr($matkhau, -3) . '<br>Mã kích hoạt: ' . $maxacnhan . '</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
		if ($tennguoidung) {
			$thongtindangky .= '<span style="text-transform:capitalize">' . $tennguoidung . '</span><br>';
		}
		if ($emailnguoidung) {
			$thongtindangky .= '<a href="mailto:' . $emailnguoidung . '" target="_blank">' . $emailnguoidung . '</a><br>';
		}
		if ($diachinguoidung) {
			$thongtindangky .= $diachinguoidung . '<br>';
		}
		if ($dienthoainguoidung) {
			$thongtindangky .= 'Tel: ' . $dienthoainguoidung . '</td>';
		}


		//<div style="margin:auto"><a href="' . $linkkichhoat . '" style="display:inline-block;text-decoration:none;background-color:' . $infoEmail['color'] . '!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:38%;margin-top:5px" target="_blank">Kích hoạt tài khoản</a></div>


		$contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid ;padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:#f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="' . MYSITE . '" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">' . $infoEmail['logo'] . '</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">' . $infoEmail['social'] . '</td>
																	</tr>
																</tbody>
															</table>
														</div>
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
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đăng ký tại ' . $optsetting['website'] . '</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Thông tin tài khoản của quý khách đã được ' . $optsetting['website'] . ' cập nhật. Quý khách vui lòng kích hoạt tài khoản bằng cách truy cập vào đường link phía dưới.</p>
														<h3 style="font-size:13px;font-weight:bold;color:' . $infoEmail['color'] . ';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày ' . date('d', $infoEmail['datesend']) . ' tháng ' . date('m', $infoEmail['datesend']) . ' năm ' . date('Y H:i:s', $infoEmail['datesend']) . ')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
													</tr>
												</thead>
												<tbody>
													<tr>' . $thongtindangky . '</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng truy cập vào đường link phía dưới để hoàn tất quá trình đăng ký tài khoản.</i>
											
											</p>
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
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã đăng ký tại ' . $infoEmail['company:website'] . '.<br>
								Để chắc chắn luôn nhận được email thông báo, phản hồi từ ' . $infoEmail['company:website'] . ', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:' . $infoEmail['company:email'] . '" target="_blank">' . $infoEmail['company:email'] . '</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> ' . $infoEmail['company:address'] . '</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		try {
			$this->sendEmail(
				$emailnguoidung,
				"Thư kích hoạt tài khoản thành viên từ CKD VIỆT NAM",
				$contentMember
			);
		} catch (Exception $e) {
		}
	}

	function active_user()
	{

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
		$maxacnhan = (isset($_POST['maxacnhan'])) ? htmlspecialchars($_POST['maxacnhan']) : '';

		/* Kiểm tra thông tin */
		$row_detail = $this->d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1", array($id));

		if (!$row_detail['id']) transfer("Tài khoản của bạn chưa được kích hoạt", MYSITE . 'account/dang-nhap', false);
		else if ($row_detail['hienthi']) transfer("Tài khoản của bạn đã được kích hoạt", MYSITE . 'account/dang-nhap');
		else {
			if ($row_detail['maxacnhan'] == $maxacnhan) {
				$data['hienthi'] = 1;
				$data['maxacnhan'] = '';
				$this->d->where('id', $id);
				if ($this->d->update('member', $data)) transfer("Kích hoạt tài khoản thành công.", MYSITE . "account/dang-nhap");
			} else {
				transfer("Mã xác nhận không đúng. Vui lòng nhập lại mã xác nhận.", MYSITE . "account/kich-hoat?id=" . $id, false);
			}
		}
	}


	function doimatkhau_user()
	{
		$infoEmail = $this->infoEmail();

		$setting = $this->data['setting'];
		$lang = $this->current_lang;
		//$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$email = getRequest('email');
		$newpass = substr(md5(rand(0, 999) * time()), 15, 6);
		$newpassMD5 = md5($newpass);

		//if (!$username) transfer("Chưa nhập tên tài khoản", MYSITE . "account/quen-mat-khau", false);
		if (!$email) transfer("Chưa nhập email đăng ký tài khoản", MYSITE . "account/quen-mat-khau", false);

		/* Kiểm tra username và email */
		$row = $this->d->rawQueryOne("select id from #_member where email = ? limit 0,1", array($email));
		if (!isset($row['id'])) transfer("Tên đăng nhập và email không tồn tại", MYSITE . "account/quen-mat-khau", false);

		/* Cập nhật mật khẩu mới */
		$data['password'] = $newpassMD5;
		//$this->d->where('username', $username);
		$this->d->where('email', $email);
		$this->d->update('member', $data);

		/* Lấy thông tin người dùng */
		$row = $this->d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where email = ? limit 0,1", array($email));

		/* Gán giá trị gửi email */
		$iduser = $row['id'] ?? '';
		$tendangnhap = $row['username'] ?? '';
		$matkhau = $row['password'] ?? '';
		$tennguoidung = $row['ten'] ?? '';
		$emailnguoidung = $row['email'] ?? '';
		$dienthoainguoidung = $row['dienthoai'] ?? '';
		$diachinguoidung = $row['diachi'] ?? '';

		/* Thông tin đăng ký */
		$thongtindangky = '<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span >Username: ' . $tendangnhap . '</span><br>Mật khẩu: *******' . substr($matkhau, -3) . '</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
		if ($tennguoidung) {
			$thongtindangky .= '<span style="text-transform:capitalize">' . $tennguoidung . '</span><br>';
		}

		if ($emailnguoidung) {
			$thongtindangky .= '<a href="mailto:' . $emailnguoidung . '" target="_blank">' . $emailnguoidung . '</a><br>';
		}

		if ($diachinguoidung) {
			$thongtindangky .= $diachinguoidung . '<br>';
		}

		if ($dienthoainguoidung) {
			$thongtindangky .= 'Tel: ' . $dienthoainguoidung . '</td>';
		}

		$contentMember = '
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
																		<a href="' . $infoEmail['home'] . '" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px;max-height: 70px;" target="_blank">' . $infoEmail['logo'] . '</a>
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
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Yêu cầu cung cấp lại mật khẩu của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Quý khách vui lòng xác nhận vào đường dẫn phía dưới để được cấp mấtu khẩu mới.</p>
														<h3 style="font-size:13px;font-weight:bold;color:' . $infoEmail['color'] . ';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày ' . date('d', $infoEmail['datesend']) . ' tháng ' . date('m', $infoEmail['datesend']) . ' năm ' . date('Y H:i:s', $infoEmail['datesend']) . ')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
													</tr>
												</thead>
												<tbody>
													<tr>' . $thongtindangky . '</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng thay đổi mật khẩu ngay khi đăng nhập bằng mật khẩu mới bên dưới.</i>
											<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:' . $infoEmail['color'] . '!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">Mật khẩu mới: ' . $newpass . '</p></div>
											</p>
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
								Để chắc chắn luôn nhận được email thông báo, phản hồi từ ' . $infoEmail['company:website'] . ', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:' . $infoEmail['company:email'] . '" target="_blank">' . $infoEmail['company:email'] . '</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> ' . $infoEmail['company:address'] . '</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		$subject = "Thư cấp lại mật khẩu từ " . $setting['ten' . $lang] ?? 'CKD VIET NAM';
		try {

			if ($this->sendEmail(
				$email,
				$subject,
				$contentMember
			)) {
				//$this->session->unset_userdata($this->session_member);
				#$this->session->sess_destroy();
				set_cookie('login_member_id', "", -1, '/');
				set_cookie('login_member_session', "", -1, '/');

				transfer("Cấp lại mật khẩu thành công. Vui lòng kiểm tra email: " . $email, MYSITE . 'account/dang-nhap');
			} else {
			}
		} catch (Exception $e) {

			transfer("Có lỗi xảy ra trong quá trình cấp lại mật khẩu. Vui lòng liện hệ với chúng tôi.", MYSITE . "account/quen-mat-khau", false);
		}
	}

	private function setVoucher($uid)
	{
		$code = 'register';

		$uid_Voucher = new EGiftVoucherUser($this->d, $uid);
		$rate = $uid_Voucher->getRate();
		$once = $uid_Voucher->getOnce();
		$start = $uid_Voucher->getStart();
		$end = $uid_Voucher->getEnd();

		$uid_Voucher->setType($code);
		$type = $uid_Voucher->getType();

		$per = $rate ?? 10; //10 phan tram

		$voucher1 = $this->voucher->generateVoucher($type, $per);
		$new_voucher = $voucher1->getVoucherId();

		$data = array(
			'code' => $new_voucher,
			'description' => 'Đăng ký mới thành viên CKD được giảm 10% giá trị đơn hàng',
			'type' => $type,
			'start_date' => $start,
			'end_date' => $end,
			'discount_amount' => '',
			'discount_percentage' => $per,
			'is_one_time_use' => $once,
			'is_combinable' => 1,
			'deleted' => 0,
			'uid' => $uid,
		);
		$this->d->insert('coupons', $data);

		return true;

		//todo new insert

	}


	function gg_save_dangky()
	{
		return  false;

		if (isset($_GET['code'])) {
			$client = $this->gg;
			$maxacnhan = digitalRandom(0, 3, 6);
			$password = digitalRandom(0, 3, 6);
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			$client->setAccessToken($token['access_token']);

			// get profile info
			$google_oauth = new Google_Service_Oauth2($client);
			$google_account_info = $google_oauth->userinfo->get();

			$email = $google_account_info['email'];

			$row = $this->d->rawQueryOne("select id from #_member where email = ? limit 0,1", array($email));
			if (isset($row['id']) && $row['id'] > 0) {

				$this->my_account_exits($row, true);

				return true;
				//transfer("Tên đăng nhập đã tồn tại", MYSITE . "account/dang-nhap", false);
			}

			$data['password'] = md5($password);
			$data['email'] = $google_account_info['email'];
			#$data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
			#$data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
			#$data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
			#$data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/", "-", $_POST['ngaysinh'])) : 0;
			$data['maxacnhan'] = $maxacnhan;

			$data['hienthi'] = 1;
			$data['ten'] = $google_account_info['name'];
			$data['gioitinh'] = $google_account_info['gender'];
			$data['id_social'] = $google_account_info['id'];
			$data['avatar'] = $google_account_info['picture'];
			#$data['diachi'] = $google_account_info['locale'];
			$data['username'] = stringRandom(6);

			// checking if user is already exists in database

			if ($uid = $this->d->insert('member', $data)) {


				//TODO SEND EMAIL
				if (!empty($uid)) {
					$this->send_active_user($uid);
				}
				try {
					$this->setVoucher($uid);
				} catch (Exception $e) {
				}

				$row = $this->d->rawQueryOne("select ngaysinh,gioitinh,ref_nick, id, password, username, dienthoai, diachi, email, ten from #_member where email = ? and hienthi > 0 limit 0,1", array($email));

				$this->my_account_exits($row, true);
			}

			// save user data into session
			//$_SESSION['user_token'] = $token;
		} else {
			redirect(MYSITE . "account/dang-ky");
		}
	}

	function gg_dangky()
	{
		return false;
		/*
		require_once APPPATH . 'libraries/google/autoload.php';
		// init configuration
		$clientID = '63359959323-88e9odjoprlrqqejsrrt7d4gk13093gr.apps.googleusercontent.com';
		$clientSecret = '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';
		$redirectUri = 'https://ckdvietnam.com/Account/gg_save_dangky';

		// create Client Request to access Google API
		$client = new Google_Client();
		$client->setClientId($clientID);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectUri);
		$client->addScope("email");
		$client->addScope("profile");

		$this->gg = $client;*/
	}

	function fb_logout()
	{
		require APPPATH . 'libraries/fb/src/facebook.php';

		$facebook = new Facebook(array(
			'appId'  => '914665893545200',
			'secret' => '9c54838cb21f126b80f8d351db035cda',
		));

		$facebook->destroySession();

		redirect(site_url(), 'refresh');
	}

	function fb_dangky()
	{
		$d = $this->data['d'];
		$id_social = getRequest('uidfb');
		$row = $d->rawQueryOne("select * from #_member where id = ? limit 0,1", array($id_social));
		if (!empty($row['id'])) {
			$id_user = $row['id'];
			$lastlogin = time();
			$login_session = md5('CKDCOSVIETNAM' . $lastlogin);

			$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));
			/* Lưu session login */
			$_sess_login = $row;
			$_sess_login['active'] = true;
			$_sess_login['login_session'] = $login_session;
			$_sess_login['ref_nick'] = $row['ref_nick'] > 0;

			$voucher = $d->rawQueryOne("select id as id_voucher,code as magiamgia,start_date,end_date,discount_amount,discount_percentage,is_one_time_use,is_combinable,used_date from #_coupons where type = ? and uid = ? and deleted = 0 limit 0,1", array('register', $id_user));
			if (is_array($voucher) && count($voucher)) {
				$_sess_login['voucher'] = $voucher;
			}

			$this->isLogin = $id_user;
			$this->session->set_userdata($this->session_member, $_sess_login);
			$this->session->set_userdata('isLogin', $this->isLogin);

			/* Nhớ mật khẩu */
			set_cookie('login_member_id', "", -1, '/');
			set_cookie('login_member_session', "", -1, '/');

			$time_expiry = time() + 3600 * 24;
			set_cookie('login_member_id', $row['id'], $time_expiry, '/');
			set_cookie('login_member_session', $login_session, $time_expiry, '/');

			transfer("Đăng nhập thành công", MYSITE . "account/thong-tin");
		} else {
			$this->isLogin = 0;
		}
	}
}
