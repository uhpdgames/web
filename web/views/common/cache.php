<?php

$path_img = MYSITE .  get_photo($d, 'banner1vi');
$imgSRC = getDataURI( $path_img );

cache_localStore('banner_1', $imgSRC);

$path_img = MYSITE .  get_photo($d, 'banner2vi');
$imgSRC = getDataURI( $path_img );

cache_localStore('banner_2', $imgSRC);

//qq($imgSRC);

$slider = $d->rawQuery("select id, tenvi as ten, photo, link from table_photo where type = ? and hienthi > 0", array('slidevi'));


cache_localStore('slider', serialize($slider));

/*foreach ($slider as $v) {
	@ob_start();

	$path_img = MYSITE .  UPLOAD_PHOTO_L . ($v['photo']) ;
	$imgSRC = getDataURI( $path_img );
	cache_localStore('slider_'.$v['id'], $imgSRC);



	@ob_end_clean();
}*/

$product_list = $d->rawQuery("select id, tenvi as ten, tenkhongdauvi, tenkhongdauen,id, photo from #_product_list where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));

cache_localStore('product_list', $product_list);

/*foreach ($product_list as $k => $v) {
	@ob_start();

	$path_img = MYSITE .  UPLOAD_PHOTO_L . ($v['photo']) ;
	$imgSRC = getDataURI( $path_img );
	cache_localStore('product_'.$v['id'], $imgSRC);

	@ob_end_clean();
}*/



echo 'ĐÃ TẠO CACHE XONG!!!';

$tt = cache_localStore('slider');

echo 'zzzzzzz';
//qq($tt);


