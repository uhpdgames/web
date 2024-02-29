<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Seo extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$_link = 'https://ckdvietnam.com
		https://ckdvietnam.com/san-pham
https://ckdvietnam.com/san-pham/cham-soc-da
https://ckdvietnam.com/san-pham/chong-nang
https://ckdvietnam.com/san-pham/co-the-toc
https://ckdvietnam.com/san-pham/mat-na
https://ckdvietnam.com/san-pham/lam-sach
https://ckdvietnam.com/san-pham/kem-duong-am-co-loi-cho-da-ngan-ngua-lao-hoa-lacto-derm-50ml
https://ckdvietnam.com/san-pham/tinh-chat-cai-thien-ket-cau-va-tong-mau-da-giam-nhiet-do-da-ckd-retino-collagen-first-essence-tieu-phan-tu-300-150g
https://ckdvietnam.com/san-pham/nuoc-hoa-hong-duong-am-lam-diu-da-kho-lacto-derm-200ml
https://ckdvietnam.com/san-pham/combo-giam-nep-nhan-x2-thanh-lan
https://ckdvietnam.com/san-pham/tinh-chat-da-nang-aqua-hyalon-danh-cho-nam-ckd
https://ckdvietnam.com/san-pham/dau-goi-duong-da-da-dau-amino-biotin-scalp-scaling
https://ckdvietnam.com/san-pham/dau-goi-amino-biotin-protein-cream-shampoo
https://ckdvietnam.com/san-pham/lactoderm-sua-rua-mat-duong-am-co-loi-cho-da-400ml
https://ckdvietnam.com/san-pham/sua-rua-mat-duong-am-co-loi-cho-da-lactoderm
https://ckdvietnam.com/san-pham/kem-chong-nang-lactoderm-daily-sun-co-loi-cho-da
https://ckdvietnam.com/san-pham/kem-chong-nang-nang-tone-chua-tinh-chat-keo-ong-ckd-green-propolis-all-covery-sun-pf-50-40ml
https://ckdvietnam.com/san-pham/kem-chong-nang-chua-tinh-chat-keo-ong-xanh-ckd-green-propolis-all-covery-sun-pf-50-40ml
https://ckdvietnam.com/san-pham/sap-tao-kieu-toc-mo-aqua-hyalon-danh-cho-nam-ckd
https://ckdvietnam.com/san-pham/sua-rua-mat-lam-sach-sau-duong-a-ckd-retino-collagen-150ml
https://ckdvietnam.com/san-pham/mat-na-nang-co-giup-da-dan-hoi-bang-vai-thun-bellasu-v-stretching-12gr-1-mieng
https://ckdvietnam.com/san-pham/mat-na-se-khit-lo-chan-long-duong-am-cho-da-ckd-retino-collagen-tieu-phan-tu-300-1-mieng
https://ckdvietnam.com/san-pham/kem-chong-nhan-co-co-dac-ngua-lao-hoa-va-nep-gap-vung-mat-ckd-retino-collagen-25ml
https://ckdvietnam.com/san-pham/deal-dac-biet-giam-55-hi-mua-set-set-tinh-chat-mo-tham-sang-da-ckd-vita-c-teca-7-days-4gchai
https://ckdvietnam.com/san-pham/mat-na-giay-duong-am-lacto-derm-chiet-xuat-diep-ca-30ml
https://ckdvietnam.com/san-pham/bo-cham-soc-da-toan-dien-limited-xuan-ruc-ro-full-qua-tang-gioi-han-100-hop-duy-nhat-cnc-d
https://ckdvietnam.com/san-pham/deal-dac-biet-giam-5-khi-mua-set-set-tinh-chat-mo-tham-sang-da-ckd-vita-c-teca-7-days
https://ckdvietnam.com/san-pham/mat-na-se-khit-lo-chan-long-duong-am-cho-da-ckd-retino-collagen-tieu-phan-tu-300-hop-5-mien
https://ckdvietnam.com/san-pham/mat-na-giay-chiec-xuat-diep-ca-giup-da-dan-hoi-mem-mai-va-am-muot-lacto-derm-hop-4mieng
https://ckdvietnam.com/san-pham/mat-na-nang-co-giup-da-dan-hoi-bang-vai-thun-bellasu-v-stretching-12gr-hop-3-mieng
https://ckdvietnam.com/san-pham/tinh-chat-mo-tham-sang-da-ckd-vita-c-teca-7-days-4g
https://ckdvietnam.com/san-pham/serum-cai-thien-nep-nhan-tang-do-dan-hoi-trang-sang-da-ckd-collagen-pumping-ampoule-tieu-phan-tu-300-30-ml
https://ckdvietnam.com/san-pham/kem-duong-am-san-chac-da-chong-lao-hoa-da-ckd-retino-collagen-tieu-phan-tu-300-40ml
https://ckdvietnam.com/san-pham/kem-duong-co-bellasu-decollete-50ml
https://ckdvietnam.com/san-pham/kem-duong-dang-thoi-cai-thien-nep-nhan-lam-sang-da-ckd-retino-collagen-tieu-phan-tu-300-10g
https://ckdvietnam.com/san-pham/toner-cap-am-can-bang-do-ph-thu-nho-lo-chan-long-ckd-retino-collagen-tieu-phan-tu-300-250ml
https://ckdvietnam.com/san-pham/mat-na-kem-duong-duong-am-sang-da-bo-sung-duong-chat-ckd-retino-collagen-50ml
https://ckdvietnam.com/san-pham/lactoderm-400ml-sua-duong-am-tho-co-loi-cho-da
https://ckdvietnam.com/san-pham/dau-goi-nhuom-den-nhanh-amino-biotin-plus
https://ckdvietnam.com/san-pham/serum-nang-co-mat-ngan-ngua-lao-hoa-da-ckd-retino-collagen-guasha-tieu-phan-tu-300-400-ml
https://ckdvietnam.com/san-pham/set-tinh-chat-giam-nam-mo-tham-sang-da-vuot-troi-ckd-vita-c-teca-7g-gom-4-cha
https://ckdvietnam.com/san-pham/amino-biotin-all-powerful-treetment
https://ckdvietnam.com/san-pham/lactoderm-beneficial-moisturizing-cream-jumbo
https://ckdvietnam.com/san-pham/kem-lan-co-ckd-ngan-ngua-nep-nhan-cai-thien-nep-nhan-co-retino-collagen-tieu-phan-tu-300-50-ml
https://ckdvietnam.com/san-pham/combo-giam-nep-nhan-tam-biet-mun-va-dom-tham
https://ckdvietnam.com/san-pham/combo-duong-da-giam-nep-nhan
https://ckdvietnam.com/san-pham/combo-cai-thien-nep-nhan-da-can-bong
https://ckdvietnam.com/san-pham/bo-cham-soc-da-toan-dien-limited-tet-doan-vien-full-qua-tang-gioi-han-100-hop-duy-nhat
https://ckdvietnam.com/san-pham/sua-rua-mat-duong-am-chiec-xuat-rau-diep-ca-giam-ba-nhon-lacto-derm-130-ml
https://ckdvietnam.com/san-pham/bo-cham-soc-da-toan-dien-limited-xuan-ruc-ro-full-qua-tang-gioi-han-100-hop-duy-nhat
https://ckdvietnam.com/san-pham/kem-duong-mat-retinal-forex-ckd-health-guasha-eye-cream
https://ckdvietnam.com/san-pham/dau-goi-giam-rung-va-kich-thich-moc-toc-ckd-amino-biotin-500ml
https://ckdvietnam.com/tin-tuc
https://ckdvietnam.com/tin-tuc/cam-nang-ve-da-lao-hoa-sau-25-tuoi
https://ckdvietnam.com/tin-tuc/top-nhung-thuc-pham-dac-quyen-cho-phu-nu-lan-da-dep-tu-nhien-tu-ben-trong
https://ckdvietnam.com/tin-tuc/tay-trang-dung-cach-nhung-loi-can-tranh-de-bao-ve-lan-da-tot-nhat
https://ckdvietnam.com/tin-tuc/bi-quyet-mat-xa-mat-theo-phong-cach-han-quoc-nhung-buoc-don-gian-cho-lan-da-rang-ngoi
https://ckdvietnam.com/tin-tuc/su-ket-hop-hoan-hao-giua-retino-va-collagen-tieu-phan-tu-300-dalton
https://ckdvietnam.com/tin-tuc/cham-soc-da-bang-collagen-loi-ich-va-cach-su-dung-hieu-qua-cho-lan-da-tuoi-tre
https://ckdvietnam.com/tin-tuc/loi-ich-vuot-troi-cua-collagen-trong-cham-soc-da
https://ckdvietnam.com/tin-tuc/mon-qua-tinh-te-danh-tang-nhung-nguoi-lai-do-tham-lang
https://ckdvietnam.com/tin-tuc/collagen-doi-pho-voi-lao-hoa-suc-manh-va-cach-tang-cuong
https://ckdvietnam.com/tin-tuc/cong-dung-tuyet-voi-cua-serum-collagen-trong-lam-dep-da
https://ckdvietnam.com/tin-tuc/cai-thien-suc-khoe-da-voi-serum-collagen-tu-nhien
https://ckdvietnam.com/tin-tuc/uu-diem-cua-serum-collagen-cho-da-kho-va-lao-hoa
https://ckdvietnam.com/tin-tuc/lam-the-nao-de-chon-lua-serum-collagen-phu-hop-cho-da-cua-ban
https://ckdvietnam.com/tin-tuc/bi-quyet-su-dung-serum-collagen-de-cai-thien-do-dan-hoi-cho-da
https://ckdvietnam.com/tin-tuc/kem-duong-da-chong-lao-hoa-bi-quyet-collagen-tu-nhien
https://ckdvietnam.com/tin-tuc/cham-soc-da-mat-dung-cach-bi-quyet-cho-lan-da-khoe-manh-va-rang-ngoi
https://ckdvietnam.com/tin-tuc/collagen-thuy-phan-tu-bi-quyet-cho-lan-da-tuoi-tre-va-suc-khoe-hoan-hao
https://ckdvietnam.com/tin-tuc/ckd-retino-collagen-cuoc-cach-mang-trong-linh-vuc-chong-lao-hoa
https://ckdvietnam.com/tin-tuc/ckd-viet-nam-thuong-hieu-my-pham-hang-dau-han-quoc-da-co-mat-tai-viet-nam
https://ckdvietnam.com/tin-tuc/dieu-ban-quan-tam-den-khi-mua-my-pham-la-gi
https://ckdvietnam.com/tin-tuc/doc-quyen-phan-phoi-my-pham-ckd-tai-viet-nam-blue-pink
https://ckdvietnam.com/tin-tuc/serum-collagen-lan-da-tuoi-tre-voi-su-ket-hop-hoan-hao
https://ckdvietnam.com/tin-tuc/collagen-va-lan-da-bi-mat-loi-ich-va-cach-lam-dep-tu-nhien-hon
https://ckdvietnam.com/tin-tuc/cham-soc-da-o-tuoi-40-top-4-hoat-chat-chong-lao-hoa-dac-biet-cho-phu-nu
https://ckdvietnam.com/tin-tuc/goi-y-mua-kem-cham-soc-da-mat-cho-co-giao-ngay-2011-top-san-pham-doc-dao-va-y-nghia
https://ckdvietnam.com/tin-tuc/lan-da-chay-xe-va-mat-do-dan-hoi-sau-30-bi-quyet-cai-thien-hieu-qua
https://ckdvietnam.com/tin-tuc/lao-hoa-da-5-dau-hieu-can-biet-va-cach-cham-soc-dung-dan
https://ckdvietnam.com/tin-tuc/kham-pha-khi-nao-nen-bat-dau-su-dung-collagen-de-duy-tri-suc-khoe-va-lan-da-tre-trung
https://ckdvietnam.com/tin-tuc/niacinamide-thanh-phan-vang-trong-cham-soc-da
https://ckdvietnam.com/tin-tuc/cap-am-cho-da-kho-bi-quyet-cham-soc-lan-da-mem-min
https://ckdvietnam.com/tin-tuc/serum-tieu-phan-tu-collagen-bi-quyet-cho-lan-da-tre-trung-va-san-chac
https://ckdvietnam.com/tin-tuc/ckd-tu-duoc-pham-den-my-pham-hanh-trinh-phat-trien-da-nganh-cua-mot-thuong-hieu-han-quoc
https://ckdvietnam.com/tin-tuc/retinol-tri-mun-cach-su-dung-loi-ich-san-pham-va-ket-qua
https://ckdvietnam.com/tin-tuc/retinol-chong-lao-hoa-bi-quyet-lam-tre-hoa-da-hieu-qua-va-danh-bai-thoi-gian
https://ckdvietnam.com/tin-tuc/retinol-cho-nep-nhan-cach-su-dung-va-loi-ich-cho-lan-da-tre-trung
https://ckdvietnam.com/tin-tuc/retinol-cho-da-nhay-cam-bi-quyet-lam-dep-an-toan-cho-lan-da-de-kich-ung
https://ckdvietnam.com/tin-tuc/collagen-thuy-phan-tu-cho-lan-da-mem-mai-va-tre-trung
https://ckdvietnam.com/tin-tuc/collagen-han-quoc-suc-manh-tu-nhien-cho-lan-da-san-chac
https://ckdvietnam.com/tin-tuc/collagen-han-quoc-loi-ich-san-pham-hang-dau-va-bi-quyet-lam-dep
https://ckdvietnam.com/tin-tuc/collagen-chong-lao-hoa-lam-dep-da-va-tang-cuong-suc-khoe-voi-san-pham-collagen
https://ckdvietnam.com/tin-tuc/collagen-chong-nep-nhan-loi-ich-cach-su-dung-va-san-pham-phu-hop
https://ckdvietnam.com/tin-tuc/collagen-chong-nep-nhan-bi-quyet-cho-lan-da-tuoi-tre-va-suc-khoe-toan-dien
https://ckdvietnam.com/tin-tuc/tac-dung-phu-cua-retinol-rui-ro-va-cach-giai-quyet-hoan-hao-nhat
https://ckdvietnam.com/tin-tuc/kem-duong-da-chong-lao-hoa-tim-hieu-va-huong-dan-su-dung-hieu-qua-nhat
https://ckdvietnam.com/tin-tuc/cham-soc-da-bang-collagen-bi-quyet-duy-tri-lan-da-tre-trung
https://ckdvietnam.com/tin-tuc/cham-soc-da-nhay-cam-hieu-qua-voi-retinol-huong-dan-day-du
https://ckdvietnam.com/tin-tuc/collagen-chong-lao-hoa-bi-quyet-cho-lan-da-tre-trung-vakhoe-manh
https://ckdvietnam.com/tin-tuc/collagen-chong-nep-nhan-bi-mat-lan-da-tre-trung-va-dan-hoi
https://ckdvietnam.com/tin-tuc/collagen-tu-nhien-bi-quyet-duy-tri-ve-dep-tu-ben-trong
https://ckdvietnam.com/tin-tuc/retinol-cho-nep-nhan-cach-su-dung-va-loi-ich-da
https://ckdvietnam.com/tin-tuc/tac-dung-phu-cua-retinol-loi-khuyen-hieu-qua-cho-cham-soc-da
https://ckdvietnam.com/tin-tuc/serum-collagen-chia-khoa-lan-da-khoe-manh-va-tre-trung
https://ckdvietnam.com/tin-tuc/kham-pha-loi-ich-tuyet-voi-cua-collagen-han-quoc-cho-suc-khoe-va-ve-dep-tu-nhien
https://ckdvietnam.com/tin-tuc/collagen-han-quoc-co-tot-khong
https://ckdvietnam.com/su-kien
https://ckdvietnam.com/su-kien/happy-vietnamese-womens-day-2020-blue-pink-co-gi-hot
https://ckdvietnam.com/su-kien/mua-noel-nam-nay-ban-da-chuan-bi-gi-chua
https://ckdvietnam.com/su-kien/mon-qua-tinh-te-danh-tang-nhung-nguoi-lai-do-tham-lang
https://ckdvietnam.com/su-kien/uu-dai-danh-rieng-khi-ban-dang-ky-thanh-vien-cua-ckd-tang-ngay-voucher-10-cho-don-hang-dau-tien-mua-sam-tai-website-ckdvietnamcom
https://ckdvietnam.com/ho-tro-dat-hang
https://ckdvietnam.com/chinh-sach-tra-hang
https://ckdvietnam.com/chinh-sach-bao-hanh
https://ckdvietnam.com/chinh-sach-ban-hang
https://ckdvietnam.com/chinh-sach-bao-mat-thong-tin
https://ckdvietnam.com/cau-hoi-thuong-gap
https://ckdvietnam.com/bai-viet-thuong-hieu
https://ckdvietnam.com/cau-chuyen-thuong-hieu
https://ckdvietnam.com/loi-hua-c-k-d
https://ckdvietnam.com/gioi-thieu-thuong-hieu
https://ckdvietnam.com/gioi-thieu
https://ckdvietnam.com/lien-he';

		$all_link = explode("\n", $_link) ;

		header("Content-Type: text/xml;charset=iso-8859-1");
		header('Content-type: text/xml');

		//$PAGE = MYSITE;

		$all_page = '';
		foreach ( $all_link as $link ){
			$all_page .= '<url>';
			$all_page .= '<loc>' . $link . '</loc>';
			//$all_page .= '<lastmod>' . date('c', $value['ngaytao']) . '</lastmod>';
			$all_page .= '<changefreq>daily</changefreq>';
			//$all_page .= '<priority>' . $priority . '</priority>';
			$all_page .= '</url>';
		}
		echo <<<html
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
$all_page
</urlset>
html;


	}

}
