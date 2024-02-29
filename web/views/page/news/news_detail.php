<?php

if(empty($news)) {
	redirect('/');
}
?>
<?= $breadcr ?>
<?= structureddata() ?>
<div class="main_fix my-5">
	<div class="row w-100 h-auto m-0">
		<?php if (!$isMobile) { ?>
			<div class="col-12 col-lg-3 m-md-0 p-md-0">
				<div class="ckd-blog">
					<div class="news-latest">
						<div class="sidebarblog-title title_block" data-toggle="collapse" href="#collapseExample"
							 role="button" aria-expanded="true" aria-controls="collapseExample"
							 style="cursor: pointer;">
							<h2>
								<?= @$this->uri->segment(1) == 'su-kien' ? getLang('sukiennoibat') : getLang('tintucnoibat') ?>
							</h2>
						</div>

						<div id="collapseExample" class="list-news-latest layered collapse show">
							<div class="w-100 item-article clearfix">
								<?php

								if (is_array($news) && count($news)) {
									foreach ($news as $k =>
											 $v) { ?>
										<div class="w-100 d-flex flex-row flex-wrap h-rem align-items-center text-left">
											<div class="post-image">
												<div class="zoom_hinh item_img">
													<a href="<?php echo $router . '/' . $v[$sluglang] ?>">
														<img class="img-fluid img-lazy"
															 src="<?= image_default() ?>"
															 data-src="<?php echo UPLOAD_NEWS_L . $v['photo']; ?>"
															 alt="<?= $v['ten'] ?>"/>
													</a>
												</div>
											</div>

											<div class="post-content">
												<h3>
													<a class="name_post catchuoi2"
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
		<?php } ?>
		<div class="pt-5 col-12 col-lg-9 m-md-0">
			<div class="title-main">
				<h1><span><?= @$row_detail['ten'] ?></span></h1>
			</div>
			<div class="content-main" id="toc-content"><?= htmlspecialchars_decode(@$row_detail['noidung']) ?></div>
		</div>

		<div class="main_fix">
			<?php share_link(); ?>
			<div class="othernews list-news-latest layered">
				<b class="my-2"><?php echo getLang('baivietkhac') ?>:</b>
				<?php
				foreach ($news as $k =>
						 $v) {
					if ($v['id'] == $id) continue; ?>


					<div class="row border-bottom-1 my-2 align-items-end">
						<div class="col-md-1 py-1 pc">
							<div class="item_img">
								<a href="<?php echo $router . '/' . $v[$sluglang] ?>"> <img
										style="width: 100%; height: auto; object-fit: cover; transform: scale(1);"
										class="img-fluid" src="<?php echo UPLOAD_NEWS_L . $v['photo']; ?>"
										alt="<?= $v['ten'] ?>"/></a>
							</div>
						</div>
						<div class="col-12 col-md-11">

							<h3 style="font-size: 1rem;">
								<a class="name_post" href="<?php echo $router . '/' . $v[$sluglang] ?>">
									<?= ucfirst(mb_strtolower($v['ten'])) . ' - Ngày đăng: ' . date('d/m/Y', $v['ngaytao']);

									?>

								</a>
							</h3>

							<span class="name_post catchuoi3" style="font-size: .86rem; padding-right:.5rem">
												<?= strip_tags_content($v['mota'] ?? '') ?>
									</span>

						</div>
					</div>


				<?php } ?>

				<div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
			</div>
		</div>
	</div>
</div>

<style>
	.content-main, .content-main img { width: 100% !important; font-size: 0.8rem;height: 100% !important; } .news-latest, .menu-blog { margin: 0 0 1.5rem; position: relative; padding: 1rem; border: 1px solid #e3e5ec; } .sidebarblog-title h2 { font-size: 18px; text-transform: uppercase; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #000; text-align: center; } .list-news-latest .item-article { border-bottom: 1px #efefef dotted; padding: 15px 0; margin: 0; } .list-news-latest .item-article .post-image { width: 30%; float: left; position: relative; height: auto; margin: 0; padding: 0; } .list-news-latest .item-article .post-content { width: 70%; float: left; padding-left: 10px; } .list-news-latest .item-article .post-content h3 { margin: 0 0 5px; font-size: 0.75em; } .list-news-latest .item-article .post-content span.author { font-size: 0.5em; } .h-rem { border-bottom: 1px solid #eee; padding: 0.25rem 0; height: auto; margin: 0.5rem 0; } .post-content { font-size: 1.225rem; } a.name_post { padding-top: 0.225rem; line-height: 1; font-size: 0.9em; font-weight: 600; } span.name_post { font-size: 0.6em; line-height: 1.5; padding-right: 0.5em; margin-bottom: 0.225rem; } .border-bottom-1 { border-bottom: 1px solid #e0e0e0 !important; }
</style>
