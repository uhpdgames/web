
<div class="mt-5 py-2 main_fix section">
	<div id="navbar" style="display: block;">
		<div id="spnarbar" style="display: none;">
			<div class="main_fix relative pc mt-2">
				<div class="info_sp_nav pt-3 d-flex justify-content-start">
					<div class="thumb_sp_nav">
						<img id="imgScrollFix" onerror="this.onerror=null;this.src='<?= image_default('empty') ?>'"
							 src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
							 alt="<?= $row_detail['ten'] ?>"
							 class="loading img-fluid" data-was-processed="true"/>
					</div>
					<div class="block_info_sp_nav w-100">
						<div class="title_nav">
							<?= $row_detail['ten'] ?? "" ?>
						</div>
						<div class="block_price_nave">
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
					<div class="block_add_to_cart_nav">
						<div class="wp-muangay">
							<a
								class="btn btn-primary buynow addcart text-decoration-none left"
								data-id="<?= $row_detail['id'] ?>"
								data-action="buynow"
								style="width: 100%;font-weight: bold;font-size: 16px;padding: 10px 20px;color: white;background-color: #3C5B2D;display: inline-block;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border: none;"
							>
								<span><?= getLang('dathang') ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div>
				<!--  Nút thêm vào giỏ hàng -->

			</div>
		</div>
		<div class="main_fix">
			<ul class="nav-tabs p-0 m-0 main_fix justify-content-evenly d-flex">
				<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="info-pro-detail">
					<a class="nav-link cover-nav-link fix-padding-one" href="#section1">
						<?= getLang('thongtinsanpham') ?>
					</a>
				</li>
				<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="info-thanhphan">
					<a class="nav-link cover-nav-link fix-padding-one" href="#section2">
						<?= getLang('thanhphansanpham') ?>
					</a>
				</li>
				<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="commentfb-pro-detail">
					<a class="nav-link cover-nav-link fix-padding-one" href="#section3">
						<?= getLang('binhluan') ?>
					</a>
				</li>
				<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="sanphamcungloai-detail">
					<a class="nav-link cover-nav-link fix-padding-one" href="#section4">
						<?= getLang('sanphamcungloai') ?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div id="section1" class="main_fix section"
	 style="padding-top: 0px;">
	<div id="box_sanpham" class="w-100 content-tabs-pro-detail info-pro-detail active">
		<h2 class="py-5 d-flex text-center m-auto w-50">
			<span class="w-100 d-block"><?= (( $row_detail['noidung'] !='') ?getLang('thongtinsanpham'): '') ?></span>
		</h2>

		<?= htmlspecialchars_decode($row_detail['noidung'] ?? "") ?>
	</div>
</div>
<div id="section2" class="main_fix section">
	<div id="box_thanhphansanpham" class="w-100 content-tabs-pro-detail info-thanhphan">
		<h2 class="py-5 d-flex text-center m-auto w-50">
			<span class="w-100 d-block"><?=  (( $row_detail['noidungthanhphan'] !='') ?getLang('thanhphansanpham'): '')  ?></span>
		</h2>
		<?= htmlspecialchars_decode($row_detail['noidungthanhphan'] ?? "") ?>
	</div>
</div>
<div id="section3" class="main_fix section">

	<div id="box_binhluan" class="w-100 content-tabs-pro-detail commentfb-pro-detail">

		<h2 class="py-5 d-flex text-center m-auto w-50">
			<span class="w-100 d-block"><?= getLang('binhluan') ?></span>
		</h2>

		<div class="sao_bl"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
				class="fas fa-star"></i><i
				class="fas fa-star"></i><i class="fas fa-star"></i></div>

		<div class="danhgia2">
			<p class="td"><?= getLang('danhgia') ?></p>
			<p><?= getLang('khachhangnhanxet') ?></p>
			<div class="bao_danhgia">
				<div class="dg1">
					<?php
					$so_danhgia = 1;
					if (is_array($danhgia) && count($danhgia) > 0) {
						$so_danhgia = @$count_danhgia ?? count($danhgia);
					}

					?>
					<p><?= getLang('danhgiatrungbinh') ?></p>
					<p class="so"><?= round($trungbinh['tb'], 1) ?></p>
					<p><?php echo $so_danhgia ?> <?= getLang('nhanxet') ?></p>
				</div>
				<div class="dg2">
					<p class="dong">5 <?= getLang('sao') ?> <span><b
								style="width:<?= ($sao5['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao5['dem'] ?> <?= getLang('rathailong') ?>
					</p>
					<p class="dong">4 <?= getLang('sao') ?> <span><b
								style="width:<?= ($sao4['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao4['dem'] ?> <?= getLang('hailong') ?>
					</p>
					<p class="dong">3 <?= getLang('sao') ?> <span><b
								style="width:<?= ($sao3['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao3['dem'] ?> <?= getLang('binhthuong') ?>
					</p>
					<p class="dong">
						2 <?= getLang('sao') ?>
						<span>
                                        <b style="width:<?= ($sao2['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao2['dem'] ?>
						<?= getLang('khonghailong') ?>
					</p>
					<p class="dong">1 <?= getLang('sao') ?> <span><b
								style="width:<?= ($sao1['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao1['dem'] ?> <?= getLang('ratte') ?>
					</p>
				</div>
			</div>
		</div>

		<?php if ($isLogin) { ?>
			<div class="danhgia3">
				<p class="td"><?= getLang('danhgiasanphamnay') ?>.</p>

				<div class="danhgiasao">
					<?php for ($i = 1; $i <= 5; $i++) { ?>
						<span data-value="<?= $i ?>"></span>
					<?php } ?>
				</div>

				<form class="form-contact validation-contact" novalidate method="post" action=""
					  enctype="multipart/form-data">
					<input type="hidden" name="link_video" id="link_video" value="5">
					<div class="input-contact">
						<input type="file" class="custom-file-input" name="file">
						<label class="custom-file-label" for="file"
							   title="<?= getLang('chon') ?>"><?= getLang('chonhinhanh') ?></label>
						<p>.jpg, .png, .gif</p>
					</div>

					<div class="input-contact">
                            <textarea class="form-control" id="motavi" name="motavi"
									  placeholder="<?= getLang('noidung') ?>"
									  required/></textarea>
						<div class="invalid-feedback"><?= getLang('vuilongnhapnoidung') ?></div>
					</div>
					<input type="submit" class="btn btn-primary" name="submit-contact"
						   value="<?= getLang('gui') ?>" disabled/>
					<input type="reset" class="btn btn-secondary" value="<?= getLang('nhaplai') ?>"/>
					<input type="hidden" name="recaptcha_response_contact"
						   id="recaptchaResponseContact">
				</form>
			</div>
		<?php } else { ?>
			<div class="vuilongdangnhap">
				<a href="account/dang-nhap"><?= getLang('vuilongdangnhap') ?></a>
			</div>
		<?php } ?>
		<?php if (is_array($danhgia) && count($danhgia)) { ?>
			<div class="danhgia">
				<?php
				//qq($danhgia);
				foreach ($danhgia as $k => $v) { ?>
					<?php
					if (empty($v['photo']) || empty($v['link_video'])) continue;

					$tennguoi = @$v['tenvi'];
					if(!empty($v['id_member']) && $v['id_member'] == 1){

					}else{
						$get_member = $d->rawQueryOne("select ten from #_member where id='" . $v['id_member'] . "'");
						$tennguoi = $get_member['ten'] ?? "";
					}

					?>

					<div class="item_dg">
						<div class="text-small"><?= date('d-m-Y', $v['ngaytao']) ?></div>
						<p class="ten"><?= $tennguoi ?></p>
						<p class="sao">
							<?php
							$sosao = 0;
							for ($i = 1; $i <= 5; $i++) { ?>
								<i class="fas fa-star <?php if ($i <= $v['link_video']) {
									echo 'active';
									$sosao++;
								} ?>"></i>
							<?php } ?>
						</p>
						<p class="mota"><?= htmlspecialchars_decode($v['motavi']) ?></p>
						<?php if ($v['photo'] != '') {

							//$opt_rev = (isset($v['options2']) && $v['options2'] != '') ? json_decode($v['options2'], true) : null;

							//$sosao = $opt_rev['sosao'] ?? 5;

							?>
							<div class="slider-img img img_post"><img data-sosao="<?= $sosao ?>" data-danhgia="true"
																	  data-id="<?= $v['id'] ?>"
																	  src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
																	  alt="<?= !empty($v['ten']) ? $v['ten'] : '' ?>">
							</div>
						<?php } ?>
					</div>
				<?php }
				?>


				<?php

				if (!empty($paging_danhgia)) {
					?>
					<div class="my-2 pt-4">
						<div
							class="pagination-home"><?= (isset($paging_danhgia) && $paging_danhgia != '') ? $paging_danhgia : '' ?></div>
					</div>
					<?php
				}
				?>
			</div>

		<?php } ?>


	</div>

	<?php /*endif; */ ?>


</div>
<div id="section4" class="main_fix section">
	<div id="box_sanphamcungloai" class="w-100 content-tabs-pro-detail sanphamcungloai-detail">
		<h2 class="py-5 d-flex text-center m-auto w-50">
			<span class="w-100 d-block"><?= getLang('sanphamcungloai') ?></span>
		</h2>
		<div class="sanpham">
			<div class="wap_loadthem_sp" data-div=".loadthem_sp100" data-lan="1" data-where="<?= $where ?>"
				 data-sosp="<?= $sosp ?>" data-max="<?= $solan_max ?>">
				<div class="wap_item loadthem_sp100">

				</div>
				<?php if ($solan_max > 1) { ?><p class="load_them"><?= getLang('xemthem') ?>
					<span><?= ($dem['numrows'] - $sosp) ?></span> <?= getLang('sanpham') ?> <i
						class="fas fa-caret-right"></i>
					</p><?php } ?>
			</div>
		</div>

	</div>
</div>
