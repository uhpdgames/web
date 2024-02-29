<?php

$hotro = $d->rawQuery(
	"select tenkhongdau$lang as link, ten$lang as ten, photo, noidung$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc",
	["ho-tro"]
);
$mangxahoi = $d->rawQuery(
	"select link, photo, options
from #_photo where type = ? order by stt,id desc",
	["mangxahoi"]
);
$lienhe = $d->rawQueryOne(
	"select noidung$lang as noidung, ten$lang as ten from #_static where type = ?",
	["trungtam"]
);
$thongtinkhac = $d->rawQueryOne(
	"select
noidung$lang as noidung, ten$lang as ten from #_static where type = ?",
	["thong-tin-khac"]
);
$chinhsach = $d->rawQuery(
	"select tenkhongdau$lang as link, ten$lang as ten from #_news where type = ? order by stt,id desc",
	["chinh-sach"]
);


?>
<style>
	.news-image {
		padding-top: 3%;
		width: 20%;
		height: 50%;
		object-fit: cover;
	}

	.news-item {
		/* có dường viền */
		min-height: 8rem;
		border: 1px solid #ebebeb;
		margin-bottom: 10%;
		padding: 0.25rem;
		font-size: 0.875rem;

	}

	.news-title {
		border: none !important;
		padding: 0.25rem;

	}

	.news-description {
		border: none !important;
		padding-left: 5%;
		padding-right: 5%;
		padding: 0.25rem;
		font-size: 0.875rem;
	}

	#footer .grp_menu p {
		display: block;
		height: 100%;
		width: 100%;
		padding: 0.4rem 0 !important;
		margin-bottom: 0 !important;
	}

	.foot_grp3-cover {
		margin-bottom: 2%;
	}

	#footer .inner {
		background: #fff;
		padding: 50px 0;
		border-top: 1px solid #e8e8e8;
		font-size: 0;
	}

	.site-wrap {
		position: relative;
		width: 70vw;
		margin: 0 auto;
		padding: 0 10px;
	}

	#footer .foot_block1, #footer .foot_block2, #footer .foot_block3 {
		width: 33.33%;
		display: inline-block;
		box-sizing: border-box;
		vertical-align: top;
		height: 240px;
		position: relative;
	}

	#footer .grp_return {
		font-size: 13px;
		line-height: 1.6;
		margin-top: 12px;
	}

	#footer .foot_block1, #footer .foot_block2 {
		padding-right: 50px;
		border-right: 1px solid #eaeaea;
	}

	#footer .foot_grp2, #footer .foot_block3 {
		padding-left: 50px;
	}

	#footer .foot_block4 {
		border-top: 1px solid #eaeaea;
		border-bottom: 1px solid #eaeaea;
		margin: 60px 0 0;
	}

	#footer .foot_block5 {
		margin: 30px 0 0;
		overflow: hidden;
	}

	#footer .foot_grp4 {
		border-top: 1px solid #eaeaea;
		border-bottom: 1px solid #eaeaea;
		display: flex;
		justify-content: space-between;
		margin: 2rem 0 0;
		align-items: center;
		padding: 0.25rem 0;
	}

	#footer .util {
		margin: 0;
		width: max-content;
		display: inline-block;
		vertical-align: middle;
	}

	#footer .util li, #header .log, .main-notice .board_list li {
		display: inline-block;
		vertical-align: middle;
	}

	#footer .util li a {
		padding: 0;
		font-size: .9rem;
		color: #000;
		text-decoration: none;
	}

	#footer .escrow li, #footer .grp_sns, #footer .shopinfo span.line, #footer .util, #footer .util li a, #footer .util li:after {
		display: inline-block;
		vertical-align: middle;
	}

	#footer .util li:after {
		content: "";
		width: 1px;
		height: 1rem;
		background: #d9d9d9;
		margin: 0;
	}

	#footer .util li:last-child:after {
		width: unset;
		height: unset;
		margin: 0
	}

	#footer .grp_sns {
		width: max-content;
	}


	.block-contact {
		min-height: 9rem;
		max-height: 10rem;
		height: 10rem;
	}

	.font-sm {
		font-size: .8em;
	}
</style>

<?php
$url = ENDPOINT_CKD_API . "fetch?select=contentvi&name=footer_pc&code=structure&data=1";
$get_data = callAPI('GET', $url);
$response = json_decode($get_data, true);
echo $response;
?>


