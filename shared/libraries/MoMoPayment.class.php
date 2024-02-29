<?php
class MoMoPayment
{
	//private $d;
	public $d;
	public $_url = 'https://payment.momo.vn/v2/gateway/api/create';
	public $_secretKey = 'xvDnTCBPvsVcWxfMm3SnUFtNHHEDBOPs';//Dùng để tạo chữ ký điện tử signature.
	public $_accessKey = 'kWjcrFYeOgAkl7qn';//Cấp quyền truy cập vào hệ thống MoMo.
	public $_partnerCode = 'MOMOKDQA20230915';//Thông tin để định danh tài khoản doanh nghiệp.

	/*public $_url = 'https://test-payment.momo.vn/v2/gateway/api/create';
	public $_secretKey = 'mIUgKDL02L3nwyT5Mq7CGaE8D0HznxRy'; // key test.
	public $_accessKey = 'O437ELigHcN6d7yj'; // Key test.
	public $_partnerCode = 'MOMOKDQA20230915'; // ma nay chay 2 moi truong test và thực.*/

	//Lưu ý: nhớ cập nhật (returnUrl và notifyUrl) cho đúng với website đang làm

	//https://ckdvietnam.com/mono_return?partnerCode=MOMOKDQA20230915&orderId=9QGMJN&requestId=9QGMJN&amount=1000&orderInfo=Thanh+toan+cho+don+hang+9QGMJN&orderType=momo_wallet&transId=1703236672583&resultCode=1006&message=Transaction+denied+by+user.&payType=&responseTime=1703236672589&extraData=&signature=15440119a2aabfd591528b522824e3344da1faf6058ec794a17ac0bf8764c08c
	public $_returnUrl = 'https://ckdvietnam.com/momo_return';//trang nhận kết quả trả về từ trang MoMo  (nhập url)
	public $_notifyUrl = 'https://ckdvietnam.com/momo_ipn';//API của đối tác. Được MoMo sử dụng để gửi kết quả thanh toán theo phương thức IPN (nhập url)

	function __construct($d){
		$this->d = $d;
	}
	 /**
	 * Trả dữ liệu về client
	 * @param: $status_code: mã http trả về
	 * @param: $data: dữ liệu trả về
	 */
	protected function response($status_code, $data = NULL)
	{
		header($this->_build_http_header_string($status_code));
		header("Content-Type: application/json");
		echo json_encode($data);
		die();
	}

	/**
	 * Tạo chuỗi http header
	 * @param: $status_code: mã http
	 * @return: Chuỗi http header, ví dụ: HTTP/1.1 404 Not Found
	 */
	private function _build_http_header_string($status_code)
	{
		$status = array(
			200 => 'OK',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			500 => 'Internal Server Error'
		);
		return "HTTP/1.1 " . $status_code . " " . $status[$status_code];
	}

	function create_url_payment($orderId, $amount, $orderInfo, $requestId, $extraData)
	{
		$arr_kq = array();

		$momo_url = $this->_url;
		$secretKey  = $this->_secretKey;
		$accessKey = $this->_accessKey;
		$partnerCode = $this->_partnerCode;
		$requestType = 'captureWallet';
		$notifyUrl = $this->_notifyUrl;
		$returnUrl = $this->_returnUrl;

		$string_data = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$notifyUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$returnUrl&requestId=$requestId&requestType=$requestType";

		$signature = hash_hmac('sha256', $string_data, $secretKey); // tạo chữ ký

		$postData = array(
			"partnerCode" => $partnerCode,
			"partnerName" => "Test",
			"storeId" => "Merchant",
			"requestType" => $requestType,
			"ipnUrl" => $notifyUrl,
			"redirectUrl" => $returnUrl,
			"orderId" => $orderId,
			"amount" => strval($amount),
			"lang" => "en",
			//"autoCapture" => false,
			"orderInfo" => $orderInfo,
			"requestId" => $requestId,
			"extraData" => $extraData,
			"signature" => $signature
		);
		$json_data = json_encode($postData);
		$curl = curl_init();
		    curl_setopt_array($curl, array(
			CURLOPT_URL => $momo_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $json_data,
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: 26790603-c665-f1d9-200c-c8b1e7c26fc6"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
		// Decode the response
		$responseData = json_decode($response, TRUE);
		if ($responseData['errorCode'] == 0) { //Tạo link thanh toán thành công
			$arr_kq['errCode'] = 0;
			$arr_kq['mess'] = $responseData['payUrl'];
		} else {
			$arr_kq['errCode'] = $responseData['errorCode'];
			$arr_kq['mess'] = 'MoMo message: errorCode ' . $responseData['errorCode'] . ' => ' . $responseData['message'] . ' - ' . $responseData['localMessage'];
		}
		return $arr_kq;
	}

	function momo_ipn($res)
	{
		
		// Hãy viết code xử lý UPDATE trạng thái đơn hàng ở đây (KHÔNG xử lý update trạng thái đơn hàng ở returnUrl)
		// tài liệu MoMo https://developers.momo.vn/#/docs/aio/
		$signature_respon = $res['signature'];
		$string_data = "partnerCode=" . $res['partnerCode'] . "&accessKey=" . $res['accessKey'] . "&requestId=" . $res['requestId'] . "&amount=" . $res['amount'] . "&orderId=" . $res['orderId'] . "&orderInfo=" . $res['orderInfo'] . "&orderType=" . $res['orderType'] . "&transId=" . $res['transId'] . "&message=" . $res['message'] . "&localMessage=" . $res['localMessage'] . "&responseTime=" . $res['responseTime'] . "&errorCode=" . $res['errorCode'] . "&payType=" . $res['payType'] . "&extraData=" . $res['extraData'] . "";
		$signature = hash_hmac('sha256', $string_data, $secretKey);//tạo chữ ký
		// đơn hàng thanh toán momo có 3 trạng thái:
		// 0: chưa xử lý
		// 1: đã xử lý và giao dịch thành công
		// 2: đã xử lý và giao dịch thất bại
		if ($res['errorCode'] == 0 && $signature == $signature_respon) {
		   //thanh toán thành công
			$trangthai = 1;
		} else {
			$trangthai = 2;
		}
		$madonhang = $res['orderId'];
		$magiaodich = $res['transId']; // Mã giao dịch của MoMo
		$time_giaodich = $res['responseTime']; // thời gian giao dịch
		$mess_momo = $res['localMessage']; // Thông báo từ MoMo
		// Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
		
		$row = $this->d->rawQueryOne("select id,thanhtoan from table_order where madonhang='".$madonhang."'");
		if (!empty($row) && $row['id'] > 0 && $row['thanhtoan'] == 0) { 
		    //$row['thanhtoan']==0) => giao dịch chưa xử lý lần nào (tránh xử lý nhiều lần trên 1 đơn hàng)
			//lưu trạng thái thanh toán đơn hàng (các bạn tùy chỉnh theo DB của mình)
		    $data_thanhtoan['thanhtoan'] = $trangthai;
		    $data_thanhtoan['time_momo'] = $time_giaodich;
		    $data_thanhtoan['id_momo'] = $magiaodich;
		    $data_thanhtoan['mess_momo'] = $mess_momo;
			$d->where('madonhang',$madonhang);
			$d->update('order',$data_thanhtoan);
		}

		// trả dữ liệu về cho MoMo
		$string_data_trave = "partnerCode=" . $res['partnerCode'] . "&accessKey=" . $res['accessKey'] . "&requestId=" . $res['requestId'] . "&orderId=" . $res['orderId'] . "&errorCode=" . $res['errorCode'] . "&message=" . $res['message'] . "&responseTime=" . $res['responseTime'] . "&extraData=" . $res['extraData'] . "";
		$signature_trave = hash_hmac('sha256', $string_data_trave, $secretKey); // tạo chữ ký
		$data = array(
			'partnerCode' => $res['partnerCode'],
			'accessKey' => $res['accessKey'],
			'requestId' => $res['requestId'],
			'orderId' => $res['orderId'],
			'errorCode' => $res['errorCode'],
			'message' => $res['localMessage'],
			'responseTime' => $res['responseTime'],
			'extraData' => $res['extraData'],
			'signature' => $signature_trave
		);
		//Trả kết quả về cho MoMo theo $data json trong tài liệu (phần HTTP Response (IPN))
		$this->response(200, $data);
	}
}
?>
