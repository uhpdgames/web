<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends MY_Controller
{
	private $html = '';

	function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

		parent::__construct();
		$this->data['api'] = true;
	}

	function momo_return()
	{
		$func = $this->data['func'];
		$lang = $this->current_lang;
		$d = $this->data['d'];
		$setting = $this->data['setting'];
		$optsetting = $this->data['optsetting'];

		$cart = new Cart($d);

		$resultCode = $this->input->get('resultCode', true);
		$ship = $this->input->get('ship', true);
		$total = $this->input->get('amount', true);
		$tamtinh = $this->input->get('amount', true);
		$madonhang = $this->input->get('orderId', true);
		$emailz = $this->input->get('email', true);
		$hotenz = $this->input->get('hoten', true);

		$hoten = $_SESSION['momo']['hoten'] ?? $hotenz;
		$email = $_SESSION['momo']['email'] ?? $emailz;
		$dienthoai = $_SESSION['momo']['dienthoai'] ?? '';
		$diachi = $_SESSION['momo']['diachi'] ?? '';
		$yeucaukhac = '';
		$htttText = $func->get_payments(1);

		$config_base = MYSITE;


		if (isset($resultCode) and $resultCode == 0) {
			//echo "GD Thanh cong";
			$chitietdonhang = '';
			$infoEmail = $this->infoEmail();


			$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
			$stt = 0;
			for ($i = 0; $i < $max; $i++) {
				$textsm = '';
				$pid = $_SESSION['cart'][$i]['productid'];
				$q = $_SESSION['cart'][$i]['qty'];
				$color = $_SESSION['cart'][$i]['mau'];
				$size = $_SESSION['cart'][$i]['size'];
				$code = $_SESSION['cart'][$i]['code'];
				$proinfo = $cart->get_product_info($pid);
				$pmau = $cart->get_product_mau($color);
				$psize = $cart->get_product_size($size);

				$chitietdonhang = '<tbody bgcolor="#e6e6e6"';

				$chitietdonhang .= ' style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px" ><tr>';
				$chitietdonhang .= '<td align="left" style="padding: 15px 20px; ' . ($stt == $max ? "border-top-left-radius:0;border-bottom-left-radius:15px;" : "") . '" valign="top">';
				$chitietdonhang .= '<span style="display:block;font-weight:bold">' . $proinfo['ten' . $lang] . '</span>';
				if ($textsm != '') $chitietdonhang .= '<span style="display:block;font-size:12px">' . $textsm . '</span>';
				$chitietdonhang .= '</td>';
				if ($proinfo['giamoi']) {
					$chitietdonhang .= '<td align="left" style="padding:15px 20px;" valign="top">';
					$chitietdonhang .= '<span style="display:block;color:#000;font-weight: bolder;">' . format_money($proinfo['giamoi']) . '</span>';
					$chitietdonhang .= '<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">' . format_money($proinfo['gia']) . '</span>';
					$chitietdonhang .= '</td>';
				} else {
					$chitietdonhang .= '<td align="left" style="padding:15px 20px;" valign="top"><span style="color:#000;">' . format_money($proinfo['gia']) . '</span></td>';
				}
				$chitietdonhang .= '<td align="center" style="padding:15px 20px;" valign="top">' . $q . '</td>';

				if ($proinfo['giamoi']) {
					$chitietdonhang .= '<td align="right" style="padding: 15px 20px; ' . ($stt == $max ? "border-bottom-right-radius:15px;" : "") . '" valign="top">';
					$chitietdonhang .= '<span style="display:block;color:#000;font-weight: bolder;">' . format_money($proinfo['giamoi'] * $q) . '</span>';
					$chitietdonhang .= '<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">' . format_money($proinfo['gia'] * $q) . '</span>';
					$chitietdonhang .= '</td>';
				} else {
					$chitietdonhang .= '<td align="right" style="padding: 15px 20px; ' . ($stt == $max ? "border-bottom-right-radius:15px;" : "") . '" valign="top"><span style="color:#000;">' . format_money($proinfo['gia'] * $q) . '</span></td>';
				}

				$chitietdonhang .= '</tr></tbody>';
			}

			$chitietdonhang .= '
		<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
			<tr>
				<td align="right" colspan="3" style="padding:5px 9px">Tạm tính</td>
				<td align="right" style="padding:5px 9px"><span>' . format_money($tamtinh) . '</span></td>
			</tr>';
			if ($ship) {
				$chitietdonhang .=
					'<tr>
					<td align="right" colspan="3" style="padding:5px 9px">Phí vận chuyển</td>
					<td align="right" style="padding:5px 9px"><span>' . format_money($ship) . '</span></td>
				</tr>';
			}
			$chitietdonhang .= '
			<tr>
				<td align="right" colspan="3" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
				<td align="right" style="padding:7px 9px"><strong><big><span>' . format_money($total) . '</span> </big> </strong></td>
			</tr>
		</tfoot>';

			/* Nội dung gửi email cho admin */
			$contentAdmin = '';
			/* Nội dung gửi email cho khách hàng */
			/* Nội dung gửi email cho khách hàng */
			$contentCustomer = '<table align="center" bgcolor="#3d5b2d" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
    <tbody>
    <tr >
        <td align="center" style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #3d5b2d;  padding: 25px; border-radius: 25px;background:#fff; margin-top: 50px;margin-bottom: 15px;" width="900" >
                <tbody style="background:#fff;">
                <tr style="background:#fff;">
                    <td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
                        <table cellpadding="0" cellspacing="0" style="border-bottom:2px solid ' . $infoEmail['color'] . ';padding-bottom:10px;background-color:#fff" width="100%">
                            <tbody>
                            <tr>
                                <td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
                                    <div style="display:flex;justify-content:space-between;align-items:center;">
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
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                <tr style="background:#fff">
                    <td align="left" height="auto" style="padding:15px" width="900">
                        <table style="width:100%;">
                            <tbody>
                            <tr>
                                <td>
                                    <p style="margin:4px 0;font-family:Roboto,sans-serif;font-size:14px;color:#444;line-height:18px;font-weight:bold">
                                        Xin chào: ' . $hoten . '</p>
                                    <p style="margin:4px 0;font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        Đơn hàng #' . $madonhang . ' của bạn đã đặt hàng thành công<br/>
                                        <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày ' . date('d', $infoEmail['datesend']) . ' tháng ' . date('m', $infoEmail['datesend']) . ' năm ' . date('Y H:i:s', $infoEmail['datesend']) . ')</span>
                                        </p>
                                    <h3 style="font-size:16px;font-weight:bold;color:' . $infoEmail['color'] . ';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #3d5b2d">Thông tin đơn hàng</h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th align="left" style="padding:6px 9px 0px 0px;font-family:Roboto,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style="margin: 0;padding: 0;border-top:0;font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">

                                                <ul style="margin: 0;padding: 0; list-style-type: none;">
                                                    <li><span style="text-transform:capitalize">' . $hoten . '</span></li>
                                                    <li><a href="mailto:' . $email . '" target="_blank">' . $email . '</a></li>
                                                    <li><span style="text-transform:capitalize">' . $dienthoai . '</span></li>
                                                    <li><span style="text-transform:capitalize">' . $diachi . '</span></li>
                                                </ul>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding:0;border-top:0;font-family:Roboto,sans-serif;font-size:12px;color:#444" valign="top">
                                                <p style="font-family:Roboto,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> ' . $htttText . '';
			if ($ship) {
				$contentCustomer .= '<br><strong>Phí vận chuyển: </strong> ' . format_money($ship);
			}
			$contentCustomer .= '</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #3d5b2d;padding-bottom:5px;font-size:16px;color:' . $infoEmail['color'] . '">CHI TIẾT ĐƠN HÀNG</h2>

                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <thead>
                                        <tr style="background-color: #3d5b2d">
                                            <th align="left" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px;border-radius: 15px 0 0 0;">Sản phẩm</th>
                                            <th align="left" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px">Đơn giá</th>
                                            <th align="center" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px;min-width:55px;">Số lượng</th>
                                            <th align="right" dddbgcolor="' . $infoEmail['color'] . '" style="padding: 15px 20px;color:#fff;font-family:Roboto,sans-serif;font-size:15px;line-height:14px;border-radius: 0 15px 0 0;">Tổng tạm</th>
                                        </tr>
                                        </thead>
                                        ' . $chitietdonhang . '
                                    </table>
                                    <div style="margin:auto;text-align:center"><a href="' . $infoEmail['home'] . '" style="display:inline-block;text-decoration:none;background-color:' . $infoEmail['color'] . '!important;text-align:center;border-radius:25px;color:#fff;padding:5px 25px;font-size:12px;font-weight:bold;margin-top:5px" target="_blank">Chi tiết đơn hàng tại ' . $infoEmail['company:website'] . '</a></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;
                                    <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 12px; color: #808080;  font-weight: lighter;  padding: 0;list-style-type: none; text-align: center;width: 800px;margin: auto; ">
                                         Cảm ơn bạn tin  chọn sản phẩm <br/> 
                                         Chúc bạn có những trải nghiệm tuyệt vời khi mua sắm tại ' . $infoEmail['company:website'] . '
                                    </p>
                                       <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 12px; color: #808080;  font-weight: lighter;  padding: 0;list-style-type: none; text-align: center;width: 800px;margin: auto; ">Trân trọng,</p>
                                         <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 14px; color: #808080;  font-weight: bold;  padding: 0; list-style-type: none; text-align: center; width: 800px;margin: auto; ">Đội ngũ Cty TNHH Bluepink</p> 
                                         <p style="font-style:italic;font-family: Roboto,sans-serif; font-size: 12px; color: #808080;  font-weight: lighter;  padding: 0;list-style-type: none; text-align: center;width: auto;margin: auto; ">
                                         Bạn có thắc mắc? Liên hệ chúng tôi qua <a href="mailto:' . $infoEmail['company:email'] . '" style="color:' . $infoEmail['color'] . ';text-decoration:none" target="_blank"> <strong>' . $infoEmail['company:email'] . '</strong> </a>, hoặc gọi về hotline <strong style="color:' . $infoEmail['color'] . '">' . $infoEmail['company:hotline'] . '</strong>
                                         </p>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;
                                     
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
            <table width="900">
                <tbody>
                <tr>
                    <td>
                        <p align="left" style="font-family: Roboto,sans-serif; font-size: 10px; line-height: 15px; color: #787675; padding: 10px 0; margin: 0px; font-weight: normal;">Quý khách nhận được email này vì đã mua hàng tại ' . $infoEmail['company:website'] . '.<br>
                            Để chắc chắn luôn nhận được email thông báo, xác nhận mua hàng từ ' . $infoEmail['company:website'] . ', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:' . $infoEmail['email'] . '" target="_blank">' . $infoEmail['email'] . '</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>';
			$data_donhang = array();
			$data_donhang['id_user'] = @$this->userInfo['id'] ?? 0;
			$data_donhang['madonhang'] = $_SESSION['momo']['madonhang'];
			$data_donhang['hoten'] = $_SESSION['momo']['hoten'];
			$data_donhang['dienthoai'] = $_SESSION['momo']['dienthoai'];
			$data_donhang['diachi'] = $_SESSION['momo']['diachi'];
			$data_donhang['email'] = $_SESSION['momo']['email'];
			$data_donhang['httt'] = $_SESSION['momo']['httt'];
			$data_donhang['phiship'] = $_SESSION['momo']['ship'];
			$data_donhang['ship_code'] = $_SESSION['momo']['ship_code'];
			$data_donhang['tamtinh'] = $_SESSION['momo']['tamtinh'];
			$data_donhang['tonggia'] = $_SESSION['momo']['tonggia'];
			$data_donhang['khoiluong'] = $_SESSION['momo']['khoiluong'];
			$data_donhang['yeucaukhac'] = $_SESSION['momo']['noidung'];
			$data_donhang['ngaytao'] = $_SESSION['momo']['ngaydangky'];
			$data_donhang['tinhtrang'] = 1;
			$data_donhang['city'] = $_SESSION['momo']['thanhpho'];
			$data_donhang['district'] = $_SESSION['momo']['quan'];
			$data_donhang['wards'] = $_SESSION['momo']['phuong'];
			$data_donhang['stt'] = 1;
			$data_donhang['thongbao'] = 1;
			$id_insert = $d->insert('order', $data_donhang);

			if ($id_insert) {
				for ($i = 0; $i < $max; $i++) {
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$proinfo = $cart->get_product_info($pid);
					$gia = $proinfo['gia'];
					$giamoi = $proinfo['giamoi'];
					$color = $cart->get_product_mau($_SESSION['cart'][$i]['mau']);
					$size = $cart->get_product_size($_SESSION['cart'][$i]['size']);
					$code = $_SESSION['cart'][$i]['code'];

					if ($q == 0) continue;
					$data_donhangchitiet = array();
					$data_donhangchitiet['id_product'] = $pid;
					$data_donhangchitiet['id_order'] = $id_insert;
					$data_donhangchitiet['photo'] = $proinfo['photo'];
					$data_donhangchitiet['ten'] = $proinfo['ten' . $lang];
					$data_donhangchitiet['code'] = $code;
					$data_donhangchitiet['mau'] = $color;
					$data_donhangchitiet['size'] = $size;
					$data_donhangchitiet['gia'] = $gia;
					$data_donhangchitiet['khoiluong'] = $proinfo['khoiluong'];
					$data_donhangchitiet['giamoi'] = $giamoi;
					$data_donhangchitiet['soluong'] = $q;
					if ($d->insert('order_detail', $data_donhangchitiet)) {
						$d->rawQuery("Update #_product SET soluong=soluong-" . $q . ",daban=daban+" . $q . " WHERE id ='" . $pid . "'");
					}
				}
			}

			/* Send email admin */
			/* Send email customer */
			$subject = "Xác nhận đặt hàng thành công " . $setting['ten' . $lang] ?? " từ CKD VIỆT NAM";
			try {
				$this->sendEmail(
					$email,
					$subject,
					$contentCustomer
				);
			} catch (Exception $e) {
			}

			/* Xóa giỏ hàng */
			unset($_SESSION['cart']);
			unset($_SESSION['momo']);
			transfer("Thông tin đơn hàng đã được gửi thành công.", MYSITE);
		} else {
			echo "Giao dịch không thành công";
			transfer("Giao dịch không thành công. Vui lòng thử phương thức thanh toán khác.", MYSITE . 'gio-hang');
		}
	}

	function zalo_return()
	{

		$func = $this->data['func'];
		$lang = $this->current_lang;
		$d = $this->data['d'];
		$setting = $this->data['setting'];
		$optsetting = $this->data['optsetting'];

		$cart = new Cart($d);

		$status = getRequest('status');
		$apptransid = getRequest('apptransid');

		//Các bạn tùy biến hiển thị kết quả thanh toán trên website
		if ($status and $apptransid and $status == 1) {
			//echo "GD Thanh cong";
			$chitietdonhang = '';
			$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
			for ($i = 0; $i < $max; $i++) {
				$pid = $_SESSION['cart'][$i]['productid'];
				$q = $_SESSION['cart'][$i]['qty'];
				$color = $_SESSION['cart'][$i]['mau'];
				$size = $_SESSION['cart'][$i]['size'];
				$code = $_SESSION['cart'][$i]['code'];
				$proinfo = $cart->get_product_info($pid);
				$pmau = $cart->get_product_mau($color);
				$psize = $cart->get_product_size($size);
				$textsm = '';
				if ($pmau != '' && $psize != '') $textsm = $pmau . " - " . $psize;
				else if ($pmau != '') $textsm = $pmau;
				else if ($psize != '') $textsm = $psize;

				if ($q == 0) continue;
			}

			$data_donhang = array();
			$data_donhang['id_user'] = @$this->userInfo['id'] ?? 0;
			$data_donhang['madonhang'] = $_SESSION['zalo']['madonhang'];
			$data_donhang['hoten'] = $_SESSION['zalo']['hoten'];
			$data_donhang['dienthoai'] = $_SESSION['zalo']['dienthoai'];
			$data_donhang['diachi'] = $_SESSION['zalo']['diachi'];
			$data_donhang['email'] = $_SESSION['zalo']['email'];
			$data_donhang['httt'] = $_SESSION['zalo']['httt'];
			$data_donhang['phiship'] = $_SESSION['zalo']['ship'];
			$data_donhang['ship_code'] = $_SESSION['zalo']['ship_code'];
			$data_donhang['tamtinh'] = $_SESSION['zalo']['tamtinh'];
			$data_donhang['tonggia'] = $_SESSION['zalo']['tonggia'];
			$data_donhang['khoiluong'] = $_SESSION['zalo']['khoiluong'];
			$data_donhang['yeucaukhac'] = $_SESSION['zalo']['noidung'];
			$data_donhang['ngaytao'] = $_SESSION['zalo']['ngaydangky'];
			$data_donhang['tinhtrang'] = 1;
			$data_donhang['city'] = $_SESSION['zalo']['thanhpho'];
			$data_donhang['district'] = $_SESSION['zalo']['quan'];
			$data_donhang['wards'] = $_SESSION['zalo']['phuong'];
			$data_donhang['stt'] = 1;
			$data_donhang['thongbao'] = 1;
			$id_insert = $d->insert('order', $data_donhang);

			if ($id_insert) {
				for ($i = 0; $i < $max; $i++) {
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$proinfo = $cart->get_product_info($pid);
					$gia = $proinfo['gia'];
					$giamoi = $proinfo['giamoi'];
					$color = $cart->get_product_mau($_SESSION['cart'][$i]['mau']);
					$size = $cart->get_product_size($_SESSION['cart'][$i]['size']);
					$code = $_SESSION['cart'][$i]['code'];

					if ($q == 0) continue;
					$data_donhangchitiet = array();
					$data_donhangchitiet['id_product'] = $pid;
					$data_donhangchitiet['id_order'] = $id_insert;
					$data_donhangchitiet['photo'] = $proinfo['photo'];
					$data_donhangchitiet['ten'] = $proinfo['ten' . $lang];
					$data_donhangchitiet['code'] = $code;
					$data_donhangchitiet['mau'] = $color;
					$data_donhangchitiet['size'] = $size;
					$data_donhangchitiet['gia'] = $gia;
					$data_donhangchitiet['khoiluong'] = $proinfo['khoiluong'];
					$data_donhangchitiet['giamoi'] = $giamoi;
					$data_donhangchitiet['soluong'] = $q;
					if ($d->insert('order_detail', $data_donhangchitiet)) {
						$d->rawQuery("Update #_product SET soluong=soluong-" . $q . ",daban=daban+" . $q . " WHERE id ='" . $pid . "'");
					}
				}
			}

			/* Send email admin */
			$arrayEmail = null;
			$subject = "Thông tin đơn hàng từ " . $setting['ten' . $lang];

			unset($_SESSION['cart']);
			unset($_SESSION['zalo']);
			transfer("Thông tin đơn hàng đã được gửi thành công.", MYSITE);
		} else {
			echo "Giao dịch không thành công";
			transfer("Giao dịch không thành công. Vui lòng thử phương thức thanh toán khác.", MYSITE . 'gio-hang');
		}
	}

	function vnpay_ipn()
	{
	}


	function momo_ipn()
	{

		$d = $this->data['d'];

		if (!empty($_POST)) {
			$momo = new MoMoPayment($d);
			$momo->momo_ipn($_POST);
		}
	}


	function min()
	{
		$this->load->view('MINIFIER');
	}

	public function testemail()
	{


		$this->toEmail();

		die;


		$twig = new Twig();
		$twig->render(
			'email_xac_nhan_don_hang',

			[
				'level' => '1',
				'items' => [
					'class' => '111',
					'href' => 'dsdsd',
				]
			]
		);
		//var_dump($file);die;

	}

	function ckdAllUrl()
	{
		$requick = array(
			array("tbl" => "product_list", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
			array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", 'menu' => true),
			array("tbl" => "news", "field" => "id_thuonghieu", "source" => "news", "com" => "thuong-hieu", "type" => "thuong-hieu", 'menu' => true),
			array("tbl" => "news", "field" => "id_dong", "source" => "news", "com" => "dong", "type" => "dong", 'menu' => true),
			array("tbl" => "news_list", "field" => "idl", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc"),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "tin-tuc", "type" => "tin-tuc", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "su-kien", "type" => "su-kien", 'menu' => true),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "thong-bao", "type" => "thong-bao", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "chinh-sach", "type" => "chinh-sach", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "bai-viet-thuong-hieu", "type" => "bai-viet-thuong-hieu", 'menu' => false),
			array("tbl" => "news", "field" => "id", "source" => "news", "com" => "ho-tro", "type" => "ho-tro", 'menu' => false),
			array("tbl" => "static", "field" => "id", "source" => "static", "com" => "gioi-thieu", "type" => "gioi-thieu", 'menu' => true),
			array("tbl" => "static", "field" => "id", "source" => "contact", "com" => "lien-he", "type" => "lien-he", 'menu' => true),
		);


		$config_base = MYSITE;
		$lang = $this->current_lang;

		$all_link = array();
		foreach ($requick as $value) {
			$table = $value['tbl'] ?? '';
			$type = $value['type'] ?? '';
			$com = $value['com'] ?? '';
			$urlsm = $config_base . $com;
			$all_link[] = $urlsm;

			$sitemap = null;
			if ($type != '' && $table != 'photo') {
				$sitemap = $this->data['d']->rawQuery("select tenkhongdau$lang as ten, ngaytao from #_$table where type = ? ", array($type));
			}

			if (!empty($sitemap) && is_array($sitemap) && count($sitemap) > 0) {
				foreach ($sitemap as $vv) {
					if (
						$com == 'tin-tuc' ||
						$com == 'su-kien' ||
						$com == 'san-pham'

					) {
						$urlsm = $config_base . $com . '/' . $vv['ten'] ?? "";
						$all_link[] = $urlsm;
					} else {
						$urlsm = $config_base . $vv['ten'] ?? "";
						$all_link[] = $urlsm;
					}
				}
			}
		}

		$all_link = array_unique($all_link);
		if (is_array($all_link) && count($all_link)) {
			foreach ($all_link as $k => $link) {
				if (!checkWebsite($link)) {
					unset($all_link[$k]);
				} else {

					//echo $link . "<br/>";
				}
			}
		}

		return $all_link;
		//header('Access-Control-Allow-Origin: *');
		//header("Content-type: application/json; charset=utf-8");


		//echo @json_encode($all_link);
	}

	function getAllCKDLink()
	{
		$urls = $this->ckdAllUrl();
		foreach ($urls as $k => $link) {
			echo $link . "<br/>";
		}
	}

	function sendAllUrlToGoogle()
	{
		require_once APPPATH . 'libraries/google_api/vendor/autoload.php';

		$key = SHAREDPATH . 'json/google_key.json';

		$type = 'URL_DELETED';

		//$urls = $this->ckdAllUrl();
		$urlszz = ' 
';
		$urls = explode("\n", $urlszz);

		try {
			$client = new \Google_Client();
			$client->setAuthConfig($key);
			$client->addScope(Google_Service_Indexing::INDEXING);
			$client->setUseBatch(true);
			$service = new \Google_Service_Indexing($client);
			$batch = $service->createBatch();

			$postBody = new \Google_Service_Indexing_UrlNotification();
			foreach ($urls as $url) {
				$postBody->setUrl($url);
				$postBody->setType($type);
				$batch->add($service->urlNotifications->publish($postBody));
			}

			$results = $batch->execute();

			echo '<pre>';
			var_dump($results);
		} catch (\Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return  false;

		//$results = $batch->execute();
		//foreach ($results as $result) {
		//echo json_encode($result);
		//}
		//echo json_encode($results);


		if ($results) {
			echo 1;
		} else {
			echo 0;
		}

		return false;


		$requests = array(
			array("url" => $url, "type" => $type),
			array("url" => $url, "type" => $type)
		);


		//init google batch and set root URL
		$batch = new Google_Http_Batch($client, false, 'https://indexing.googleapis.com');

		//init service Notification to sent request
		$postBody = new Google_Service_Indexing_UrlNotification();
		$postBody->setType('URL_UPDATED');
		$postBody->setUrl('https://your_job_detail');

		//init service Indexing ( like updateJobPosting )
		$service = new Google_Service_Indexing($client);
		//create request
		//$service->urlNotifications->createRequestUri('https://indexing.googleapis.com/batch');
		$request_kame = $service->urlNotifications->publish($postBody);
		//add request to batch
		$batch->add($request_kame);
	}

	function update_single_index($url, $type)
	{
		global $client;
		// $client->setUseBatch(false);
		$httpClient = $client->authorize();
		$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

		$content = '{"url":' . '"' . $url . '"' . ',"type":' . '"' . $type . '"' . '}';
		echo $content;
		$response = $httpClient->post($endpoint, ['body' => $content]);
		$status_code = $response->getStatusCode();

		echo json_encode($response);
		echo $status_code;
	}

	function test()
	{
		getAllProductSale();
	}

	function onepay()
	{
		echo 'hi';

		$end_point_test = 'https://mtf.onepay.vn/paygate/vpcpay.op';
		$end_point_prod = 'https://onepay.vn/paygate/vpcpay.op';

		//vpc_CardList


		//vpc_MerchTxnRef ma giao dich
		//vpc_OrderInfo ma don
		//vpc_Amount //VND 25,000 thì số tiền gởi qua là: 2500000
		//vpc_TicketNo Địa chỉ IP khách hàng

		//AgainLink Link trang thanh toán của website trước khichuyển sang OnePAY

		//Title


		//options
		//vpc_Customer_Phone
		//vpc_Customer_Email
		//vpc_Customer_Id

		//vpc_SecureHash .Chuỗi chữ ký đảm bảo toàn vẹn dữ liệu. Tham khảo code sample và mục II.8


		//vpc_TxnResponseCode = 0 ; OKI


		$SECURE_SECRET = "6D0870CDE5F24F34F3915FB0045120DB";

		// add the start of the vpcURL querystring parameters
		//$vpcURL = $_POST["virtualPaymentClientURL"] . "?";
		$vpcURL = $end_point_test . "?";

		//$_POST =;

		$data = array(
			''
		);

		// Remove the Virtual Payment Client URL from the parameter hash as we 
		// do not want to send these fields to the Virtual Payment Client.
		//unset($_POST["virtualPaymentClientURL"]);

		// The URL link for the receipt to do another transaction.
		// Note: This is ONLY used for this example and is not required for 
		// production code. You would hard code your own URL into your application.

		// Get and URL Encode the AgainLink. Add the AgainLink to the array
		// Shows how a user field (such as application SessionIDs) could be added
		$_POST['AgainLink'] = urlencode($_SERVER['HTTP_REFERER']);
		//$_POST['AgainLink']=urlencode($_SERVER['HTTP_REFERER']);
		// Create the request to the Virtual Payment Client which is a URL encoded GET
		// request. Since we are looping through all the data we may as well sort it in
		// case we want to create a secure hash and add it to the VPC data if the
		// merchant secret has been provided.
		//$md5HashData = $SECURE_SECRET; Khởi tạo chuỗi dữ liệu mã hóa trống
		$md5HashData = "";

		ksort($_POST);

		// set a parameter to show the first pair in the URL
		$appendAmp = 0;

		foreach ($_POST as $key => $value) {

			// create the md5 input and URL leaving out any fields that have no value
			if (strlen($value) > 0) {

				// this ensures the first paramter of the URL is preceded by the '?' char
				if ($appendAmp == 0) {
					$vpcURL .= urlencode($key) . '=' . urlencode($value);
					$appendAmp = 1;
				} else {
					$vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
				}
				//$md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
				if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
					$md5HashData .= $key . "=" . $value . "&";
				}
			}
		}
		//xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa
		$md5HashData = rtrim($md5HashData, "&");
		// Create the secure hash and append it to the Virtual Payment Client Data if
		// the merchant secret has been provided.
		if (strlen($SECURE_SECRET) > 0) {
			//$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));
			// Thay hàm mã hóa dữ liệu
			$vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*', $SECURE_SECRET)));
		}

		// FINISH TRANSACTION - Redirect the customers using the Digital Order
		// ===================================================================

		//chuyen huong


		//header("Location: " . $vpcURL);

		// *******************
		// END OF MAIN PROGRAM
		// *******************




	}

	function onepay_callback()
	{

		//responsecode=1&desc=confirm-success


		$func = $this->data['func'];

		$d = $this->data['d'];


		$cart = new Cart($d);

		$resultCode = getRequest('responsecode');
		$vpc_TxnResponseCode = getRequest('vpc_TxnResponseCode');

		/*
			$hoten = $_SESSION['momo']['hoten'] ?? $hotenz;
			$email = $_SESSION['momo']['email'] ?? $emailz;
			$dienthoai = $_SESSION['momo']['dienthoai'] ?? '';
			$diachi = $_SESSION['momo']['diachi'] ?? ''; 
		*/

		$yeucaukhac = '';
		$htttText = $func->get_payments(634);

		$config_base = MYSITE;


		if ($resultCode == 0) {
			if (
				$vpc_TxnResponseCode == 253 ||
				$vpc_TxnResponseCode == 'Z' ||
				$vpc_TxnResponseCode == 'D' ||
				$vpc_TxnResponseCode == 'F' ||
				$vpc_TxnResponseCode == 'U'

			) {
				transfer("Giao dịch không thành công. Lý do: Hết phiên giao dịch! Vui lòng thanh toán lại giao dịch.", MYSITE . 'gio-hang');
				return false;
			}

			if (
				$vpc_TxnResponseCode == 98 ||
				$vpc_TxnResponseCode == 99

			) {
				transfer("Giao dịch không thành công. Lý do: Bạn đã hủy đơn hàng! Vui lòng thanh toán lại giao dịch.", MYSITE . 'gio-hang');
				return false;
			}
			if (
				$vpc_TxnResponseCode == 25 ||
				$vpc_TxnResponseCode == 26

			) {
				transfer("Giao dịch không thành công. Lý do: OTP không hợp lệ! Vui lòng thanh toán lại giao dịch.", MYSITE . 'gio-hang');
				return false;
			}
			if (

				$vpc_TxnResponseCode == 1 ||
				$vpc_TxnResponseCode == 2 ||
				$vpc_TxnResponseCode == 4 ||
				$vpc_TxnResponseCode == 5
			) {
				transfer("Giao dịch không thành công. Lý do: Ngân hàng từ chối thẻ của bạn! Vui lòng thanh toán lại giao dịch.", MYSITE . 'gio-hang');
				return false;
			}

			$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
			$stt = 0;
			for ($i = 0; $i < $max; $i++) {
				$textsm = '';
				$pid = $_SESSION['cart'][$i]['productid'];
				$q = $_SESSION['cart'][$i]['qty'];
				$color = $_SESSION['cart'][$i]['mau'];
				$size = $_SESSION['cart'][$i]['size'];
				$code = $_SESSION['cart'][$i]['code'];
				$proinfo = $cart->get_product_info($pid);
				$pmau = $cart->get_product_mau($color);
				$psize = $cart->get_product_size($size);

				$data_donhang = array();
				$data_donhang['id_user'] = @$this->isLogin ?? 0;
				$data_donhang['madonhang'] = $_SESSION['onepay']['madonhang'];
				$data_donhang['hoten'] = $_SESSION['onepay']['hoten'];
				$data_donhang['dienthoai'] = $_SESSION['onepay']['dienthoai'];
				$data_donhang['diachi'] = $_SESSION['onepay']['diachi'];
				$data_donhang['email'] = $_SESSION['onepay']['email'];
				$data_donhang['httt'] = $_SESSION['onepay']['httt'];
				$data_donhang['phiship'] = $_SESSION['onepay']['ship'];
				$data_donhang['ship_code'] = $_SESSION['onepay']['ship_code'];
				$data_donhang['tamtinh'] = $_SESSION['onepay']['tamtinh'];
				$data_donhang['tonggia'] = $_SESSION['onepay']['tonggia'];
				$data_donhang['khoiluong'] = $_SESSION['onepay']['khoiluong'];
				$data_donhang['yeucaukhac'] = $_SESSION['onepay']['noidung'];
				$data_donhang['ngaytao'] = $_SESSION['onepay']['ngaydangky'];
				$data_donhang['tinhtrang'] = 1;
				$data_donhang['city'] = $_SESSION['onepay']['thanhpho'];
				$data_donhang['district'] = $_SESSION['onepay']['quan'];
				$data_donhang['wards'] = $_SESSION['onepay']['phuong'];
				$data_donhang['stt'] = 1;
				$data_donhang['json_order'] = json_encode($_GET);
				$data_donhang['thongbao'] = 1;
				$id_insert = $d->insert('order', $data_donhang);

				//vpc_MerchTxnRef
				//vpc_AuthorizeId
				//vpc_Amount

				//https://ckdvietnam.com/onepay_callback?vpc_Amount=65775000&vpc_AuthorizeId=831000&vpc_Card=MC&vpc_CardExp=0526&vpc_CardNum=512345***0008&vpc_CardUid=INS-siwpapmFOCjgUAB_AQAz_w&vpc_Command=pay&vpc_MerchTxnRef=1709020126&vpc_Merchant=TESTONEPAY&vpc_Message=Approved&vpc_OrderInfo=B7SXB7&vpc_PayChannel=WEB&vpc_TransactionNo=PAY-LP5381yERsaec9vPrCEs3A&vpc_TxnResponseCode=0&vpc_Version=2&vpc_BinCountry=EC&vpc_SecureHash=47BE6D99CC85E0A4342C89C7C4394C4CC5A7293FCFAC28CC402E5E15D8D253D7

				if ($id_insert) {
					for ($i = 0; $i < $max; $i++) {
						$pid = $_SESSION['cart'][$i]['productid'];
						$q = $_SESSION['cart'][$i]['qty'];
						$proinfo = $cart->get_product_info($pid);
						$gia = $proinfo['gia'];
						$giamoi = $proinfo['giamoi'];
						$color = $cart->get_product_mau($_SESSION['cart'][$i]['mau']);
						$size = $cart->get_product_size($_SESSION['cart'][$i]['size']);
						$code = $_SESSION['cart'][$i]['code'];

						if ($q == 0) continue;

						$data_donhangchitiet = array();
						$data_donhangchitiet['id_product'] = $pid;
						$data_donhangchitiet['id_order'] = $id_insert;
						$data_donhangchitiet['photo'] = $proinfo['photo'];
						$data_donhangchitiet['ten'] = $proinfo['tenvi'];
						$data_donhangchitiet['code'] = $code;
						$data_donhangchitiet['mau'] = $color;
						$data_donhangchitiet['size'] = $size;
						$data_donhangchitiet['gia'] = $gia;
						$data_donhangchitiet['khoiluong'] = $proinfo['khoiluong'];
						$data_donhangchitiet['giamoi'] = $giamoi;
						$data_donhangchitiet['soluong'] = $q;
						if ($d->insert('order_detail', $data_donhangchitiet)) {
							$d->rawQuery("Update #_product SET soluong=soluong-" . $q . ",daban=daban+" . $q . " WHERE id ='" . $pid . "'");
						}
					}
				}

				/* Xóa giỏ hàng */
				unset($_SESSION['cart']);
				unset($_SESSION['onepay']);
				transfer("Thông tin đơn hàng đã được gửi thành công.", MYSITE);
			}
		} else {
			#echo "Giao dịch không thành công";
			transfer("Giao dịch không thành công. Vui lòng thử phương thức thanh toán khác.", MYSITE . 'gio-hang');
		}
	}
}
