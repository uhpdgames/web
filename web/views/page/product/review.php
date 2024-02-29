<div class="wp-review">
	<div class="d-flex w-100 text-center justify-content-center">
		<div class="img-review w-100 pt-4">
			<p class="text-sm text-center font-weight-normal w-100 font-weight-bold">
				<?= getLang('hinhanhreview') ?>
			</p>
			<div class="swiper-container review-swiper">
				<div class="swiper-wrapper">
					<?php
					$count = 1;
					if (is_array($danhgia) && count($danhgia)) {
						foreach ($danhgia as $v) {
							//if($count >=5) break;
							//$count++;
							$opt_rev = (isset($v['options2']) && $v['options2'] != '') ? json_decode($v['options2'], true) : null;
							$sosao = $opt_rev['sosao'] ?? 5;
							if ($v['photo'] == '') continue;
							?>
							<div class="swiper-slide h-auto px-1 mt-0">
								<div class="img_post">
									<!--slider-img-->
									<img
										data-sosao="<?= $sosao ?>"
										data-danhgia="true" data-id="<?= $v['id'] ?>"
										onerror="this.onerror=null;this.src='<?= image_default('empty') ?>'"
										class="img-fluid center"
										src="<?= MYSITE . UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
										alt="<?= !empty($v['motavi']) ? $v['motavi'] : '' ?>"
									/>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>

			</div>


		</div>
	</div>

</div>
