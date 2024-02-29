<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends MY_Controller
{
    private $html = '';

    function __construct($config = 'rest')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        parent::__construct($config);
        /*if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }*/

        $this->data['ajax'] = true;
    }

    function saveFB()
    {

        $d = $this->data['d'];

        $id_social = getRequest('id_social');
        $ten = getRequest('ten');

        $row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1", array($ten));

        if (!empty($row['id'])) {

            echo $row['id'];
            exit;
        } else {
            $data['id_social'] = $id_social;
            $maxacnhan = digitalRandom(0, 3, 6);
            $password = digitalRandom(0, 3, 6);
            $email = getRequest('email');

            if ($email == '') {
                #$email = stringRandom(12);
                #$email .= '@gmail.com';
            }
            $data['password'] = md5($password);
            $data['username'] = $ten;
            $data['ten'] = $ten;
            #$data['email'] = $email;
            $data['email'] = '';
            $data['hienthi'] = 1;
            $data['maxacnhan'] = $maxacnhan;
            $id = $d->insert('member', $data);

            echo $id;
            exit;
        }
    }



    function sethasTuiGiay()
    {
        $tui = getRequest('has_tuigiay');
        $this->session->set_userdata('has_tuigiay', $tui);
    }
    function setmodalVocher()
    {
        $sess = getRequest('modalVocher');
        $this->session->set_userdata('modalVocher', $sess);
    }

    function sethasQuaTang()
    {
        $qua = getRequest('has_quatang');
        $id = getRequest('id');
        $img = getRequest('img');


        if (!empty($qua)) {
            $data = $this->session->userdata('has_quatang');
            if (!is_array($data)) $data = array();

            $data[$id] = array(
                'name' => $qua,
                'img' => $img,
            );
            $this->session->set_userdata('has_quatang', $data);
        }

        // $this->session->set_userdata('has_quatang', $qua);
    }

    function checkEmail()
    {
        $email = getRequest('email');
        $d = $this->data['d'];
        $row = $d->rawQueryOne("select id from #_member where email = ? limit 0,1", array($email));
        echo !empty($row['id']) ? 'true' : 'false';
    }

    function checkAccount()
    {
        $username = getRequest('username');
        $d = $this->data['d'];
        $row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1", array($username));
        echo !empty($row['id']) ? 'true' : 'false';
    }

    function Xvoucher()
    {

        $myVoucher = array();
        $myCode = array();

        $allVoucher = getCurrentVoucher();
        if (is_array($allVoucher) && count($allVoucher)) {
            foreach ($allVoucher as $voucher) {
                $tmp = array(
                    'rate' => $voucher['rate'] ?? $voucher['discount_percentage'],
                    //'code' => $voucher['code'],
                    'from' => $voucher['dieukien_from'] ?? "",
                    'to' => $voucher['dieukien_to'] ?? "",
                    'used' => $voucher['used_date'] ?? FALSE,
                );

                $myVoucher[$voucher['code']] = $tmp;
                $myCode[] = $voucher['code'];
            }
        }


        $test = array(
            'code' => $myCode,
            'myvoucher' => $myVoucher,
        );


        //  qq($test);
        return $test;
    }

    function check_voucher()
    {
        $not_sale = getAllProductSale();
        $has_product_sale = false;
        if (
            isset($_SESSION['cart'])
            && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0
        ) {
            foreach ($_SESSION['cart'] as $cart) {
                if (in_array($cart['productid'], $not_sale)) {
                    $has_product_sale = true;
                }
            }
        }



        $code = getRequest('code');
        $uid = getRequest('uid');
        $ship = getRequest('ship');

        $price = getRequest('price');

        $infoCode = $this->Xvoucher();
        $myCode = $infoCode['code'] ?? array();
        $myVoucher = $infoCode['myvoucher'] ?? array();

        $arr = array(
            'id' => 0,
            'case' => 0,
            'msg' => 'Mã giảm giá này không hợp lệ',
            'total' => $price,
            'text_price' => format_money($price),
            'dagiam' => 0,
        );

        if ($has_product_sale && $code != 'FREESHIP') {
            echo @json_encode($arr);
            exit(0);
        }

        if (!in_array($code, $myCode)) {
            echo @json_encode($arr);
            exit(0);
        }

        $no_code_register = $myCode;
        if (empty($no_code_register[count($no_code_register) - 1])) {
            unset($no_code_register[count($no_code_register) - 1]);
        }
        $discount = 0;
        $vouchers = array();
        $d = $this->data['d'];




        $vouchers = $myVoucher[$code] ?? false;
        if ($vouchers === false) {
            echo @json_encode($arr);
            exit(0);
        }

        $discount = $vouchers['rate'];
        $from = $vouchers['from'];
        $to = $vouchers['to'];

        $used_date = $vouchers['used'];

        if (!empty($used_date)) {
            $arr = array(
                'id' => 0,
                'msg' => 'Mã giảm giá này đã được xử dụng!',
                'case' => 2,
            );

            echo @json_encode($arr);
            exit(0);
        }


        $has_discount = false;
        $not_user = false;
        if ($discount > 0 && $code != 'FREESHIP') {
            if (in_array($code, $no_code_register)) {
                //CASE NOT REGISTER
                $not_user = true;
                if ($from < $price) {
                    $price_discount = $price * (100 - $discount) / 100;
                    $dagiam = $price - $price_discount;
                } else {
                    echo @json_encode($arr);
                    exit(0);
                }
            } else {
                //CASE REGISTER

                $price_discount = $price * (100 - $discount) / 100;
                $dagiam = $price - $price_discount;
            }
            $has_discount = true;
        } else {

            if ($code == 'FREESHIP') {
                if ($ship > 0 && $price > 0) {
                    if ($price > 299000) {
                        $price_discount = $price;
                        $dagiam = $ship;
                    } else {
                        $price_discount = $price - 16000;
                        $dagiam = $ship - 16000;
                        if ($dagiam <= 0) $dagiam = 0;
                    }


                    $has_discount = true;
                }
            } else {

                echo @json_encode($arr);
                exit(0);
            }
        }

        if (!$has_discount) {
            $price_discount = $price;
            $dagiam = 0;
        }

        if ($ship && $code != 'FREESHIP') {
            $price_discount += $ship;
            $price += $ship;
        }


        if ($dagiam > 0) {

            $label_text = getLang('text_voucher') . $discount . '%';
            if ($code == 'FREESHIP') {
                $label_text =  getLang('text_voucher') . format_money($dagiam);
            }
            $arr = array(
                'msg' => $label_text,
                'case' => 1,
                'total' => $price_discount,
                'id' => 0,
                'dagiam' => $dagiam,
                'text_price_voucher' => format_money($dagiam),
                'text_price' => format_money($price_discount),
            );

            echo @json_encode($arr);
            exit(0);
        }


        echo @json_encode($arr);
        exit(0);

        return false;
        $rsVoucher = $d->rawQueryOne('select id from #_coupons where uid = ? and code = ?', array($uid, $code));
        if (!empty($rsVoucher)) {
            $arr = array(
                'msg' => getLang('text_voucher') . $vouchers['discount_percentage'] . '%',
                'case' => 1,
                'total' => $price_discount,
                //'text_price_voucher' => format_money($price_temp),
                'id' => $rsVoucher['id'],
                'dagiam' => $dagiam,
                'text_price_voucher' => format_money($dagiam),
                'text_price' => format_money($price_discount),
            );
        } else {
            $arr = array(
                'id' => 0,
                'case' => 0,
                'msg' => 'Mã giảm giá này không hợp lệ',
                'total' => $price,
                'text_price' => format_money($price),
                'dagiam' => 0,
            );
        }

        if (!empty($code) && $price > 0) {

            $case_all = false;
            if ($uid > 0) {
                $my_voucher = $d->rawQueryOne("select id as id_voucher,code as magiamgia,start_date,end_date,discount_amount,discount_percentage,is_one_time_use,is_combinable,used_date from #_coupons where type = ? and uid = ? and deleted = 0 limit 0,1", array('register', $uid));

                if (!empty($my_voucher)) {
                    $vouchers = $my_voucher;
                    $discount = $vouchers['discount_percentage'];
                    $used_date = $vouchers['used_date'];
                }
            } else {
                $case_all = true;
                //case all
                $my_voucher = $d->rawQueryOne('select * from #_coupons_cate where hienthi > ? and code = ? order by stt,id desc', array(0, $code));

                if (!empty($my_voucher)) {
                    $vouchers = $my_voucher;
                    $discount = $vouchers['rate'];

                    $from = $vouchers['dieukien_from'];
                    $to = $vouchers['dieukien_to'];
                    $name = $vouchers['name'];

                    $used_date = false;
                } else {

                    echo @json_encode($arr);
                    exit(0);
                }
            }


            if (!empty($used_date)) {
                $arr = array(
                    'id' => 0,
                    'msg' => 'Mã giảm giá này đã được xử dụng!',
                    'case' => 2,
                );

                echo @json_encode($arr);
                exit(0);
            }
            //198000

            $has_discount = false;
            if ($discount > 0) {
                if ($case_all) {
                    //theo dieu kien
                    /*if($name !='giam-20-per'){

                        if($from > $price && $price < $to){
                            $price_discount = $price * (100 - $discount) / 100;
                            $dagiam = $price - $price_discount;
                        }else{
                            echo @json_encode($arr);
                            exit(0);
                        }
                    }else{
                        $price_discount = $price * (100 - $discount) / 100;
                        $dagiam = $price - $price_discount;
                    }*/

                    if ($from < $price) {
                        $has_discount = true;

                        $price_discount = $price * (100 - $discount) / 100;
                        $dagiam = $price - $price_discount;
                    } else {
                        echo @json_encode($arr);
                        exit(0);
                    }
                } else {
                    $has_discount = true;
                    $price_discount = $price * (100 - $discount) / 100;
                    $dagiam = $price - $price_discount;
                }
            } else {
                echo @json_encode($arr);
                exit(0);
            }

            if (!$has_discount) {
                $price_discount = $price;
                $dagiam = 0;
            }

            if ($ship) {
                $price_discount += $ship;
                $price += $ship;
            }


            if ($case_all) {
                $arr = array(
                    'msg' => getLang('text_voucher') . $vouchers['rate'] . '%',
                    'case' => 1,
                    'total' => $price_discount,
                    'id' => 0,
                    'dagiam' => $dagiam,
                    'text_price_voucher' => format_money($dagiam),
                    'text_price' => format_money($price_discount),
                );

                echo @json_encode($arr);
                exit(0);
            }

            //require_once SHAREDLIBRARIES . 'class/class.EGiftVoucherSystem.php';
            //$Voucher = new EGiftVoucherUser($this->data['d'], $uid);
            //$Voucher->Voucher('register');

            $rsVoucher = $d->rawQueryOne('select id from #_coupons where uid = ? and code = ?', array($uid, $code));
            if (!empty($rsVoucher)) {
                $arr = array(
                    'msg' => getLang('text_voucher') . $vouchers['discount_percentage'] . '%',
                    'case' => 1,
                    'total' => $price_discount,
                    //'text_price_voucher' => format_money($price_temp),
                    'id' => $rsVoucher['id'],
                    'dagiam' => $dagiam,
                    'text_price_voucher' => format_money($dagiam),
                    'text_price' => format_money($price_discount),
                );
            } else {
                $arr = array(
                    'id' => 0,
                    'case' => 0,
                    'msg' => 'Mã giảm giá này không hợp lệ',
                    'total' => $price,
                    'text_price' => format_money($price),
                    'dagiam' => 0,
                );
            }
        }

        echo @json_encode($arr);
        exit(0);
    }

    public function index()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
    }

    public function html()
    {
        $text = array();
        $type = getRequest('type');

        if ($type) {
            $all_html = explode(',', $type);
            if (is_array($all_html) && count($all_html)) {
                foreach ($all_html as $file_html) {

                    $file = $file_html;
                    $int = (int)filter_var($file_html, FILTER_SANITIZE_NUMBER_INT);
                    /*if ($int != '') {
                        $file = 'banner/' . $int;
                    }*/
                    $template = 'common/' . $file;
                    $html = htmlentities(str_replace("\r\n", "", $this->load->view($template, $this->data, true)), ENT_QUOTES, "UTF-8");
                    $text[$file_html] = $html;
                }
            }
        }

        echo json_encode($text);


        return;
        $this->load->view($template . $type, $this->data);
        switch ($type) {
            case 'submenu':
                $this->load->view('common/menu', $this->data);
                break;
            case 'menu':
                $this->load->view('common/menu', $this->data);
                break;
        }
    }

    public function search()
    {
        $lang = $this->current_lang;
        $d = $this->data['d'];
        $sluglang = $this->sluglang;

        $tukhoa = htmlspecialchars($_POST['ten']);
        $tukhoa = str_replace("đ", "d", $tukhoa);
        $tukhoa = str_replace(' ', '%', $tukhoa);
        $where = "";
        $where = "type = ? and (REPLACE(ten$lang, 'đ', 'd') LIKE ? or tenkhongdauvi LIKE ?) and hienthi > 0";

        $params = array("san-pham", "%$tukhoa%", "%$tukhoa%");
        $sql = "select photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id from #_product where $where order by stt,id desc limit 0,30";
        $product = $d->rawQuery($sql, $params);
        foreach ($product as $v) :
?>
<div class="item_sea clear">
    <p class="sp_img"><a href="<?= $v[$sluglang] ?>" title="<?= $v['ten'] ?>">
            <img src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>" alt="<?= $v['ten'] ?>" /></a></p>
    <h3 class="sp_name"><a class="catchuoi2" href="<?= $v[$sluglang] ?>" title="<?= $v['ten'] ?>"><?= $v['ten'] ?></a>
    </h3>
    <?php /*<p class="gia_sp">
        	<span class="giamoi"><?php if($v['giamoi']>0) echo $func->format_money($v['giamoi'])?></span>
    <span
        class="gia <?php if($v['giamoi']>0)echo 'giacu'?>"><?php if($v['giamoi']<=0)echo gia.': '?><?php if($v['gia']>0)echo $func->format_money($v['gia']);else echo lienhe;?></span>
    </p>*/ ?>
</div>

<?php endforeach;
    }

    public function banner()
    {

        //$func = $this->data['func'];
        $d = $this->data['d'];
        $lang = $this->current_lang;
        $m = $this->data['m'];
        $slider = $d->rawQuery("select ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc", array('slide' . $lang . $m));

        $this->html = '<div class="main_bnr_100 swiper-container swiper-container-horizontal">
            <ul class="swiper-wrapper df-bannermanager df-bannermanager-wp-main-bnr" df-banner-code="wp-main-bnr">';

        $full = '';
        if (!$this->data['isMobile']) {
            $full = "style=height:43.75rem;";
        }
        foreach ($slider as $v) {
            $this->html .= '<li class="swiper-slide swiper-slide-duplicate">';
            $this->html .= '<a href="' . $v['link'] . '" title="' . $v['ten'] . '">';
            $this->html .= '<img ' . $full . ' src="' . UPLOAD_PHOTO_L . toWebp($v['photo']) . '"/></a>';
        }

        $this->html .= <<<HTML
            </ul>
            <div class="swiper-pagination swiper-pagination-progressbar">
                <span class="swiper-pagination-progressbar-fill"></span>
            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
</div>
HTML;

        //echo $this->html;

        echo json_encode(
            array(
                'banner' => $this->html,
                //'cate'=>get_slider_cate(),
                //'cate' => $this->cate(),
            )
        );
    }

    protected function cate()
    {
        $func = $this->data['func'];
        $sluglang = $this->sluglang;
        $lang = $this->current_lang;
        $d = $this->data['d'];
        $product_list = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id, photo from #_product_list where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));

        $this->html =
            ' <div class="wap_danhmuc main_fix ">';
        //$dongdau = THUMBS . '/300x300x1/';
        $dongdau = '';

        foreach ($product_list as $k => $v) {
            $this->html .= '<div>';
            $this->html .= '<div class="item_dm">';
            $this->html .= '<p class="img_sp zoom_hinh">';
            $this->html .= '<a href="' . $v[$sluglang] . '" title="' . $v['ten'] . '">';
            $this->html .= '<img class="img-fluid no_lazy" src="' . UPLOAD_PRODUCT_L . toWebp($v['photo']) . '" alt="' . $v['ten'] . '" />';
            $this->html .= '<h2 class="name_sp catchuoi2">' . $v['ten'] . '</h2>';
            $this->html .= '</a>';
            $this->html .= '</p>';
            $this->html .= '</div>';
            $this->html .= '</div>';
        }

        $this->html .= '</div>';

        return $this->html;
    }

    function sanpham()
    {

        $id = getRequest('id');

        $sluglang = $this->sluglang;

        $product = get_prod();
        $banchay = $product['banchay'];
        $noibat = $product['noibat'];
        $moi = $product['moi'];

        $link = 'moi';
        if ($id == 'noibat') {
            $link = 'tot-nhat';
            $noibat_1 = array_slice($noibat, 0, 8);
            $noibat_2 = array_slice($noibat, 8, 8);

            echo get_product_slick($noibat_1, $sluglang, true, '1');
            echo '<br/>';
            //echo get_product_slick($noibat_2, $sluglang, true, '2');

        } else if ($id == 'moi') {
            $moi_1 = array_slice($moi, 0, 8);
            $moi_2 = array_slice($moi, 8, 8);

            echo get_product_slick($moi_1, $sluglang, true, '1');
            echo '<br/>';
            //echo get_product_slick($moi_2, $sluglang, true, '2');
        }

        echo '<p class="xemtatca">';
        echo '<a href="san-pham/' . $link . '">' . getLang('xemthem') . '</a></p>';

        return false;

        //code du bo qua ham nay, tu helper


        $sluglang = $this->sluglang;
        $lang = $this->current_lang;
        $d = $this->data['d'];

        $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';

        if ($id == 'moi') {
            $isWhere = 'moi = 1';
        } else {
            $isWhere = 'noibat = 1';
        }

        $product = $d->rawQuery("select hethang, photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id, type, mota$lang as mota, moi, soluong 
from #_product where type = 'san-pham' and hienthi > 0 and $isWhere order by stt,id desc limit 0,16");
        //and $id > 0
        $link = 'moi';
        if ($id == 'noi-bat') {
            $link = 'tot-nhat';
        }

        echo '<div class="slick4322 control_slick" id="slider_sanpham">';
        echo get_product_slick($product, $sluglang, true);
        echo '</div>';
        echo '<p class="xemtatca">';
        echo '<a href="' . $link . '">' . getLang('xemthem') . '</a></p>';
    }

    function load_them()
    {
        //$func = $this->func;
        $d = $this->data['d'];
        $lang = $this->current_lang;
        $sluglang = $this->sluglang;

        $lan = (int)$_REQUEST['lan'];
        $where = ((string)$_REQUEST['where']);
        if (empty($where)) {
            return false;
        }

        $sql_sp = "hethang, photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id, moi, mota$lang as mota, soluong";
        $sosp = (int)$_REQUEST['sosp'];
        $lan2 = $lan * $sosp;

        if ($product = $d->rawQuery("select $sql_sp from #_product where $where limit $lan2,$sosp")) {
            echo get_product($product, $sluglang);
        }
    }

    function goto_cat()
    {
        $type = getRequest('type');
        $d = $this->data['d'];
        $lang = $this->current_lang;

        if (!empty($type)) {

            $name = $d->rawQueryOne("SELECT tenkhongdau$lang as url from #_product_list where id = ?", array($type));

            if (!empty($name)) {
                echo ($name['url']);
            }
        }
    }

    function loc()
    {
    }

    function updatelang()
    {
        $lang = getRequest('lang');
        $lang_dir = getRequest('lang_dir');

        if (!empty($lang)) {
            $this->session->set_userdata('site_lang', $lang_dir);
            $this->session->set_userdata('lang', $lang);
        }
    }

    function review()
    {
        $lang = $this->current_lang;
        $d = $this->data['d'];
        $id = getRequest('id') ?? 0;
        $danhgia = getRequest('danhgia') ?? false;

        $sosao = getRequest('sosao') ?? 1;
        $review2 = $d->rawQuery("select id,ten$lang as ten, photo from #_news where type = ? and hienthi > 0 order by RAND() limit 0,12", array('review'));


        /*
        $twig = new Twig();
        $twig->render('review_markup',
        [
             'product'=>[
                'link'=>'ssssssssssssssss','icon'=>'1','name'=>'1',
             ],
             'star'=>5,
             'date'=>1,
             'content'=>'dsdsds'
        ]
        );

*/




        if ($danhgia) {
            $review = $d->rawQueryOne("select ngaytao, id,tenvi,motavi, photo, link_video, id_member, ngaytao from #_gallery where id = ? and hienthi > 0 order by ngaytao desc", array($id));
            $get_member = $d->rawQueryOne("select ten from #_member where id='" . $review['id_member'] . "'");

            echo '
		<div class="review_l">
			<img src="' . MYSITE . UPLOAD_PRODUCT_L . ($review['photo']) . '">
		</div>
		<div class="review_r">
			<div class="close_review"><i class="fas fa-times"></i></div>
			<div class="img_p p-0">
				<img class="img-fluid" src="' . MYSITE . UPLOAD_PRODUCT_L . ($review['photo']) . '">
				
				<p class="p-0 m-0">' . htmlspecialchars_decode($get_member['ten'] ?? "") . '
					<span><i class="fas fa-star"></i>' . $sosao . " " . getLang('danhgia') . '</span>
				</p>
				 
			</div>
			<p class="rattot">
			';


            for ($i = 1; $i < 6; $i++) {
                $active = $i < ($sosao + 1) ? 'active' : '';
                echo '<i aria-hidden class="fas fa-star ' . $active . '"></i>';
            }
            echo '
			 
			<a class="text-sm"> ' . getLang('rattot') . '</a>
			 
			</p>
			<div class="noidung">' . strip_tags_content($review['motavi'] ?? "") . '</div>
			<p class="td">' . getLang('danhgiakhac') . '</p>
		
			<div class="hinh_p">
			';
            foreach ($review2 as $k => $v) {
                echo '<img data-id="' . @$v['id'] . '" src="' . UPLOAD_NEWS_L . (@$v['photo']) . '" alt="' . @$v['ten'] . '">';
            }
            echo '
			</div>
				<script>
			$( document ).ready(function() {
				need_close_review();
			})
		</script>';
        } else {
            $review = $d
                ->rawQueryOne(
                    "select ngaytao, ten$lang as ten, tenkhongdauvi, tenkhongdauen, id, photo,icon, type, mota$lang as mota, noidung$lang as noidung, options2 
from #_news where type = ? and id= ? order by ngaytao desc limit 0,1",
                    array('review', $id)
                );

            $opt_rev = (isset($review['options2']) && $review['options2'] != '') ? json_decode($review['options2'], true) : null;

            $sosao = $opt_rev['sosao'] ?? 5;
            if ($sosao == '') {
                $sosao = 5;
            }
            //$opt_rev['thoigian'] = date('d-m-Y', $review['ngaytao']);

            $review2 = $d->rawQuery("select id,ten$lang as ten, photo from #_news where type = ? and hienthi > 0 order by RAND() limit 0,12", array('review'));

            $text_sosao = '';
            for ($i = 1; $i < 6; $i++) {
                $active = $i < ($sosao + 1) ? 'active' : '';
                $text_sosao .= '<i aria-hidden class="fas fa-star ' . $active . '"></i>';
            }


            echo '
		<div class="review_l">
			<img src="' . UPLOAD_NEWS_L . ($review['photo']) . '" alt="' . $review['ten'] . '">
		</div>
		<div class="review_r">
			<div class="close_review"><i class="fas fa-times"></i></div>
			<div class="img_p">
				<img src="' . UPLOAD_NEWS_L . ($review['icon']) . '" alt="' . $review['ten'] . '">
				<p>' . $review['ten'] . '
					<span><i class="fas fa-star"></i>' . $sosao . " " . getLang('danhgia') . '</span>
				</p>
				
					
			</div>
			<div class="rattot">
			
				<ul class="rating-score" data-rating="' . $sosao . '">
				  ' . $text_sosao . '
				</ul>
				
		
			 
			 
			 <a class="text-sm"> ' . getLang('rattot') . '</a><span>' . $opt_rev['thoigian'] . '</span>
			 
			 </div>
			 
			<div class="noidung">' . strip_tags_content($review['noidung'] ?? "") . '</div>
			<p class="td">' . getLang('danhgiakhac') . '</p>
			<div class="hinh_p">
				';
            foreach ($review2 as $k => $v) {
                echo '<img data-id="' . $v['id'] . '" src="' . UPLOAD_NEWS_L . ($v['photo']) . '" alt="' . $v['ten'] . '">';
            }
            echo '
			</div>
		</div>
		<script>
			$( document ).ready(function() {
				need_close_review();
        



			})
		</script>';
        }
    }

    function product_details()
    {

        $func = $this->data['func'];
        $id_mau = getRequest('pid');
        $key = getRequest('key');

        switch ($key) {
            case 'chitiet':
                #echo $func->getContentProduct($id_mau, $this->current_lang);
                break;
            case 'binhluan':
                echo $func->getCommentProduct($id_mau, $this->current_lang);
                break;
            case 'sanphamcungloai':

                break;
            default:
        }
    }

    function tinhgia()
    {

        $gia = (isset($_POST['gia']) && $_POST['gia'] > 0) ? htmlspecialchars($_POST['gia']) : 0;
        $sl = (isset($_POST['sl']) && $_POST['sl'] > 0) ? htmlspecialchars($_POST['sl']) : 0;
        echo format_money($gia * $sl);
    }

    function updateNewPrice()
    {
        $price = 0;
        //temp: temp, ship: ship, voucher:voucher
        $temp = getRequest('temp');
        $ship = getRequest('ship');
        $voucher = getRequest('voucher');


        if ($temp > 0) {
            $price = $temp;
        }

        if ($ship > 0) {
            //	$price +=$ship;
        }

        if ($voucher > 0) {
            $price -= $voucher;
        }

        echo format_money($price);
    }

    function ajax_cart()
    {
        $uid = getRequest('uid');
        $discount = 0;
        $vouchers = array();

        $d = $this->data['d'];

        if (!empty($uid)) {
            $my_voucher = $d->rawQueryOne(
                "select 
    id as id_voucher, code as magiamgia,
    start_date, end_date,
    discount_amount, discount_percentage, is_one_time_use, is_combinable, used_date 
from #_coupons where type = ? and uid = ? and deleted = 0 limit 0,1",
                array('register', $uid)
            );

            if (!empty($my_voucher)) {
                $vouchers = $my_voucher;
                $discount = $vouchers['discount_percentage'];
            }
        }


        $dagiam = 0;
        $text_dagiam = '';

        $func = $this->data['func'];

        $config = $this->data['config'];
        $cart = new Cart($d);

        $sluglang = $this->data['sluglang'];
        $lang = $this->current_lang;

        $api = new API();
        $cmd = getRequest('cmd');
        $id = getRequest('id');
        $mau = getRequest('mau');
        $size = getRequest('size');
        $quantity = getRequest('quantity');
        $code = getRequest('code');
        $ship = getRequest('ship');
        $id_city = getRequest('id_city');
        $id_district = getRequest('id_district');
        //$id_wards = getRequest('id_wards');

        // $has_add_voucher = getRequest('giadagiam');
        $has_add_voucher = false;



        if ($cmd == 'add-cart' && $id > 0) {
            $cart->addtocart($quantity, $id, $mau, $size);
            $max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
            $data = array('max' => $max);

            echo json_encode($data);
        } else if ($cmd == 'update-cart' && $id > 0 && $code != '') {


            if (isset($_SESSION['cart'])) {
                $max = count($_SESSION['cart']);
                for ($i = 0; $i < $max; $i++) {
                    if ($code == $_SESSION['cart'][$i]['code']) {
                        if ($quantity) $_SESSION['cart'][$i]['qty'] = $quantity;
                        break;
                    }
                }
            }

            $proinfo = $cart->get_product_info($id);

            $gia = $func->format_money($proinfo['gia'] * $quantity);
            $giamoi = $func->format_money($proinfo['giamoi'] * $quantity);

            $temp = $cart->get_order_total();
            $tempText = $func->format_money($temp);

            $total = $cart->get_order_total();


            if ($has_add_voucher != 0) {
                $price_discount = $total * (100 - $discount) / 100;
                $dagiam = $total - $price_discount;
                $text_dagiam = $func->format_money($dagiam);
                $total = $price_discount;
            }

            $temp_str = html_gifts($total);
            $mygift = htmlentities(str_replace("\r\n", "", $temp_str), ENT_QUOTES, "UTF-8");

            if ($ship) $total += $ship;

            $totalText = $func->format_money($total);
            $data = array('html_gitfs' => $mygift, 'text_dagiam' => $text_dagiam, 'giadagiam' => $dagiam, 'gia' => $gia, 'giamoi' => $giamoi, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText);

            echo json_encode($data);
        } else if ($cmd == 'delete-cart' && $code != '') {
            $cart->remove_product($code);
            $max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
            $temp = $cart->get_order_total();
            $tempText = $func->format_money($temp);
            $total = $cart->get_order_total();

            if ($has_add_voucher != 0) {
                $price_discount = $total * (100 - $discount) / 100;
                $dagiam = $total - $price_discount;
                $text_dagiam = $func->format_money($dagiam);
                $total = $price_discount;
            }

            $temp_str = html_gifts($total);
            $mygift = htmlentities(str_replace("\r\n", "", $temp_str), ENT_QUOTES, "UTF-8");

            if ($ship) $total += $ship;
            $totalText = $func->format_money($total);

            /*   if (mySetting('is_gift')) {

            } else {
                $mygift = '';
            }
		*/
            $data = array('html_gitfs' => $mygift, 'text_dagiam' => $text_dagiam, 'giadagiam' => $dagiam, 'max' => $max, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText);

            echo json_encode($data);
        } else if ($cmd == 'ship-cart') {
            $shipData = array();
            $shipPrice = 0;
            $shipText = '0đ';
            $total = 0;
            $totalText = '';
            $trongluong = $cart->get_order_weight();
            $data_key = $config['data_key'];

            $city = $d->rawQueryOne('select province_id from #_city where id=?', array($id_city));
            $district = $d->rawQueryOne('select district_id from #_district where id=?', array($id_district));

            $shop = $config['shop'];
            $data['PRODUCT_WEIGHT'] = $trongluong;
            $data['PRODUCT_PRICE'] = $cart->get_order_total();
            $data['MONEY_COLLECTION'] = $cart->get_order_total();
            $data['SENDER_PROVINCE'] = $shop['province_shop'];
            $data['SENDER_DISTRICT'] = $shop['district_shop'];
            $data['RECEIVER_PROVINCE'] = $city['province_id'];
            $data['RECEIVER_DISTRICT'] = $district['district_id'];
            $data['PRODUCT_TYPE'] = 'HH';
            $data['TYPE'] = 1;

            $result = $api->MainShip(11, $data, $data_key);

            $ship = json_decode($result, true);
            //usort($ship, fn($a, $b) => $a['GIA_CUOC'] <=> $b['GIA_CUOC']);
            if (empty($ship)) $shipData = array();
            else $shipData = $ship[0];
            $total = $cart->get_order_total();

            if ($has_add_voucher != 0) {
                $price_discount = $total * (100 - $discount) / 100;
                $dagiam = $total - $price_discount;
                $text_dagiam = $func->format_money($dagiam);
                $total = $price_discount;
            }

            $temp_str = html_gifts($total);
            $mygift = htmlentities(str_replace("\r\n", "", $temp_str), ENT_QUOTES, "UTF-8");

            if (isset($shipData['GIA_CUOC']) && $shipData['GIA_CUOC'] > 0) {
                $total += $shipData['GIA_CUOC'];
                $shipText = $func->format_money($shipData['GIA_CUOC']);
            }
            $totalText = $func->format_money($total);
            $shipPrice = (isset($shipData['GIA_CUOC'])) ? $shipData['GIA_CUOC'] : 0;
            $data = array('html_gitfs' => $mygift, 'text_dagiam' => $text_dagiam, 'giadagiam' => $dagiam, 'shipText' => $shipText, 'ship' => $shipPrice, 'totalText' => $totalText, 'total' => $total, 'ship_code' => $shipData['MA_DV_CHINH']);

            echo json_encode($data);
        } else if ($cmd == 'popup-cart') { ?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="wrap-cart">
        <div class="top-cart">
            <div class="list-procart">
                <div class="procart procart-label d-flex align-items-start justify-content-between">
                    <div class="pic-procart"><?= getLang('hinhanh') ?></div>
                    <div class="info-procart"><?= getLang('tensanpham') ?></div>
                    <div class="quantity-procart">
                        <p><?= getLang('soluong') ?></p>
                        <p><?= getLang('thanhtien') ?></p>
                    </div>
                    <div class="price-procart"><?= getLang('thanhtien') ?></div>
                </div>
                <?php if (isset($_SESSION['cart'])) {
                                $total_price = 0;
                                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                                    $pid = $_SESSION['cart'][$i]['productid'];
                                    $quantity = $_SESSION['cart'][$i]['qty'];
                                    $mau = ($_SESSION['cart'][$i]['mau']) ? $_SESSION['cart'][$i]['mau'] : 0;
                                    $size = ($_SESSION['cart'][$i]['size']) ? $_SESSION['cart'][$i]['size'] : 0;
                                    $code = ($_SESSION['cart'][$i]['code']) ? $_SESSION['cart'][$i]['code'] : "";
                                    $proinfo = $cart->get_product_info($pid);
                                    $pro_price = $proinfo['gia'];
                                    $pro_price_new = $proinfo['giamoi'];
                                    $pro_price_qty = $pro_price * $quantity;
                                    $pro_price_new_qty = $pro_price_new * $quantity;

                            ?>
                <div class="procart procart-<?= $code ?> d-flex align-items-start justify-content-between">
                    <div class="pic-procart">
                        <a class="text-decoration-none" href="<?= $proinfo[$sluglang] ?>" target="_blank"
                            title="<?= $proinfo['ten' . $lang] ?>"><img
                                src="<?= UPLOAD_PRODUCT_L . toWebp($proinfo['photo']) ?>"
                                alt="<?= $proinfo['ten' . $lang] ?>"></a>
                        <a class="del-procart text-decoration-none" data-code="<?= $code ?>">
                            <i class="fa fa-times-circle"></i>
                            <span><?= getLang('xoa') ?></span>
                        </a>
                    </div>
                    <div class="info-procart">
                        <h3 class="name-procart"><a class="text-decoration-none" href="<?= $proinfo[$sluglang] ?>"
                                target="_blank"
                                title="<?= $proinfo['ten' . $lang] ?>"><?= $proinfo['ten' . $lang] ?></a>
                        </h3>
                        <div class="properties-procart">
                            <?php if ($mau) {
                                                    $maudetail = $d->rawQueryOne("select ten$lang from #_product_mau where type = ? and id = ? limit 0,1", array($proinfo['type'], $mau)); ?>
                            <p>Màu: <strong><?= $maudetail['ten' . $lang] ?></strong></p>
                            <?php } ?>
                            <?php if ($size) {
                                                    $sizedetail = $d->rawQueryOne("select ten$lang from #_product_size where type = ? and id = ? limit 0,1", array($proinfo['type'], $size)); ?>
                            <p>Size: <strong><?= $sizedetail['ten' . $lang] ?></strong></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="quantity-procart">
                        <div class="price-procart price-procart-rp">
                            <?php if ($proinfo['giamoi']) { ?>
                            <p class="price-new-cart load-price-new-<?= $code ?>">
                                <?= $func->format_money($pro_price_new_qty) ?>
                            </p>
                            <p class="price-old-cart load-price-<?= $code ?>">
                                <?= $func->format_money($pro_price_qty) ?>
                            </p>
                            <?php } else { ?>
                            <p class="price-new-cart load-price-<?= $code ?>">
                                <?= $func->format_money($pro_price_qty) ?>
                            </p>
                            <?php } ?>
                        </div>
                        <div
                            class="quantity-counter-procart quantity-counter-procart-<?= $code ?> d-flex align-items-stretch justify-content-between">
                            <span class="counter-procart-minus counter-procart">-</span>
                            <input type="number" class="quantity-procat" min="1" value="<?= $quantity ?>"
                                data-pid="<?= $pid ?>" data-code="<?= $code ?>" />
                            <span class="counter-procart-plus counter-procart">+</span>
                        </div>
                        <div class="pic-procart pic-procart-rp">
                            <a class="text-decoration-none" href="<?= $proinfo[$sluglang] ?>" target="_blank"
                                title="<?= $proinfo['ten' . $lang] ?>"><img
                                    src="<?= UPLOAD_PRODUCT_L . toWebp($proinfo['photo']) ?>"
                                    alt="<?= $proinfo['ten' . $lang] ?>"></a>
                            <a class="del-procart text-decoration-none" data-code="<?= $code ?>">
                                <i class="fa fa-times-circle"></i>
                                <span><?= getLang('xoa') ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="price-procart">
                        <?php if ($proinfo['giamoi']) { ?>
                        <p class="price-new-cart load-price-new-<?= $code ?>">
                            <?= format_money($pro_price_new_qty) ?>
                        </p>
                        <p class="price-old-cart load-price-<?= $code ?>">
                            <?= format_money($pro_price_qty) ?>
                        </p>
                        <?php } else { ?>
                        <p class="price-new-cart load-price-<?= $code ?>">
                            <?= format_money($pro_price_qty) ?>
                        </p>
                        <?php } ?>
                    </div>
                </div>
                <?php }
                            } ?>
                <div id="my-gifts">
                    <?= html_gifts($cart->get_order_total()) ?>
                </div>
            </div>
            <div class="money-procart">
                <div class="total-procart d-flex align-items-center justify-content-between">
                    <p><?= getLang('tamtinh') ?>:</p>
                    <p class="total-price load-price-temp"><?= $func->format_money($cart->get_order_total()) ?></p>
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-between">
                <a href="san-pham" class="buymore-cart text-decoration-none" title="<?= getLang('tieptucmuahang') ?>">

                    <span><?= getLang('tieptucmuahang') ?></span>
                </a>
                <a class="btn-cart btn btn-primary" href="gio-hang"
                    title="<?= getLang('thanhtoan') ?>"><?= getLang('thanhtoan') ?></a>
            </div>
        </div>
    </div>
</form>

<script>
NN_FRAMEWORK.Cart();
</script>
<?php } ?>

<?php

    }

    function ajax_district()
    {
        $id_city = (isset($_POST['id_city']) && $_POST['id_city'] > 0) ? htmlspecialchars($_POST['id_city']) : 0;
        $district = null;
        if ($id_city) $district = $this->data['d']->rawQuery("select ten, id from #_district where id_city = ? order by id asc", array($id_city));

        if ($district) { ?>
<option value=""><?= getLang('quanhuyen') ?></option>
<?php for ($i = 0; $i < count($district); $i++) { ?>
<option value="<?= $district[$i]['id'] ?>"><?= $district[$i]['ten'] ?></option>
<?php }
        } else { ?>
<option value=""><?= getLang('quanhuyen') ?></option>
<?php }
    }

    function ajax_wards()
    {
        $id_district = (isset($_POST['id_district']) && $_POST['id_district'] > 0) ? htmlspecialchars($_POST['id_district']) : 0;
        $wards = null;
        if ($id_district) $wards = $this->data['d']->rawQuery("select ten, id from #_wards where id_district = ? order by id asc", array($id_district));

        if ($wards) { ?>
<option value=""><?= getLang('phuongxa') ?></option>
<?php for ($i = 0; $i < count($wards); $i++) { ?>
<option value="<?= $wards[$i]['id'] ?>"><?= $wards[$i]['ten'] ?></option>
<?php }
        } else { ?>
<option value=""><?= getLang('phuongxa') ?></option>
<?php }
    }
}