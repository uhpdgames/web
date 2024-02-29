<?php
class OnePayPayment
{

    //private $SECURE_SECRET = "6D0870CDE5F24F34F3915FB0045120D6";
    private $SECURE_SECRET = "6D0870CDE5F24F34F3915FB0045120DB";
    public $vpcURL;
    //public $AccessCode = '6BEB2566';
    public $AccessCode = '6BEB2546';
    // public $Merchant = 'TESTONEPAY32';
    public $Merchant = 'TESTONEPAY';
    private $md5HashData = "";
    private $_url_return = 'https://ckdvietnam.com/onepay_callback';


    function __construct()
    {

        $end_point_test = 'https://mtf.onepay.vn/paygate/vpcpay.op';
        $end_point_prod = 'https://onepay.vn/paygate/vpcpay.op';



        $this->vpcURL = $end_point_test . '?';


        /*

        <_POST>
array(18) {
  ["price-temp"]=>
  string(6) "594150"
  ["price-ship"]=>
  string(5) "38001"
  ["ship_code"]=>
  string(4) "LCOD"
  ["price-total"]=>
  string(6) "594150"
  ["payments"]=>
  string(3) "634"
  ["ten"]=>
  string(9) "free-ship"
  ["dienthoai"]=>
  string(10) "0961078996"
  ["email"]=>
  string(20) "kenji.vn14@gmail.com"
  ["city"]=>
  string(2) "18"
  ["district"]=>
  string(3) "102"
  ["wards"]=>
  string(4) "3741"
  ["diachi"]=>
  string(5) "34234"
  ["yeucaukhac"]=>
  string(9) "324324234"
  ["magiamgia"]=>
  string(7) " 324234"
  ["coupon_id"]=>
  string(1) "0"
  ["giadagiam"]=>
  string(1) "0"
  ["thanhtoan"]=>
  string(11) "Thanh toán"
  ["uid"]=>
  string(1) "0"
}
<_SESSION>
array(8) {
  ["__ci_last_regenerate"]=>
  int(1709009844)
  ["LoginMember"]=>
  array(0) {
  }
  ["lang"]=>
  string(2) "vi"
  ["site_lang"]=>
  string(10) "vietnamese"
  ["modalVocher"]=>
  string(1) "1"
  ["ref_code"]=>
  NULL
  ["ref_uid"]=>
  NULL
  ["cart"]=>
  array(1) {
    [0]=>
    array(5) {
      ["productid"]=>
      string(3) "247"
      ["qty"]=>
      string(1) "1"
      ["mau"]=>
      string(1) "0"
      ["size"]=>
      string(1) "0"
      ["code"]=>
      string(32) "a7a0da96b4c16537050114ceed8368c9"
    }
  }
}

        */
    }


    function createLink(&$data)
    {
        $appendAmp = 0;

        $data['vpc_Merchant'] = $this->Merchant;
        $data['vpc_Command'] = 'pay';
        $data['vpc_Locale'] = 'vn';
        $data['Title'] = 'CKD Viet Nam';

        $data['vpc_AccessCode'] = $this->AccessCode;
        $data['AgainLink'] = ($this->_url_return);
        $data['vpc_ReturnURL'] = ($this->_url_return);
        $data['vpc_Version'] = '2';

        ksort($data);

        foreach ($data as $key => $value) {

            // create the md5 input and URL leaving out any fields that have no value
            if (strlen($value) > 0) {

                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $this->vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $this->vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$this->md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
                if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $this->md5HashData .= $key . "=" . $value . "&";
                }
            }
        }

        $this->md5HashData = rtrim($this->md5HashData, "&");

        if (strlen($this->SECURE_SECRET) > 0) {
            //$this->vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($this->md5HashData));
            // Thay hàm mã hóa dữ liệu
            $this->vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $this->md5HashData, pack('H*', $this->SECURE_SECRET)));
        }
    }
    function getURL()
    {
        return  $this->vpcURL;
    }

    //https://mtf.onepay.vn/paygate/vpcpay.op?AVS_City=%C4%90%C3%A0+N%E1%BA%B5ng&AVS_PostCode=700000&AVS_Street01=ho+chi+minh&vpc_Amount=68875000&vpc_Customer_Email=kenji.vn14%40gmail.com&vpc_Customer_Id=1709019949&vpc_Customer_Phone=0961078996&vpc_MerchTxnRef=1709019949&vpc_OrderInfo=Q04XMA&vpc_SHIP_City=%C4%90%C3%A0+N%E1%BA%B5ng&vpc_SHIP_Street01=ho+chi+minh&vpc_TicketNo=222.255.206.168&vpc_Merchant=TESTONEPAY&vpc_Command=pay&vpc_Locale=vn&Title=CKD+Viet+Nam&vpc_AccessCode=6BEB2546&AgainLink=https%3A%2F%2Fckdvietnam.com%2Fonepay_callback&vpc_ReturnURL=https%3A%2F%2Fckdvietnam.com%2Fonepay_callback&vpc_Version=2&vpc_SecureHash=6873BDE2B1DABB10F70FF163A7A533BD4D27A0F3C75B675F46E8166572851D76
    //zzzstring(719) "https://mtf.onepay.vn/vpcpay/vpcpay.op?AVS_City=Hanoi&AVS_PostCode=10000&AVS_StateProv=Hoan+Kiem&AVS_Street01=194+Tran+Quang+Khai&AgainLink=http%253A%252F%252Flocalhost%252F&Title=VPC+3-Party&vpc_AccessCode=6BEB2546&vpc_Amount=1000000&vpc_Command=pay&vpc_Customer_Email=support%40onepay.vn&vpc_Customer_Id=thanhvt&vpc_Customer_Phone=840904280949&vpc_Locale=vn&vpc_MerchTxnRef=202402271328331539723987&vpc_Merchant=TESTONEPAY&vpc_OrderInfo=JSECURETEST01&vpc_ReturnURL=http%3A%2F%2Flocalhost%2Fdr.php&vpc_SHIP_City=Ha+Noi&vpc_SHIP_Country=Viet+Nam&vpc_SHIP_Provice=Hoan+Kiem&vpc_SHIP_Street01=39A+Ngo+Quyen&vpc_TicketNo=%3A%3A1&vpc_Version=2&vpc_SecureHash=585E85BDC566AEEC464740411F1899CD4674A6A49DF42B15E10DADEA68F5B17B"
}
