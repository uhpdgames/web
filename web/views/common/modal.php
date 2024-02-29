<?php if (isset($popup) && $popup['hienthi'] == 1) { ?>
	<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header"><h6 class="modal-title" id="popupModalLabel"><?= $popup['ten' . $lang] ?></h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body"><a href="<?= $popup['link'] ?>"><img
							src="<?= UPLOAD_PHOTO_L . $popup['photo'] ?>" alt="Popup"></a></div>
			</div>
		</div>
	</div> <?php } ?> <!-- Modal notify -->
<div class="modal modal-custom fade" id="popup-notify" tabindex="-1" role="dialog" aria-labelledby="popup-notify-label"
	 aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header"><h6 class="modal-title" id="popup-notify-label"><?= getLang('thongbao') ?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><?= getLang('thoat') ?></button>
			</div>
		</div>
	</div>
</div> <!-- Modal cart -->
<div class="modal fade" id="popup-cart" tabindex="-1" role="dialog" aria-labelledby="popup-cart-label"
	 aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header"><h6 class="modal-title" id="popup-cart-label"><?= getLang('giohangcuaban') ?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div> <!-- Modal xem nhanh sản phẩm -->
<div class="modal fade" id="popup-pro-detail" tabindex="-1" role="dialog" aria-labelledby="popup-pro-detail-label"
	 aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header"><h6 class="modal-title" id="popup-pro-detail-label">XEM NHANH SẢN PHẨM</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>


