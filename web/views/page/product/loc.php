<?php if ($com != 'khuyen-mai'): ?>
	<!--todo: LOC.php-->



	<?php
	@$id = htmlspecialchars($_GET['id']);
	@$idl = htmlspecialchars($_GET['idl']);
	@$idc = htmlspecialchars($_GET['idc']);
	@$idi = htmlspecialchars($_GET['idi']);
	@$ids = htmlspecialchars($_GET['ids']);
	@$idb = htmlspecialchars($_GET['idb']);
	@$id_thuonghieu = htmlspecialchars($_GET['id_thuonghieu']);
	@$id_dong = htmlspecialchars($_GET['id_dong']);
	@$isPromotion = htmlspecialchars($_GET['khuyen_mai']);



	$product_list = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id, photo from #_product_list where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));

	$thuonghieu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id from #_news where type = ? and hienthi > 0 order by stt,id desc", array('thuong-hieu'));

	$dong = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id from #_news where type = ? and hienthi > 0 order by stt,id desc", array('dong'));

	$mucgia = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id, gia1, gia2 from #_news where type = ? and hienthi > 0 order by stt,id desc", array('muc-gia'));
	?>


<?php endif; ?>
