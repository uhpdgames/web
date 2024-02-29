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
<div class="<?= $fullpage; ?> p-0 pt-5" style="margin-top: -2px;">

	<?php

	if ($fullpage) {
		?>
		<div class="title-main">
			<h1 class="h1_home"><?= $title_crumb ?></h1>
		</div>
		<?php
	}

	if(!empty($isBrand) && $isBrand){
		?>
		<div class="w-100 mw-100 d-block text-content pr-2 pl-2">
			<img src="<?=@$image?>" alt="<?=$seo_alt?>" class="img-fluid">
		</div>
		<?php
	}else  if (!empty($item[0]['noidung'])):
		echo '<div class="w-100 mw-100 d-block text-content pr-2 pl-2">' . htmlspecialchars_decode($item[0]['noidung']) . '</div>';
	else:

		?>
		<div class="w-100 alert alert-warning" role="alert"><strong><?= getLang('khongtimthayketqua') ?></strong></div>

	<?php
	endif;
	?>
	<?php if ($fullpage): share_link();  ?>
		<div class="row">
			<div class="col-md-12">
				<div class="share othernews">
					<b>Bài viết khác:</b>
					<ul class="list-news-other">
						<li><a href="brand" title="Brand">Brand - 31/08/2023</a></li>
						<li><a href="gioi-thieu-thuong-hieu" title="Giới thiệu thương hiệu">Giới thiệu thương hiệu -
								23/06/2023</a></li>
						<li><a href="loi-hua-c-k-d" title="Lời hứa C-K-D">Lời hứa C-K-D - 23/06/2023</a></li>
					</ul>
					<div class="pagination-home"></div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
