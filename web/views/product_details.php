<!doctype html>
<html lang="<?= $lang ?>">
<head>

    <link rel="stylesheet" href="<?= MYSITE ?>assets/css/base.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= MYSITE ?>assets/css/text.min.css?v=<?= time() ?>">


    <script src="<?= MYSITE ?>assets/swiper/swiper-bundle.min.js?v=<?= time() ?>"></script>
    <link rel="stylesheet" href="<?= MYSITE ?>assets/swiper/swiper-bundle.min.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= MYSITE ?>assets/css/product.css?v=<?= time() ?>">

    <link rel="stylesheet" href="<?= MYSITE ?>assets/magiczoomplus/magiczoomplus.css?v=<?= random_string() ?>"/>
    <script src="<?= MYSITE ?>assets/magiczoomplus/magiczoomplus.js?v=<?= random_string() ?>"></script>


    <?php $this->load->view('all/head'); ?>

    <style>
		.toolbar, span, footer {
			display: none;
		}
	</style>

</head>

<body id="prod">
<div class="wapper">
    <div class="main-container">
        <?php trimHtml('all/header'); ?>

        <div  class="clear mypage product-detail" data-view="<?= $template ?>" id="page">

            <?php $this->load->view($template); ?>
        </div>

    </div>

    <?php $this->load->view('all/under'); ?>

</div>

<div id="loader" style="display:none">
    <div class="spinner-border" role="status"></div>
</div>


<script>


</script>


<style>
    #header{
		min-height: unset !important;
	}




	#box_sanpham strong,
	#box_thanhphansanpham strong,
	#box_sanphamcungloai strong,
	#box_binhluan strong,
	#box_sanpham h2,
	#box_thanhphansanpham h2,
	#box_sanphamcungloai h2,
	#box_binhluan h2

	{
		font-weight: 500;
		font-size: 1rem;
		line-height: 1.5;
		display: block;
	}

    .wp-review .swiper-container {
        height: 8rem !important;
    }

    .row {
        margin: 0 !important;
    }

    #prod .main_fix {
        margin-top: 1rem;
    }

    .swiper-wrapper {
        height: 100%;
    }

    .gallery-container {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
        overflow: hidden;
        height: 25rem;
        gap: 1rem;
        text-align: justify;
        vertical-align: middle;
        align-items: center;
    }

    .swiper-container {
        height: 100% !important;
    }

    .gallery-main {
        width: 100%;
        height: auto;
     /*   box-shadow: 0 50px 75px 50px rgba(30, 30, 30, 0.18);*/
       /* border: 1px solid #e9e9e9;*/
    }

    .gallery-thumbs {
        order: -1;
        width: 100%
        height: auto;
        margin-right: 1rem;
        padding-left: 1rem;
    }

    .gallery-thumbs .swiper-slide img {
        transition: 0.3s;
        /*border-radius: 50%;*/
    }

    .gallery-thumbs .swiper-slide-active {
        opacity: 0.9;
    }

    .gallery-thumbs .swiper-slide-thumb-active {
        opacity: 1;
    }

    .gallery-thumbs .swiper-slide-thumb-active img {
       /* margin-left: -15px;*/
    }

    /**
     * Optionnal
     */

    @-webkit-keyframes slide-in {
        from {
            opacity: 0;
            right: -50%;
        }
    }

    @keyframes slide-in {
        from {
            opacity: 0;
            right: -50%;
        }
    }


    @media (max-width: 991px) {
        .wp-review .swiper-container {
            height: 5rem !important;
        }

        .gallery-thumbs {
            order: 1;
            width: 100%

        }

        .gallery-container {
            height: auto;
        }

        .gallery-main, .gallery-container {
            margin: 0 !important;
        }

        .gallery-main .swiper-wrapper {
            width: 100% !important;
        }

        .gallery-main img {
            max-height: 37.5rem !important;
            max-width: 37.5rem !important;
        }

    }


</style>
<script defer src="<?= MYSITE ?>assets/js/ckd.js?v=<?= time() ?>"></script>

<script>
	$(document).ready(function() {
		$('.box-input-vouchers').remove();

		$('.mCustomScrollbar').attr('style', '');

	});

	document.addEventListener('DOMContentLoaded', function () {


		setTimeout(function () {
			$('header').show();
		}, 10);
		setTimeout(function () {
			$('#page').show();
		}, 30);
		setTimeout(function () {
			$('span').show();
		}, 40);
		setTimeout(function () {
			$('footer').show();
		}, 400);

		setTimeout(function () {
			$('.toolbar').show();
		}, 500);


	})

</script>
</body>
</html>


