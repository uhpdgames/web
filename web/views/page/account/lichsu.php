<?= create_BreadCrumbs('account/lich-su-mua-hang', 'Lịch sử mua hàng') ?>

<div class="main_fix my-5">
	<div class="title-main">
		<span><?= getLang('lichsu') ?></span>
	</div>
	<div class="donhang">
		<?php if (is_array($order) && count($order)) {
			foreach ($order as $k => $v) { ?>
				<?php
				$tinhtrang = $d->rawQueryOne("select trangthai from #_status where id = ?", array($v['tinhtrang']));
				$giatien = 0;
				$order_detail = $d->rawQuery("select * from #_order_detail where id_order = ?", array($v['id']));
				$order = $d->rawQueryOne("select tonggia, phiship from #_order where id = ?", array($v['id']));
				?>
				<div class="item_dh">
					<p class="tinhtrang"><?= $tinhtrang['trangthai'] ?><span><?= date('d/m/Y', $v['ngaytao']) ?></span>
					</p>
					<ul>
						<?php foreach ($order_detail as $k2 => $v2) {
							if ($v2['giamoi'] != 0) {
								$giatien = $v2['giamoi'];
							} else {
								$giatien = $v2['gia'];
							}
							?>
							<li>
								<div class="img_dh">
									<p class="img">
										<img src="<?php echo MYSITE . UPLOAD_PRODUCT_L . $v2['photo'] ?>"
											 alt="<?= $v2['ten'] ?>">
										<span>x <?= $v2['soluong'] ?></span>
									</p>
									<h4><?= $v2['ten'] ?></h4>
								</div>
								<p class="gia"><?= format_money($giatien * $v2['soluong']) ?></p>
							</li>
						<?php } ?>
					</ul>
					<p class="phiship tongtien" style="color:indianred">Phí
						ship <?= format_money($order['phiship']) ?? '' ?></p>
					<p class="tongtien" style="color:palevioletred">Giá trị đơn
						hàng: <?= format_money($order['tonggia']) ?? '' ?></p>
				</div>
			<?php }
		} ?>
		<?php
		if (empty($order) || is_array($order) && count($order) <= 0) {
			?>

			<div class="item_dh">
				<h3>BẠN CHƯA CÓ ĐƠN HÀNG</h3>
			</div>
			<?php
		}
		?>
	</div>
</div>
