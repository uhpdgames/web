const keys = {
	chitiet: false,
	binhluan: false,
	sanphamcungloai: false,
}
$('.loc select,.loctatca select').change(function () {
	var root = $('.wap_loadthem_sp');
	var tatca = $('#tatca').val();
	var loaisanpham = $('#loaisanpham').val();
	var thuonghieu = $('#thuonghieu').val();
	var dong = $('#dong').val();
	var mucgia = $('#mucgia').val();

	if (mucgia != undefined) mucgia = mucgia.split('-');

	//var where = root.data('where');
	var where = " type = 'san-pham' and hienthi > 0";
	if (tatca != undefined && tatca != '') where += ' and ' + tatca + ' > 0';
	if (loaisanpham != undefined && loaisanpham != '') where += ' and id_list=' + loaisanpham + '';
	if (thuonghieu != undefined && thuonghieu != '') where += ' and id_thuonghieu=' + thuonghieu + '';
	if (dong != undefined && dong != '') where += ' and id_dong=' + dong + '';
	if (mucgia != undefined && mucgia[0] != '' && mucgia[1] != '') where += ' and gia>=' + mucgia[0] + ' and gia <= ' + mucgia[1] + '';
	
	
	$.ajax({
		type: 'post',
		url: site_url() + 'ajax/loc',
		data: {where: where, type:loaisanpham},
		success: function (kq) {
			
			$('.sanpham').html(kq);
		},
	});
	return false;
	
	if(loaisanpham){
		$.ajax({
			type: 'post',
			url: site_url() + 'ajax/goto_cat',
			data: {type:loaisanpham},
			success: function (kq) {
				//window.location.href =kq;
			},
		});
	}else {
	
	
	}

	return false;
})
$(document).on('click', '.load_them', function (event) {
	var root = $(this).parents('.wap_loadthem_sp');
	var div = root.data('div');
	var lan = root.data('lan');
	var where = root.data('where');
	var sosp = root.data('sosp');
	var max = root.data('max');
	var conlai = max - lan - 1;
	var sanpham = conlai * sosp;

	load_them(div, lan, where, sosp);
	root.data('lan', (lan + 1));
	$(this).find('span').html(sanpham);
	if (max == (lan + 1)) {
		$(this).hide();
	}
});

function loading_details_product($key){
return 0;
	$.ajax({
		type: 'post',
		url: site_url() + 'ajax/product_details',
		data: {pid: $('#pid').val(), key: $key},
		success: function (kq) {
			$('#box_sanpham').html(kq);
			keys[$key] = true;
		}
	});

}

window.addEventListener("scroll", bringmenu);
var loadDetail = false;

function bringmenu() {
	//$('#tab_sub_info a').removeClass('active');

	if(!$isMobile){
		if (document.documentElement.scrollTop > 1000) {
			// $("#mm-menu").addClass("fixed-mmenu");
			// $("#mm-menu").removeClass("main_fix");
		} else {
			// $("#mm-menu").removeClass("fixed-mmenu");
			// $("#mm-menu").addClass("main_fix");
		}
	}

/*
	if (document.documentElement.scrollTop >= 700) {
		$("#mm-menu-2").addClass("fixed-menu");
		$("#mm-menu-2").removeClass("header-fix-2");
		$("#mb-gtsp ").addClass("boxshadow");
	} else {
		$("#mm-menu-2").removeClass("fixed-menu");
		$("#mm-menu-2").addClass("header-fix-2");
		$("#mb-gtsp").removeClass("boxshadow");
	}*/

	if (!loadDetail && document.documentElement.scrollTop > 20) {
		loadDetail = true;
		//loading_details_product('chitiet');
	}
	if (document.documentElement.scrollTop > 40) {
		//   loading_details_product('sanphamcungloai');
	}
}

function resetClass() {
	$('.smooth-goto').removeClass('active')


	return false;
	$('.thongtinsanpham').removeClass('active');
	$('#box_sanpham').removeClass('active');
	$('.commentfb').removeClass('active');
	$('#box_binhluan').removeClass('active');
	$('#tab_sub_info a').removeClass('active');
}

setTimeout(function () {
	$(document).on('click', 'a[href^="#"]', function (event) {
		event.preventDefault();

		//$('.smooth-goto').removeClass('active')
		$(this).addClass('active');

		event.preventDefault();

		var _val = $(this).data('id');

		resetClass();


		$(this).addClass('active');

	});
}, 50)

var loading = false;

function load_san_pham_cung_loai(_this) {
	console.log('zzz');

	const where = $(_this).data('where');
	const sosp = $(_this).data('solan');

	if (!loading) {
		loading = true;
		load_them('.loadthem_sp100', 0, where, sosp);
	}
}

$(window).load(function () {
	setTimeout(function () {

	}, 250);
	if ($('#box_sanpham').length) {
		loading_details_product('chitiet');
	}
});

document.addEventListener('DOMContentLoaded', (event) => {
	if($('#prod').length){
		const sanpham = $('.sanpham');
		const $where = sanpham.data('where');
		const $sosp = sanpham.data('sosp');
		load_them('.loadthem_sp100', '0', $where, $sosp);
	}
})
