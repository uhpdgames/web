<div class="all_review"></div>
<?php
$ci = &get_instance();
$ci->load->library('user_agent');
$slt = '';


 $qua_tang = $ci->session->userdata('has_quatang');
 $tui_giay = $ci->session->userdata('has_tuigiay');
if ($tui_giay == 'true') {
	$check = 'checked';
} else {
	$check = '';
}

if ($qua_tang == 'true') {

} else {

}



$num_slider = 1;
?>
<?= $breadcr; ?>
<?php
$mygia = $row_detail['giamoi'];
if(empty($mygia) || $mygia !=''){
	$mygia = $row_detail['gia'];
}

$sodanhgia = @$count_danhgia?? count($danhgia);
//if($sodanhgia ==0 || empty($sodanhgia)) $sodanhgia = @count($danhgia);

?>
<?= structuredataProduct(format_money($mygia), $row_detail['masp'], $sodanhgia, round(@$trungbinh['tb']??4, 1)) ?>

<main class="main_fix d-block mb-2" id="details">


	<section>
		<div class="wp-box" <?= $slt ?> >
			<div class="row" <?= $slt ?> >
				<div class="col-12 col-lg-6">


					<div class="wp-slider">
						<div class="slider" <?= $slt ?> >
							<div class="slider__flex">
								<div class="slider__col  justify-content-center text-center">
									<div class="slider__thumbs">
										<div class="swiper-container">
											<div class="swiper-wrapper text-center justify-content-center">
												<div class="swiper-slide ">
													<div class="slider__image">
														<img class="center img-fluid"
															 src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
															 alt="<?= $row_detail['ten'] ?>">
													</div>
												</div>
												<?php if (is_array($hinhanhsp) && count($hinhanhsp) >
													0) { ?>
													<?php foreach ($hinhanhsp as $v) {
														$num_slider++;
														?>
														<div class="swiper-slide">
															<div class="slider__image">
																<img class="cloudzoom center img-fluid"
																	 src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
																	 alt="<?= $row_detail['ten'] ?>"/>
															</div>
														</div>
													<?php }
												} ?>
											</div>
										</div>
									</div>
								</div>
								<div class="slider__images detail-swiper  justify-content-center text-center">
									<div class="swiper-container">
										<div class="swiper-wrapper album_pro2" style="height: 100%; width: 100%">
											<div class="swiper-slide h-100 h-100">
												<div class="slider__image  h-100 h-100">
													<a data-options="hint: off;" data-zoom-id="Zoom-detail"
													   id="Zoom-detail" class="MagicZoom"
													   href="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
													   title="<?= $row_detail['ten'] ?>"><img
															class="cloudzoom center img-fluid  h-100 h-100"
															src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
															alt="<?= $row_detail['ten'] ?>"></a>
												</div>
											</div>
											<?php if (is_array($hinhanhsp) && count($hinhanhsp) >
												0) { ?>
												<?php foreach ($hinhanhsp as $v) { ?>
													<div class="swiper-slide">
														<div class="slider__image">
															<a data-options="hint: off;" data-zoom-id="Zoom-detail"
															   id="Zoom-detail"
															   class="MagicZoom"
															   href="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
															   title="<?= $row_detail['ten'] ?>">
																<img class="cloudzoom center img-fluid"
																	 src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
																	 alt="<?= $row_detail['ten'] ?>"/>
															</a>
														</div>
													</div>
												<?php }

											} ?>
										</div>
									</div>
								</div>


							</div>


						</div>
					</div>


					<?php $this->load->view('page/product/review'); ?>
				</div>

				<div class="col-12 col-lg-6">
					<div class="brand">

						<?php

						$id_thuonghieu = @$row_detail['id_thuonghieu'] ?? 0;
						if (!empty($row_detail['id_thuonghieu']) && $row_detail['id_thuonghieu'] > 0) {
							$name_thuonghieu = $d->rawQueryOne("select ten$lang as ten from #_news where id=$id_thuonghieu");
							if (!empty($name_thuonghieu) && isset($name_thuonghieu['ten'])) {
								echo $name_thuonghieu['ten'];
							}
						} else {
							echo '<span></span>';
						}

						?>
					</div>

					<p class="font-weight-bold title--detail catchuoi2"><?= $row_detail['ten'] ?></p>
					<div class="row">
						<div class="col-4 detail-title cover--detail pb-1"><?= getLang('masp') ?></div>
						<div class="col-8 cover--detail"><?= (isset($row_detail['masp']) && $row_detail['masp'] != '') ? $row_detail['masp'] : '' ?></div>
						<input type="hidden" value="<?= $row_detail['id'] ?? "" ?>" id="product_id" />
					</div>
					<div class="row">
						<div class="col-4 detail-title cover--detail pb-1"><?= getLang('thetich') ?></div>
						<div
							class="col-8 cover--detail"><?= (isset($row_detail['thetich']) && $row_detail['thetich'] != '') ? $row_detail['thetich'] : '' ?></div>
					</div>
					<div class="row">
						<div class="col-4 detail-title cover--detail pb-1"><?= getLang('gia') ?></div>
						<div class="col-8 cover--detail">
							<?php if ($row_detail['giamoi']) { ?>
								<span class="price-new-pro-detail"
									  data-gia="<?= $row_detail['giamoi'] ?>"><?= format_money($row_detail['giamoi']) ?></span>
								<span class="price-old-pro-detail"><?= format_money($row_detail['gia']) ?></span>
							<?php } else { ?>
								<span class="price-new-pro-detail"
									  data-gia="<?= $row_detail['gia'] ?>"><?= ($row_detail['gia']) ? format_money($row_detail['gia']) : getLang('lienhe') ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col-4 detail-title cover--detail pb-1"><?= getLang('daban') ?></div>
						<div class="col-8 cover--detail">
							<?= $row_detail['nhaplieu_daban']??0 ?>
						</div>
					</div>
					<div class="row">
						<div class="col-4 detail-title cover--detail"><?= getLang('soluong') ?></div>
						<div class="col-4 mt-1">
							<div class="d-block">


								<div class="quantity-pro-detail">
									<span class="quantity-minus-pro-detail_2">-</span>
									<input type="number" class="qty-pro" min="1" value="1" onblur="updateMorePrice()"/>
									<span class="quantity-plus-pro-detail_2">+</span>
								</div>
							</div>
						</div>
						<div class="col-4">

							<div class="attr-content-pro-detail-2">
								<input <?=$check?> type="checkbox" name="themtui" class="chb chb-2 themtui" id="radio-themtui"/>
								<label  for="radio-themtui"
									   class="w-100 mt-2"><?= getLang('themtui') ?></label>
							</div>

						</div>
					</div>



					<div class="add-tuigiay">

						<div id="effects_wrapper" style="display: none;">
							<div class="tile">
								<img alt="<?=$seo_alt?>" src="<?= MYSITE ?>assets/images/paper_bag.webp"
									 class="img-fluid no_lazy">
							</div>
						</div>


						<style>
							.buynow {
								height: 100%;
								width: 100%;
								font-weight: bold;
								padding: 10px 20px;
								color: white;
								background-color: #3C5B2D;
								display: inline-block;
								transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
								border: none;
							}

							.themtui:hover {
								display: block;
							}

							.add-tuigiay {
								position: absolute;
								right: 1.5rem;
								width: 8rem;
								top: 4.5rem;
								z-index: 0;
							}

							#effects_wrapper {
								width: 100%;
								display: flex;
								gap: 32px;
								align-items: center;
								justify-content: center;
								flex-wrap: wrap;
							}


							#effects_wrapper .tile {
								outline: 2px solid #e0e0e0e0;
								background-color: white;
								/* background-color: white; */
								/* text-align: center; */
								/* width: 80px; */
								height: auto;
								/* padding: 40px; */
								display: flex;
								flex-direction: column;
								justify-content: center;
								align-items: center;
								position: relative;
								box-shadow: 1px 10px 20px rgba(0, 0, 0, .1);
								border-radius: 8px;

							}

							[type="checkbox"]:not(:checked),
							[type="checkbox"]:checked {
								position: absolute;
								left: 0;
								opacity: 0.01;
							}

							[type="checkbox"]:not(:checked) + label,
							[type="checkbox"]:checked + label {
								position: relative;
								/*padding-left: 2.3em;
								font-size: 1.05em;
								line-height: 1.7;*/
								cursor: pointer;
							}

							/* checkbox aspect */
							[type="checkbox"]:not(:checked) + label:before,
							[type="checkbox"]:checked + label:before {
								content: '';
								position: absolute;
								left: 0;
								top: 0;
								width: 1.4em;
								height: 1.4em;
								border: 1px solid #aaa;
								background: #FFF;
								border-radius: 50%;
								box-shadow: inset 0 1px 3px rgba(0, 0, 0, .1), 0 0 0 rgba(203, 34, 237, .2);
								-webkit-transition: all .275s;
								transition: all .275s;
							}

							/* checked mark aspect */
							[type="checkbox"]:not(:checked) + label:after,
							[type="checkbox"]:checked + label:after {
								content: '\2713';
								position: absolute;
								top: .35em;
								left: .18em;
								font-size: 1.5em;
								color: #CB22ED;
								line-height: 0;
								-webkit-transition: all .2s;
								transition: all .2s;
							}

							/* checked mark aspect changes */
							[type="checkbox"]:not(:checked) + label:after {
								opacity: 0;
								-webkit-transform: scale(0) rotate(45deg);
								transform: scale(0) rotate(45deg);
							}

							[type="checkbox"]:checked + label:after {
								opacity: 1;
								-webkit-transform: scale(1) rotate(0);
								transform: scale(1) rotate(0);
							}

							/* Disabled checkbox */
							[type="checkbox"]:disabled:not(:checked) + label:before,
							[type="checkbox"]:disabled:checked + label:before {
								box-shadow: none;
								border-color: #bbb;
								background-color: #e9e9e9;
							}

							[type="checkbox"]:disabled:checked + label:after {
								color: #777;
							}

							[type="checkbox"]:disabled + label {
								color: #aaa;
							}

							/* Accessibility */
							[type="checkbox"]:checked:focus + label:before,
							[type="checkbox"]:not(:checked):focus + label:before {
								box-shadow: inset 0 1px 3px rgba(0, 0, 0, .1), 0 0 0 6px rgba(203, 34, 237, .2);
							}

						</style>
						<script>
							if($('.themtui').is(":checked")){
								$('#effects_wrapper').show();
							}

							const checkbox = document.getElementById('radio-themtui')

							checkbox.addEventListener('change', (event) => {
								if (event.currentTarget.checked) {
									$('#effects_wrapper').show();

								} else {
									$('#effects_wrapper').hide();
								}
							})



						</script>


					</div>


					<!--TODO QUA TANG KEM THEO-->
					<?php $this->load->view('page/product/gifts'); ?>

					<!--TODO VOUCHER-->
					<?php $this->load->view('page/product/voucher'); ?>

					<!--TODO fast_delivery-->
					<?php $this->load->view('page/product/fast_delivery'); ?>

					<!--TODO CART-->
					<div class="wp-cart-add">

						<div class="row">

							<div class="col-12">
								<div class="share-link" style="position: absolute; left: 0;top: -1rem;">
									<?=share_link()?>
								</div></div>
						</div>
						<div class="m-0 p-0 d-flex flex-row flex-wrap justify-content-end mb-2">
							<a
								class="btn btn-primary transition addnow addcart text-decoration-none"
								target="_blank"
								data-id="<?= $row_detail['id'] ?>"
								style="border-radius:5px; width: 4rem; height: auto;border: 1px solid #3c5b2d;   background-color: #fff; color: white; padding: 10px 10px; text-decoration: none;"
							>
								<img src="<?= site_url(); ?>assets/icon/cart.png" width="25px" height="25px"/>
							</a>
							<a
								class=" ml-2 btn btn-primary transition text-decoration-none"
								target="_blank"
								href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>"
								style="border-radius:5px; font-weight: bold; background-color: #118acb; color: white; padding: 10px 20px; text-decoration: none;"
							>
								Zalo
							</a>
						</div>

						<div class="row justify-content-end align-items-center text-center">

							<div class="col-12 ml-0 pl-0">
								<a
									class="w-100 d-block btn btn-primary buynow addcart text-decoration-none left"
									data-id="<?= $row_detail['id'] ?>"
									data-action="buynow"
								>
									<span><?= getLang('dathang') ?></span>
								</a>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="mb-5">

	</section>
	<section class="mt-5 mx-4">

	</section>
	<section>
		<?php $this->load->view('page/product/details'); ?>
	</section>

</main>

<script>

	var total_slider = '<?=$num_slider?>';
</script>
<style>
	.all_review {
		z-index: 99999999999 !important;
	}

	.img_post {
		height: 10rem;
		width: 100%;
	}

	/* CSS cho thanh điều hướng và các tab */
	@media (max-width: 767.98px) {
		.cover-nav-link {
			margin-top: 0.5rem !important;
			padding: 0.6rem 0.4rem !important;
		}

		#navbar {
			top: 94px !important;
		}
	}


	.thumb_sp_nav {
		width: 7rem;
		height: auto;
	}

	.not_fixed {
		font-size: 1.2rem;
		padding: 8px 15px !important;
		/* background-color: #eee !important; */
		border: 1px solid #eee !important;
		margin-right: 1px;
	}

	#navbar {
		/* position: fixed; */
		top: 0;
		width: 100%;
		background-color: #fff;
		z-index: 99; /* Đảm bảo hiển thị trên cùng */
		/* box-shadow: 0 2px 5px #dfdbdb; */
	}

	.nav-tabs {
		list-style-type: none;
		margin: 0;
		padding: 0;
		display: flex;
		border-bottom: none !important;
	}

	.nav-item {
		/* margin-right: 10px; */
	}

	.nav-link {
		margin-bottom: 7% !important;
		/* color: #fff; */
		/* background-color: gray; */
		text-decoration: none;
		/* padding: 15px 19px; */
		/* border-radius: 4px; */
		transition: background-color 0.3s ease;
	}

	.nav-link:hover {
		color: #3d5c16;
		/* border-color: gray !important; */
		background-color: #eee !important;

	}

	.nav-link.active {
		/* padding: 15px 19px; */
		/* margin-bottom: 7% !important; */
		/* background-color: #3d5c16 !important; */
		color: #3d5c16 !important;
		border-color: #fff !important;
		/* bỏ border trên cùng */
		border-top: none !important;
		border-bottom: 2px solid #3d5c16 !important;

	}

	.nav-tabs .nav-link {
		border: 1px solid transparent;
		border-top-left-radius: 0rem !important;
		border-top-right-radius: 0rem !important;
	}

	/* CSS cho các phần */
	.section {
		/* height: 100vh; */
		display: flex;
		justify-content: center;
		align-items: center;
		/*font-size: 3em;*/
		font-size: 1rem;
		scroll-margin-top: 50px; /* Tạo khoảng trống trên cùng để không che phần content */
	}

	.section:nth-child(even) {
		/* background-color: #f0f0f0; */
	}

	.frame-sesson-1 {
		/* padding: 0px 1%; */
		/* margin: 0px 4%;
	  }

	  .container.relative {
		display: flex;
		align-items: center;
		justify-content: space-between;
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.info_sp_nav {
		display: flex;
		align-items: center;
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.block_info_sp_nav {
		margin-left: 20px; /* Điều chỉnh khoảng cách giữa các phần tử */
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.block_add_to_cart_nav {
		display: flex;
		align-items: center;
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.block_add_to_cart_nav .btn {
		margin-left: 20px; /* Điều chỉnh khoảng cách giữa các phần tử */
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.title_nav {
		font-weight: 700;
		font-size: 14px;
		margin-bottom: 5px;
	}

	.block_price_nave {
		font-size: 14px;
		color: #3c5b2d;
		display: inline-block;
	}

	.txt_brand_name_nav {
		font-weight: 700;
		font-size: 14px;
		color: #326e51;
	}

</style>
<style>
	.slider__flex {
		min-height: 0;
		height: 100%;
		max-height: unset;
	}

	.bao_danhgia .dg2 p span b {
		max-width: 100%;
	}

	.wp-review, .wp-review .slider__flex, .wp-review .img-review {
		/*min-height: 12rem;
		height: 10rem;
		max-height: 15rem;
		width: 100%;*/
	}

	.img-review {
		width: 35rem !important;
	}

	.slider-img {
		position: relative;
		display: block;
		width: 12rem;
		height: 12rem;
		/*background-color: blue;*/
		/*border: 2px solid red;*/
	}

	.slider-img img {
		display: block;
		width: 100%;
		max-width: 100%;
		max-height: 100%;
		height: 100%;
		/* object-fit: contain; */
		object-fit: cover;
	}

	.review-swiper img {
		/*height: 15rem;
		max-height: 20rem;
		width: auto;*/
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.brand {
		color: #4fad8b;
		border: 1px solid #4fad8b;
		padding: 0 7px !important;
		font-size: 12px;
		width: fit-content;
		height: auto;
		margin: 0;
	}

	.title--detail {
		padding-top: 5px !important;
		font-size: 1.2rem !important;
		color: var(--color-red);
		line-height: 1;
	}

	.title--detail--1 {
		padding-top: 5px !important;
		font-size: 1.2rem !important;
		color: var(--color-red);
		line-height: 1;
	}

	.slider {
		padding: 0;
		margin: 0;
		color: #fff;
	}

	.slider .swiper-container {
		width: 100%;
		height: 100%;
	}

	.slider__flex {
		display: flex;
		align-items: flex-start;
	}

	.slider__col {
		display: flex;
		flex-direction: column;
		width: 100px;
		min-width: 100px;
		max-width: 100px;
		height: auto;

		margin: auto 1rem;
	}

	.slider_empty {
		width: 5rem;
		min-width: 5rem;
	}

	.slider__prev,
	.slider__next {
		display: none;
		cursor: pointer;
		text-align: center;
		font-size: 14px;
		height: 48px;
		/*display: flex;*/
		align-items: center;
		justify-content: center;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	.slider__prev:focus,
	.slider__next:focus {
		outline: none;
	}

	.slider__thumbs {
		/*//8*4+400*/
		/**/
		height: calc(400px - 100px);
		padding: 0;
		margin: 0;
	}

	.slider__thumbs .swiper-slide {
		height: 100%;
	}

	.slider__thumbs .slider__image {
		transition: 0.25s;
		/*	-webkit-filter: grayscale(100%);
			filter: grayscale(100%);
			opacity: 0.5;*/
	}

	.slider__thumbs .slider__image:hover {
		opacity: 1;
	}

	.slider__thumbs .slider__image {
		border-radius: 50%;
	}

	.slider__thumbs .swiper-slide-thumb-active .slider__image {
		/*	-webkit-filter: grayscale(0%);
			filter: grayscale(0%);
			opacity: 1;*/
	}

	.slider .slider__images {
		height: 40rem;
		min-height: 40rem;
		max-height: 40rem;
		width: auto;
	}

	.slider__images .slider__image img {
		transition: 3s;
	}

	.slider__images .slider__image:hover img {
		transform: scale(1.1);
	}

	.slider__images .slider__image {
		border-radius: 0;
	}

	.slider__image {
		width: 100%;
		/*height: auto;*/
		height: 100%;
		overflow: hidden;
	}

	.slider__thumbs .slider__image {
		border-radius: 50%;
		width: 100%;
		height: 100%;
		/*	width: 70%;*/
	}

	.slider__image img {
		display: block;
		width: 100%;
		height: 100%;
		-o-object-fit: cover;
		object-fit: cover;
	}

	@media (max-width: 767.98px) {

		.img_post {

			height: 6rem;
		}

		.slider-img {

			width: 6rem;
			height: 6rem;
			/*background-color: blue;*/
			/*border: 2px solid red;*/
		}

		.slider .slider__images {
			height: 100%;
			width: 100%;
		}

		.slider__flex {

			flex-direction: row;
			/* flex-direction: column-reverse; */
		}

		.slider__col {
			flex-direction: column;
			/* flex-direction: row; */
			align-items: center;
			margin-right: 0;
			/* margin-top: 24px; */
			margin: 0;
			margin-top: 0;
			margin-left: 0;
			width: 100%;
			height: 100%;
		}

		.slider__images {
			width: 100%;
		}

		.slider__thumbs {
			height: 18rem;
			width: 6rem;
			margin-left: 2rem;
			/* margin: 0 16px; */
		}

		.slider_empty {
			display: none;
		}

		.slider .slider__images {
			/* height: 30.5rem !important;	 */
			min-height: 0rem !important;
			/* width: auto; */
		}

		.slider__prev,
		.slider__next {
			height: auto;
			width: 32px;
		}

		.slider__images .slider__image {
			border-radius: 0;
			width: 70%;
		}

		.slider__thumbs .slider__image {
			border-radius: 50%;
			width: 62%;
		}

		.grid-pro-detail {
			margin-bottom: 0;
		}

		.slider__images {
			min-height: 0rem;
		}
	}

	.wp-slider .swiper-slide:first-child {
		margin-top: 1rem;
	}

	.slider-img.img_post {
		margin-top: 0 !important;
	}
</style>

<link rel="stylesheet" href="<?= MYSITE ?>assets/css/product.css?v=<?= random_string() ?>"/>
<input type="hidden" value="<?= $row_detail['id'] ?>" id="pid"/>
<link rel="stylesheet" href="<?= MYSITE ?>assets/magiczoomplus/magiczoomplus.css?v=<?= random_string() ?>"/>
<script src="<?= MYSITE ?>assets/magiczoomplus/magiczoomplus.js?v=<?= random_string() ?>"></script>
<script src="<?= MYSITE ?>/assets/swiper/swiper-bundle.min.js?v=<?= random_string() ?>"></script>
<link rel="stylesheet" href="<?= MYSITE ?>/assets/swiper/swiper-bundle.min.css?v=<?= random_string() ?>"/>

<link rel="stylesheet" href="<?= MYSITE ?>assets/mCustomScrollbar/mCustomScrollbar.min.css">
<script src="<?= MYSITE ?>assets/mCustomScrollbar/mCustomScrollbar.min.js"></script>


<script>
	(function ($) {
		$(window).on("load", function () {
			$(".content").mCustomScrollbar();
		});
	})(jQuery);
</script>

<script>


	function isEven(n) {
		return n % 2 == 0;
	}

	var slider = 3;
	if (isEven(total_slider)) {
		slider = 4;
	} else {
		slider = 3;
	}

	const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
		direction: "vertical",
		slidesPerView: slider,
		centeredSlides: false,
		roundLengths: true,
		spaceBetween: 16,
		navigation: {
			nextEl: ".slider__next",
			prevEl: ".slider__prev",
		},
		autoplay: {
			delay: 3500,
		},
		freeMode: true,
		breakpoints: {
			0: {
				slidesPerView: slider,
				direction: "vertical",
			},
			768: {
				slidesPerView: slider,
				direction: "vertical",
			},
			990: {
				slidesPerView: slider,
				direction: "vertical",
			},
		},
	});

	const sliderImages = new Swiper(".slider__images.detail-swiper .swiper-container", {
		autoplay: {
			delay: 3500,
		},
		direction: "vertical",
		slidesPerView: 1,
		spaceBetween: 10,
		mousewheel: true,
		navigation: {
			nextEl: ".slider__next",
			prevEl: ".slider__prev",
		},
		grabCursor: true,
		thumbs: {
			swiper: sliderThumbs,
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 10,
				direction: "horizontal",
			},
			768: {
				slidesPerView: 1,
				spaceBetween: 10,
				direction: "vertical",
			},
		},
	});

	const sliderReivew = new Swiper('.review-swiper', {
		direction: "horizontal",
		slidesPerView: 4,
		spaceBetween: 0,
		freeMode: true,
		loop: true,
		autoplay: {
			delay: 3000,
		},
	});


	setTimeout(function () {

		$(".slider__thumbs").css({"height": "calc(" + ((slider * 100) + 100) + "px - 100px)"});

	}, 250)
</script>


<style>

	.slider__thumbs .swiper-wrapper .swiper-slide:first-child {

	}

	#scrollable {
		height: 1000px;
		overflow: scroll;
		position: relative;
		overflow-x: hidden;
	}
</style>

<script>
	// Code goes here

	document.addEventListener('DOMContentLoaded', function () {
		setTimeout(function () {
			var hash = document.location.hash;
			if (hash) {
				$([document.documentElement, document.body]).animate({
					scrollTop: $(hash).offset().top
				}, 500, function () {


					window.location.hash = hash;
				});
			}
		}, 500);
	})

	$(document).ready(function () {


		var loading = false;

		load_san_pham_cung_loai();

		function load_san_pham_cung_loai(_this) {

			const where = $(_this).data('where') || "<?=$where?>";
			const sosp = $(_this).data('solan') || "<?=$sosp?>";

			if (!loading) {
				loading = true;
				load_them('.loadthem_sp100', 0, where, sosp);
			}
		}


		$('.nav-link.cover-nav-link').on('click', function (e) {

			e.preventDefault();

		})


		$('[data-spy="scroll"]').each(function () {
			var $spy = $(this).scrollspy('refresh');
		});

		$('#target_nav').on('activate.bs.scrollspy', function () {
			var activeTab = $('.nav-tabs li.active a');
			activeTab.parent().removeClass('active');
			activeTab.tab('show');
		});


		setTimeout(fixEdImages, 1500);

		const checkbox = document.getElementById('radio-themtui')
		checkbox.addEventListener('change', (event) => {
			$check = event.currentTarget.checked;
			$.ajax({
				type: "post",
				url: site_url() + "ajax/sethasTuiGiay",
				data: {has_tuigiay: $check},
				beforeSend: function () {
				},
			})
		})


		$('.chosen_gift').on('click', function(e) {
			var qua = $(this).val();
			var id = $('#product_id').val();
			var img =$(this).data('img');

			$.ajax({
				type: "post",
				url: site_url() + "ajax/sethasQuaTang",
				data: {
					has_quatang: qua,
					img: img,
					id: id,
				},
				beforeSend: function () {
				},
			})
		});

	});
</script>

<script>
	// JavaScript để xử lý Scrollspy
	window.addEventListener("scroll", function () {
		const sections = document.querySelectorAll(".section");
		let currentSection = "";

		sections.forEach((section) => {
			const sectionTop = section.offsetTop - 0;
			const sectionHeight = section.clientHeight;
			if (
				pageYOffset >= sectionTop &&
				pageYOffset < sectionTop + sectionHeight
			) {
				currentSection = section.getAttribute("id");

				console.log(currentSection);
			}
		});

		const navLinks = document.querySelectorAll(".nav-link");

		// khi click vào tab thì sẽ scroll đến section tương ứng và active tab đó ngay lập tức và khi scroll thì tab đó sẽ active theo section tương ứng
		navLinks.forEach((link) => {
			link.addEventListener("click", () => {
				for (let i = 0; i < navLinks.length; i++) {
					navLinks[i].classList.remove("active");
					console.log(navLinks[i]);
				}
				link.classList.add("active");
				const target = link.getAttribute("href").substring(1);
				const targetSection = document.getElementById(target);
				window.scrollTo({
					top: targetSection.offsetTop - 0,
					behavior: "smooth",
				});
			});
		});

		navLinks.forEach((link) => {

			link.classList.remove("active");
			if (link.getAttribute("href").substring(1) == (currentSection)) {
				link.classList.add("active");
			}
		});

		const navbar = document.getElementById("navbar");
		const cover_nav_link = document.querySelectorAll(".cover-nav-link");
		var block = $('#details').outerHeight();


		var spnarbar = document.getElementById('spnarbar');


		if (document.documentElement.scrollTop > 1000) {
			$('#navbar').addClass('fixed');
			$('#spnarbar').show();
		} else {
			$('#navbar').removeClass('fixed');
			$('#spnarbar').hide();
		}
		//spnarbar.style.display = "block";
		if (window.scrollY > block) {
			//  cover-nav-link thêm class not_fixed
			cover_nav_link.forEach((link) => {
				link.classList.remove("not_fixed");
				link.classList.remove("fix-padding-one");

			});

			navbar.style.position = "fixed";
			//box-shadow: 0 2px 5px #dfdbdb
			navbar.style.boxShadow = "0 2px 5px #dfdbdb";
			spnarbar.style.display = "block";


		} else {
			cover_nav_link.forEach((link) => {
				link.classList.add("not_fixed");
				link.classList.add("fix-padding-one");
			});

			navbar.style.position = "static";
			//	navbar.style.boxShadow = "none";
			//spnarbar.style.display = "none";
		}
	});
</script>


<style>
	.chosen_gift{
		position: absolute;
		margin-top: 1rem;
		margin-left: -1.25rem;
		width: 1.5rem;
		height: 1.5rem;
	}
	img.center {
		display: block;
		margin: 0 auto;
	}


	.swiper {
		width: 100%;
		height: 100%;
	}


	.swiper .swiper-slide {
		height: auto;
	}

	.swiper-slide img {
		display: block;
		width: 100%;
		height: 100%;
		object-fit: cover;

		/*box-shadow: 0px 0px 10px -3px rgba(0, 0, 0, 0.225);*/
	}

	.slider .slider__images img {
		height: 100%;
		width: 100%;
		object-fit: contain;
	}


	/*
		@media (max-width: 1366px) {
			!*.slider .slider__images{
				height: 26rem;
				min-height: 26rem;
				max-height: 26rem;
			}*!
			!*.slider__col{
				width: 6rem;
				min-width: 6rem;
				max-width: 6rem;
			}
			.slider__thumbs{
				height: 26rem;
			}*!
		}
		@media (max-width: 990px) {
			.slider .slider__images{
				height: 26rem;
				min-height: 26rem;
				max-height: 26rem;
			}
			!*.slider__col{
				width: 6rem;
				min-width: 6rem;
				max-width: 6rem;
			}
			.slider__thumbs{
				height: 26rem;
			}*!
		}
		@media (max-width: 768px) {
			!*.slider .slider__images{
				height: 20rem;
				min-height: 20rem;
				max-height: 20rem;
			}

			.slider__col{
				width: 3rem;
				min-width: 3rem;
				max-width: 3rem;
			}
			.slider__thumbs{
				height: 16rem;
			}*!

		}
		@media (max-width: 450px) {
			!*.slider .slider__images{
				height: 20rem;
				min-height: 20rem;
				max-height: 20rem;
			}

			.slider__col{
				width: 3rem;
				min-width: 3rem;
				max-width: 3rem;
			}
			.slider__thumbs{
				height: 16rem;
			}*!

		}

		*/

</style>


<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper(".mySwiper", {
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});
</script>

<!-- Demo styles -->
<style>#header .top-area,
	#header.fixed, .cate-wrap .inner {
		border: none;
	}

	#header.fixed .cate-wrap .inner,
	#header .top-area, #header .top-member {
		border-bottom: 0 !important;
	}

	#header {
		border: none;
		box-shadow: none;
	}

	span.w-100 {
		/*font-size: 1rem;*/
		color: var(--color-red);
		font-size: 1.68rem;
		text-transform: uppercase;
		display: inline-block;
		font-weight: 700;

	}


	.mySwiper .swiper {
		width: 100%;
		height: 100%;
	}

	.mySwiper .swiper-slide {
		text-align: center;


		/* Center slide text vertically */
		display: -webkit-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-align-items: center;
		align-items: center;
	}

	.mySwiper .swiper-slide img {
		display: block;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.mySwiper .swiper {
		margin-left: auto;
		margin-right: auto;
	}

	.mySwiper .swiper-button-prev {
		background-image: none !important;
		color: #3C5B2D !important;
	}

	.mySwiper .swiper-button-next {
		background-image: none !important;
		color: #3C5B2D !important;
		width: 50px !important;
	}

	.mySwiper .swiper-pagination-bullet-active {
		border-radius: 11px;
		background: #3C5B2D !important;
		padding-left: 26px !important;
		padding-right: 5px !important;
	}


	.fixed {
		display: block !important;
		position: fixed !important;
		/*		top: -10rem;
				width: 100%;
				background-color: #fff;*/
		/*		z-index: 999;
				height: 22rem;
				padding-top: 12rem;*/
		/*	box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.02);*/
	}

	html {
		scroll-behavior: smooth !important;
	}

	.swiper-pagination {
		display: none;
	}
</style>


<!--mobile ver-->
<?php ?>
