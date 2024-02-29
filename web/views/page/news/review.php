<script src="https://cdn.tailwindcss.com"></script>

<style>
	.mota em {
		color: #fff;
	}

	.catchuoi4 {
		min-height: 5rem;
	}

	.fixed-photo {
		max-height: 20rem;
	}

	.glass {
		background: rgba(255, 255, 255, 0.13);
		border-radius: 16px;
		box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		border: 1px solid rgba(255, 255, 255, 0.3);
	}


	.wp-desc {
		border: 1px solid #ddd;
		background: linear-gradient(145deg, #ffffff, #ffff);
		box-shadow: 11px 11px 22px #fff, -11px -11px 22px #ffff;
	}

	.review-top {
		display: grid;
		grid-template-columns: repeat(3, 0fr);
		grid-gap: 50px;
	}

	.review-top .item_rv {
		width: 15rem;
	}

	.photo_review_thumbnail__review_title {
		font-size: 12px;
		line-height: 18px;
		padding-bottom: 5px;
		color: black;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.photo_review_thumbnail__review_author_info {
		height: 32px;
		padding: 12px 2px 15px 2px;
		margin: 0 10px;
		border-bottom: 1px solid #f3f3f3;
		position: relative;
	}

	.popup-video {
		position: fixed;
		top: 0;
		left: 0;

		z-index: 100;
		background: rgba(0, 0, 0, .8);
		height: 100%;
		width: 100%;
		display: none;

		justify-content: space-between;
		overflow: hidden;
		flex-direction: row;
	}

	.popup-video video {
		position: absolute;
		top: 50%;
		left: 25%;

		transform: translate(0, -50%);
		width: 650px;
		border-radius: 5px;
		border: 3px solid #fff;
		object-fit: cover;
	}

	.popup-video span {
		/*position: absolute;
		top:5px;
		right: 50px;
		font-size: 50px;
		color: #fff;
		font-weight: bolder;
		z-index: 1000;
		cursor: pointer;*/
	}

	.video-container {
		position: relative;
		display: flex;
		gap: 15px;
		justify-content: center;
		padding: 10px;
	}

	.video-container .d-flex {
		border: 1px solid #303030;
	}

	.video-container .video {
		height: 250px;
		width: 250px;

		overflow: hidden;
		cursor: pointer;

	}

	.video-container .video video {
		height: 100%;
		width: 100%;
		object-fit: cover;
		transition: 0.2s linear;
	}

	.video-container .video:hover video {
		transform: scale(1.2);
	}


</style>
<script>

</script>


<div id="content">
	<!--
		<div class="titleArea">
			<h2><font color="#555555">REVIEW</font></h2>
			<p>Sản phẩm chính hãng CKD</p>
		</div>


		<div class="video-container review-top w-60 m-auto">


			<div class="item_rv">

				<div class="video m-0 p-0 img_post zoom_hinh" data-id="601">
					<video data-id="601" src="assets/webm/300da.mp4" class="" playsinline="" autoplay="" loop=""
						   muted=""></video>
				</div>
				<div class="px-2 wp-desc">
					<br/>
					<p class="hinh_sp">
						<img
							src="https://ckdvietnam.com/upload/news/z4853975067091065170a3a0c72264af0ce867583476f5-2467-9442-1036-2148.webp"
							alt="Ngọc Hiếu">
						<span>Ngọc Hiếu</span>
					</p>

					<br/>
					<p class="mota catchuoi4 h-100">Tui mới dùng em nước thần này 1 tuần thôi mà thấy bật tông thấy rõ ấy. Chấm
						10/10 nha</p>
				</div>
			</div>
			<div class="item_rv">

				<div class="video m-0 p-0 img_post zoom_hinh" data-id="601">
					<video data-id="601" src="assets/webm/300da.mp4" class="" playsinline="" autoplay="" loop=""
						   muted=""></video>
				</div>


				<div class="px-2 wp-desc">
					<p class="hinh_sp">
						<img
							src="https://ckdvietnam.com/upload/news/z4853975067091065170a3a0c72264af0ce867583476f5-2467-9442-1036-2148.webp"
							alt="Ngọc Hiếu">
						<span>Ngọc Hiếu</span>
					</p>
					<p class="mota catchuoi4">Tui mới dùng em nước thần này 1 tuần thôi mà thấy bật tông thấy rõ ấy. Chấm
						10/10 nha</p>
				</div>
			</div>
			<div class="item_rv">

				<div class="video m-0 p-0 img_post zoom_hinh" data-id="601">
					<video data-id="601" src="assets/webm/300da.mp4" class="" playsinline="" autoplay="" loop=""
						   muted=""></video>
				</div>


				<div class="px-2 wp-desc">
					<p class="hinh_sp">
						<img
							src="https://ckdvietnam.com/upload/news/z4853975067091065170a3a0c72264af0ce867583476f5-2467-9442-1036-2148.webp"
							alt="Ngọc Hiếu">
						<span>Ngọc Hiếu</span>
					</p>
					<p class="mota catchuoi4">Tui mới dùng em nước thần này 1 tuần thôi mà thấy bật tông thấy rõ ấy. Chấm
						10/10 nha</p>
				</div>
			</div>


		</div>
	-->

	<div class="mt-5 pt-5"></div>


	<div class="main_fix pt-5">
		<div class="title-main"><h1 class="h1_home">REVIEW</h1></div>
		<div class="px-2">
			<div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-4 2xl:grid-cols-4 gap-7 xl:gap-10">
				<?php //$thumb = THUMBS.'/300x300x1/';
				foreach ($news as $k => $v) {

					//	list($width, $height) = getimagesize(UPLOAD_NEWS_L. $v['photo']);


					if (empty($v['photo'])) continue;
					$options = @json_decode($v['options2'], true);
					$sosao = @$options['sosao'] ?? 5;
					?>
					<?php

					$none_start = '<svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
										<path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
									</svg>';
					$max_start = '<svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
										<path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
									</svg>';
					$product_rv = $d->rawQueryOne("select photo, ten$lang as ten, tenkhongdauvi as link, tenkhongdauen from #_product where type = ?  and hienthi > 0 and id= ? order by stt,id desc limit 0,1", array('san-pham', $v['id_list']));

					if (empty($product_rv)) continue;
					?>

					<div class="card rounded overflow-hidden relative  ">
						<div class="aspect-w-16 aspect-h-9 img_post cursor-pointer ">


							<img class="object-cover brightness-100 group-hover:brightness-50 w-full fixed-photo"
								 src="<?=image_cdn($v['photo'])?>"
								 alt="<?= $v['ten'] ?>"
								 data-id="<?= $v['id'] ?>"></div>
						<div class="group relative">

							<div
								class="translate-y-40 group-hover:translate-y-0 text-white glass absolute bottom-0 m-4 p-4  group-hover:opacity-100 duration-300">
								<div class="grid gap-1">

									<div>
										<div class="flex items-center">

											<?php for ($i = 0; $i < $sosao; $i++): echo $max_start;

											endfor; ?>

											<?php if ($sosao <= 4) echo $none_start ?>

										</div>
										<?= $v['ten'] ?>
										<p class="text-white text-sm sm:text-xs md:text-xs lg:text-xs xl:text-xs 2xl:text-xs line-clamp-3">
											<em class="mota catchuoi4"><?= $v['mota'] ?></em>

										</p>

										<div class="flex items-center mb-4">

											<div
												class="text-white text-sm sm:text-xs md:text-xs lg:text-xs xl:text-xs 2xl:text-xs line-clamp-3">

												<div class="mota catchuoi1">
													<a href="san-pham/<?= @$product_rv['link'] ?>"><em><?= @$product_rv['ten'] ?></em></a>
												</div>
											</div>

										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class="all_review"></div>
