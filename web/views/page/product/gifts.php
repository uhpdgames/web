<?php

$hasGift = mySetting('is_gift') ? true: false;
$gifts = @json_decode($row_detail['gift']?? array());
if(!empty($gifts) && is_array($gifts) && count($gifts) > 0){
	$hasGift = true;
	$gifts = (Array)$gifts;
}else{
    $hasGift = false;
}

/*echo 'sssssssssssssssss<pre>';
var_dump($gifts);die;*/
$hasGift = true;


$not_sale = getAllProductSale();

$hasGift = $hasGift && !in_array($row_detail['id'], $not_sale);


?>
<?php if($hasGift && !empty($gifts->image) && count($gifts->image) > 0):?>
<div class="wp-gift pt-4 pb-4">
	<div class="sp_dis_container">
		<div class="row">
			<div class="col-8">
				<div class="sp_dis_title">
					Sản phẩm tặng kèm
				</div>
<!--				<div class="sp_dis_mota">-->
<!--					Chọn 1 trong các quà tặng-->
<!--				</div>-->
			</div>
			<div class="col-4 text-right p-0 m-0">
				<!--<div class="img-thumbnail_dis">
					<img class=" float-end"
						 width="50px"
						 src="assets/images/giftbox.png" alt="Hình ảnh"/>
				</div>-->
			</div>
		</div>

		<div style="height: 150px" class=" content mCustomScrollbar" data-mcs-theme="dark">

			<?php
			$data = $this->session->userdata('has_quatang');
			$pid = $row_detail['id'] ?? 0;

			for ($i= 0 ; $i < count($gifts->image) ; $i++):
				$stt = $i;
				$link = $gifts->image[$i];
				$img = UPLOAD_PRODUCT_L . $link;
				$name = $gifts->name[$i] ?? "";
				$desc = $gifts->desc[$i] ?? "";

				if(!empty($data[$pid]) && $data[$pid]['name'] == $name){
					$check_name = 'checked="checked"';
				}else{
					$check_name ='';
				}

				?>

				<div class="container-voucher mt-4">
					<div class="row"
						 style="
			margin-right: -15px !important;
  	  margin-left: -15px !important;"
					>

						<div class="col-3 sp_img_dis">
							<a data-zoom-id="Zoom-detail"
							   id="Zoom-detail" class="MagicZoom"
							   href="<?= $img ?>"
							   data-options="hint: off;zoomWidth:400px; zoomHeight:400px;zoomPosition: top"
							   title="Hình ảnh">

							<img class="cloudzoom voucher-img" src="<?=$img?>" alt="Hình ảnh"/>
							</a>
						</div>
						<div class="col-9 p-0 m-0">
							<div>
								<?= htmlspecialchars_decode($desc)?>
							</div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
		</div>


	</div>
</div>
<?php endif;?>
