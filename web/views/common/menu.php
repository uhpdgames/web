<style>
.sz-navbar-mb {
    height: 4rem;
    top: 2rem;
    /* box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); */
}

.menu-icon-mb {
    max-width: 72%;
    height: auto;
}
</style>
<div class="pc cate-wrap">
    <div class="inner">
        <div class="main_fix">
            <!--site-wrap-->
            <div class="float-left">
                <?php
                $url = ENDPOINT_CKD_API . "fetch?select=contentvi&code=structure&name=menu&data=1";
                $get_data = callAPI('GET', $url);
                $response = json_decode($get_data, true);
                echo $response;
                ?>
            </div>
            <div class="float-right">
                <!--<form id="searchBarForm" action="#" method="get" target="_self" >--> <input id="banner_action"
                    name="banner_action" value="" type="hidden" />
                <div class="xans-element- xans-layout xans-layout-searchheader">
                    <div class="form-group"><label for="keyword">&nbsp;</label><input onKeyDown="doEnter(e, 'keyword')"
                            id="keyword" class="inputTypeText" type="text" autocomplete="off" />
                        <div class="search_auto" onclick="onSearch('keyword');"></div>
                        <input class="bt-search" type="image" src="/assets/images/search.svg" alt="<?= $seo_alt ?>" />
                        <ul class="autoDrop"></ul>
                    </div>
                </div>
                <!--</form>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div> <?php if ($isMobile) :


            $slogan = $d->rawQuery("select ten$lang as ten, mota$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('slogan'));


        ?>
<div class="mb layout-menu" id="menu_mobile">
    <div class="sz-navbar-top-slide m-0 p-0">
        <div class="swiper-container m-0 p-0" id="slogan-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($slogan as $k => $v) { ?>
                <!-- Slides -->
                <div class="swiper-slide d-flex justify-content-center align-items-center">
                    <a class="discount_slide" href="<?= $v['mota'] ?>"><?= $v['ten'] ?></a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="sz-navbar">
        <div class="sz-navbar-inner sz-navbar-left">
            <div class="row sz-navbar-mb align-items-center justify-content-center">
                <div class="col-4 d-flex justify-content-start">
                    <input type="checkbox" id="sz-navbar-check" />
                    <label for="sz-navbar-check" class="sz-navbar-hamburger menu-toggle">
                        <img src="assets/icon/menu/open_menu.svg" alt="<?= $seo_alt ?>" class="img-fluid menu-icon" />
                    </label>
                </div>
                <div class="col-4 d-flex justify-content-center navbar-logo">
                    <a class="menu-icon-mb" href="<?= MYSITE ?>"><img src="<?= MYSITE ?>assets/images/logo.png" /></a>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <div class="wap_search d-flex align-items-center">
                        <i class="fas fa-search tim"></i>
                        <div class="search"><input type="text" id="keyword2" placeholder="Nhập từ khóa cần tìm..."
                                onkeypress="doEnter(event,'keyword2');" autocomplete="off">
                            <p onclick="onSearch('keyword2');"> </p>
                            <div class="search_auto"></div>
                        </div>
                        <a class="giohang_m" href="gio-hang" title="title"> <i class="fas fa-shopping-bag"></i> </a>
                    </div>
                </div>
            </div>
            <?php
                //$url = ENDPOINT_CKD_API . "fetch?select=contentvi&name=menu_mb&code=structure&data=1";
                //$get_data = callAPI('GET', $url);
                //$response = json_decode($get_data, true);
                //echo $response;
                ?>




            <div class="sz-navbar-items">
                <div class="ngonngu">
                    <div class="execphpwidget"><br></div>
                </div>
                <div class="menu-table-mb">
                    <div class="row cover-moblie pt-3">
                        <div class="col-4 centered-image"><a href="/"><img class="menu-icon-cover"
                                    src="https://ckdvietnam.com/assets/images/icon/trangchu.png" alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Trang chủ</div>
                            </a></div>
                        <div class="col-4 centered-image"><a href="san-pham">
                                <!--assets/icon/menu/shop.png--> <img class="menu-icon-cover"
                                    src="https://ckdvietnam.com/assets/images/icon/shop.png" alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Shop</div>
                            </a></div>



                        <?php $isLogin = $this->session->userdata('isLogin');

                            if ($isLogin) {
                            ?>
                        <div class="col-4 centered-image"><a href="account/dang-xuat"><img class="menu-icon-cover"
                                    src="assets/images/login.png" alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Đăng xuất</div>
                            </a></div>
                        <div class="col-4 centered-image"><a href="account/thong-tin"><img class="menu-icon-cover"
                                    src="assets/images/icon_home.png" alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Thông tin</div>
                            </a></div>
                        <?php
                            } else {
                            ?>
                        <div class="col-4 centered-image"><a href="account/dang-nhap"><img class="menu-icon-cover"
                                    src="https://ckdvietnam.com/assets/images/icon/dangnhap.png" alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Đăng nhập</div>
                            </a></div>
                        <div class="col-4 centered-image"><a href="account/dang-ky"><img class="menu-icon-cover"
                                    src="https://ckdvietnam.com/assets/images/icon/dangky.png" alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Đăng ký</div>
                            </a></div>
                        <?php
                            }
                            ?>



                        <div class="col-4 centered-image"><a href="gio-hang"><img class="menu-icon-cover"
                                    src="https://ckdvietnam.com/assets/images/icon/giohang.png" alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Giỏ hàng</div>
                            </a></div>
                        <div class="col-4 centered-image"><a href="https://www.facebook.com/ckdvietnamchinhhang/"><img
                                    class="menu-icon-cover" src="https://ckdvietnam.com/assets/images/icon/chat.png"
                                    alt="CKD VIỆT NAM">
                                <div class="font-menup-mb">Chat</div>
                            </a></div>
                    </div>
                </div>
                <nav class="animated bounceInDown nav-menu">
                    <ul>
                        <li class="text-left"><a title="Trang chủ" href="/"> Trang chủ </a></li>
                        <li class="text-left"><a title="Giới thiệu" href="gioi-thieu"> Giới thiệu </a></li>
                        <li class="sub-menu"><a class="submenu-toggle" title="bai-viet-thuong-hieu"
                                href="bai-viet-thuong-hieu">Thương hiệu</a></li>
                        <li class="text-left"><a title="Khuyến mãi" href="san-pham/khuyen-mai"> Khuyến mãi </a></li>
                        <li class="sub-menu"><a class="submenu-toggle" title="Sản phẩm" href="san-pham">Sản phẩm</a>
                            <ul style="display: none;">
                                <li class="sub-menu"><a class="submenu-toggle" href="./"> Tất cả sản phẩm <span
                                            class="submenu-icon">&nbsp;</span> </a>
                                    <ul style="display: none;">
                                        <li class="sub-menu"><a href="san-pham"> Tất cả </a> <a
                                                href="san-pham/tot-nhat"> Tốt nhất </a> <a href="san-pham/moi"> Mới </a>
                                            <a href="/san-pham/khuyen-mai"> Sản phẩm khuyến mãi </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu"><a class="submenu-toggle" href="/"> Loại sản phẩm <span
                                            class="submenu-icon">&nbsp;</span> </a>
                                    <ul style="display: none;">
                                        <li class="sub-menu"><a href="san-pham/lam-sach"> Làm sạch </a> <a
                                                href="san-pham/cham-soc-da"> Chăm sóc da </a> <a href="san-pham/mat-na">
                                                Gói mặt nạ </a> <a href="/san-pham/chong-nang"> Chống nắng </a> <a
                                                href="san-pham/co-the-toc"> Cơ thể tóc </a></li>
                                    </ul>
                                </li>
                                <li class="sub-menu"><a class="submenu-toggle" href="/"> Thương hiệu <span
                                            class="submenu-icon">&nbsp;</span> </a>
                                    <ul style="display: none;">
                                        <li class="sub-menu"><a href="san-pham/ckd">CKD</a> <a
                                                href="san-pham/bellasu">Bellasu</a> <a
                                                href="san-pham/lacto-derm">Lacto</a></li>
                                    </ul>
                                </li>
                                <li class="sub-menu"><a class="submenu-toggle" href="/"> Theo dòng CKD <span
                                            class="submenu-icon">&nbsp;</span> </a>
                                    <ul style="display: none;">
                                        <li class="sub-menu"><a href="san-pham/retino-collagen">Retino Collagen</a> <a
                                                href="san-pham/vitac-teca">Vitac Teaca</a> <a
                                                href="san-pham/amino-biotin">Amino Biotin</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="text-left"><a title="Sự kiện" href="su-kien"> Sự kiện </a></li>
                        <li class="text-left"><a title="Tin tức" href="tin-tuc"> Tin tức </a></li>
                        <li class="text-left"><a title="Liên hệ" href="lien-he"> Liên hệ </a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <div class="menu_overlay"></div>
    <script>
    NN_FRAMEWORK.Search();
    $(".sub-menu ul").hide();
    $(".submenu-toggle").click(function(e) {
        e.preventDefault();
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        var icon = $(this).find(".submenu-icon");
        icon.text(icon.text() == "&nbsp" ? "" : "");
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
        } else {
            $(this).addClass('open');
        }
    });
    $("#sz-navbar-check").change(function() {
        if (this.checked) {
            $('.layout-menu').addClass('mb_menu_open');
            $('body').addClass("fixed-position");
            $('.menu_overlay').show();
            $(".sz-navbar-hamburger img").attr("src", "assets/icon/menu/close.png");
        } else {
            $('.menu_overlay').hide();
            $('body').removeClass("fixed-position");
            $('.layout-menu').removeClass('mb_menu_open');
            $(".sz-navbar-hamburger img").attr("src", "assets/icon/menu/open_menu.svg");
        }
    });
    $(document).mouseup(function(e) {
        var container = $(".results");
        var menu = $(".sz-navbar-items");
        var search = $(".search");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
        if (!search.is(e.target) && search.has(e.target).length === 0) {
            search.hide();
            $('.menu_overlay').hide();
            $('body').removeClass("fixed-position");
        }
    });
    </script>
</div> <?php endif; ?>