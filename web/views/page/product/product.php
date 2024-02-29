<style>


	.font-size-fitter {
		font-size: 0.8rem;
	}
	.cover-font-radio{
		margin-right: 0rem;
	}
	.cover-row-fitter{    
		margin-left: 0rem !important;
	}
	.font-color-fitter{
		font-weight: 600;
		color: #1f3914;
	}
	.font-color-fitter-1{
		font-weight: 600;
		color: #1f3914;
	}
	.font-lable-fitter{
		font-size: 0.7rem;
	}

    .loc {
	flex: 15%;
	margin-top: 1.2rem !important;
    margin-right: 1rem !important;
	/* float: left;
	gap: 10px;
	display: flex;
	align-items: center;
	flex-flow: wrap;
	list-style: none;
	clear: both;

	justify-content: center;
	margin: 1.25rem 0; */
}
.product_list {
    flex: 80%;
}

.container-fitter{
    display: flex;
}

.cover-frame-fitter{
    margin: 3px;
    border-radius: 0.25rem !important;
    width: 100%;
}

.cover-frame-fitter-1{
    margin: 3px;
    border-radius: 0.25rem !important;
    width: 46%;
}


@media (min-width: 768px) {

.wap_loadthem_sp .item {
    height: 23rem !important;
}

.wap_loadthem_sp .item img {
    height: 15.5rem !important;
}
}
@media screen and (max-width: 768px) {
    .product_list {
        flex: 100%;
    }
    .container-fitter{
    display: block;
    }
}
</style>
<?php
$ci = &get_instance();
$com = $this->uri->segment(1); if($com =='') $com = 'khuyen-mai'; //=$breadcr;?>
<?php

$bg = MYSITE . 'assets/images/cate/'.$com;
if($isMobile){
	$bg .='m';
}
$bg .= '.webp';

if (!empty($pro_cat)): //$bg = UPLOAD_PRODUCT_L . toWebp($pro_cat['photo']); ?>
<div class="container-fluid bg-img">
    <div class="title-main title-main_sp">
        <span style="--bg: url(<?=$bg?>); --bg-m: url(<?=$bg?>);"> <?php /*= (@$title_cat != '') ? $title_cat : @$title_crumb */?></span>
    </div>
</div>

<?php else:

	$bg = MYSITE . 'assets/images/cate/'.$com;
	if($isMobile){
		$bg .='m';
	}
	$bg .= '.webp';

?>
<div class="container-fluid bg-img">
    <div class="title-main title-main_sp">
        <span style="--bg: url(<?=$bg?>); --bg-m: url(<?=$bg?>);">
            <?php /*= (@$title_cat != '') ? $title_cat : @$title_crumb */?>
        </span>
    </div>
</div>
<?php endif; ?>
<div class="main_fix pt-3 pt-md-0">
    <?php $this->load->view('page/product/loc');?>
    <?php $this->load->view('page/product/fitter_pc_new');?>
    <div class="container-fitter">
    <!-- <?php $this->load->view('page/product/fitter_pc');?>
    <?php $this->load->view('page/product/fitter_mb');?> -->

        <div class="product_list">
            <div class="wap_loadthem_sp sanpham" data-div=".loadthem_sp100" data-lan="1" data-where="<?= $where ?>" data-sosp="<?= $sosp ?>" data-max="<?= $solan_max ?>">
                <div class="wap_item loadthem_sp100" data-mcs-theme="dark"></div>
                <?php if ($solan_max >
                1) { ?>
                <p class="load_them">
                    <?= getLang('xemthem') ?>
                    <span><?= ($dem['numrows'] - $sosp) ?></span>
                    <?= getLang('sanpham') ?>
                    <i class="fas fa-caret-right"></i>
                </p>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php if (!empty($noidung_cap) && $noidung_cap): ?>
    <div style="display: block;">
        <div class="row">
            <div class="col-12 desc-sanpham">
                <div class="text content mCustomScrollbar page-product-description" data-mcs-theme="dark">

					<?= htmlspecialchars_decode($noidung_cap); ?>
				</div>


            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="my-2 pt-4">
        <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
    </div>

    <div class="mb-5">
        <?php share_link();?>
    </div>
</div>
<script src="<?= MYSITE ?>assets/js/product_init.js?v=<?=time();?>"></script>
<link rel="stylesheet" href="<?= MYSITE ?>assets/css/product.css?v=<?=time();?>" />
<script>
    var url = "<?=$url?>";
    $(document).ready(function () {
        // nếu trong url có chứa từ khóa 'san-pham' thì hiển thị display none vào class .container-fluid.bg-img
        if (
            url.indexOf("san-pham") > -1 ||
            url.indexOf("tot-nhat") > -1 ||
            url.indexOf("moi") > -1 ||
            url.indexOf("ckd") > -1 ||
            url.indexOf("bellasoo") > -1 ||
            url.indexOf("lacto") > -1 ||
            url.indexOf("retino-collagen") > -1 ||
            url.indexOf("nuoc-pha-tron") > -1 ||
            url.indexOf("vita-citeca") > -1 ||
            url.indexOf("biotin-amin") > -1 ||
            url.indexOf("keo-ong-xanh") > -1 ||
            url.indexOf("vitac-teca") > -1 ||
            url.indexOf("amino-biotin") > -1 ||
            url.indexOf("bellasoo") > -1
        ) {
            $(".container-fluid.bg-img").css("display", "none");
        }
    });
</script>
