<?php

$my_proudct = get_prod();
$banchay = @$my_proudct['banchay'] ?? array();
$noibat = @$my_proudct['noibat'] ?? array();
$moi = @$my_proudct['moi'] ?? array();
$rs_banner = my_banner();
$label_banner = 'banner' . @$lang . @$m;
$slider = my_ads();
?>

<section id="banner-slider-home">
	<div class="slider" id="banner"><?= get_banner() ?></div>
</section>
<section id="cate-home">
	<div class="cate" id="cate"><?= get_slider_cate() ?></div>
</section>
<section>
	<div class="m-0">
		<a title="CKD COS VIET NAM" href="<?= @$rs_banner[$label_banner]['link'] ?>" class="<?= $label_banner ?>"><img
				class="img-fluid w-100 img-lazy" src="<?= image_default() ?>"
				data-src="<?= MYSITE . UPLOAD_PHOTO_L . @$rs_banner[$label_banner]['photo'] ?>" alt="<?= $seo_alt ?>"></a>
	</div>
</section>
<section id="product-list-index">
	<div class="main_fix">
		<ul class="cap1">
			<li class="sw-product-cate active" data-id="noibat"><?= getLang('totnhat') ?></li>
			<li class="sw-product-cate" data-id="moi"><?= getLang('moi') ?></li>
		</ul>
		<div class="load_sp">
			<?php
			$noibat_1 = array_slice($noibat, 0, 8);
			$noibat_2 = array_slice($noibat, 8, 8);
			echo get_product_slick($noibat_1, $sluglang, true, '1');
			echo '<br/>';
			echo get_product_slick($noibat_2, $sluglang, true, '2'); ?>
			<p class="xemtatca">
				<a href="<?= site_url('san-pham/tot-nhat') ?>"><?= getLang('xemthem') ?></a>
			</p>
		</div>
	</div>

	<div class="mt-5">
		<a
			title="<?=$seo_alt?>"
			href="<?php $label_banner = 'banner2' . @$lang . @$m;
			echo @$rs_banner[$label_banner]['link'] ?>"
			class="<?= $label_banner ?>"
		>
			<img class="img-fluid w-100 img-lazy" src="<?= image_default() ?>"
				 data-src="<?= MYSITE . UPLOAD_PHOTO_L . @$rs_banner[$label_banner]['photo'] ?>"
				 alt="<?= $seo_alt ?>"/>
		</a>
	</div>
	<div class="main_fix mt-lg-5 mt-5">
		<div class="title-main">
			<h1 class="h1_home"><?= getLang('sanphamkhuyenmai') ?></h1>
		</div>
		<?php
		$banchay_1 = array_slice($banchay, 0, 8);
		$banchay_2 = array_slice($banchay, 8, 8);
		echo get_product_slick($banchay_1, $sluglang, true, '1');
		echo '<br/>';
		echo get_product_slick($banchay_2, $sluglang, true, '2'); ?>
		<p class="xemtatca">
			<a href="<?= site_url('san-pham/khuyen-mai') ?>"><?= getLang('xemthem') ?></a>
		</p>
	</div>


</section>
<section id="review-index">
	<div class="main_fix wap_review mt-5">

		<div class="title-main mt-lg-4">
			<h1 class="h1_home"><?= getLang('titlereview') ?></h1>
		</div>

		<div class="all_review"></div>

		<?php $this->load->view('common/review'); ?>

		<p class="xemtatca"><a href="review"><?= getLang('xemthem') ?></a></p>


	</div>
</section>
<section id="video-index">
	<div class="main_fix mt-lg-5" id="videolocal">
		<div class="title-main">
			<a title="<?=$seo_alt?>" href="<?= site_url('video') ?>">
				<h1 class="h1_home">VIDEO</h1>
			</a>
		</div>
		<a href="https://youtu.be/VGugPGF1Ztk?si=N61EJ3N8OWv_BhxH" target="_blank">
			<video playsinline autoplay loop muted>
				<source type="video/mp4" src="<?= site_url() ?>assets/webm/welcome.mp4?v=<?= time() ?>"/>
				<source type="video/webm" src="<?= site_url() ?>assets/webm/welcome.webm?v=<?= time() ?>"/>
				<source type="video/ogg" src="<?= site_url() ?>assets/webm/welcome.ogg?v=<?= time() ?>"/>
			</video>
		</a>
	</div>
</section>
<section id="news-index">
	<div class="container-fluid mt-5">
		<div class="title-main">
			<h1 class="h1_home"><?= getLang('thuonghieugiadinh') ?></h1>
		</div>
		<div class="quangcao">
			<!-- Slider main container -->
			<div class="swiper quangcao-swiper swiper-container" id="quangcao-swiperr">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<!-- Slides -->
					<?php if (is_array($slider) && count($slider)): foreach ($slider as $v) : ?>
						<div class="swiper-slide">
							<div class="item">
								<div class="img_sp zoom_hinh">
									<div class="image-container">
										<a href="<?= ($v['link'] ?? '') ?>"
										   title="<?= $v['ten'] ?? 'CKD COS VIET NAM' ?>">
											<img
												class="img-fluid img-lazy"
												src="<?= image_default() ?>"
												data-src="<?= MYSITE . UPLOAD_PHOTO_L . ($v['photo']) ?>"
												alt="<?= $v['ten'] ?? 'CKD COS VIET NAM' ?>"
												title="<?= $v['ten'] ?? 'CKD COS VIET NAM' ?>"
											/>

											<span class="image-text">
                                                * Bổ sung collagen và tạo độ đàn hồi cho da <br/>
                                                * Cải thiện nếp nhăn nhỏ và sâu<br/>
                                                * Cải thiện làn da và mật độ da<br/>
                                                * Giữ ẩm lâu dài trên da<br/>
                                            </span>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>


<script>

	function init_sw_review($stt) {
		new Swiper('.swiper-review' + $stt, {
			paginationClickable: true,
			slidesPerView: 2,
			spaceBetween: 16,
			 autoplay: {
				delay: 5000,
			},
			navigation: {
				nextEl: '.next',
				prevEl: '.prev',
			},
			breakpoints: {
				600: {
					slidesPerView: 3,
					spaceBetween: 16,
				},
				768: {
					slidesPerView: 4,
					spaceBetween: 16,
				},
				1024: {
					slidesPerView: 5,
					spaceBetween: 16,
				},

			}
		});
	}

	function int_swiper_prod() {
		init_sw_review(0);
		init_sw_review(1);
		init_sw_review(2);
		init_sw_review(3);


		var swiper1 = new Swiper('.swiper1', {
			pagination: '.swiper-pagination1',
			paginationClickable: true,
			slidesPerView: 2,
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
					slidesPerView: 2,
					spaceBetween: 2,
				},
				500: {
					slidesPerView: 3,
					spaceBetween: 8,
				},
				768: {
					slidesPerView: 4,
					spaceBetween: 36,
				},

			}
		});
		var swiper2 = new Swiper('.swiper2', {
			pagination: '.swiper-pagination2',
			paginationClickable: true,
			slidesPerView: 2,
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
					slidesPerView: 2,
					spaceBetween: 2,
				},
				500: {
					slidesPerView: 3,
					spaceBetween: 8,
				},
				768: {
					slidesPerView: 4,
					spaceBetween: 36,
				},

			}
		});

	}


	function init_swiper() {
		int_swiper_prod();


		var slick_banner = document.getElementById('slick_banner')
		if (typeof slick_banner != 'undefined' && slick_banner != null) {
			new Swiper("#slick_banner", {
				autoplay: {
					delay: 5000,
				},
				slidesPerView: 1,

			});

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


		if ($('.quangcao').length) {
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
	}

	$(document).ready(function () {
		if ($('.sw-product-cate').length) {
			$('.sw-product-cate').on("click", function () {
				var id = $(this).data('id');
				$('.sw-product-cate').removeClass('active');
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
						//SlickInit();

						int_swiper_prod();
					}
				})
				return false;
			})
		}

		init_swiper();
	})


</script>

<style>


	.swiper-review .swiper-wrapper {
		margin-top: 1rem !important;
	}


	.single_testimonial {
		padding: 0.225rem;
		padding-top: 0.5rem;
		max-height: 6rem;
	}

	.swiper-review .swiper-slide img {
		max-width: 100%;
		transform-origin: center;
		transform: scale(1.001);
		transition: transform 0.4s ease-in-out;
	}

	.single_testimonial {
		display: flex;
	}

	.testimonial_thumb {
		min-width: 3rem;
		width:3rem;
		margin-right: 5px;
	}

	.testimonial_thumb img {
		border-radius: 50%;
		width: 4.6875rem
	}

	.testimonial_content h3 {
		font-size: 18px;
		line-height: 18px;
		font-weight: 600;
		text-transform: capitalize;
		font-size: 18px;
		line-height: 18px;
		font-weight: 600;
		text-transform: capitalize;
		/* padding-left: 0.8rem; */
		font-weight: bold;
		font-family: "Montserrat", Sans-Serif;
		font-size: small;
		line-height: 1.5;
		/* width: 8rem; */
		margin: auto;
	}


	.testimonial_content p {


		font-size: smaller;
		font-weight: 500;

		line-height: 1.5;
	}

	.image-container {
		display: block;
		height: inherit;
		width: inherit;
		position: relative;
		cursor: pointer;
	}

	.image-container img {
		width: 100%;
		height: auto;
		border: 15px;
	}

	.image-text {
		display: none;
		position: absolute;
		top: 0;
		left: 0;
		justify-content: flex-start;
		/*display: flex;*/
		align-items: flex-start;
		color: #808080;
		font-size: 1.5rem;
		height: 100%;
		width: 100%;
		line-height: 1.5;
	}

	/*	.span-item{
			display: block;
			height: inherit;
			width: inherit;
		}
		.span-item > img {
			width: 100%;
			height: auto;
			display:block;
		}
		:root{
			--font: 1rem;
			--line: calc(var(--font) * 2);
			--move: calc(-2 * var(--line));
		}

		!*.quangcao {
			font-size: calc(1vh + 1vw + 10px);
		}*!
		.label {
			font-size: var(--font);
			line-height: var(--line);
			padding: 0 1rem;
			margin: 0;
			color: #000;
			!*background-color: hsla(0, 0%, 0%, 0.48);*!
			height: var(--line);
			!* margin-top: var(--move);
			position:relative; *!

			transform: translateY(var(--move));
			margin-bottom: var(--move);

			text-overflow:ellipsis;
			white-space: nowrap;
			overflow:hidden;
		}*/


	.image-container {
		display: block;
		height: inherit;
		width: inherit;
		position: relative;
		cursor: pointer;
	}

	.image-container img {
		width: 100%;
		height: auto;
		border: 15px;
	}

	.image-text {
		display: none;
		position: absolute;
		top: 0;
		left: 0;
		justify-content: flex-start;
		/*display: flex;*/
		align-items: flex-start;
		color: #808080;
		font-size: 1.5rem;
		height: 100%;
		width: 100%;
		line-height: 1.5;
	}

	.h1_home {
		color: var(--color-red);
		font-size: 1.68rem !important;
		text-transform: uppercase;
		display: inline-block;
		font-weight: 700;
		font-family: "Montserrat", Sans-Serif;
	}

</style>
