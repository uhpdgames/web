<?php

//$allVoucher = getCurrentVoucher();
//qq($allVoucher);

$has_voucher = mySetting('is_voucher') ? TRUE : FALSE;
$magiamgia = '';
if (!empty($voucher)) {

    $discount = $voucher['discount_percentage'];
    $magiamgia = $voucher['magiamgia'];
}

$my_city = array();
if (@$this->isLogin) {
    $my_city = $d->rawQueryOne("select dienthoai,email, diachi, city,district,wards from #_member where id=?", array($this->isLogin ?? 0));
}

$qua_tang = $this->session->userdata('has_quatang');


?>
<div class="main_fix my-4">
    <form class="pl-4 form-cart validation-cart" novalidate method="post" action="order/process"
        enctype="multipart/form-data">
        <div class="wrap-cart row pl-3">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart'])) { ?>
            <div class="col-12 col-lg-6 top-cart ">
                <p class="title-cart"><?= getLang('giohangcuaban') ?>:</p>
                <div class="list-procart">
                    <div class="procart procart-label d-flex align-items-start justify-content-between">
                        <div class="pic-procart"><?= getLang('hinhanh') ?></div>
                        <div class="info-procart"><?= getLang('tensanpham') ?></div>
                        <div class="quantity-procart">
                            <p><?= getLang('soluong') ?></p>
                            <p><?= getLang('thanhtien') ?></p>
                        </div>
                        <div class="price-procart"><?= getLang('thanhtien') ?></div>
                    </div>
                    <?php $max = count($_SESSION['cart']);
                        for ($i = 0; $i < $max; $i++) {



                            $pid = $_SESSION['cart'][$i]['productid'];
                            $quantity = $_SESSION['cart'][$i]['qty'];
                            $mau = ($_SESSION['cart'][$i]['mau']) ? $_SESSION['cart'][$i]['mau'] : 0;
                            $size = ($_SESSION['cart'][$i]['size']) ? $_SESSION['cart'][$i]['size'] : 0;
                            $code = ($_SESSION['cart'][$i]['code']) ? $_SESSION['cart'][$i]['code'] : '';
                            $proinfo = $cart->get_product_info($pid);
                            $pro_price = $proinfo['gia'];
                            $pro_price_new = $proinfo['giamoi'];
                            $pro_price_qty = $pro_price * $quantity;
                            $pro_price_new_qty = $pro_price_new * $quantity;
                        ?>
                    <div class="procart procart-<?= $code ?> d-flex align-items-start justify-content-between">
                        <div class="pic-procart">
                            <a class="text-decoration-none" href="san-pham/<?= $proinfo[$sluglang] ?>" target="_blank"
                                title="<?= $proinfo['ten' . $lang] ?>"><img
                                    src="<?= UPLOAD_PRODUCT_L . toWebp($proinfo['photo']) ?>"
                                    alt="<?= $proinfo['ten' . $lang] ?>"></a>
                            <a class="del-procart text-decoration-none" data-code="<?= $code ?>">
                                <i class="fa fa-times-circle"></i>
                                <span><?= getLang('xoa') ?></span>
                            </a>
                        </div>
                        <div class="info-procart">
                            <h3 class="name-procart"><a class="text-decoration-none"
                                    href="san-pham/<?= $proinfo[$sluglang] ?>" target="_blank"
                                    title="<?= $proinfo['ten' . $lang] ?>"><?= $proinfo['ten' . $lang] ?></a>
                            </h3>
                            <div class="properties-procart">
                                <?php if ($mau) {
                                            #$maudetail = $d->rawQueryOne("select ten$lang from #_product_mau where type = ? and id = ? limit 0,1", array($proinfo['type'], $mau)); 
                                        ?>

                                <?php } ?>
                                <?php if ($size) {
                                            #$sizedetail = $d->rawQueryOne("select ten$lang from #_product_size where type = ? and id = ? limit 0,1", array($proinfo['type'], $size)); 
                                        ?>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="quantity-procart">
                            <div class="price-procart price-procart-rp">
                                <?php if ($proinfo['giamoi']) { ?>
                                <p class="price-new-cart load-price-new-<?= $code ?>">
                                    <?= format_money($pro_price_new_qty) ?>
                                </p>
                                <p class="price-old-cart load-price-<?= $code ?>">
                                    <?= format_money($pro_price_qty) ?>
                                </p>
                                <?php } else { ?>
                                <p class="price-new-cart load-price-<?= $code ?>">
                                    <?= format_money($pro_price_qty) ?>
                                </p>
                                <?php } ?>
                            </div>
                            <div
                                class="quantity-counter-procart quantity-counter-procart-<?= $code ?> d-flex align-items-stretch justify-content-between">
                                <span class="counter-procart-minus counter-procart">-</span>
                                <input type="number" class="quantity-procat" min="1" value="<?= $quantity ?>"
                                    data-pid="<?= $pid ?>" data-code="<?= $code ?>" />
                                <span class="counter-procart-plus counter-procart">+</span>
                            </div>
                            <div class="pic-procart pic-procart-rp">
                                <a class="text-decoration-none" href="san-pham/<?= $proinfo[$sluglang] ?>"
                                    target="_blank" title="<?= $proinfo['ten' . $lang] ?>"><img
                                        src="<?= UPLOAD_PRODUCT_L . toWebp($proinfo['photo']) ?>"
                                        alt="<?= $proinfo['ten' . $lang] ?>"></a>
                                <a class="del-procart text-decoration-none" data-code="<?= $code ?>">
                                    <i class="fa fa-times-circle"></i>
                                    <span><?= getLang('xoa') ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="price-procart">
                            <?php if ($proinfo['giamoi']) { ?>
                            <p class="price-new-cart load-price-new-<?= $code ?>">
                                <?= format_money($pro_price_new_qty) ?>
                            </p>
                            <p class="price-old-cart load-price-<?= $code ?>">
                                <?= format_money($pro_price_qty) ?>
                            </p>
                            <?php } else { ?>
                            <p class="price-new-cart load-price-<?= $code ?>">
                                <?= format_money($pro_price_qty) ?>
                            </p>
                            <?php } ?>
                        </div>


                    </div>


                    <?php } ?>
                    <?php

                        if ($tui_giay == 'true') {

                        ?>
                    <div class="procart d-flex align-items-center justify-content-between">


                        <input type="hidden" value="1" name="tui_giay">
                        <div class="pic-procart">
                            <img src="<?= MYSITE ?>assets/images/paper_bag.webp" style="width: 150px" sizes="150px"
                                height="150px" width="150px">
                            <a class="current-dels text-decoration-none">
                                <i class="fa fa-times-circle"></i>
                                <span><?= getLang('xoa') ?></span>
                            </a>
                        </div>


                        <div class="info-procart d-flex align-items-center">
                            <h3 class="name-procart">
                                <a class="text-decoration-none" title="Túi giấy">Túi giấy</a>


                            </h3>
                        </div>

                        <div class="quantity-procart">x1</div>


                        <div class="price-procart">
                            <p class="price-new-cart load-price-new-54d303c9ddc2a43df23563254885d936">
                                0đ
                            </p>
                        </div>

                    </div>

                    <?php
                        }
                        ?>

                    <?php
                        if (mySetting('is_gift') && is_array($qua_tang) && count($qua_tang) > 0) {
                        }

                        echo '<div id="my-gifts">';
                        echo html_gifts(null);
                        echo '</div>';
                        ?>


                </div>
                <div class="money-procart">
                    <?php if ($config['order']['ship']) { ?>
                    <div class="total-procart d-flex align-items-center justify-content-between">
                        <p><?= getLang('tamtinh') ?>:</p>
                        <p class="total-price load-price-temp"><?= format_money($cart->get_order_total()) ?></p>
                    </div>
                    <?php } ?>
                    <?php if ($config['order']['ship']) { ?>
                    <div class="total-procart d-flex align-items-center justify-content-between">
                        <p><?= getLang('phivanchuyen') ?>:</p>
                        <p class="total-price load-price-ship">0đ</p>
                    </div>
                    <?php } ?>


                    <?php
                        if ($magiamgia != '' || $has_voucher) :
                        ?>
                    <div class="total-procart discount align-items-center justify-content-between"
                        style="display: none;">
                        <p>Giảm giá:</p>
                        <p class="total-price load-price-voucher">0đ</p>
                    </div>

                    <?php
                        endif;
                        ?>


                    <div class="total-procart d-flex align-items-center justify-content-between">
                        <p><?= getLang('tongtien') ?>:</p>
                        <p class="total-price load-price-total"><?= format_money($cart->get_order_total()) ?></p>
                    </div>
                    <input type="hidden" class="price-temp" name="price-temp" value="<?= $cart->get_order_total() ?>">
                    <input type="hidden" class="price-ship" name="price-ship">
                    <input type="hidden" class="price-ship_code" name="ship_code">

                    <input type="hidden" name="price-total" class="price-total" value="<?= $cart->get_order_total() ?>">
                </div>

            </div>
            <div class="col-12 col-lg-6 bottom-cart">
                <div class="load-cart"></div>
                <div class="section-cart">
                    <p class="title-cart"><?= getLang('hinhthucthanhtoan') ?>:</p>
                    <div class="information-cart">

                        <?php

                            foreach ($httt as $key => $value) {
                                if (!empty($value['id']) && $value['id'] == 1) {
                                    $image = image_default('momo');
                                } elseif ($value['id'] == 2) {
                                    $image = image_default('zalo');
                                } elseif ($value['id'] == 12) {
                                    $image = image_default('delivery-transfer-footer');
                                } elseif ($value['id'] == 13) {
                                    $image = image_default('delivery-local-footer');
                                    //$image = '';
                                } else {
                                    $image = 'https://cdn-icons-png.freepik.com/512/14062/14062982.png';
                                }

                            ?>
                        <div class="payments-cart custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="payments-<?= $value['id'] ?>"
                                name="payments" value="<?= $value['id'] ?>" required>
                            <label class="payments-label custom-control-label" for="payments-<?= $value['id'] ?>"
                                data-payments="<?= $value['id'] ?>">
                                <?php if (true) {
                                            if (!empty($image)) { ?><img src="<?= $image; ?>"
                                    alt="<?= $value['ten' . $lang] ?>"><?php }
                                                                                                                            } ?>
                                <?= $value['ten' . $lang] ?>
                                <span class="clear"></span>
                            </label>

                            <div class="payments-info payments-info-<?= $value['id'] ?> transition">
                                <?= htmlspecialchars_decode($value['mota' . $lang] ?? "") ?></div>
                        </div>
                        <?php } ?>
                    </div>
                    <p class="title-cart"><?= getLang('thongtingiaohang') ?>:</p>
                    <div class="information-cart">
                        <div class="input-double-cart clear">
                            <div class="input-cart">
                                <input type="text" class="form-control" id="ten" name="ten"
                                    placeholder="<?= getLang('hoten') ?>"
                                    value="<?= (isset($_SESSION[$login_member]['ten'])) ? $_SESSION[$login_member]['ten'] : '' ?>"
                                    required />
                                <div class="invalid-feedback"><?= getLang('vuilongnhaphoten') ?></div>
                            </div>
                            <div class="input-cart">
                                <input type="number" onKeyPress="if(this.value.length==11) return false;"
                                    class="form-control" id="dienthoai" name="dienthoai"
                                    placeholder="<?= getLang('sodienthoai') ?>" value="<?= @$my_city['email'] ?? "" ?>"
                                    required />
                                <div class="invalid-feedback" id="invalid-phone">
                                    <?= getLang('vuilongnhapsodienthoai') ?></div>
                            </div>
                        </div>
                        <div class="input-cart">
                            <input required type="email" class="form-control" id="email" name="email"
                                placeholder="Email" value="<?= @$my_city['email'] ?? "" ?>" />
                        </div>


                        <div class="input-triple-cart clear">
                            <div class="input-cart mb-0">
                                <select class="select-city-cart custom-select" required id="city" name="city">
                                    <option value=""><?= getLang('tinhthanh') ?></option>
                                    <?php for ($i = 0; $i < count($city); $i++) { ?>
                                    <option value="<?= $city[$i]['id'] ?>"><?= $city[$i]['ten'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"><?= getLang('vuilongchontinhthanh') ?></div>
                            </div>
                            <div class="input-cart mb-0">
                                <select class="select-district-cart select-district custom-select" required
                                    id="district" name="district">
                                    <option value=""><?= getLang('quanhuyen') ?></option>
                                </select>
                                <div class="invalid-feedback"><?= getLang('vuilongchonquanhuyen') ?></div>
                            </div>
                            <div class="input-cart mb-0">
                                <select class="select-wards-cart select-wards custom-select" required id="wards"
                                    name="wards">
                                    <option value=""><?= getLang('phuongxa') ?></option>
                                </select>
                                <div class="invalid-feedback"><?= getLang('vuilongchonphuongxa') ?></div>
                            </div>
                        </div>

                        <div class="input-cart">
                            <input type="text" class="form-control" id="diachi" name="diachi"
                                placeholder="<?= getLang('diachi') ?>" value="<?= @$my_city['diachi'] ?? "" ?>"
                                required />
                            <div class="invalid-feedback"><?= getLang('vuilongnhapdiachi') ?></div>
                        </div>

                        <?php
                            if (isset($this->userInfo['id'])) {
                                $user_dc = $d->rawQuery("select tenvi from #_news where id_user= ? and type = ? and hienthi > 0", array(@$this->userInfo['id'] ?? 0, 'user'));
                            ?>
                        <!--<p class="c_doidiachi tdtt">+ <?php /*= getLang('thaydoi') */ ?></p>-->
                        <div class="thongtin_dc" id="hidden-content">
                            <?php foreach ($user_dc as $k => $v) { ?>
                            <div class="item_dc">
                                <p class="ten"><?= $v['tenvi'] ?></p>
                                <p class="chon"><?= getLang('chon') ?></p>
                                <div class="clear"></div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <div class="input-cart">
                            <textarea class="form-control" id="yeucaukhac" name="yeucaukhac"
                                placeholder="<?= getLang('yeucaukhac') ?>" /></textarea>
                        </div>
                        <!--							<div class="input-cart ">-->
                        <!--								<input type="text" class="form-control" id="magioithieu" name="magioithieu"-->
                        <!--									   placeholder="--><?php //= getLang('magioithieu') 
                                                                                        ?>
                        <!--"-->
                        <!--									   value="--><?php //= (isset($_SESSION[$login_ctv]['code'])) ? $_SESSION[$login_ctv]['code'] : '' 
                                                                                    ?>
                        <!--"-->
                        <!--								/>-->
                        <!--							</div>-->
                        <?php if ($magiamgia != '') : ?>
                        <!--<div class="input-cart ">
									<input type="text" class="form-control" id="magiamgia" onblur="updateVoucher();"
										   name="magiamgia"
										   placeholder="<?php /*= getLang('text_voucher_title') */ ?>"
										   value=""
									/>

									<input type="hidden" value="" name="coupon_id" id="coupon_id">
									<input type="hidden" value="" name="giadagiam" id="giadagiam">
									<div class="invalid-feedback magiamgia"></div>

									<div class="ckd-discount-choose-coupons" style="display: none;">
										<div id="list_short_coupon">
											<span><span onclick="them_magiamgia(this)"
														data-code="<?php /*= @$magiamgia ?? '' */ ?>">Giảm <?php /*= @$discount ?? 10 */ ?>%</span></span>
										</div>
									</div>


								</div>-->
                        <?php endif; ?>

                        <?php $has_voucher = mySetting('is_voucher') ? TRUE : FALSE;
                            if ($has_voucher) : ?>
                        <div class="box-input-vouchers">
                            <input type="text" class="form-control" id="magiamgia" onblur="updateVoucher();"
                                name="magiamgia" placeholder="<?= getLang('text_voucher_title') ?>" value="" />

                            <input type="hidden" value="" name="coupon_id" id="coupon_id">
                            <input type="hidden" value="" name="giadagiam" id="giadagiam">
                            <div class="invalid-feedback magiamgia"></div>
                        </div>
                        <?php $this->load->view('page/product/voucher');
                            endif; ?>

                    </div>
                    <input type="submit" class="btn-cart btn btn-primary btn-lg btn-block" name="thanhtoan"
                        id="thanhtoan" value="<?= getLang('thanhtoan') ?>" disabled>
                </div>
            </div>
            <?php } else { ?>
            <a href="/" class="empty-cart text-decoration-none">
                <i class="fa fa-cart-arrow-down"></i>
                <p><?= getLang('khongtontaisanphamtronggiohang') ?></p>
                <span><?= getLang('vetrangchu') ?></span>
            </a>
            <?php } ?>
        </div>

        <input type="hidden" value="<?= @$this->userInfo['id'] ?? 0 ?>" name="uid" id="uid">
    </form>

</div>
<style>
/*todo ma giam gia*/
.fixed-vouchers-box {
    display: none;
}

/*   #testing-vouchers , .fixed-vouchers-footer-list{
        padding-bottom: 0;
    }*/


.invalid-feedback.magiamgia.succ {
    color: var(--color-red)
}

.invalid-feedback {
    text-align: left;
}

.ckd-discount-choose-coupons {
    cursor: pointer;
    display: -webkit-flex;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    color: #338dbc;
}

.ckd-discount-choose-coupons>div:first-child {
    flex: 0 0 100%;
    margin-top: 10px;
    margin-bottom: 10px;
}

.ckd-discount-choose-coupons {
    cursor: pointer;
    display: -webkit-flex;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    color: #338dbc;
}

.ckd-discount-choose-coupons #list_short_coupon {
    display: -webkit-flex;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    width: 100%;
}

.ckd-discount-choose-coupons #list_short_coupon>span {
    overflow: hidden;
    padding: 6px 0;
    position: relative;
    margin-bottom: 5px;
}

.ckd-discount-choose-coupons #list_short_coupon>span:not(:last-child) {
    margin-right: 5px;
}

.ckd-discount-choose-coupons #list_short_coupon>span:before {
    content: "";
    display: block;
    width: 10px;
    height: 10px;
    border: 1px solid #338dbc;
    background: #fff;
    z-index: 1;
    left: -7px;
    top: 50%;
    position: absolute;
    border-radius: 50%;
    transform: translateY(-50%);
}

.ckd-discount-choose-coupons #list_short_coupon>span span {
    border: 1px solid #338dbc;
    padding: 5px 10px;
    border-radius: 3px;
    background: #fff;
    font-weight: 700;
    color: #338dbc;
}

.ckd-discount-choose-coupons #list_short_coupon>span:after {
    content: "";
    display: block;
    width: 10px;
    height: 10px;
    border: 1px solid #338dbc;
    background: #fff;
    z-index: 1;
    right: -7px;
    top: 50%;
    position: absolute;
    border-radius: 50%;
    transform: translateY(-50%);
}
</style>

<script>
var current_price = $('.price-total').val() || '<?= $cart->get_order_total() ?>';
var current_price_label = '<?= format_money($cart->get_order_total()) ?>';
var text_voucher = '<?= getLang('text_voucher') . @$vouchers['discount_percentage'] . '%' ?>';

<?php
    if (is_array($my_city) && count($my_city) > 0) {
    ?>
var id_city = '<?= $my_city['city'] ?>';
var id_district = '<?= $my_city['district'] ?>';
var id_wards = '<?= $my_city['wards'] ?>';

$(function() {
    load_district(id_city);
    //load_wards(id_district)

    setTimeout(function() {
        $("#city").val(id_city);
        $("#district").val(id_district).change();
        load_wards(id_district);
    }, 500);

    setTimeout(function() {
        $("#wards").val(id_wards).change();
        $('.ckd-discount-choose-coupons').show();
    }, 1500);

});

<?php
    }
    ?>

$(document).ready(function() {
    $('.current-dels').on('click', function() {

        $(this).closest('.procart').remove();

        $.ajax({
            type: "post",
            url: site_url() + "ajax/sethasTuiGiay",
            data: {
                has_tuigiay: false
            },
            beforeSend: function() {},
        })

    })
})
</script>
<script defer type="application/javascript" src="<?= MYSITE ?>assets/js/order.js?v=<?= time() ?>"></script>