function SlickInit() {
	if ($(".slick4322").length) {
		$('.slick4322').slick({
			rows: 2,
			lazyLoad: 'ondemand',
			infinite: true,
			accessibility: false,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 3000,
			speed: 1000,
			arrows: true,
			centerMode: false,
			dots: false,
			draggable: true,
			pauseOnHover: true,
			responsive: [
				{
					breakpoint: 960,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
						rows: 1
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						rows: 1
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
						rows: 1
					}
				}
			]
		});
	}
}

//index
var _path = {
	site: site_url(),
	assets: site_url() + '/assets/'
}
var loading_html = false;

const loading_template = {
	slick4322: '<div class="main_fix slick4322_loading" style=display:block;width:100%><div class="gx-0 gy-0 mt-2 pt-2 row"><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div></div><div class="gx-0 gy-0 mt-2 pt-2 row"><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div><div class=col><div class="animated-background box-item"style="height:100%;width:100%;display:inline-block"><div class="item item_i"><div class="background-masker btn-divide-left"></div></div></div></div></div></div>',
}

function load_html($type) {
	$.ajax({
		type: "POST",
		url: site_url() + `ajax/html`,
		dataType: 'html',
		data: {type: $type},
		success: function (result) {
			if (result) {
				const array = $type.split(',');
				$text = jQuery.parseJSON(result);
				for (const id of array) {
					let tag = '#';
					// if (id.includes('banner_')) tag = '#';
					const ele = tag + id;
					if ($(ele).length) $(ele).html(decode($text[id]));
				}
			}
			
			
		},
		complete: function () {
			InitWhereLoadHTML();
		}
	});
}
var playerYTB;

function loadVideo() {
	return false;
	var done = false;
	
	window.YT.ready(function () {
		playerYTB = new window.YT.Player("video", {
			height: "1200",
			width: "500",
			videoId: "cAI57ElFDv4",
			playerVars: {
				loop: 1,
				autoplay: 1,
				controls: 0,
				disablekb: 1,
				modestbranding: 1,
				showinfo: 0,
				iv_load_policy: 3,
				rel: 0
			},
			events: {
				onReady: onPlayerReady, onStateChange: onPlayerStateChange
			}
		});
		
	});
	
	function onPlayerStateChange(event) {
		var videoStatuses = Object.entries(window.YT.PlayerState)
		
		if (event.data === YT.PlayerState.ENDED) {
			playerYTB.playVideo();
			
		}
		
		
	}
	
	function onPlayerReady(event) {
		playerYTB.playVideo();
		playerYTB.mute();
	}
}
function CloseVourcher() {
	$('#voucher .close').on('click', function () {
		$('#voucher').remove();
		//$.cookie('Vourcher_loaded', 'true', {expires: 7, path: '/'});
	})
}

function updateAds() {
	
	
	
	var wap_slogan = document.getElementById('slogan-swiper')
	if (typeof wap_slogan != 'undefined' && wap_slogan != null) {
		new Swiper('#slogan-swiper', {
			//direction: 'vertical',
			//effect: 'slide',
			slidesPerView: 1,
			//	loop: true,
			autoplay: {
				delay: 2000
			},
			
		})
	}
	
	var wap_danhmuc = document.getElementById('cate')
	if (typeof wap_danhmuc != 'undefined' && wap_danhmuc != null) {
		var swiper = new Swiper('#slick_cate', {
			slidesPerView: 4,
			spaceBetween: 10,
			autoplay: {
				delay: 3000,
			},
			navigation: {
				nextEl: '.next',
				prevEl: '.prev',
			},
			
			breakpoints: {
				499: {
					slidesPerView: 3,
					spaceBetween: 2,
				},
				500: {
					slidesPerView: 3,
					spaceBetween: 8,
				},
				768: {
					slidesPerView: 5,
					spaceBetween: 36,
				},
			}
		})
	}
	
	var slick_banner = document.getElementById('slick_banner')
	if (typeof slick_banner != 'undefined' && slick_banner != null) {
		new Swiper("#slick_banner", {
			autoplay: {
				delay: 5000,
			},
			slidesPerView: 1,
			/*pagination: {
				el: ".swiper-pagination",
				type: "progressbar",
			},*/
		});
		
	}
	
	
	
	
	//var slick_ADS = document.getElementById('quangcao')
	//if (typeof slick_ADS != 'undefined' && slick_ADS != null) {
	if ($('#quangcao').length) {
		new Swiper('.quangcao-swiper', {
			autoplay: {
				delay: 3000,
			},
			breakpoints: {
				450: {
					slidesPerView: 1,
					spaceBetween: 0,
				},
				600: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				900: {
					slidesPerView: 3,
					spaceBetween: 20,
				}
			}
		});
	}
	//}
	
	
	/*if ($('.quangcao-swiper').length) {
		var swiper = new Swiper('.quangcao-swiper', {
			slidesPerView: 3,
			spaceBetween: 20,
			init: true,
			pagination: false,
			breakpoints: {
				450: {
					slidesPerView: 1,
					spaceBetween: 0,
				},
				640: {
					slidesPerView: 2,
					spaceBetween: 10,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 20,
				}
			}
		});
	}*/
	
}


function updateLang() {
	const old_uri = window.location.href;
	$('.ngonngu a').on('click', function (e) {
		e.preventDefault();
		
		// $_this = $(this).data();
		$lang_dir = $(this).data('lang_dir');
		$lang = $(this).data('lang');
		
		$.ajax({
			type: "POST",
			url: site_url() + `ajax/updatelang`,
			data: {lang: $lang, lang_dir: $lang_dir},
			success: function (result) {
			
			},
			
			complete: function () {
				window.location.href = old_uri;
			}
		});
	});
}

function decode(str) {
	
	let txt = new DOMParser().parseFromString(str, "text/html");
	
	return txt.documentElement.textContent;
	
}


function fixEdImages(sm = false) {
	return false;
	
	let empty = empty_image;
	;
	if (sm) {
		empty = site_url() + '/assets/images/noimage.webp';
	}
	
	/*$('img').each(function () {
		const oldSrc = this.src;

		//!this.complete
		if (
			typeof this.naturalWidth == "undefined"
			|| this.naturalWidth == 0
		) {
			var fixed = oldSrc.replace(/.[^.]+$/gi, '.webp');
			this.src = fixed;
			//this.src = empty;
		}
	});*/
	$('img').each(function () {
		
		if (
			!this.complete ||
			typeof this.naturalWidth == "undefined"
			|| this.naturalWidth == 0
		) {
			this.src = empty;
		}
	});
	
}

function InitWhereLoadHTML() {
	/*if (typeof wap_danhmuc !== 'undefined') {
		wap_danhmuc.slick('refresh');
	}
*/
	initImage();
	
	if ($('.cap1').length) {
		$('.cap1 li').on("click", function () {
			var id = $(this).data('id');
			$('.cap1 li').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: 'post',
				url: site_url() + 'ajax/sanpham',
				data: {id: id},
				beforeSend: function () {
					$('.load_sp').html(loading_template.slick4322);
				},
				success: function (kq) {
					$('.load_sp').html(kq);
				},
				complete: function () {
					SlickInit();
					//refreshSlickInit();
					//fixEdImages()
				}
			})
			return false;
		})
	}
	
	CloseVourcher();
	SlickInit();
	
	displayNode();
	loader();
	load_review();
	updateLang();
	
	$.ajaxSetup({
		beforeSend: function () {
			//loader();
		},
		complete: function () {
			loader();
			
			
		},
	});
	
	if ($('body#main').length) {
		/*setTimeout(function () {
			//fixEdImages();

		}, 2000);*/
	}
	
	updateAds();
	
	NN_FRAMEWORK.BackToTop();
	NN_FRAMEWORK.AltImages();
	NN_FRAMEWORK.Tools();
	//NN_FRAMEWORK.FixMenu();
	//NN_FRAMEWORK.mMenu();
	NN_FRAMEWORK.Search();
	//NN_FRAMEWORK.Popup();
	
	
	NN_FRAMEWORK.Cart();
	NN_FRAMEWORK.Tabs();
	NN_FRAMEWORK.star();
	
	
	$('.scrollToTop a').on("click", function () {
		_scrollTo();
	});
	
	/*if ($('.cap1').length) {
		$('.cap1 li').on("click", function () {
			var id = $(this).data('id');
			$('.cap1 li').removeClass('active');
			$(this).addClass('active');
			$.ajax({
				type: 'post',
				url: site_url() + 'ajax/sanpham',
				data: {id: id},
				success: function (kq) {
					$('.load_sp').html(kq);

				},
				complete: function () {
					SlickInit();
				
				}
			})
			return false;
		})
	}*/
	
	//NN_FRAMEWORK.Sapxep();
	//NN_FRAMEWORK.chaychu();
	//NN_FRAMEWORK.WowAnimation();
	//NN_FRAMEWORK.Toc();
	//NN_FRAMEWORK.Photobox();
	//NN_FRAMEWORK.DatetimePicker();
	//NN_FRAMEWORK.xemnhanh_sanpham();
	//NN_FRAMEWORK.yeuthich_sanpham();
}


var $load_review = false;
function load_review() {
	if (!$load_review) {
		$(".img_post img").on("click", function () {
			var id = $(this).data("id");
			var danhgia = $(this).data("danhgia");
			var sosao = $(this).data("sosao");
			$.ajax({
				type: "post",
				url: site_url() + "ajax/review",
				data: {id: id, danhgia:danhgia, sosao: sosao},
				beforeSend: function () {
					$("#loader").hide();
					
				},
				
				success: function (kq) {
					$load_review = true;
					
					$(".all_review").html(kq);
					$(".all_review").addClass("all_review_active");
					
					$('body').addClass('lock');
				}
			})
			return false;
		});
	}
	
	
}
function need_close_review() {
	if (!!$(".close_review").length) {
		$(".close_review").on("click", function () {
			$(".all_review").removeClass("all_review_active");
			$('body').removeClass('lock');
			$load_review = false;
			return false;
		});
	}
	
	load_review_more();
}
function load_review_more() {
	$(".hinh_p img").on("click", function () {
		var id = $(this).data("id");
		var danhgia = $(this).data("danhgia");
		var sosao = $(this).data("sosao");
		$.ajax({
			type: "post",
			url: site_url() + "ajax/review",
			data: {id: id, danhgia:danhgia, sosao: sosao},
			beforeSend: function () {
				$("#loader").hide();
				
			},
			
			success: function (kq) {
				$load_review = true;
				
				$(".all_review").html(kq);
				$(".all_review").addClass("all_review_active");
				$('body').addClass('lock');
			}
		})
		return false;
	});
}
function load_addon() {
	$.ajax({
		type: "POST",
		url: `${_path.site}/Ajax/load_addon`,
		dataType: 'html',
		success: function (result) {
			if (result) {
				$('.overlay-addon').html(result);
			}
		}
	});
}
function modalNotify(text) {
	$("#popup-notify").find(".modal-body").html(text);
	$('#popup-notify').modal('show');
}


function ValidationFormSelf(ele = '') {
	if (ele) {
		$("." + ele).find("input[type=submit]").removeAttr("disabled");
		var forms = document.getElementsByClassName(ele);
		var validation = Array.prototype.filter.call(forms, function (form) {
			form.addEventListener('submit', function (event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}
}

function loadPagingAjax(url = '', eShow = '') {
	if ($(eShow).length && url) {
		$.ajax({
			url: url,
			type: "GET",
			data: {
				eShow: eShow
			},
			success: function (result) {
				$(eShow).html(result);
			}
		});
	}
}

function doEnter(event, obj) {
	if (event.keyCode == 13 || event.which == 13) onSearch(obj);
}

function onSearch(obj) {
	var keyword = $("#" + obj).val();
	
	if (keyword == '') {
		
		modalNotify(LANG['no_keywords']);
		return false;
	} else {
		
		location.href = "tim-kiem?keyword=" + encodeURI(keyword);
		
		loadPage(document.location);
	}
}

function goToByScroll(id) {
	var offsetMenu = 0;
	id = id.replace("#", "");
	if ($(".menu").length) offsetMenu = $(".menu").height();
	$('html,body').animate({
		scrollTop: $("#" + id).offset().top - (offsetMenu * 2)
	}, 'slow');
}

function mosaicGrid(selector, target, cols) {
	//var cols = [0,0,0,0];
	var allTarget = $(selector).find(target);
	if (!allTarget.length) return;
	allTarget.each(function (e) {
		var pos = minPos(cols);
		console.log(pos);
		var x = pos * 100 / cols.length;
		var y = cols[pos];
		$(this).css({left: x + "%", top: y + "px", width: Math.floor(100 / cols.length) + "%"});
		console.log($(this));
		cols[pos] = cols[pos] + $(this).height();
		$(selector).height(Math.max.apply(null, cols));
	})
}

function minPos(arr) {
	var min = Math.min.apply(null, arr);
	for (var i = 0; i < arr.length; i++) {
		if (min === arr[i])
			return i;
	}
}

function update_cart(id = 0, code = '', quantity = 1, _this) {
	
	
	if (id) {
		var ship = $(".price-ship").val();
		let id_city = $('#city').val();
		let id_district = $('#district').val();
		let id_wards = $('#wards').val();
		let magiamgia = $('#magiamgia').val();
		let uid = $('#uid').val();
		$.ajax({
			type: "POST",
			url: site_url() + "ajax/ajax_cart",
			dataType: 'json',
			data: {
				uid: uid,
				magiamgia: magiamgia,
				cmd: 'update-cart',
				id: id,
				code: code,
				quantity: quantity,
				ship: ship,
				giadagiam: $('#giadagiam').val() || 0,
			},
			before: function () {
				//_this.attr('disabled', 'disabled'); //disable the button
				//alert(1)
			},
			success: function (result) {
				// IN AJAX CALLBACK
				//_this.removeAttr('disabled'); //enable the button again
				//alert(122);
				if (result) {
					if ($('#my-gifts').length) {
						$('#my-gifts').html(decode(result.html_gitfs || ""));
					}
					
					$('.load-price-voucher').text(result.text_dagiam);
					$('#giadagiam').val(parseInt(result.giadagiam));
					
					$('.load-price-' + code).html(result.gia);
					$('.load-price-new-' + code).html(result.giamoi);
					$('.price-temp').val(result.temp);
					$('.load-price-temp').html(result.tempText);
					$('.price-total').val(result.total);
					$('.load-price-total').html(result.totalText);
					if (id_city > 0 && id_district > 0 && id_wards > 0) load_ship(id_city, id_district, id_wards);
					
					
					if ($('#giadagiam').val() != 0) {
						$('.total-procart.discount').addClass('d-flex').show();
					} else {
						$('#magiamgia').val(" ");
						$('.magiamgia').text(" ").hide();
						$('.total-procart.discount').removeClass('d-flex').hide();
					}
					
					
					//loading_ajax = false;
				}
			}
		});
	}
}

function load_district(id = 0) {
	$.ajax({
		type: 'post',
		url: site_url() + 'ajax/ajax_district',
		data: {
			id_city: id
		},
		success: function (result) {
			$(".select-district").html(result);
			$(".select-wards").html('<option value="">' + LANG['wards'] + '</option>');
		}
	});
}

function load_wards(id = 0) {
	$.ajax({
		type: 'post',
		url: site_url() + 'ajax/ajax_wards',
		data: {
			id_district: id
		},
		success: function (result) {
			$(".select-wards").html(result);
		}
	});
}

function load_ship(id_city = 0, id_district = 0, id_wards = 0) {
	//alert(3)
	$.ajax({
		type: "POST",
		url: site_url() + "ajax/ajax_cart",
		dataType: 'json',
		data: {
			uid: $('#uid').val() || 0,
			cmd: 'ship-cart',
			id_city: id_city,
			id_district: id_district,
			id_wards: id_wards,
			giadagiam: $('#giadagiam').val() || 0,
		},
		success: function (result) {
			if (result) {
				if ($('#my-gifts').length) {
					$('#my-gifts').html(decode(result.html_gitfs || ""));
				}
				
				$('.load-price-voucher').text(result.text_dagiam);
				$('#giadagiam').val(parseInt(result.giadagiam));
				if ($('#giadagiam').val() != 0) {
					$('.total-procart.discount').addClass('d-flex').show();
				} else {
					$('#magiamgia').val(" ");
					$('.magiamgia').text(" ").hide();
					$('.total-procart.discount').removeClass('d-flex').hide();
				}
				
				$('.load-price-ship').html(result.shipText);
				$('.load-price-total').html(result.totalText);
				$('.price-ship').val(result.ship);
				$('.price-total').val(result.total);
				$('.price-ship_code').val(result.ship_code);
			}
		}
	});
}

/**
 * Loading
 */
function loader() {
	$("#loader").show().delay(500).fadeOut();
}

function displayNode() {
	$('.d-none-all').hide();
}

function _scrollTo() {
	$("html, body").animate({
		scrollTop: 0
	}, 0, 'linear');
}

/* Validation form */
//ValidationFormSelf("validation-newsletter");
ValidationFormSelf("validation-cart");
ValidationFormSelf("validation-user");
ValidationFormSelf("validation-contact");


/* Back to top */
NN_FRAMEWORK.BackToTop = function () {
	
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
		else $('.scrollToTop').fadeOut();
	});
	
	
	$('.c_binhluan').on("click", function () {
		$('.active_bl').click();
		var cao = $('.active_bl').offset().top;
		$('html, body').animate({scrollTop: cao + 'px'}, 800);
		return false;
	});
	
	
	if (!!$('.close_review').length) {
		$('.close_review').on("click", function () {
			$('.all_review').removeClass('all_review_active');
			$('body').removeClass('lock');
			return false;
		});
	}
	
	
	if (!!$('.c_doidiachi').length) {
		$('.c_doidiachi').on("click", function () {
			$.fancybox.open({
				src: '#hidden-content',
				trapFocus: true,
				clickSlide: true,
				clickOutside: true,
				autoDimensions: false,
				touch: false,
			})
		})
	}
	
	
	if (!!$('.item_dc').length) {
		$('.item_dc').on("click", function () {
			var dc = $(this).find('.ten').text();
			$('#diachi').val(dc);
			$.fancybox.close();
			return false;
		});
	}
	
	
};

/* Alt images */
NN_FRAMEWORK.AltImages = function () {
	$('img').each(function (index, element) {
		if (!$(this).attr('alt') || $(this).attr('alt') == '') {
			$(this).attr('alt', WEBSITE_NAME);
		}
	});
};

NN_FRAMEWORK.star = function () {
	if ($(".danhgiasao").length) {
		var giatri_default = 0;
		$('.danhgiasao span:lt(' + giatri_default + ')').addClass('active');
		$('.danhgiasao span').hover(function () {
			var giatri = $(this).data('value');
			$('.danhgiasao span').removeClass('hover');
			$('.danhgiasao span:lt(' + giatri + ')').addClass('hover');
		}, function () {
			$('.danhgiasao span').removeClass('hover');
		});
		
		$('.danhgiasao span').click(function () {
			var giatri = $(this).data('value');
			$('#link_video').val(giatri);
			$('.danhgiasao span').removeClass('active');
			$('.danhgiasao span:lt(' + giatri + ')').addClass('active');
		});
	}
};

NN_FRAMEWORK.chaychu = function () {
	$(function () {
		$('.slogan').textillate({
			loop: true,
			in: {
				effect: 'bounce',//fadeInLeftBig
				delayScale: 1.5,
				delay: 50,
				sync: false,
				reverse: false,
				shuffle: false,
				callback: function () {
				}
			},
			out: {
				effect: 'wobble',
				delayScale: 1.5,
				delay: 100,
				sync: false,
				reverse: false,
				shuffle: false,
				callback: function () {
				}
			},
		});
	})
};

/* Fix menu */
NN_FRAMEWORK.FixMenu = function () {
	$(window).scroll(function () {
		if ($(window).scrollTop() >= $(".wap_thongtin").height()) $(".wap_header").addClass('wap_header_fix');
		else $(".wap_header").removeClass('wap_header_fix');
	});
	
	$('.dmsp ul li').hover(function () {
		var vitri = $(this).position().top;
		$(this).children('ul').css({'top': vitri + 'px'});
	});
	
	$("#danhmuc ul li a").click(function () {
		if ($(this).parent('li').children('ul').find('li').length > 0) {
			if ($(this).hasClass('active')) {
				$(this).parent('li').find('ul:first').hide(300);
				$(this).removeClass('active');
			} else {
				$(this).parent('li').find('ul:first').show(300);
				$(this).addClass('active');
			}
			return false;
		}
	});
};

/* Fix menu */
NN_FRAMEWORK.mMenu = function () {
	/* tạo menu mobile */
	var menu_mobi = $('.menu ul').html();
	$('.menu_mobi_add2').append('<span class="close_menu">X</span><ul>' + menu_mobi + '</ul>');
	$(".menu_mobi_add ul li").each(function (index, element) {
		if ($(this).children('ul').children('li').length > 0) {
			$(this).children('a').append('<i class="fas fa-chevron-right"></i>');
		}
	});
	$(".menu_mobi_add ul li a i").click(function () {
		if ($(this).parent('a').hasClass('active2')) {
			$(this).parent('a').removeClass('active2');
			if ($(this).parent('a').parent('li').children('ul').children('li').length > 0) {
				$(this).parent('a').parent('li').children('ul').hide(300);
				return false;
			}
		} else {
			$(this).parent('a').addClass('active2');
			if ($(this).parents('li').children('ul').children('li').length > 0) {
				$(".menu_m ul li ul").hide(0);
				$(this).parents('li').children('ul').show(300);
				return false;
			}
		}
	});
	
	$('.icon_menu_mobi,.close_menu,.menu_baophu').click(function () {
		if ($('.menu_mobi_add').hasClass('menu_mobi_active')) {
			$('.menu_mobi_add').removeClass('menu_mobi_active');
			$('.menu_baophu').fadeOut(300);
		} else {
			$('.menu_mobi_add').addClass('menu_mobi_active');
			$('.menu_baophu').fadeIn(300);
		}
		return false;
	});
};

/* Tools */
NN_FRAMEWORK.Tools = function () {
	if ($(".toolbar").length) {
		$(".wap_copy").css({marginBottom: $(".toolbar").innerHeight()});
	}
};
/* Popup */
NN_FRAMEWORK.Popup = function () {
	if ($("#popup").length) {
		$('#popup').modal('show');
	}
};
/* Wow */
NN_FRAMEWORK.WowAnimation = function () {
	WOW.prototype.addBox = function (element) {
		this.boxes.push(element);
	};
	var wow = new WOW();
	wow.init();
	
	$('.wow').on('scrollSpy:exit', function () {
		$(this).css({
			'visibility': 'hidden',
			'animation-name': 'none'
		}).removeClass('animated');
		wow.addBox(this);
	}).scrollSpy();
};
/* Toc */
NN_FRAMEWORK.Toc = function () {
	if ($(".toc-list").length) {
		$(".toc-list").toc({
			content: "div#toc-content",
			headings: "h2,h3,h4"
		});
		if (!$(".toc-list li").length) $(".meta-toc").hide();
		$('.toc-list').find('a').click(function () {
			var x = $(this).attr('data-rel');
			goToByScroll(x);
		});
	}
};

/* Tabs */
NN_FRAMEWORK.Tabs = function () {
	if ($(".ul-tabs-pro-detail").length) {
		$(".ul-tabs-pro-detail li").click(function () {
			var tabs = $(this).data("tabs");
			$(".content-tabs-pro-detail, .ul-tabs-pro-detail li").removeClass("active");
			$(this).addClass("active");
			$("." + tabs).addClass("active");
		});
	}
};

/* Sap Xep */
NN_FRAMEWORK.Sapxep = function () {
	if ($(".sapxep").length) {
		$(window).resize(function () {
			var manghinh = $(window).width();
			if (manghinh > 1366) {
				mosaicGrid('.sapxep', '.item_sx', [0, 0, 0, 0]);
			} else if (manghinh > 604) {
				mosaicGrid('.sapxep', '.item_sx', [0, 0, 0]);
			} else {
				mosaicGrid('.sapxep', '.item_sx', [0, 0]);
			}
		});
		
		$(window).load(function () {
			var manghinh = $(window).width();
			if (manghinh > 1366) {
				mosaicGrid('.sapxep', '.item_sx', [0, 0, 0, 0]);
			} else if (manghinh > 604) {
				mosaicGrid('.sapxep', '.item_sx', [0, 0, 0]);
			} else {
				mosaicGrid('.sapxep', '.item_sx', [0, 0]);
			}
		});
	}
};

/* Datetime picker */
NN_FRAMEWORK.DatetimePicker = function () {
	if ($('#ngaysinh').length) {
		$('#ngaysinh').datetimepicker({
			timepicker: false,
			format: 'd/m/Y',
			formatDate: 'd/m/Y',
			minDate: '01/01/1950',
			maxDate: TIMENOW
		});
	}
};

/* Search */
NN_FRAMEWORK.Search = function () {
	if ($(".tim").length) {
		var lan = 0;
		$('.tim').click(function () {
			
			if (lan == 0) {
				$('.search').slideDown(300);
				lan = 1;
				$('.menu_overlay').show();
				$('body').addClass("fixed-position");
			} else {
				$('.search').slideUp(300);
				lan = 0;
				$('.menu_overlay').hide();
				$('body').removeClass("fixed-position");
			}
		});
	}
	if ($("#keyword").length) {
		$('#keyword,#keyword2').keyup(function () {
			var ten = $(this).val();
			if ($(this).val().length > 1) {
				$.ajax({
					url: 'ajax/search',
					type: 'post',
					data: {ten: ten},
					success: function (kq) {
						if (kq != '') {
							if ($('.results').length) $('.results').fadeIn()
							$('.search_auto').html(kq).show();
						} else {
							if ($('.results').length) $('.results').fadeOut()
							$('.search_auto').hide();
						}
					},
					complete: function () {
						loader();
						setTimeout(function () {
							//fixEdImages();
						}, 100)
					},
				});
			} else {
				$('.search_auto').hide();
			}
		});
	}
};
NN_FRAMEWORK.Lazy = function () {

};


/* xemnhanh product detail */
NN_FRAMEWORK.xemnhanh_sanpham = function () {
	/*	$("body").on("click", ".xemnhanh", function () {
			var id = $(this).data("id");

			if (id) {
				$.ajax({
					url: 'ajax/ajax_xemnhanh.php',
					type: "POST",
					dataType: 'html',
					async: false,
					data: {id: id},
					success: function (result) {
						$("#popup-pro-detail .modal-body").html(result);
						$('#popup-pro-detail').modal('show');
						MagicZoom.refresh("Zoom-1");
						NN_FRAMEWORK.OwlProDetail();
					}
				});
			}
		});*/
};

/* Cart */
NN_FRAMEWORK.Cart = function () {
	$("body").on("click", ".addcart", function () {
		var mau = ($(".color-pro-detail input:checked").val()) ? $(".color-pro-detail input:checked").val() : 0;
		var size = ($(".size-pro-detail input:checked").val()) ? $(".size-pro-detail input:checked").val() : 0;
		var id = $(this).data("id");
		var action = $(this).data("action");
		var quantity = ($(".qty-pro").val()) ? $(".qty-pro").val() : 1;
		
		if (id) {
			$.ajax({
				url: site_url() + "ajax/ajax_cart",
				type: "POST",
				dataType: 'json',
				async: false,
				data: {cmd: 'add-cart', id: id, mau: mau, size: size, quantity: quantity},
				success: function (result) {
					if (action == 'addnow') {
						$('.count-cart').html(result.max);
						$.ajax({
							url: site_url() + "ajax/ajax_cart",
							type: "POST",
							dataType: 'html',
							async: false,
							data: {cmd: 'popup-cart'},
							success: function (result) {
								if ($('#my-gifts').length) {
									$('#my-gifts').html(decode(result.html_gitfs||""));
								}
								$("#popup-cart .modal-body").html(result);
								$('#popup-cart').modal('show');
							}
						});
					} else if (action == 'buynow') {
						window.location = CONFIG_BASE + "gio-hang";
					}
				}
			});
		}
	});
	
	$("body").on("click", ".del-procart", function () {
		if (confirm(LANG['delete_product_from_cart'])) {
			var code = $(this).data("code");
			var ship = $(".price-ship").val();
			
			$.ajax({
				type: "POST",
				url: site_url() + 'ajax/ajax_cart',
				dataType: 'json',
				data: {cmd: 'delete-cart', code: code, ship: ship},
				success: function (result) {
					
					if($('#my-gifts').length) {
						$('#my-gifts').html(decode(result.html_gitfs||""));
					}
					
					
					$('.count-cart').html(result.max);
					if (result.max) {
						$('.price-temp').val(result.temp);
						$('.load-price-temp').html(result.tempText);
						$('.price-total').val(result.total);
						$('.load-price-total').html(result.totalText);
						$(".procart-" + code).remove();
					} else {
						$(".wrap-cart").html('<a href="javascript:void(0);" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>' + LANG['no_products_in_cart'] + '</p><span>' + LANG['back_to_home'] + '</span></a>');
					}
				}
			});
		}
	});
	
	$("body").on("click", ".btn-cart", function () {
		//$('.load-cart').addClass('load_active')
	});
	
	$("body").on("click", ".counter-procart", function () {
		var $button = $(this);
		var quantity = 1;
		var input = $button.parent().find("input");
		var id = input.data('pid');
		var code = input.data('code');
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") quantity = parseFloat(oldValue) + 1;
		else if (oldValue > 1) quantity = parseFloat(oldValue) - 1;
		$button.parent().find("input").val(quantity);
		update_cart(id, code, quantity);
	});
	
	$("body").on("change", "input.quantity-procat", function () {
		var quantity = $(this).val();
		var id = $(this).data("pid");
		var code = $(this).data("code");
		update_cart(id, code, quantity);
	});
	
	if ($(".select-city-cart").length) {
		$(".select-city-cart").change(function () {
			var id = $(this).val();
			load_district(id);
			load_ship();
		});
	}
	
	if ($(".select-district-cart").length) {
		$(".select-district-cart").change(function () {
			var id = $(this).val();
			load_wards(id);
			load_ship(0, 0, 0);
		});
	}
	
	if ($(".select-wards-cart").length) {
		$(".select-wards-cart").change(function () {
			let id_city = $('#city').val();
			let id_district = $('#district').val();
			let id_wards = $(this).val();
			load_ship(id_city, id_district, id_wards);
		});
	}
	
	if ($(".payments-label").length) {
		$(".payments-label").click(function () {
			var payments = $(this).data("payments");
			$(".payments-cart .payments-label, .payments-info").removeClass("active");
			$(this).addClass("active");
			$(".payments-info-" + payments).addClass("active");
		});
	}
	
	if ($(".color-pro-detail").length) {
		$(".color-pro-detail").click(function () {
			$(".color-pro-detail").removeClass("active");
			$(this).addClass("active");
			
			var id_mau = $("input[name=color-pro-detail]:checked").val();
			var idpro = $(this).data('idpro');
			
			/*		$.ajax({
						url: 'ajax/ajax_color.php',
						type: "POST",
						dataType: 'html',
						data: {id_mau: id_mau, idpro: idpro},
						success: function (result) {
							if (result != '') {
								$('.left-pro-detail').html(result);
								MagicZoom.refresh("Zoom-1");
								NN_FRAMEWORK.OwlProDetail();
							}
						}
					});*/
		});
	}
	
	if ($(".size-pro-detail").length) {
		$(".size-pro-detail").click(function () {
			$(".size-pro-detail").removeClass("active");
			$(this).addClass("active");
		});
	}
	
	if ($(".quantity-pro-detail span").length) {
		$(".quantity-pro-detail span").click(function () {
			var $button = $(this);
			var oldValue = $button.parent().find("input").val();
			if ($button.text() == "+") {
				var newVal = parseFloat(oldValue) + 1;
			} else {
				if (oldValue > 1) var newVal = parseFloat(oldValue) - 1;
				else var newVal = 1;
			}
			$button.parent().find("input").val(newVal);
			
			var gia = parseInt($('.price-new-pro-detail').data('gia'));
			
			$.ajax({
				url: site_url() + 'ajax/tinhgia',
				type: "POST",
				data: {gia: gia, sl: newVal},
				
				success: function (result) {
					if (result != '') {
						$('.price-new-pro-detail').html(result);
					}
				}
			});
			
		});
	}
};

/* Ready */


function load_them($div, $lan = 0, $where = '', $sosp = 0) {
	$.ajax({
		type: 'post',
		url: site_url() + 'ajax/load_them',
		data: {lan: $lan, where: $where, sosp: $sosp},
		success: function (kq) {
			$('' + $div + '').append(kq);
		},
		complete: function () {
			setTimeout(function () {
				//fixEdImages();
			}, 250)
		}
	});
}


$(window).load(function () {
	console.log('ckd init');
	//var Vourcher_loaded = $.cookie("Vourcher_loaded");
	var Vourcher_loaded = 0;
	if (Vourcher_loaded != 'true') {
		//load_html('voucher');
	}
	//load_html('main_menu,sub_menu');
	
	load_html('menu');
	
	
	
	$('footer').show();
	$('#footer').show();
	$('#header').show();
	if ($('.loading').length) {
		setTimeout(function () {
			$('body').removeClass('loading');
			$('.overlay').remove();
		}, 250)
	}
	
	//InitOutSiteIndex();
	//load_addon();
});


$(document).ready(function () {
	$(document).scroll(function () {
		var scroll = $(this).scrollTop();
		var topDist = $("#header").position();
		if (scroll > 99) {//99
			$('#header').addClass('fixed')
		} else {
			$('#header').removeClass('fixed')
		}
		if (!loading_html && $('#main').length) {
			console.log('loading');
			loading_html = true;
		}
	});
	
	if(!loading_html && $('#prod').length){
		loading_html = true;
		load_html('thongbao,overlay,modal');
	}
	
	
	$(document).scroll(function () {
		var scroll = $(this).scrollTop();
		var topDist = $("#header").position();
		if (scroll > 99) {//99
			$('#header').addClass('fixed')
		} else {
			$('#header').removeClass('fixed')
		}
		if (!loading_html && $('#main').length) {
			console.log('loading');
			loading_html = true;
			load_html('overlay,modal,slider_product,slider_khuyenmai,review,quangcao');
		}
		
		if (!loading_html && $('#prod').length) {
			loading_html = true;
			load_html('overlay,modal');
		}
	});
	/*$.getScript("https://www.youtube.com/iframe_api", function () {
		loadVideo();
	});*/
});
//fix bug


//Simple function that will tell if the function is defined or not
function is_function(func) {
	return typeof window[func] !== 'undefined' && $.isFunction(window[func]);
}

//usage


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
		data: {where: where},
		success: function (kq) {
			
			$('.sanpham').html(kq);
		},
	});
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

function loading_details_product($key) {
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
	
	if (!$isMobile) {
		if (document.documentElement.scrollTop > 800) {
			$("#mm-menu").addClass("fixed-mmenu");
			$("#mm-menu").removeClass("main_fix");
		} else {
			$("#mm-menu").removeClass("fixed-mmenu");
			$("#mm-menu").addClass("main_fix");
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
	console.log('home init');

	if ($('#box_sanpham').length) {
		loading_details_product('chitiet');
	}
});


if ($('#prod').length) {
	const sanpham = $('.sanpham');
	const $where = sanpham.data('where');
	const $sosp = sanpham.data('sosp');
	load_them('.loadthem_sp100', '0', $where, $sosp);
}

