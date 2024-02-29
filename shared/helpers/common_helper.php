<?php
if (!defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');

function getAllProductSale()
{

	$ci = &get_instance();

	$rs = $ci->data['d']->rawQuery("select id from #_product where khuyenmai > 0 and hienthi > 0");

	$i = array();
	if (is_array($rs) && count($rs)) {
		foreach ($rs as $r) {
			$i[] = (int)$r['id'];
		}
	}

	$i[] = 266;
	$i[] = 231;
	$i[] = 288;
	$i[] = 290;
	$i[] = 283;

	return $i;
}

