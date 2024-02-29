

var cost = {}


function checkPrice() {
	cost.total = parseFloat($('.price-total').val())
	cost.temp = parseFloat($('.price-temp').val())
	cost.ship = parseFloat($('.price-ship').val() || 0)
	cost.dagiam = parseFloat($('#giadagiam').val() || 0)
	
	cost.all = cost.temp + cost.ship - cost.dagiam;
	
	//$('.load-price-total').text(number_format(cost.all));
}

checkPrice();
var current_code = '';
function updateVoucher($magiamgia) {
	current_code = $magiamgia;
	
 	$data = {
		code: $magiamgia,
		uid: $('#uid').val() || 0,
		ship: $('.price-ship').val() || 0,
		price: $('.price-temp').val() || 0,
	};
	
	if ($magiamgia != '') {
		
		$.ajax({
			type: "POST",
			url: "ajax/check_voucher",
			data: $data,
			before: function () {
				cost.temp = parseFloat($('.price-total').val());
				checkPrice();
			},
			success: function (info) {
				info = jQuery.parseJSON(info);
				
				switch (info.case){
					case 0:
						updateOldPrice(info);
						break;
					case 1:
						updatePrice(info);
						break;
					case 2:
					case -1:
						updateErrorVoucher(info.msg);
						break;
				}
				checkPrice();
			}
		})
	}
}

function updateErrorVoucher(msg){
	$('#coupon_id').val(0);
	$('#giadagiam').val(0);
	$('.total-procart.discount').removeClass('d-flex').hide();
	$('.invalid-feedback.magiamgia').removeClass('succ').text(msg).show();
	
	$('.load-price-ship').removeClass('price-old-pro-detail');
}

function updatePrice($info) {
	if(current_code == 'FREESHIP') $('.load-price-ship').addClass('price-old-pro-detail');
	else {
		$('.load-price-ship').removeClass('price-old-pro-detail');
	}
 
	$('.price-total').val(parseFloat($info.total));
	
	$('.load-price-voucher').text($info.text_price_voucher);
	$('.load-price-total').text($info.text_price);
	$('#coupon_id').val(parseFloat($info.id));
	$('#giadagiam').val(parseInt($info.dagiam));
	
	$('.invalid-feedback.magiamgia').addClass('succ').text($info.msg).show();
	
	if( $('#giadagiam').val() !=0 ) {
		$('.total-procart.discount').addClass('d-flex').show();
	}else{
		$('.total-procart.discount').removeClass('d-flex').hide();
	}
	
	
	
	
	return false;
	
	
	
	
	
	
	
	
	
	
	

	
	//per 10
	$newPriew = parseFloat(cost.temp) * ((100 - 10) / 100);
	ship = parseFloat($('.price-ship').val());
	
	if (ship > 0) {
		$newPriew += ship;
	}
	
	$('.price-total').val(parseFloat($newPriew));
	$('.price-current').val(parseFloat($newPriew));
	$('.total-price').val(parseFloat($newPriew));
	$('.load-price-voucher').text($new_priceLabel.voucher);
	$('#coupon_id').val(parseFloat($new_priceLabel.id));
	$('#giadagiam').val(parseInt(cost.temp - parseFloat(cost.temp) * ((100 - 10) / 100)));
}

function number_format(number, decimals, dec_point, thousands_sep) {
	// Strip all characters but numerical ones.
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split(',');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec) + 'đ';
}

function updateOldPrice($info) {
	$('.load-price-voucher').text('');
	$('#coupon_id').val(0);
	$('#giadagiam').val(0);
	

	$('.invalid-feedback.magiamgia').removeClass('succ').text($info.msg).show();
	$('.load-price-total').text($info.text_price);
	$('.price-total').val(parseFloat($info.total));
	
	$('.total-procart.discount').removeClass('d-flex').hide();
	
	//
 
	$('.load-price-ship').removeClass('price-old-pro-detail');
	return false;
	
	$total = parseFloat(cost.temp);
	ship = parseFloat($('.price-ship').val());
	
	if (ship > 0) {
		$total += ship;
	}
	
	//per 10
	
	
	$('.price-total').val(parseFloat($total));
	$('.price-current').val(parseFloat($total));
	$('.total-price').val(parseFloat($total));
	$('.load-price-total').text(number_format(cost.all));
	$('.load-price-voucher').text(0);
}

setTimeout(function () {
	$(document).ready(function () {
		$('body').on('click', '#thanhtoan', function () {
			var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
			var mobile = $('#dienthoai').val();
			if (mobile !== '') {
				if (vnf_regex.test(mobile) == false) {
					$('#dienthoai').val(" ");
					$('#invalid-phone').text("Vui lòng nhập số điện thoại hợp lệ");
				} else {
				
				}
			} else {
				$('.invalid-feedback').val(" ");
			}
		});
		
		$('.quantity-procat').on('change', function () {
			if ($(this).val() == 0) {
				$(this).val(1);
			}
		});
	});
}, 1500);

$('#wards').change(function () {
	setTimeout(function (){
		updateNewPrice();
	}, 1000)
	
});


function updateNewPrice() {
	checkPrice();
	
	var TOTAL = 0;
	var GIAMGIA = 0;
	
	var temp = cost.temp;
	var ship = cost.ship;
	var dagiam = cost.dagiam;
	
	TOTAL = (temp + ship - dagiam);
	
	$('.price-total').val(TOTAL);
	
	$('.load-price-total').text(number_format(TOTAL));
	
	setTimeout(function (){
		checkPrice();
	}, 2000);
}

function them_magiamgia(_this){
	const code = $(_this).data('code') || '';
 
	$('#magiamgia').val(code);
	updateVoucher(code);
}


$(".quantity-procat").bind('keyup mouseup', function () {
	checkPrice();
});



$( ".select-wards-cart" ).on( "change", function() {
	$('.load-price-ship').removeClass('price-old-pro-detail');
} );
