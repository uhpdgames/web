<?= $breadcr;
//ww($this->uri->segment(1));

//het_han

$isSukien = $this->uri->segment(1) == 'su-kien';


?>
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

<div class="clear main_fix">
	<div class="title-main">
		<h1 class="h1_home"><?= $title_crumb ?></h1>
	</div>
	<div class="row w-100 h-auto"
		 style="margin-left: 0px !important;"
	>
		<!--Collapse-->
		<div class="col-12 col-md-4 m-md-0 p-md-0 pc">

			<div class="ckd-blog">
				<div class="news-latest">
					<div class="sidebarblog-title title_block"
						 data-toggle="collapse" href="#collapseExample" role="button"
						 aria-expanded="true" aria-controls="collapseExample"
						 style="cursor: pointer"
					>
						<h2>
							<?= $this->router == 'su-kien' ? getLang('sukiennoibat') : getLang('tintucnoibat') ?>
						</h2>
					</div>

					<div id="collapseExample" class="list-news-latest layered collapse show">

						<div class="w-100 item-article clearfix">

							<?php

							if (is_array($news) && count($news)) {
								foreach ($news as $k => $v) {
									//  qq(UPLOAD_NEWS_L . $value['photo']);
									?>
									<div class="w-100 d-flex flex-row flex-wrap h-rem align-items-center text-left">
										<div class="post-image">
											<div class="zoom_hinh item_img">
												<a href="<?php echo $router . '/' . $v[$sluglang] ?>">
													<img
														class="img-fluid"
														src="<?php echo UPLOAD_NEWS_L . $v['photo']; ?>"
														alt="<?= $v['ten'] ?>"></a></div>
										</div>

										<div class="post-content">
											<h3><a class="name_post catchuoi2"
												   href="<?php echo $router . '/' . $v[$sluglang] ?>"><?= ucfirst(mb_strtolower($v['ten'])) ?></a>
											</h3>

											<span
												class="name_post catchuoi3"><?= strip_tags_content($v['mota'] ?? '') ?></span>

										</div>
									</div>
								<?php }
							}
							?>

						</div>

					</div>


				</div>
			</div>


		</div>


		<div class="col-12 col-md-8 m-md-0 p-md-0">
			<div class="w_1000">
				<div class="list-group">
					<?php
					if (is_array($item) && count($item)) {
						foreach ($item as $value) {
							//  qq(UPLOAD_NEWS_L . $value['photo']);
							$img = UPLOAD_NEWS_L . $value['photo'];

							$classHetHan = '';
							if ($isSukien && $value['het_han'] == 1) {
								$classHetHan = 'outdate';
							}

							?>
							<div class="item_news m-2 m-md-0 p-0">
								<div class="row m-0 p-0">
									<div class="col-md-6 m-0 p-0">
										<a href="<?= $router ?>/<?= @$value['tenkhongdauvi'] ?>" target="_self"
										>
											<div class="zoom_hinh fix_frame_news_img_left <?= $classHetHan ?>">
												<img src="<?php echo $img; ?>"
													 class="image-fluid fix__img_news_img_left"/>
											</div>
										</a>
									</div>
									<div class="col-md-6 m-0 p-0">
										<div class="fix_frame_news_content_left">
											<h3>
												<a class="name_post catchuoi2"
												   href="<?= $router ?>/<?= @$value['tenkhongdauvi'] ?>"><?= @$value['ten'] ?></a>
											</h3>
											<div class="desc_post catchuoi6">
												<?= htmlspecialchars_decode(@$value['mota'] ?? "") ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php
						} ?>

						<?php ?>
						<?php ?>
						<?php


					} else {
						?>
						<div class="w-100 alert alert-warning" role="alert">
							<strong><?= getLang('khongtimthayketqua') ?></strong>
						</div>
						<?php
					} ?>

				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>

</div>


<style>
	.outdate { opacity: 1; position: relative; } .outdate:after { opacity: .5; position: absolute; width: 100%; height: 100%; content: ""; z-index: 1; background-color: azure; top: 0; left: 0; } .outdate:before { opacity: 1; content: "SỰ KIỆN ĐÃ KẾT THÚC"; position: absolute; height: 3rem; left: 0; bottom: 0; align-items: center; text-align: center; justify-content: center; display: block; width: auto; z-index: 10; color: #fff; font-size: 25px; margin: auto; line-height: 1.5; text-transform: uppercase; padding: 0.5rem 1.5rem; font-family: 'SVN-Gilroy' !important; font-weight: bold; font-style: normal; background-color: #eea3c8; } .news-latest, .menu-blog { margin: 0 0 1.5rem; position: relative; padding: 1rem; border: 1px solid #e3e5ec; } .sidebarblog-title h2 { font-size: 18px; text-transform: uppercase; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #000; text-align: center; } .list-news-latest .item-article { border-bottom: 1px #efefef dotted; padding: 15px 0; margin: 0; } .list-news-latest .item-article .post-image { width: 30%; float: left; position: relative; height: auto; margin: 0; padding: 0; } .list-news-latest .item-article .post-content { width: 70%; float: left; padding-left: 10px; } .list-news-latest .item-article .post-content h3 { margin: 0 0 5px; font-size: .75em; } .list-news-latest .item-article .post-content span.author { font-size: .5em; } .h-rem { border-bottom: 1px solid #eee; padding: .25rem 0; height: auto; margin: .5rem 0; } .post-content { font-size: 1.225rem; } a.name_post { padding-top: .225rem; line-height: 1; font-size: .8em; font-weight: 600; } span.name_post { font-size: 0.6em; line-height: 1.2; padding-right: 0.5em; margin-bottom: .225rem; }
</style>

