<?php echo create_BreadCrumbs('account/thong-tin', 'Thông tin tài khoản');

$city = $d->rawQuery("select ten, id from #_city order by id asc");
$my_city = array();
if (@$this->isLogin) {
    $my_city = $d->rawQueryOne("select city, district, wards from #_member where id = ? ", array($this->isLogin));
}


?>


<div class="main_fix my-5">


    <?php if (@$voucher) : ?>

    <?php
        $da_su_dung = $voucher['used_date'] ?? false;
        if ($da_su_dung) {
            $text_da_su_dung = 'Bạn đã sử dụng mã giảm giá!';
        } else {
            $text_da_su_dung = getLang('text_giamgia');
        }


        ?>
    <div class="my_voucher_new">
        <div class="wp">
            <div class="title-main"><span><?= getLang('text_voucher_title') ?></span></div>
            <ul class="bc_voucher_list" id="list-vouchers-main">
                <li class="bc_voucher_item row flex-wrap g-2 <?= $da_su_dung ? 'disabled' : '' ?>">
                    <a href="<?= site_url('san-pham') ?>" class="bc_voucher_logo" rel="nofollow"> <img
                            src="<?= site_url('assets/images/giftbox.png') ?>"
                            data-src="<?= site_url('assets/images/giftbox.png') ?>"
                            class="bc_lazyload ls-is-cached lazyloaded" alt="CKD COS VIỆT NAM">
                        <span>Voucher</span> </a>
                    <div class="bc_voucher_info">

                        <span class="bc_voucher_divider"></span>
                        <div class="bc_voucher_content">
                            <div class="bc_voucher_content_main mt-2">

                                <div class="bc_voucher_title"><span class="bc_voucher_label"
                                        style="background-color: #ffe89b;color: #eb3600;">

                                        <?= !$da_su_dung ? '' : $text_da_su_dung ?>
                                    </span>
                                    &nbsp;
                                    <span>



                                        <?php if (!$da_su_dung) : echo (getLang('text_voucher') . @$voucher['discount_percentage'] . '%');
                                            endif; ?></span>
                                </div>


                                <div class="copy-text">
                                    <input type="text" class="text" value="<?= @$voucher['magiamgia'] ?>" />
                                    <button><i class="fa fa-clone"></i></button>
                                </div>

                                <!--<span><?php /*=$voucher*/ ?></span>-->
                            </div>
                            <div class="bc_voucher_action">

                                <div class="bc_voucher_buttons">
                                    <a class="bc_voucher_button bc_voucher_copy" href="<?= site_url('san-pham') ?>"> <i
                                            class="fas fa-shopping-cart"></i>
                                        <span><?= getLang('text_dungngay') ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
    <?php endif; ?>


    <div class="wrap-user">


        <!--<div class="line"></div>-->
        <div class="title-user">
            <span><?= getLang('thongtincanhan') ?></span>
        </div>
        <form class="form-user validation-user" novalidate method="post" action="account/thongtin_process"
            enctype="multipart/form-data">
            <label for="basic-url"><?= getLang('hoten') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control" id="ten" name="ten" placeholder="<?= getLang('nhaphoten') ?>"
                    value="<?= $row_detail['ten'] ?>" required>
                <div class="invalid-feedback"><?= getLang('vuilongnhaphoten') ?></div>
            </div>
            <label for="basic-url"><?= getLang('taikhoan') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="<?= getLang('nhaptaikhoan') ?>" value="<?= $row_detail['username'] ?>" required>
            </div>
            <label for="basic-url"><?= getLang('matkhaucu') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="<?= getLang('nhapmatkhaucu') ?>">
            </div>
            <label for="basic-url"><?= getLang('matkhaumoi') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="new-password" name="new-password"
                    placeholder="<?= getLang('nhapmatkhaumoi') ?>">
            </div>
            <label for="basic-url"><?= getLang('nhaplaimatkhaumoi') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="new-password-confirm" name="new-password-confirm"
                    placeholder="<?= getLang('nhaplaimatkhaumoi') ?>">
            </div>
            <label for="basic-url"><?= getLang('gioitinh') ?></label>
            <div class="input-group input-user">
                <div class="radio-user custom-control custom-radio">
                    <input type="radio" id="nam" name="gioitinh" class="custom-control-input"
                        <?= $row_detail['gioitinh'] == 1 ? 'checked' : '' ?> value="1" required>
                    <label class="custom-control-label" for="nam"><?= getLang('nam') ?></label>
                </div>
                <div class="radio-user custom-control custom-radio">
                    <input type="radio" id="nu" name="gioitinh" class="custom-control-input"
                        <?= $row_detail['gioitinh'] == 2 ? 'checked' : '' ?> value="2" required>
                    <label class="custom-control-label" for="nu"><?= getLang('nu') ?></label>
                </div>
            </div>
            <label for="basic-url"><?= getLang('ngaysinh') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="text" class="form-control" id="ngaysinh" name="ngaysinh"
                    placeholder="<?= getLang('nhapngaysinh') ?>"
                    value="<?= !empty($row_detail['ngaysinh']) ? @date("d/m/Y", $row_detail['ngaysinh']) : '' ?>"
                    required>
                <div class="invalid-feedback"><?= getLang('vuilongnhapsodienthoai') ?></div>
            </div>
            <label for="basic-url">Email</label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                </div>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="<?= getLang('nhapemail') ?>" value="<?= $row_detail['email'] ?>" required>
                <div class="invalid-feedback"><?= getLang('vuilongnhapdiachiemail') ?></div>
            </div>
            <label for="basic-url"><?= getLang('dienthoai') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-phone-square"></i></div>
                </div>
                <input type="number" class="form-control" id="dienthoai" name="dienthoai"
                    placeholder="<?= getLang('nhapdienthoai') ?>" value="<?= $row_detail['dienthoai'] ?>" required>
                <div class="invalid-feedback"><?= getLang('vuilongnhapsodienthoai') ?></div>
            </div>


            <label for="basic-url"><?= getLang('diachi') ?></label>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-map"></i></div>
                </div>
                <input type="text" class="form-control" id="diachi" name="diachi"
                    placeholder="<?= getLang('nhapdiachi') ?>" value="<?= $row_detail['diachi'] ?>" required>
                <div class="invalid-feedback"><?= getLang('vuilongnhapdiachi') ?></div>
            </div>

            <div class="input-group input-user input-triple-cart ">
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
                    <select class="select-district-cart select-district custom-select" required id="district"
                        name="district">
                        <option value=""><?= getLang('quanhuyen') ?></option>
                    </select>
                    <div class="invalid-feedback"><?= getLang('vuilongchonquanhuyen') ?></div>
                </div>
                <div class="input-cart mb-0">
                    <select class="select-wards-cart select-wards custom-select" required id="wards" name="wards">
                        <option value=""><?= getLang('phuongxa') ?></option>
                    </select>
                    <div class="invalid-feedback"><?= getLang('vuilongchonphuongxa') ?></div>
                </div>
            </div>


            <div class="button-user">
                <input type="submit" class="btn btn-primary btn-block" name="capnhatthongtin"
                    value="<?= getLang('capnhat') ?>" disabled>
            </div>
        </form>
    </div>
</div>


<style>
.copy-text {
    position: relative;
    padding: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    display: flex;
}

.copy-text input.text {
    padding: 5px;
    font-size: 1rem;
    color: #555;
    border: 1px dashed;
    outline: none;
    margin: 0.25rem 0;
    margin-right: 0.5rem;
}

.copy-text button {
    padding: 1rem;
    background: hotpink;
    color: #fff;
    font-size: 1rem;
    border: none;
    outline: none;
    border-radius: 10px;
    cursor: pointer;
}

.copy-text button:active {
    background: #809ce2;
}

.copy-text button:before {
    content: "Copied";
    position: absolute;
    top: -45px;
    right: 0px;
    background: #5c81dc;
    padding: 8px 10px;
    border-radius: 20px;
    font-size: 15px;
    display: none;
}

.copy-text button:after {
    content: "";
    position: absolute;
    top: -20px;
    right: 25px;
    width: 10px;
    height: 10px;
    background: #5c81dc;
    transform: rotate(45deg);
    display: none;
}

.copy-text.active button:before,
.copy-text.active button:after {
    display: block;
}


.my_voucher {
    display: block;
    position: absolute;
    top: 0;
    left: 0;

    width: 20rem;
    height: 20rem;
}

.bc_voucher_label {
    background-color: #ffa500;
    color: #5f4b14;
}

.bc_voucher_list * {
    box-sizing: border-box;
    border: 0 solid #e2e8f0;
}

.bc_voucher_list .bc_voucher_item+.bc_voucher_item {
    margin-top: 1rem;
}

.bc_voucher_item .bc_voucher_logo {


    background-color: hotpink;
    display: inline-flex;
    flex: 0 0 auto;
    width: 106px;
    position: relative;
    align-items: center;
    justify-content: center;
    border-radius: 4px 0 0 4px;
    flex-direction: column;
    color: #fff;
    padding: 1rem;
    text-align: center;
    outline: 0 !important;
    text-decoration: none;
}

.bc_voucher_item .bc_voucher_logo>img {
    -o-object-fit: contain;
    object-fit: contain;
    /* border-radius: 100%;*/
    display: inline-flex;
    flex: 0 0 auto;
    width: 60px;
    height: 60px;
    pointer-events: none;
}

.bc_voucher_item .bc_voucher_logo>span {
    font-size: 0.75rem;
    line-height: 1rem;
    margin-top: 0.2rem;
    max-width: 4rem;
    color: blanchedalmond;
}

.bc_voucher_content {
    text-align: left;
}

.bc_voucher_list .bc_voucher_item {
    display: flex;
    gap: 1rem;

    background: #fff;
    max-width: 100%;
    width: fit-content;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
    border-radius: 0 8px 8px 0;
    color: #000;

    margin: 2rem auto;
    padding: 1rem;
    text-align: center;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
}

.disabled {
    user-select: none;
    pointer-events: none;
    filter: grayscale(1);
}
</style>
<script type="text/javascript">
setTimeout(function() {
    $(document).ready(function() {

        let copyText = document.querySelector(".copy-text");
        copyText.querySelector("button").addEventListener("click", function() {
            let input = copyText.querySelector("input.text");
            input.select();
            document.execCommand("copy");
            copyText.classList.add("active");
            window.getSelection().removeAllRanges();
            setTimeout(function() {
                copyText.classList.remove("active");
            }, 2500);
        });


        $('.c_themdiachi').click(function() {
            $('.themdiachi').append(
                '<div class="input-group input-user"><div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-map"></i></div></div><input type="text" class="form-control" name="diachi2[]" placeholder="<?= getLang('nhapdiachi') ?>"><span class="dlt_dc"><i class="fas fa-trash-alt"></i></span></div>'
            );
            return false;
        })
        $(document).on('click', '.dlt_dc', function() {
            $(this).parents('.input-user').remove();
            return false;
        })
    });
}, 1000)

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
</script>