<style>
		.h1_home {
		color: var(--color-red);
		font-size: 1.68rem !important;
		text-transform: uppercase;
		display: inline-block;
		font-weight: 700;
		font-family: "Montserrat", Sans-Serif;
	}
</style>
<?php $slider = $d->rawQuery("select ten$lang as ten,photo, link from #_photo where type = 'quang-cao' and hienthi > 0 order by stt,id desc");

//qq($slider);


?>

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
					<a href="<?= ($v['link'] ?? '') ?>" title="<?= $v['ten'] ?? 'CKD COS VIET NAM' ?>">
						<img
							class="img-fluid no-lazy"

							src="<?= MYSITE . UPLOAD_PHOTO_L .  ($v['photo']) ?>" alt="<?= $v['ten'] ?? 'CKD COS VIET NAM' ?>"
							title="<?= $v['ten'] ?? 'CKD COS VIET NAM' ?>"/>
					</a>
				</div>
			<?php endforeach; endif; ?>
		</div>
	</div>
</div>
