<?php
$mygia = $row_detail['giamoi'];
if (empty($mygia) || $mygia != '') {
    $mygia = $row_detail['gia'];
}

$sodanhgia = @$count_danhgia ?? 0;
if ($sodanhgia == 0 || empty($sodanhgia)) $sodanhgia = 0;

?>
<?= structuredataProduct(format_money($mygia), $row_detail['masp'], $sodanhgia, round(@$trungbinh['tb'] ?? 4, 1)) ?>
<style>
    .fixed-top-mb {
        background: rgb(255, 255, 255);
        padding-top: 5rem;
        top: 0px;
        right: 0px;
        left: 0px;
        z-index: 9999;
        position: fixed;
        box-shadow: rgb(223, 219, 219) 0px 2px 5px;
    }

    .fix-padding-two {
        border: 1px solid #cccccc !important;
        margin-right: 8px !important;
    }
</style>
<div class="all_review"></div>
<div>
    <div class="row w-100 h-100">
        <div class="col-12 col-lg-6">
            <div class="gallery-container row">
                <div class="col-12 col-lg-9 swiper-container gallery-main">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slider__image  h-100 h-100">

                                <a data-options="hint: off" data-zoom-id="Zoom-detail-000" id="Zoom-detail-000" class="MagicZoom" href="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>" title="<?= $row_detail['ten'] ?>">

                                    <img class="cloudzoom center img-fluid  h-100 h-100" src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>" alt="<?= $row_detail['ten'] ?>" />
                                </a>
                            </div>

                        </div>

                        <?php if (
                            is_array($hinhanhsp) && count($hinhanhsp) >
                            0
                        ) { ?>
                            <?php foreach ($hinhanhsp as $v) { ?>
                                <div class="swiper-slide">
                                    <div class="slider__image  h-100 h-100">
                                        <a data-options="hint: off" data-zoom-id="Zoom-detail-<?= $v['photo'] ?>" id="Zoom-detail-<?= $v['photo'] ?>" class="MagicZoom" href="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>" title="<?= $row_detail['ten'] ?>">

                                            <img class="cloudzoom center img-fluid" src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>" alt="<?= $row_detail['ten'] ?>" />

                                        </a>
                                    </div>


                                </div>
                        <?php }
                        } ?>


                    </div>
                </div>
                <div class="col-12 col-lg-3 swiper-container gallery-thumbs">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="center img-fluid" src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>" alt="<?= $row_detail['ten'] ?>" />
                        </div>
                        <?php if (
                            is_array($hinhanhsp) && count($hinhanhsp) >
                            0
                        ) { ?>
                            <?php foreach ($hinhanhsp as $v) { ?>
                                <div class="swiper-slide">
                                    <img class="center img-fluid" src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>" alt="<?= $row_detail['ten'] ?>" />
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <?php /*= $isMobile ? 'row' : '' */ ?>
            <!--wp-review-->
            <div class="wwp-review">
                <div class="d-flex w-100 text-center justify-content-center">
                    <!--slider__flex w-100-->
                    <!--<div class="slider_empty"></div>-->
                    <div class="img-review w-100 pt-2">
                        <p class="text-bold text-center font-weight-normal w-100 font-weight-bold">
                            <?= getLang('hinhanhreview') ?>
                        </p>

                        <?php
                        //	qq($danhgia);

                        ?>

                        <div class="swiper-container review-swiper">
                            <div class="swiper-wrapper">
                                <?php
                                $count = 1;
                                if (is_array($danhgia) && count($danhgia)) {
                                    foreach ($danhgia as $v) {
                                        //if($count >=5) break;
                                        //$count++;
                                        $opt_rev = (isset($v['options2']) && $v['options2'] != '') ? json_decode($v['options2'], true) : null;
                                        $sosao = $opt_rev['sosao'] ?? 5;
                                        if ($v['photo'] == '') continue;
                                ?>
                                        <div class="swiper-slide h-auto px-1 mt-0">
                                            <div class="img_post item_img">
                                                <!--slider-img-->
                                                <img data-sosao="<?= $sosao ?>" data-danhgia="true" data-id="<?= $v['id'] ?>" onerror="this.onerror=null;this.src='<?= image_default('empty') ?>'" class="img-fluid center" src="<?= MYSITE . UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>" alt="<?= !empty($v['motavi']) ? $v['motavi'] : '' ?>" />
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>


                    </div>
                </div>

            </div>

        </div>
        <div class="col-12 col-lg-6 right-pro-detail infoArea">
            <div class="brand">

                <?php

                $id_thuonghieu = @$row_detail['id_thuonghieu'] ?? 0;
                if (!empty($row_detail['id_thuonghieu']) && $row_detail['id_thuonghieu'] > 0) {
                    $name_thuonghieu = $d->rawQueryOne("select ten$lang as ten from #_news where id=$id_thuonghieu");
                    if (!empty($name_thuonghieu) && isset($name_thuonghieu['ten'])) {
                        echo $name_thuonghieu['ten'];
                    }
                } else {
                    echo '<span></span>';
                }

                ?>
            </div>

            <p class="headingArea title--detail catchuoi2"><?= $row_detail['ten'] ?></p>
            <div class="row">
                <div class="col-4 detail-title cover--detail pb-3" style="padding-left: 0%"><?= getLang('masp') ?></div>
                <div class="col-8 cover--detail">
                    <?= (isset($row_detail['masp']) && $row_detail['masp'] != '') ? $row_detail['masp'] : '' ?></div>
            </div>
            <div class="row">
                <div class="col-4 detail-title cover--detail pb-3" style="padding-left: 0%"><?= getLang('thetich') ?>
                </div>
                <div class="col-8 cover--detail">
                    <?= (isset($row_detail['thetich']) && $row_detail['thetich'] != '') ? $row_detail['thetich'] : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-4 detail-title cover--detail pb-3" style="padding-left: 0%"><?= getLang('gia') ?></div>
                <div class="col-8 cover--detail">
                    <?php if ($row_detail['giamoi']) { ?>
                        <span class="price-new-pro-detail" data-gia="<?= $row_detail['giamoi'] ?>"><?= format_money($row_detail['giamoi']) ?></span>
                        <span class="price-old-pro-detail"><?= format_money($row_detail['gia']) ?></span>
                    <?php } else { ?>
                        <span class="price-new-pro-detail" data-gia="<?= $row_detail['gia'] ?>"><?= ($row_detail['gia']) ? format_money($row_detail['gia']) : getLang('lienhe') ?></span>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-4 detail-title cover--detail" style="padding-left: 0%"><?= getLang('soluong') ?></div>
                <div class="col-4">
                    <div class="attr-content-pro-detail d-block">
                        <div class="quantity-pro-detail">
                            <span class="quantity-minus-pro-detail_2">-</span>
                            <input type="number" class="qty-pro" min="1" value="1" readonly />
                            <span class="quantity-plus-pro-detail_2">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="attr-content-pro-detail-2">
                        <?php

                        $ci = &get_instance();
                        $tui_giay = $ci->session->userdata('has_tuigiay');
                        if ($tui_giay == 'true') {
                            $check = 'checked';
                        } else {
                            $check = '';
                        }
                        ?>
                        <input <?= $check ?> type="checkbox" name="themtui" class="themtui" id="radio-themtui" />
                        <label for="radio-themtui" class="w-100 attr-label-pro-detail-3"><?= getLang('themtui') ?></label>
                    </div>
                </div>

            </div>

            <?php $this->load->view('page/product/gifts'); ?>
            <?php $this->load->view('page/product/voucher'); ?>



            <!--			<div class="wp-gift pt-4 pb-4">-->
            <!--				<div class="sp_dis_container">-->
            <!--					<div class="row">-->
            <!--						 in đậm -->
            <!--						<div class="col-8">-->
            <!--							<div class="sp_dis_title">-->
            <!--								Các sản phẩm tặng kèm-->
            <!--							</div>-->
            <!--							<div class="sp_dis_mota">-->
            <!--								Chọn 1 trong các quà tặng-->
            <!--							</div>-->
            <!--						</div>-->
            <!--						<div class="col-4 text-right">-->
            <!--							div class="img-thumbnail_dis">-->
            <!--								<img class=" float-end"-->
            <!--									 width="50px"-->
            <!--									 src="giftbox.png" alt="Hình ảnh"/>-->
            <!--							</div> -->
            <!--						</div>-->
            <!--					</div>-->
            <!--					<div class="container-voucher mt-4">-->
            <!--						<div class="row">-->
            <!--							<div class="col-1">-->
            <!--								<div class="form-check">-->
            <!--									<input class="form-check-input" type="radio" id="age1" name="age" value="30"/>-->
            <!--								</div>-->
            <!--							</div>-->
            <!--							<div class="col-2 sp_img_dis">-->
            <!--								<img class="voucher-img" src="assets/images/noimage.webp" alt="Hình ảnh"/>-->
            <!--							</div>-->
            <!--							<div class="col-9">-->
            <!--								<div class="sp_cover_1">-->
            <!--									Khi mua-->
            <!--									<span class="red-text">1</span> BỘ ĐÔI KEM CHỐNG NẮNG 40ML VÀ BÔNG TÂY TRANG <br/>-->
            <!--									Tặng <span class="red-text">1</span> TÚI ĐỰNG MỸ PHẨM DU LỊCH [TRỊ GIÁ 30.000Đ]-->
            <!--								</div>-->
            <!--							</div>-->
            <!--						</div>-->
            <!--					</div>-->
            <!--					<div class="container-voucher mt-4">-->
            <!--						<div class="row">-->
            <!--							<div class="col-1">-->
            <!--								<div class="form-check">-->
            <!--									<input class="form-check-input" type="radio" id="age1" name="age" value="30"/>-->
            <!--								</div>-->
            <!--							</div>-->
            <!--							<div class="col-2 sp_img_dis">-->
            <!--								<img class="voucher-img" src="assets/images/noimage.webp" alt="Hình ảnh"/>-->
            <!--							</div>-->
            <!--							<div class="col-9">-->
            <!--								<div class="sp_cover_1">-->
            <!--									Khi mua <span class="red-text">1</span> BỘ ĐÔI KEM CHỐNG NẮNG 40ML VÀ BÔNG TÂY TRANG-->
            <!--									<br/>-->
            <!--									Tặng <span class="red-text">1</span> TÚI ĐỰNG MỸ PHẨM DU LỊCH [TRỊ GIÁ 30.000Đ]-->
            <!--								</div>-->
            <!--							</div>-->
            <!--						</div>-->
            <!--					</div>-->
            <!--				</div>-->
            <!--			</div>-->

            <!--TODO VOUCHER-->

            <!--<div class="wp-voucher">
                <p class="headingArea title--detail--1">Mã khuyến mãi</p>

                <div class="d-flex flex-row">
                    <div class="box-voucher">
                        ABC
                    </div>
                    <div class="box-voucher">
                        XYZ
                    </div>
                    <div class="box-voucher">
                        XYZ
                    </div>
                </div>
            </div>-->

            <?php $fast_delivery_2h = mySetting('fast_delivery_2h');

            if ($fast_delivery_2h) :
            ?>

                <div class="quick_ship">
                    <img class="imgimage_quick_ship loading" src="<?= MYSITE ?>assets/images/now-free.png">
                    <?= htmlspecialchars_decode($fast_delivery_2h) ?>
                    <style>
                        .quick_ship {
                            padding: 10px 0;
                        }

                        .imgimage_quick_ship {
                            height: 25px;
                            margin-right: 2px;
                            /* padding: 5px 0; */
                            padding-top: 5px;

                            /* margin-top: -4px; */
                            border: 0px;
                            font-size: 0;
                            line-height: 0;
                            max-width: 100%;
                        }

                        @media (min-width: 768px) and (max-width: 1024px) {
                            .imgimage_quick_ship {
                                height: 27px;
                                margin-right: 2px;
                                /* padding: 5px 0; */
                                padding-top: 5px;

                                /* margin-top: -4px; */
                                border: 0px;
                                font-size: 0;
                                line-height: 0;
                                max-width: 100%;
                            }
                        }
                    </style>
                </div>

            <?php endif; ?>
            <div class="row">
                <?= share_link(); ?>
            </div>
            <div class="row pt-5 cover-mb-combo-button">
                <div class="col-12">
                    <!-- <div class="col-6"></div> -->

                </div>
                <div class="wp-btn d-flex flex-row justify-content-start cover-mb-combo-button">
                    <div class="mr-1">
                        <!--wp-muangay-->
                        <a class="btn btn-primary buynow addcart text-decoration-none left" data-id="<?= $row_detail['id'] ?>" data-action="buynow" style="height: 100%;width: 100%;font-weight: bold;padding: 10px 20px;color: white;background-color: #3C5B2D;display: inline-block;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border: none;">
                            <span><?= getLang('dathang') ?></span>
                        </a>
                    </div>
                    <div class="mr-1">

                        <a class="btn btn-primary transition addnow addcart addcart2 text-decoration-none" target="_blank" data-id="<?= $row_detail['id'] ?>" data-action="addnow" style="width: 4rem; height: auto;border: 1px solid #3c5b2d;   background-color: #fff; color: white; padding: 10px 10px; text-decoration: none;">
                            <img src="<?= site_url(); ?>assets/icon/cart.png" width="25px" height="25px" />
                        </a>
                    </div>

                    <div>
                        <a class="btn btn-primary transition addnow addcart addcart2 text-decoration-none" target="_blank" href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>" style="font-weight: bold; background-color: #118acb; color: white; padding: 10px 20px; text-decoration: none;">
                            Zalo
                        </a>
                    </div>
                </div>
            </div>
            <!-- <div class="pt-5">
                <a href="https://ckdvietnam.vn/account/dangky">
                <img class="img-fluid" src="assets/images/banner_demo.webp"

                     alt="banner"/>
                </a>

            </div> -->
            <!--<div class="col-6">
					<div class="row">
						<div class="col-6">
							<p class="headingArea title--detail--1">Tổng số tiền:</p>
						</div>
						<div class="col-6">
							<div class="gia-font-cover">
								<span class="price-new-pro-detail"
									  data-gia="<?php /*= $row_detail['giamoi'] */ ?>"><?php /*= format_money($row_detail['giamoi']) */ ?></span>
							</div>
						</div>
					</div>
				</div>-->
            <!-- <div class="col-6">

            </div> -->
        </div>
    </div>
</div>

<div>
    <!--mt-5 py-2 main_fix section-->
    <div id="navbar-3" style="display: block;">
        <div id="spnarbar" style="display: none;">
            <div class="main_fix relative pc mt-2">
                <div class="info_sp_nav pt-3 d-flex justify-content-start">
                    <div class="thumb_sp_nav">
                        <img id="imgScrollFix" onerror="this.onerror=null;this.src='<?= image_default('empty') ?>'" src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>" alt="<?= $row_detail['ten'] ?>" class="loading img-fluid" data-was-processed="true" />
                    </div>
                    <div class="block_info_sp_nav w-100">
                        <div class="title_nav">
                            <?= $row_detail['ten'] ?? "" ?>
                        </div>
                        <div class="block_price_nave">
                            <?php if ($row_detail['giamoi']) { ?>
                                <span class="price-new-pro-detail" data-gia="<?= $row_detail['giamoi'] ?>"><?= format_money($row_detail['giamoi']) ?></span>
                                <span class="price-old-pro-detail"><?= format_money($row_detail['gia']) ?></span>
                            <?php } else { ?>
                                <span class="price-new-pro-detail" data-gia="<?= $row_detail['gia'] ?>"><?= ($row_detail['gia']) ? format_money($row_detail['gia']) : getLang('lienhe') ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="block_add_to_cart_nav">
                        <div class="wp-muangay">
                            <a class="btn btn-primary buynow addcart text-decoration-none left" data-id="<?= $row_detail['id'] ?>" data-action="buynow" style="width: 100%;font-weight: bold;font-size: 16px;padding: 10px 20px;color: white;background-color: #3C5B2D;display: inline-block;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border: none;">
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
                    <a id="trans_section_1" class="nav-link cover-nav-link fix-padding-one" href="#section1">
                        <?= getLang('thongtinsanpham') ?>
                    </a>
                </li>
                <li class="text-center w-25 nav-item frame-sesson-1" data-tabs="info-thanhphan">
                    <a id="trans_section_2" class="nav-link cover-nav-link fix-padding-one" href="#section2">
                        <?= getLang('thanhphansanpham') ?>
                    </a>
                </li>
                <li class="text-center w-25 nav-item frame-sesson-1" data-tabs="commentfb-pro-detail">
                    <a id="trans_section_3" class="nav-link cover-nav-link fix-padding-one" href="#section3">
                        <?= getLang('binhluan') ?>
                    </a>
                </li>
                <li class="text-center w-25 nav-item frame-sesson-1" data-tabs="sanphamcungloai-detail">
                    <a id="trans_section_4" class="nav-link cover-nav-link fix-padding-one" href="#section4">
                        <?= getLang('sanphamcungloai') ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="section1" class="main_fix section" style="padding-top: 0px;">
    <div id="box_sanpham" class="w-100 content-tabs-pro-detail info-pro-detail active">
        <h2 class="py-5 d-flex text-center m-auto w-50">
            <span class="w-100 d-block"><?= getLang('thongtinsanpham') ?></span>
        </h2>

        <?= htmlspecialchars_decode($row_detail['noidung'] ?? "") ?>
    </div>
</div>
<div id="section2" class="main_fix section">
    <div id="box_thanhphansanpham" class="w-100 content-tabs-pro-detail info-thanhphan">
        <h2 class="py-5 d-flex text-center m-auto w-50">
            <span class="w-100 d-block"><?= getLang('thanhphansanpham') ?></span>
        </h2>
        <?= htmlspecialchars_decode($row_detail['noidungthanhphan'] ?? "") ?>
    </div>
</div>
<div id="section3" class="main_fix section">
    <?php /*if (is_array($danhgia) && count($danhgia) > 0) : */ ?>

    <div id="box_binhluan" class="w-100 content-tabs-pro-detail commentfb-pro-detail">

        <h2 class="py-5 d-flex text-center m-auto w-50">
            <span class="w-100 d-block"><?= getLang('binhluan') ?></span>
        </h2>

        <div class="sao_bl"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>

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
                    <p class="dong">5 <?= getLang('sao') ?> <span><b style="width:<?= ($sao5['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao5['dem'] ?>
                        <?= getLang('rathailong') ?>
                    </p>
                    <p class="dong">4 <?= getLang('sao') ?> <span><b style="width:<?= ($sao4['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao4['dem'] ?>
                        <?= getLang('hailong') ?>
                    </p>
                    <p class="dong">3 <?= getLang('sao') ?> <span><b style="width:<?= ($sao3['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao3['dem'] ?>
                        <?= getLang('binhthuong') ?>
                    </p>
                    <p class="dong">
                        2 <?= getLang('sao') ?>
                        <span>
                            <b style="width:<?= ($sao2['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao2['dem'] ?>
                        <?= getLang('khonghailong') ?>
                    </p>
                    <p class="dong">1 <?= getLang('sao') ?> <span><b style="width:<?= ($sao1['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao1['dem'] ?>
                        <?= getLang('ratte') ?>
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

                <form class="form-contact validation-contact" novalidate method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="link_video" id="link_video" value="5">
                    <div class="input-contact">
                        <input type="file" class="custom-file-input" name="file">
                        <label class="custom-file-label" for="file" title="<?= getLang('chon') ?>"><?= getLang('chonhinhanh') ?></label>
                        <p>.jpg, .png, .gif</p>
                    </div>

                    <div class="input-contact">
                        <textarea class="form-control" id="motavi" name="motavi" placeholder="<?= getLang('noidung') ?>" required /></textarea>
                        <div class="invalid-feedback"><?= getLang('vuilongnhapnoidung') ?></div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit-contact" value="<?= getLang('gui') ?>" disabled />
                    <input type="reset" class="btn btn-secondary" value="<?= getLang('nhaplai') ?>" />
                    <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
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
                    if (!empty($v['id_member']) && $v['id_member'] == 1) {
                    } else {
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
                            <div class="slider-img img img_post"><img data-sosao="<?= $sosao ?>" data-danhgia="true" data-id="<?= $v['id'] ?>" src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>" alt="<?= !empty($v['ten']) ? $v['ten'] : '' ?>">
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                ?>


                <?php

                if (!empty($paging_danhgia)) {
                ?>
                    <div class="my-2 pt-4">
                        <div class="pagination-home">
                            <?= (isset($paging_danhgia) && $paging_danhgia != '') ? $paging_danhgia : '' ?></div>
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
            <div class="wap_loadthem_sp" data-div=".loadthem_sp100" data-lan="1" data-where="<?= $where ?>" data-sosp="<?= $sosp ?>" data-max="<?= $solan_max ?>">
                <div class="wap_item loadthem_sp100">

                </div>
                <?php if ($solan_max > 1) { ?><p class="load_them"><?= getLang('xemthem') ?>
                        <span><?= ($dem['numrows'] - $sosp) ?></span> <?= getLang('sanpham') ?> <i class="fas fa-caret-right"></i>
                    </p><?php } ?>
            </div>
        </div>

    </div>
</div>


<input type="hidden" value="<?= $row_detail['id'] ?>" id="pid" />



<link rel="stylesheet" href="<?= MYSITE ?>assets/swiper/swiper-bundle.min.css?v=<?= time() ?>" />

<script defer src="<?= MYSITE ?>assets/swiper/swiper-bundle.min.js?v=<?= time() ?>"></script>


<script>
    const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
        direction: "vertical",
        slidesPerView: 4,
        centeredSlides: false,
        roundLengths: true,
        spaceBetween: 0,
        navigation: {
            nextEl: ".slider__next",
            prevEl: ".slider__prev",
        },
        autoplay: {
            delay: 3500,
        },
        freeMode: true,
        breakpoints: {
            0: {
                direction: "vertical",
            },
            768: {
                direction: "vertical",
            },
        },
    });

    const sliderImages = new Swiper(".slider__images.detail-swiper .swiper-container", {
        autoplay: {
            delay: 3500,
        },
        direction: "vertical",
        slidesPerView: 1,
        spaceBetween: 10,
        mousewheel: true,
        navigation: {
            nextEl: ".slider__next",
            prevEl: ".slider__prev",
        },
        grabCursor: true,
        thumbs: {
            swiper: sliderThumbs,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
                direction: "horizontal",
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 10,
                direction: "vertical",
            },
        },
    });
</script>


<style>
    .wwp-review .swiper-wrapper {
        height: 7.0244rem;
    }

    .all_review {
        z-index: 9999999999 !important;
    }

    .slider__thumbs .swiper-wrapper .swiper-slide:first-child {}

    #scrollable {
        height: 1000px;
        overflow: scroll;
        position: relative;
        overflow-x: hidden;
    }
</style>

<script>
    // Code goes here

    /*    document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var hash = document.location.hash;
                if (hash) {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $(hash).offset().top
                    }, 500, function () {


                        window.location.hash = hash;
                    });
                }
            }, 500);
        })*/

    $(document).ready(function() {


        var loading = false;

        load_san_pham_cung_loai();

        function load_san_pham_cung_loai(_this) {

            const where = $(_this).data('where') || "<?= $where ?>";
            const sosp = $(_this).data('solan') || "<?= $sosp ?>";

            if (!loading) {
                loading = true;
                load_them('.loadthem_sp100', 0, where, sosp);
            }
        }


        $('.nav-link.cover-nav-link').on('click', function(e) {

            e.preventDefault();

        })


        $('[data-spy="scroll"]').each(function() {
            var $spy = $(this).scrollspy('refresh');
        });

        $('#target_nav').on('activate.bs.scrollspy', function() {
            var activeTab = $('.nav-tabs li.active a');
            activeTab.parent().removeClass('active');
            activeTab.tab('show');
        });


        setTimeout(fixEdImages, 1500);

        const checkbox = document.getElementById('radio-themtui')
        checkbox.addEventListener('change', (event) => {
            $check = event.currentTarget.checked;
            $.ajax({
                type: "post",
                url: site_url() + "ajax/sethasTuiGiay",
                data: {
                    has_tuigiay: $check ? 'true' : 'false'
                },
                beforeSend: function() {},
            })
        })
    });
</script>

<script>
    // JavaScript để xử lý Scrollspy
    window.addEventListener("scroll", function() {
        const sections = document.querySelectorAll(".section");
        let currentSection = "";

        sections.forEach((section) => {
            const sectionTop = section.offsetTop - 0;
            const sectionHeight = section.clientHeight;
            if (
                pageYOffset >= sectionTop &&
                pageYOffset < sectionTop + sectionHeight
            ) {
                currentSection = section.getAttribute("id");
            }
        });

        const navLinks = document.querySelectorAll(".nav-link");

        // khi click vào tab thì sẽ scroll đến section tương ứng và active tab đó ngay lập tức và khi scroll thì tab đó sẽ active theo section tương ứng
        navLinks.forEach((link) => {
            link.addEventListener("click", () => {
                for (let i = 0; i < navLinks.length; i++) {
                    navLinks[i].classList.remove("active");

                }
                link.classList.add("active");
                const target = link.getAttribute("href").substring(1);
                const targetSection = document.getElementById(target);
                window.scrollTo({
                    top: targetSection.offsetTop - 0,
                    behavior: "smooth",
                });
            });
        });

        navLinks.forEach((link) => {

            link.classList.remove("active");
            if (link.getAttribute("href").substring(1) == (currentSection)) {
                link.classList.add("active");
            }
        });

        const navbar = document.getElementById("navbar-3");
        const cover_nav_link = document.querySelectorAll(".cover-nav-link");
        var block = $('#details').outerHeight();


        var spnarbar = document.getElementById('spnarbar');


        if (document.documentElement.scrollTop > 1100) {
            $('#navbar-3').addClass('fixed-top-mb');
            $('#trans_section_1').removeClass('fix-padding-two');
            $('#trans_section_2').removeClass('fix-padding-two');
            $('#trans_section_3').removeClass('fix-padding-two');
            $('#trans_section_4').removeClass('fix-padding-two');
            $('#spnarbar').show();
        } else {
            $('#navbar-3').removeClass('fixed-top-mb');
            $('#trans_section_1').addClass('fix-padding-two');
            $('#trans_section_2').addClass('fix-padding-two');
            $('#trans_section_3').addClass('fix-padding-two');
            $('#trans_section_4').addClass('fix-padding-two');
            $('#spnarbar').show();
        }
    });
</script>


<script defer type="application/javascript">
    var galleryThumbs = new Swiper(".gallery-thumbs", {
        centeredSlides: true,
        centeredSlidesBounds: true,
        slidesPerView: 3,
        watchOverflow: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        direction: 'vertical',
        spaceBetween: 10,
        autoplay: {
            delay: 3500,
        },
        breakpoints: {
            0: {
                spaceBetween: 8,
                direction: "horizontal",
            },
            991: {
                spaceBetween: 10,
                direction: "horizontal",
            },
            992: {
                spaceBetween: 10,
                direction: "vertical",
            },
        },
    });

    var galleryMain = new Swiper(".gallery-main", {

        autoplay: {
            delay: 3500,
        },
        watchOverflow: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        preventInteractionOnTransition: true,
        /*navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },*/
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        thumbs: {
            swiper: galleryThumbs
        }
    });

    galleryMain.on('slideChangeTransitionStart', function() {
        galleryThumbs.slideTo(galleryMain.activeIndex);
    });

    galleryThumbs.on('transitionStart', function() {
        galleryMain.slideTo(galleryThumbs.activeIndex);
    });

    const sliderReivew = new Swiper('.review-swiper', {
        direction: "horizontal",
        slidesPerView: 3,
        spaceBetween: 0,
        freeMode: true,
        loop: false,
        autoplay: {
            delay: 3000,
        },
    });
</script>