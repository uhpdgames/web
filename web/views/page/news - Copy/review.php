<div class="main_fix">
	<!-- <div class="main_fix"> -->
	<div class="cover-review">
		<div class="title-main"><span><?=$title_crumb?></span></div>
		<?=htmlspecialchars_decode($noidung_cap);?>

        <div class="review">
            <?php //$thumb = THUMBS.'/300x300x1/';
            foreach($news as $k => $v) { ?>
                <?php
                $product_rv = $d->rawQueryOne("select photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product where type = ?  and hienthi > 0 and id='".$v['id_list']."' order by stt,id desc limit 0,1",array('san-pham'));
                ?>
               <div class="item_rv">
                    <p class="m-0 p-0 img_post zoom_hinh" data-id="<?= $v['id'] ?>">
                        <img class="viewimg img-fluid cover"
                                    data-id="<?=$v['id']?>"
                                    src="<?=UPLOAD_NEWS_L.toWebpREVIEW($v['photo'])?>"
                                    alt="<?=$v['ten']?>" />
    </p>
    <div class="px-2">
        <p class="hinh_sp">
            <img src="<?=UPLOAD_NEWS_L . toWebpREVIEW($v['icon']) ?>" alt="<?= $v['ten'] ?>" />
            <span><?= $v['ten'] ?></span>
        </p>
        <p class="mota catchuoi2"><?= $v['mota'] ?></p>
    </div>
</div>
            <?php } ?>
        </div>


		<?php if(count($news)==0) echo '<div class="alert alert-warning" role="alert"><strong>'.getLang('khongtimthayketqua').'</strong></div>'; ?>
		<div class="clear"></div>

		<div class="my-2 pt-4">
			<div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
		</div>

		<div class="all_review"></div>
	</div>

</div>
