<?php

$allVoucher = getCurrentVoucher();
$not_sale = getAllProductSale();


$has_voucher = !in_array($row_detail['id']??0, $not_sale);

$has_product_sale = false;
if(isset($_SESSION['cart'])
&& is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0
){
	foreach ($_SESSION['cart'] as $cart){
		if(in_array($cart['productid'], $not_sale)){
			$has_product_sale = true;
		}
	}
}
if($has_product_sale){
	foreach ($allVoucher as $key => $item){
		if($item['name'] !='free-ship'){
			unset($allVoucher[$key]);
		}
	}
}

if($has_voucher && is_array($allVoucher) && count($allVoucher) > 0):
?>

<div id="testing-vouchers" class="product-fixed-vouchers">
	<div class="fixed-vouchers-box">
		<div class="fixed-vouchers-heading">
			<h3 class="fixed-vouchers-title">Ưu Đãi Voucher Tháng <?=date('m', time());?></h3>
		</div>
		<ul class="fixed-vouchers-list">
			<?php
			foreach ($allVoucher as $voucher):
                if($voucher['name'] == 'register') continue;
                if($voucher['name'] == 'free-ship') continue;

                $from = '<span style="font-size: 1rem;color: var(--color-main);font-weight: 700;">' . format_money($voucher['dieukien_from']) . '</span>';
                $to = '<span style="font-size: 1rem;color: var(--color-main);font-weight: 700;">' . format_money($voucher['dieukien_to']) . '</span>';

				$text = "<p>Nhập mã <strong class='color-main'>{$voucher['code']} giảm {$voucher['rate']}%</strong> giá trị đơn hàng ";

          		 /*if(@$voucher['name'] =='giam-20-per'){
                    $text .= "từ {$from} <span style='font-size: 1rem;color: var(--color-main);font-weight: 700;'>trở lên</span>";
                }else{
                    $text .= "từ {$from} đến {$to} ";
                }
          		 */

				$text .= "từ {$from} <span style='font-size: 1rem;color: var(--color-main);font-weight: 700;'></span>";

				//$text .= "Nhận ngay <strong class='color-main'>mã giảm giá 10%</strong> khi bạn đăng ký là thành viên của CKD";
                $text .= ' </p>';

				//if($voucher['code'] == 'register'){

				//}
			?>
			<li class="fixed-voucher">
				<p><?=$text?></p>
			</li>
			<?php endforeach; ?>
			<li class="fixed-voucher">
				<p>Hỗ trợ phí ship <strong class='color-main'>16.000 đồng</strong> cho đơn hàng dưới <span style='font-size: 1rem;color: var(--color-main);font-weight: 700;'>299.000đ</span></p>
				<p>Miễn phí ship cho đơn hàng từ <span style='font-size: 1rem;color: var(--color-main);font-weight: 700;'>299.000đ</span></p>
			</li>
			<li class="fixed-voucher">
				<p>Nhận ngay <strong class='color-main'>mã giảm giá 10%</strong> khi bạn đăng ký là thành viên</p>
			</li>
		</ul>
		<p></p>
		<p class="fixed-vouchers-box__footer">- Voucher áp dụng khi mua hàng tại website</p>
	</div>


	<div class="fixed-vouchers-footer">
		<div class="fixed-vouchers-footer-heading">
			<h3 class="fixed-vouchers-footer-title">Các mã giảm giá có thể sử dụng:</h3>
		</div>
		<div class="voucher-container">
		<ul class="fixed-vouchers-footer-list">

			<?php
			foreach ($allVoucher as $voucher):
				$code = $voucher['code']?? "";
				if($code == 'register' || $code=="") continue;

                if($voucher['name'] == 'register') {
                    $to = $from = '';
                }else{
                    $from = '<span style="font-size: 1rem;color: var(--color-main);font-weight: 700;">' . format_money($voucher['dieukien_from']) . '</span>';
                    $to = '<span style="font-size: 1rem;color: var(--color-main);font-weight: 700;">' . format_money($voucher['dieukien_to']) . '</span>';
                }



                $rate = $voucher['rate']?? "10";

                $text_rate = "<span class='px-2'>Giảm {$rate}% giá trị đơn hàng <br/>";

            if($voucher['name'] != 'register') {
                if(@$voucher['name'] =='giam-20-per'){
                    $text_rate .= "từ {$from} <span style='font-size: 1rem;color: var(--color-main);font-weight: 700;'>trở lên</span>";
                }else{
                    $text_rate .= "từ {$from} đến {$to} ";
                }
            }

			if($voucher['name'] == 'free-ship') {
				$text_rate = "<span class='px-2 ' style='font-size: 1rem;color: var(--color-main);font-weight: 700;'>Miễn phí ship cho đơn hàng từ 299.000đ<br/>";
 			}


                $text_rate .= '</span>';

				$text_code = "<p class='m-0 p-0'>Nhập mã <strong class='color-main'>{$code}</strong></p>";

				$text_counter = "<p>Lượt đã sử dụng ( <span class='used-counter' id='counter2'>{$rate}</span> ) </p>";
			?>
			<li class="fixed-voucher">
				<a href="javascript:void(0)" onclick="them_magiamgia(this)"
                   data-code="<?= @$code ?? '' ?>" class="voucher-copy-btn" data-voucher="<?=$code?>"><?=$code?></a>
				<div class="fixed-voucher-infobox">
					<?=$text_code?>
					<?=$text_rate?>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<style>
	:root{
		--color-bg: #f0b3b3;
	}
	.product-fixed-vouchers{
		padding-bottom: 20px;
	}
	.fixed-vouchers-box {
		border: 2px solid var(--color-bg);
		padding-bottom: 15px;
	}

	.fixed-vouchers-heading {
		background:  var(--color-bg);
		margin-bottom: 15px;
		padding: 2px 0;
	}

	.fixed-vouchers-heading .fixed-vouchers-title {
		margin: 0 !important;
		color: #fff;
		text-transform: uppercase!important;
		font-weight: 700;
		text-align: center;
		font-size: 18px;
		padding:5px 10px;
	}

	.color-main{
		color:var(--color-red);
	}
	.fixed-voucher p {
		margin-bottom: 10px;
		font-size: 14px;
	}

	ul.fixed-vouchers-list {
		padding: 0 15px;
	}

	.fixed-vouchers-box__footer {
		font-size: 14px;
		font-weight: 700;
		padding: 0 15px;
	}

	.fixed-vouchers-footer-list {
		display: flex;
		flex-wrap: wrap;
		gap: 10px 20px;
		padding-bottom: 20px;
		width: max-content;
	}

	.fixed-vouchers-footer-list .fixed-voucher {
		flex-shrink: 0;
		border-top: 4px solid var(--color-red);
		background: var(--color-bg);
		position: relative;
	}
	.fixed-vouchers-footer-list .fixed-voucher .voucher-copy-btn {
		background: transparent;
		margin: 0;
		color: #fff;
		font-size: 16px;
		font-weight: 700;
		line-height: 1.5;
		padding: 2px 10px;
		cursor: pointer;
		border: 0;
	}

	.fixed-vouchers-footer-list .fixed-voucher::after {
		position: absolute;
		content: '';
		top: 50%;
		right: -1px;
		border: 1px solid transparent;
		border-left: 0;
		width: 5px;
		height: 10px;
		background-color: #fff;
		border-radius: 0 100% 100% 0 / 0 50% 50% 0;
		transform: translateY(-50%) rotate(180deg);
		-webkit-transform: translateY(-50%) rotate(180deg);
	}
	.fixed-vouchers-footer-list .fixed-voucher::before {

		position: absolute;
		content: '';
		top: 50%;
		transform: translateY(-50%);
		left: -1px;
		border: 1px solid transparent;
		border-left: 0;
		width: 5px;
		height: 10px;
		background-color: #fff;
		border-radius: 0 100% 100% 0 / 0 50% 50% 0;
	}
	
	.fixed-vouchers-footer .fixed-vouchers-footer-title {
		margin: 10px 0;
		color: #000;
		font-size:.95rem;
		font-family: var(--skin-body-font);
	}
	.fixed-voucher-infobox {
		position: absolute;
		background: #fff;
		display: none;
		box-shadow: 0 0 4px 0px #fff;
		z-index: 5;
		text-align: center;
		border-radius: 10px;
		border: 1px solid #f5f5f5;
		width: max-content;
		padding: 10px 5px;
		top: 100%;
		left: 50%;
		transform: translate(-50%, 10px);
	}
	.fixed-voucher-infobox span{font-size:12px;}
	.fixed-voucher-infobox::after {
		content: '';
		width: 10px;
		height: 10px;
		bottom: 100%;
		position: absolute;
		left: 50%;
		background: #fff;
		transform: translate(-50%, 40%) rotate(45deg);
		border: 1.5px solid #00000024;
		border-bottom: 0;
		border-right: 0;
	}
	.fixed-vouchers-footer-list .fixed-voucher:hover .fixed-voucher-infobox{
		display:block;
	}

	.voucher-container {
        display: flex; /* Sử dụng Flexbox */
        flex-direction: row; /* Sắp xếp theo chiều ngang */
        flex-wrap: wrap; /* Cho phép các mục wrap xuống hàng dưới khi không đủ không gian ngang */
       
    }

    /* Tùy chỉnh chiều rộng của mỗi mục voucher (thay đổi theo ý muốn) */
    .fixed-voucher-next {
		flex: 0 0 auto; /* Không đặt mục voucher để thay đổi kích thước tự động */
        margin-right: 10px; /* Khoảng cách giữa các mục voucher */
    }
	@media(max-width: 767px){
		.fixed-voucher-next {
			margin-right: 0px; /* Khoảng cách giữa các mục voucher */
		}
		.product-fixed-vouchers {
			padding-top:10px;
			padding-bottom: 10px;
			background: #fff;
		}
		.fixed-vouchers-footer-list .fixed-voucher::before, .fixed-vouchers-footer-list .fixed-voucher::after{
			background-color: #f5f5f5;
		}
		.fixed-vouchers-footer-list{
			padding-bottom: 0;
			gap: 0.4rem 0.7rem;
		}
		.fixed-voucher-infobox::after {
    content: '';
    width: 10px;
    height: 10px;
    bottom: 100%;
    position: absolute;
    left: 14%;
    background: #fff;
    transform: translate(-50%, 40%) rotate(45deg);
    border: 1.5px solid #00000024;
    border-bottom: 0;
    border-right: 0;
}

	}
	@media (max-width:480px){
		.fixed-voucher-infobox {
			left:-8px;
			transform: translate(0%, 10px);
		}
		.fixed-vouchers-heading .fixed-vouchers-title{
			font-size: 16px;
		}
		
	}

	/* ipad  */
	@media (min-width: 768px) and (max-width: 1024px) {
		.fixed-voucher-infobox {
			left: -8px;
			transform: translate(0%, 10px);
			font-size: 0.6rem !important;
		}

		.fixed-voucher-infobox::after {
    content: '';
    width: 10px;
    height: 10px;
    bottom: 100%;
    position: absolute;
    left: 14%;
    background: #fff;
    transform: translate(-50%, 40%) rotate(45deg);
    border: 1.5px solid #00000024;
    border-bottom: 0;
    border-right: 0;
}
		
	}
</style>


<?php endif; ?>
