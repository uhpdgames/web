<?php

class Congtacvien
{
	public $_active = true;
	private $_settings;
	private $config;

	private $bank;

	private $revenue = 0;
	private $money_balance = 0;

	private $_Wallet = array();
	private $d;
	private $url;

	private $link;
	private $textUrl;

	private $allCode;
	private $code;
	private $current_pid;
	private $keyCode = 'ref';

	private $_admin = false;
	private $infoRef = NULL;
	private $refOrder = NULL;

	private $_table = 'ref';
	private $_table_order = 'ref_order';
	public $login_member = '';
	public $login_ctv = '';

public function __construct($isAdmin = false, $d = false)
	{
		$this->login_member = 'LoginMember';
		$this->login_ctv = 'CTVMember';


//		$info_db = array(
//			'server-name' => DB_HOST,
//			'url' => '/',
//			'type' => 'mysql',
//			'host' => DB_HOST,
//			'username' => DB_USER,
//			'password' => DB_PASS,
//			'dbname' => DB_NAME,
//			'port' => 3306,
//			'prefix' => 'table_',
//			'charset' => 'utf8'
//		);


		$this->d = $d;

		$this->setConfig();
		//IF: USER IS REF
		//if (!empty($_SESSION[$this->login_member]) && $_SESSION[$this->login_member]['ref_nick']) {
			$this->setSESS();
			$this->setDefaultSetting();

		//}


		//IF: USER IS BUYER
		//
		//set code ref
		/**
		 * todo
		 * VIA ?REF=
		 */


		$this->_admin = $isAdmin;
		$this->setDefaultAdmin();

		//setting end line fi
		$this->setTotalRevenue();

		$this->setCode();

		if (isset($this->code) && $this->code !='') {
			$this->getRefBy();
		}


		//mid
		$this->resetSetting();

		//last
		$this->setRefActive();

	}

	public function resetSetting()
	{
		if (!empty($this->_settings) && !empty($this->_settings['code'])) {
			if (is_array($this->_settings)) {
				$this->_settings = array_fill_keys(array_keys($this->_settings), false);
			}


			if (isset($_GET[$this->keyCode]) && $_GET[$this->keyCode] != '') {
				$this->setRegister($_GET[$this->keyCode]);
			}
		}

		//reset uid
		if (!empty($this->_settings) && !$this->_settings['uid']) {
			$item = $this->getRefUidByCode();
			$this->_settings['uid'] = !empty($item[0]) ? $item[0] : 0;
		}

	}

	public function getCurrentUid()
	{
		return $this->_settings['uid'];
	}

	public function setRegister($code)
	{

		$this->code = $code;

		//return $this->code;
		//  $this->product_generators();
	}

	public function getLink($key)
	{
		return $this->link[$key];
	}

	public function getTextLink($key)
	{
		return $this->textUrl[$key];
	}

	public function link()
	{
		$this->link = [
			'confirm_transfer' => $this->url . 'account/xac-nhan-chuyen-khoan',
			'now_transfer' => $this->url . 'account/xac-nhan-chuyen-khoan',
			'transfer' => $this->url . 'account/thong-tin-chuyen-khoan',
			'add_bank' => $this->url . 'account/them-tai-khoan-ngan-hang',
		];

		$this->textUrl = [
			'confirm_transfer' => 'Xác nhận rút tiền',
			'now_transfer' => 'Rút tiền ngay',
			'transfer' => 'Rút tiền',
			'add_bank' => "Thêm",
		];
	}

	public function getRawRefOrder()
	{
		if (!$this->_settings['uid']) return false;

		$this->refOrder = $this->d->rawQuery('select o.*, r.* from #_ref_order o join #_ref r on r.id = o.ref_id where o.uid=' . $this->_settings['uid']);
	}

	public function product_generators($lang)
	{
		//todo Sản Phẩm Của Tôi
		// $all_RefOrder = $this->getRawRefOrder();

		//select id, photo,tenkhongdauvi,tenkhongdauen,tenen,tenvi,masp,gia
		//create all lin for product/   type='san-pham'

		$sql = <<<END
select id, photo,
       tenkhongdauvi ,
       tenvi, masp,
       gia,giamoi 
from #_product
where hienthi = 1
group by id;
END;
		$all_product = $this->d->rawQuery($sql);

		$gen = array();
		$html = '';
		//get_product

		if (is_array($all_product) && count($all_product)) {
			foreach ($all_product as $product) {
				$pid = !empty($product['id']) ? $product['id'] : NULL;
				if ($pid) {

					$html .= $this->product_create_link($product);

					/*if(isset($all_RefOrder[$pid])){

					}*/


					//check is order

					/*$gen[$pid] = array(

						'user_id' => $this->_settings['uid'],
						'code' => $this->code,
						'pid' => $pid,
						'url_vi' => $product['tenkhongdauvi'],
						//'url_en' => $product['tenkhongdauen'],
						'date_create' => date("Y-m-d H:i:s"),
					);

					if (is_array($all_RefOrder) && count($all_RefOrder)) {
						foreach ($all_RefOrder as $ref) {

						}
					}*/


				} else {
					//continue;
				}
			}
		}

		return $html;
	}

	private function updateOrder($data, $order_id)
	{
		$this->d->where('order_id', $order_id);
		$this->d->update($this->_table_order, $data);
	}

	public function convert_create_link($product)
	{
		$product_list = (array)json_decode($product['product_list']);

		$image = $this->url . 'assets/images/ctv/quest.png';

		$status = 'Chưa thanh toán';
		$text = 'Hoa hồng đang chờ xử lý --';


		$orderId = $product['madonhang'];
		$date = date('d-m-y H:s:i', strtotime($product['date_create']));
		//date('d-m-y', strtotime($product['ngaytao']));

		if (is_array($product_list) && count($product_list)) {
			foreach ($product_list as $pros) {
				$imageProduct = $this->url . 'upload/product/' . $pros->photo;
				$name = $pros->ten;
				$qty = $pros->qty;

				switch ($product['tinhtrang']) {
					case '0':
						break;
					case '1':
						$status = 'Đơn hàng đã xác nhận';
						break;
					case '2':
						$status = 'Đơn hàng đang xử lý';
						break;
					case '3':
						$status = 'Đơn hàng đang vận chuyển';
						break;
					case '4':
						$text = 'Hoa hồng: ' . $this->formatMoney($pros->gia) . ' VNĐ';
						$status = 'Đã hoàn thành';
						break;
					case '5':
						$status = 'Đơn hàng đã bị hủy';
						$text = '--';
						break;
					default:
				}
				$html .= <<<HTML
 <div class="row list-item wp_form mt-4 p-4">
                <div class="col-12 col-lg-3">
                    <div class="wp d-flex flex-column">
                        <div class="order trangthai f-small sub-text">Order ID: $orderId</div>
                        <div class="soluong my-2"><img
                                    src="$imageProduct"
                                    class="img-fluid item product-img" /></div>
                        <div class="date hoahong f-small sub-text">Đặt hàng vào ngày $date</div>
                    </div>

                </div>
                <div class="col-6 col-lg-6">
                    <div class="note d-flex flex-column">
                        <div class="trangthai">&nbsp;</div>
                        <div class="name left">$name</div>
                        <div class="hoahong">&nbsp;</div>
                    </div>

                </div>
                <div class="col-6 col-lg-3">
                    <div class="note d-flex flex-column ">
                        <div class="trangthai text-right">$status</div>
                        <div class="soluong text-right font-weight-bold">x$qty</div>
                        <div class="hoahong text-right font-weight-bold">$text
                            <img
                                    src="$image" class="img-fluid quest">
                        </div>
                    </div>
                </div>
            </div>
HTML;
			}
		}

		return $html;

	}

	public function convert_generators()
	{


		////order/product//trangthai-4/
		/// SELECT * FROM `table_ref` // id
		///
		$html = '';
		$sql = <<<SQL
select 
    r.id as refOrderId, o.id as myOrderId, o.madonhang, o.ngaytao, o.tinhtrang, revenue, r.date_create, r.order_id,r.product_list
from #_ref_order r 
    join #_order o 
        on o.ref_id = r.ref_id 
where r.uid = ? order by r.id desc  
                 
SQL;
		$all_product = $this->d->rawQuery($sql, array($this->_settings['uid']));

		if (is_array($all_product) && count($all_product)) {
			foreach ($all_product as $product) {
				$pid = !empty($product['refOrderId']) ? $product['refOrderId'] : NULL;
				if ($pid) {
					$html .= $this->convert_create_link($product);
				}
			}
		} else {
			$html = '<div class="no-order"><h3>Bạn chưa có đơn hàng được giới thiệu</h3></div> ';
		}

		return $html;
	}

	public function product_details()
	{
		$ref_order = $this->getTotalOrder();

		//$this->getRawRefOrder();
		//$ref_order = $this->getRefOrder();

		$data = array('sell' => 0);
		if (is_array($ref_order) && count($ref_order)) {
			$old_item = 1;
			$old_product = 0;
			foreach ($ref_order as $item) {
				if ($old_product != $item['product_id']) {
					$old_product = $item['product_id'];
					$data['item']++;

					if ($item['sell'] == 1) {
						$data['sell']++;
					}

				}

				//$data['visits'] += $item['visits'];
				//todo how to check van chuyen
				$old_item++;
			}
		}

		return array(
			'visits' => $this->getTotalVisits(),
			'item' => count($ref_order) - $data['sell'],
			'commission' => $this->getRate(),
			'sell' => $data['sell'],
			'total_item' => count($ref_order),
			'new_buy' => 0,
		);
	}

	//todo NGUOI MUA MOI SUM TU COT DANG KY


	public function product_create_link($item)
	{
		$rate = $this->getRate();
		$price_old = $item['gia'];
		$price = $item['gia'];
		$name = $item['tenvi'];
		$image = $this->url . 'upload/product/' . $item['photo'];
		$image_share = $this->url . 'assets/images/ctv/share.png';
		$link_share = $this->url . $item['tenkhongdauvi'] . '?' . $this->keyCode . '=' . $this->code;
		//$item
		$html = '';
		if ($price > 0) {
			//<div class=" f-small">Giá bán: $price</div>
			$html = <<<HTML
<div class="row list-item wp_form mt-4 p-4">
                    <div class="col-12 col-lg-3">
                        <div class="wp d-flex flex-column">

                            <div class="soluong my-2">
                            <img src="$image"class="img-fluid item product-img"></div>

                        </div>

                    </div>
                    <div class="col-6 col-lg-6">
                        <div class="note d-flex flex-column">
                            <div class="left m-0 p-0 h-auto font-weight-bold">$name</div>
                            <div class="left w-100 mt-4 mb-0 p-0 h-auto">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="soluong m-0 p-0 label f-small sub-text">Giá bán: $price_old</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="soluong m-0 p-0 label f-small sub-text">Ước tính hoa hồng $rate %</div>
                                        <div class=" f-small"></div>
                                    </div>
                                    <div class="col-6"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="note d-flex flex-column">
                            <div class="trangthai text-right">
                                <a href="$link_share" target="_blank">
                                    <img src="$image_share" class="img-fluid share-quest" />
                                </a>
                            </div>
                            <div class="left"></div>
                        </div>
                    </div>
                </div>
HTML;
		}


		return $html;
	}

	public function share($pid)
	{
		return $this->url . '1' . $pid . '?' . $this->keyCode . '=' . $this->code;
		//  http://localhost/kem-ngan-ngua-nep-nhan-o-co-retino-collagen-small-molecule-300?ref=WwpHhMmksF
	}

	public function link_generators($key)
	{
		$link = '';
		switch ($key) {
			case "confirm_transfer":
				$link = '<div class="text-center money-btn f"><a href="' . $this->getLink($key) . '" class="btn btn-primary">' . $this->getTextLink($key) . '</a></div>';
				break;

			case "now_transfer": //' . $this->getLink($key) . '
				$link = '<div class="text-center money-btn"><a href="javascript:void(0);" class="btn btn-primary">' . $this->getTextLink($key) . '</a></div>';
				break;

			case "transfer":
				//$this->getLink($key)
				$link = '<a href="javascript:void(0);" class="btn btn-primary" id="requestTransfer">' . $this->getTextLink($key) . '</a>';
				break;
			case "add_bank":
				$link = '<a href="' . $this->getLink($key) . '"><span>+</span>' . $this->getTextLink($key) . '</a>';
				break;
		}
		return $link;
	}

	public function getRefActive()
	{
		return $this->_active;
	}

	public function setRefActive()
	{
		$this->_active = !empty($this->_settings['active']) ? $this->_settings['active'] : false;
	}

	public function setSetting($setting)
	{
		array_push($this->_settings, $setting);
	}

	public function checkRef()
	{
		return is_array($this->_settings) && count($this->_settings) > 0;
	}

	public function setCode($code =null)
	{
		if ($this->checkRef()) {
			$item = $this->getRefUid();

			if(!empty($item)){
				$this->code = $this->_settings['code'] = $item['code'];
				$this->_settings['url'] = $this->url . '?' . $this->keyCode . '=' . $this->code;
			}

		}else{

			$this->code = $code;
		}
	}

	public function code()
	{
		return $this->code;
	}

	public function urlCode()
	{
		return !empty($this->_settings['url']) ? $this->_settings['url'] : array();
	}

	public function getConfig()
	{

		return $this->config;
	}

	public function setConfig()
	{
		$this->config = $this->d->rawQueryOne("select * from #_ref_config limit 0,1");

		$this->link();
		$this->getAllCode();
	}

	public function getRef()
	{
		$rs = $this->d->rawQuery("select * from #_ref where user_id = ? limit 0,1", array($this->_settings['uid']));
	}

	public function setDefaultSetting()
	{

		//$this->_settings['uid'] = $_SESSION[$this->login_ctv]['uid'];
		//$this->_settings['active'] = true;//for dev
	}

	public function setSESS()
	{
		$this->login_ctv;
		$this->url = MYSITE;

		if (!empty($_SESSION[$this->login_member]) && $_SESSION[$this->login_member]['ref_nick']) {
			$_SESSION[$this->login_ctv]['uid'] = $_SESSION[$this->login_member]['id'] ?? 0;
			//$_SESSION[$this->login_ctv]['active'] = true;
			$this->_settings['active'] = true;
		}
	}

	public function getVAT()
	{
		return $this->config['vat'];
	}

	public function getLv1()
	{
		return $this->config['lv1'];
	}

	public function getLv2()
	{
		return $this->config['lv2'];
	}

	public function getLv3()
	{
		return $this->config['lv3'];
	}

	public function getCIT()
	{
		return $this->config['cit'];
	}

	public function getRate()
	{
		return $this->config['rate'];
	}

	public function getMinWithDraw()
	{
		return $this->config['min_withdraw'];
	}

	public function getMaxWithDraw()
	{
		return !empty($this->config['max_withdraw']) ? $this->config['max_withdraw'] : 0;
	}

	public function setTotalRevenue()
	{
		if (!$this->checkRef()) return false;

		$sql = 'select sum(revenue) as TotalRevenue from #_ref_order where sell = 1 and uid = ' . $this->_settings['uid'];
		$item = $this->d->rawQueryOne($sql);
		if (is_array($item) && count($item)) {

			$this->revenue = !empty($item['TotalRevenue']) ? $item['TotalRevenue'] : 0;
			if ($this->revenue != 0) {
				$this->revenue = $this->formatMoney($this->revenue) . ' VNĐ';
			} else {
				$this->revenue = 0;
			};
		}
	}

	public function getTotalRevenue()
	{
		$this->setMoneyRevenue();
		return $this->money_balance;
	}


	/**
	 * @param $uid
	 * @param $wallet_id
	 * @return false|mixed Lệnh chờ rút đang có sẳn
	 */
	function checkIssetTransfer($wallet_id, $uid)
	{
		if (empty($uid)) {
			$uid = $this->_settings['uid'];
		}

		$rs = $this->d->rawQueryOne('select id from #_ref_withdrawal where user_id = ? and wallet_id ? and status = 0', array($uid, $wallet_id));

		if ($rs) {
			return $rs[0];
		}

		return false;
	}

	public function getRequestWithdrawn($wallet_id)
	{
		if ($issetRequest = $this->checkIssetTransfer($wallet_id, '')) {
			return $issetRequest;
		}


		return false;
	}

	public function totalWithdrawn()
	{
		$rs = $this->d->rawQueryOne('select sum(amount) as amount from #_ref_withdrawal where user_id = ?', array($this->_settings['uid']));

		if ($rs && !empty($rs['amount'])) {
			return $this->formatMoney($rs['amount']) . ' VNĐ';
		}

		return 0;
	}

	public function totalTransferToWallet()
	{

		$rs = $this->d->rawQueryOne("select sum(amount) as received from #_ref_withdrawal where user_id = ? and status = 1", array($this->_settings['uid']));

		if ($rs) {
			return $this->formatMoney($rs['received']) . ' VNĐ';
		}

		return 0;
	}

	public function setMoneyRevenue()
	{
		$this->setWallet();
		$_Wallet = $this->getWallet();
		$this->money_balance = !empty($_Wallet['balance']) ? $_Wallet['balance'] : 0;

		if ($this->money_balance != 0) {
			$this->money_balance = $this->formatMoney($this->money_balance) . ' VNĐ';
		} else {
			$this->money_balance = 0;
		};
	}

	public function getTempRevenue()
	{
		$sql = 'select sum(revenue) as TotalRevenue from #_ref_order where sell = 1 and uid = ?';
		$item = $this->d->rawQueryOne($sql, array($this->_settings['uid']));
		return !empty($item['TotalRevenue']) ? $this->formatMoney($item['TotalRevenue']) . ' VNĐ' : 0;
	}

	public function getBackAccount()
	{
		if (!$this->checkRef()) return 0;

		$this->bank = $this->d->rawQueryOne('select * from #_bank where uid =' . $this->_settings['uid']);

		return $this->bank;
	}

	public function getSTK()
	{
		$ccNum = $this->bank['stk'] ?? '';
		return $this->_admin ? ($this->bank['stk']?? 'Chưa có thông tin') : str_replace(range(0, 9), "*", substr($ccNum, 0, -4)) . substr($ccNum, -4);

	}

	public function getNumBacnkAccount()
	{
		return $this->bank['stk'];
	}

	/*ADMIN PROCESS*/
	public function setDefaultAdmin()
	{
		if (!$this->_admin) return false;

		$this->_settings['uid'] = !empty($_GET['uid']) ? $_GET['uid'] : 0;
		$this->getBackAccount();
		$this->setInfoRef();
		$this->setRefOrder();

		//if(isset($_SESSION))

		//http://localhost/admin/index.php?com=affiliate&act=ref&id=36

	}

	public function setInfoRef()
	{
		if (!$this->_admin) return false;

		$this->infoRef = $this->d->rawQueryOne('select * from #_member where id =' . $this->_settings['uid']);

		//$this->infoRef = array_merge($this->infoRef, )
		//return $this->infoRef;
	}

	public function getInfoRef()
	{
		return $this->infoRef;
	}


	public function setRefOrder()
	{
		if (!$this->_admin) return false;

		$this->getRawRefOrder();
	}

	public function getRefOrder()
	{
		return $this->refOrder;
	}

	public function getVisits()
	{
		return $this->refOrder['visits'];
	}

	public function getRegister()
	{
		return 'đang cập nhật';//;$this->refOrder['visits'];
	}

	public function getPurchased($status)
	{
		return $status ? 'Đang hoàn tất' : 'Đang chờ xử lý';
	}

	public function getProductInfo($pid)
	{
		//243//
		if (!$this->_admin) return false;

		// $this->infoProduc = $this->d->rawQueryOne("select * from #_product where id = ? limit 0,1", array($pid));

	}


	/*END-LINE ADMIN PROCESS*/

	/*PRODUCT PROCESS*/

	private function getAllCode()
	{
		$this->allCode = $this->d->rawQueryValue("select code from #_ref where pid = 0 group by code");
	}

	public function isRef()
	{
		return isset($_GET[$this->keyCode]) && in_array($_GET[$this->keyCode], $this->allCode);
	}

	public function setRef()
	{
		$code = isset($_GET[$this->keyCode]) ? $_GET[$this->keyCode] : NULL;
		if ($code === NULL) return false;

		$item = $this->d->rawQueryOne('select user_id, code,id from #_ref where code = ? and pid = 0 limit 0,1', array($code));


//		$_SESSION[$this->login_ctv]['user_id'] = isset($item['user_id']) ? $item['user_id'] : '';
//		$_SESSION[$this->login_ctv]['code'] = isset($item['code']) ? $item['code'] : '';
//		$_SESSION[$this->login_ctv]['ref_id'] = isset($item['id']) ? $item['id'] : '';
	}

	public function updateRef($pid, $name)
	{
		$today = date("Y-m-d H:i:s");
		$current_ip = getRealIPAddress();
		$refId = $this->d->rawQueryOne("select id,visits,ip,user_new from #_ref where code = ? and pid = ? limit 0,1", array($this->code, $pid));

		$data = array(
			'code' => $this->code,
			'url_vi' => $name,
			'pid' => $pid,
			'user_id' => $this->_settings['uid'],//is login
			'user_ref' => 0,
			'visits' => 1,
			'ip' => $current_ip,
			'date_create' => $today,
		);


		if ($this->_settings['ref_by_uid'] != $this->_settings['uid']) {
			$data['user_ref'] = $this->_settings['ref_by_uid'];
		}

		if (!empty($refId) && $refId['id']) {

			if ($refId['ip'] != $data['ip']) {
				$data['visits'] = $refId['visits'] + 1;
			}
			//update
			$data['date_update'] = $today;
			$this->d->where('id', $refId['id']);
			$this->d->update('ref', $data);
		} else {
			//inset
			$data['url'] = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$this->d->insert('ref', $data);
		}
	}

	public function getRefBy()
	{
		$item = $this->d->rawQueryOne('select user_id from #_ref where code = ? and pid = 0 limit 0,1', array($this->code));
		if (!empty($item['user_id'])) {
			$this->_settings['ref_by_uid'] = $item['user_id'];
		}
	}

	public function getRefUidByCode()
	{
		return $this->d->rawQueryValue('select user_id from #_ref where code = ? and pid = 0 limit 0,1', array($this->code));
	}

	public function getRefUid()
	{
		return $this->d->rawQueryOne('select * from #_ref where user_id = ? and pid = 0 limit 0,1', array($this->_settings['uid']));
	}

	/**
	 * @return Thông tin người giới thiệu - pip=0
	 */
	public function _getRef()
	{
		return $this->d->rawQueryOne('select * from #_ref where code = ? and pid = 0 limit 0,1', array($this->code));
	}

	/*USER PROCESS*/

	public function getRefInfo($by)
	{


		$sql = <<<SQL
SELECT
    $by
FROM
    #_ref
WHERE
    user_id = ?
SQL;
		$rs = $this->d->rawQueryValue($sql, array($this->_settings['uid']));
		return !empty($rs[0]) ? $rs[0] : 0;
	}

	public function getTotalOrder()
	{

		$sql = <<<SQL
SELECT * 
FROM
    #_ref_order
WHERE
	  uid = ?
SQL;
		$item = $this->d->rawQuery($sql, array(
			$this->_settings['uid'],
		));

		return $item;
	}

	public function getTotalVisits()
	{
		$sql = <<<SQL
SELECT
    SUM(visits) AS TotalVisits
FROM
    #_ref
WHERE
    user_id = ?
SQL;
		$rs = $this->d->rawQueryValue($sql, array(
			///$this->code,//code = ? and
			$this->_settings['uid'],
		));
		return !empty($rs[0]) ? $rs[0] : 0;
	}


	//Non Login / order uid


	public function issetRefOrder($ref_id, $order_id)
	{
		if ($rs = $this->d->rawQueryOne("select id from #_ref_order where ref_id = ? and order_id = ? limit 0,1", array($ref_id, $order_id))) {
			return $rs['id'];
		}
		return false;
	}

	public function _insertRefOrder(&$data, $order_id)
	{
		if (isset($data['code'])) {
			$this->code = $data['code'];
		} else {
			return false;
		}

		$item = $this->_getRef();
		if (isset($item['user_id'])) {
			$this->setUserUid($item['user_id']);
		}

		if ($id = $this->issetRefOrder($item['id'], $order_id)) {
			$data['date_update'] = date("Y-m-d H:i:s");
			$this->d->where('id', $id);
			$this->d->update($this->_table_order, $data);
		} else {
			$data['ref_id'] = $item['id'];
			$data['uid'] = $item['user_id'];
			$this->d->insert($this->_table_order, $data);
		}

		return true;
	}

	public function insertRefOrder($arr_data)
	{
		$this->getAllCode();

		//array(3) { [0]=> string(10) "fckIRi3env" [1]=> string(10) "Fq3N472XIn" [2]=> string(10) "QlJsvECPfM" }

		if (in_array($arr_data['code'], $this->allCode)) {

			$product_list = $arr_data['product_list'];

			$data = $arr_data;
			$data['product_list'] = json_encode($product_list);
			$data['sell'] = 0;
			$data['date_create'] = date("Y-m-d H:i:s");

			$this->_insertRefOrder($data, $arr_data['order_id']);
		}
		return true;
	}

	function issetWallet()
	{
		if ($rs = $this->d->rawQueryOne('select wallet_id  from #_ref_wallet where user_id = ? ', array($this->_settings['uid']))) {
			return $rs['wallet_id'];
		}

		return false;
	}

	public function setUserUid($user_id)
	{
		$this->_settings['uid'] = $user_id;
	}

	public function insertWallet($par)
	{
		if (isset($par['code'])) {
			$this->code = $par['code'];
		} else {
			return false;
		}

		if (empty($par['orderId'])) return false;


		$this->setUserUid($par['uid']);
		$this->getAllCode();


		if (in_array($this->code, $this->allCode)) {

			$this->setWallet();

			$wallet = $this->getWallet();

			$ref_order = $this->getCurrentRevenue($par['orderId']);

			$today = date("Y-m-d H:i:s");

			$data_wallet['user_id'] = $par['uid'];
			$data_wallet['currency'] = 'VNĐ';
			//$data_wallet['balance'] = 0;
			$data_wallet['status'] = 0;

			//process  status
			if ($wallet['wallet_id']) {
				// $old_order_list = (array)json_decode($wallet['order_list']);

				if ($par['tinhtrang'] == 4) {

					//$data_wallet['balance'] = $ref_order['revenue'];

					if ($ref_order['status'] == 1) {
						$data_wallet['balance'] = $wallet['balance'] + $ref_order['revenue'];
						$data_wallet['status'] = 1;
					}

				} else if ($par['tinhtrang'] == 5) {
					if ($ref_order['status'] == 1) {
						$data_wallet['balance'] = $wallet['balance'] - $ref_order['revenue'];
						$data_wallet['status'] = 1;
						//$this->d->rawQuery("update #_ref_order set status = 1 where order_id = ?",array($par['orderId']));
					} else {
						//$data_wallet['balance'] = $wallet['balance'];
					}
				}


				/*     switch ($par['tinhtrang']) {
						 case  4:
							 //$data_wallet['balance'] = $wallet['balance'] + $ref_order['revenue'];
							 break;
						 case  0:
						 case  1:
						 case  2:
						 case  3:
							 //$data_wallet['balance'] = $wallet['balance'];
							 break;
						 case 5:
							 //$data_wallet['balance'] = $wallet['balance'] - $ref_order['revenue'];
							 break;
						 default:
					 }*/

				if ($data_wallet['balance'] < 0) $data_wallet['balance'] = 0;

				$data_wallet['date_update'] = $today;

				$this->d->where('wallet_id', $wallet['wallet_id']);
				$this->d->update('ref_wallet', $data_wallet);
			} else {
				//chưa có Ví
				$data_wallet['balance'] = 0;

				if ($ref_order) {
					if ($ref_order['sell'] == 1 && $par['tinhtrang'] == 4) {
						$data_wallet['balance'] = $ref_order['revenue'];
					}
				}

				$data_wallet['date_create'] = $today;
				$this->d->insert('ref_wallet', $data_wallet);
			}

			//IF: Ví có tiền.
			/* if ($wallet['wallet_id']) {
				 $old_balance = $wallet['balance'];

				 if ($par['tinhtrang'] == 4) {
					 $newData['balance'] = $old_balance + $par['balance'];
				 } else if ($par['tinhtrang'] == 5) {

					 //todo: chỉ trừ tiền hiện tại theo id order


					 $newData['balance'] = $old_balance - $par['balance'];
				 } else {
					 $newData['balance'] = $old_balance;
				 }

			 } else {
				 if ($par['tinhtrang'] == 4) {
					 //todo: chỉ lấy số tiền hiện tại theo id order

				 } else {
					 $data['balance'] = 0;
				 }

				 $data['currency'] = 'VNĐ';
				 $data['user_id'] = $this->_settings['uid'];
				 $data['date_create'] = date("Y-m-d H:i:s");
				 $this->d->insert('ref_wallet', $data);
			 }*/

			return true;
		}
		return false;
	}

	public function setWallet()
	{
		$this->_Wallet = $this->d->rawQueryOne('select * from #_ref_wallet where user_id = ? ', array($this->_settings['uid']));
	}

	public function getWallet()
	{
		return $this->_Wallet;
	}

	public function getMoney()
	{
		return !empty($this->_Wallet['balance']) ? $this->_Wallet['balance'] : 0;
	}

	public function getCurrentRevenue($order_id)
	{
		if ($rs = $this->d->rawQueryOne('
    select * 
    from #_ref_order 
         where order_id = ?
', array($order_id))) {
			return $rs;
		}
		return 0;
	}

	public function getCurrentReceived($amount)
	{
		return $amount - ($this->getVAT() - $this->getCIT());
	}

	function checkValidateAmount($amount)
	{
		return $this->getMoney() < $amount && $amount > 0;
	}


	public function confirmTransfer(&$data)
	{

		/*  if(empty($data['amount'])) {
			  return false;
		  }*/


		if ($this->checkValidateAmount($data['amount'])) {
			$wallet = $this->getWallet();


			$withdrawal_id = $this->checkIssetTransfer($wallet['wallet_id'], '');

			$data['user_id'] = $this->_settings['uid'];
			$data['wallet_id'] = $wallet['wallet_id'];
			$data['withdrawal_data'] = date("Y-m-d H:i:s");
			$data['status'] = 0;
			$data['sender'] = "";
			$data['receiver'] = "";
			$data['transaction_type'] = "";
			$data['transaction_info'] = "";

			if ($withdrawal_id) {
				$this->d->where('withdrawal_id', $withdrawal_id);
				$this->d->update('ref_withdrawal', $data);
			} else {
				$this->d->insert('ref_withdrawal', $data);
			}

			if ($data['status'] == 1) {
				//bat dau tru tien
				//update Wallet
				$this->d->rawQuery('UPDATE #ref_wallet SET balance = balance - ? WHERE user_id = ? and wallet_id = ?', array($data['amount'], $this->_settings['uid'], $wallet['wallet_id']));
			}

			return true;
		}

		return false;
	}

	public function getAllRequestWithDrawal()
	{
		return $this->d->rawQuery('select * from #_ref_withdrawal where user_id = ?', array($this->_settings['uid']));
	}

	public function formatMoney($money)
	{
		return number_format($money??0, 0, '', '.');

	}

	/*    public function getProductInfo($pid){
			return $this->d->rawQueryOne("select * from #_product where id=?", array($pid));
		}*/

	public function setWalletEmpty()
	{

		return false;

		$today = date("Y-m-d H:i:s");
		$data_wallet['user_id'] = $this->_settings['uid'];
		$data_wallet['currency'] = 'VNĐ';
		$data_wallet['balance'] = 0;
		$data_wallet['status'] = 0;

		$data_wallet['date_create'] = $today;
		$this->d->insert('ref_wallet', $data_wallet);
	}

	public function getNewBuyer()
	{

		$sql = 'select count(*) as new from #_ref_order where buyer_uid <> 0 and uid = ?';
		if ($item = $this->d->rawQueryOne($sql, array($this->_settings['uid']))) {
			return $item['new'];
		}
		return 0;
	}

	public function getAllSeller()
	{

		$sql = 'select count(*) as new from #_ref_order where sell = 1 and uid = ' . $this->_settings['uid'];
		if ($item = $this->d->rawQueryOne($sql)) {
			return $item['new'];
		}
		return 0;
	}

	function getAllOrder()
	{
		$sql = 'select count(*) as new from #_ref_order where uid = ' . $this->_settings['uid'];
		if ($item = $this->d->rawQueryOne($sql)) {
			return $item['new'];
		}
		return 0;
	}

	function getAllOrderPending()
	{
		$sql = 'select count(*) as new from #_ref_order r join #_order o on o.id=r.order_id where (o.tinhtrang <> 4 or o.tinhtrang <>5) and sell = 0 and uid = ?';
		if ($item = $this->d->rawQueryOne($sql, array($this->_settings['uid']))) {
			return $item['new'];
		}
		return 0;
	}

	function upgradeLevel()
	{
		$level = $this->getCurrentLevel();
		$money = $this->getTotalSellByUser();

		switch ($level) {
			case 0:
				$lv1 = $this->getLv1();
				if ($money >= $lv1) $this->updateLevel(1);
				break;
			case 1:
				$lv2 = $this->getLv2();
				if ($money >= $lv2) $this->updateLevel(2);
				break;
			case 2:
				$lv3 = $this->getLv3();
				if ($money >= $lv3) $this->updateLevel(3);
				break;
		}

		return $level;
	}

	function updateLevel($level)
	{
		$this->d->where('id', $this->_settings['uid']);
		$this->d->update('member',
			array(
				'level' => $level
			));
	}

	function getCurrentLevel()
	{

		if ($rs = $this->d->rawQueryOne(
			'select 
                level
            from #_member
            where id = ? and ref_nick = 1
             limit 0,1'
			, array($this->_settings['uid']))) {
			return $rs['level'];
		}

		return 0;
	}

	function getTotalSellByUser()
	{
		if ($rs = $this->d->rawQueryOne(
			'select sum(tamtinh) as total from #_order where ref_uid = ? and tinhtrang = 4 limit 0,1'
			, array($this->_settings['uid']))) {
			return $rs['total'];
		}

		return 0;

	}

}

