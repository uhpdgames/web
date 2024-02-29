<header id="header" class="container-fluid p-0 m-0">
    <div id="sub_menu">
        <div class="pc wap_thongtin clear">
            <div class="thongtin slick-coupon">
                <div class="swiper-container" id="slogan-swiper">
                    <div class="swiper-wrapper">
                        <?php if(is_array($slogan) && count($slogan)): foreach ($slogan as $k =>
                        $v) { ?>
                        <div class="swiper-slide">
                            <a href="<?= @$v['mota'] ?>"><?= @$v['ten'] ?></a>
                        </div>
                        <?php }
						endif;
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main_menu">
        <div class="top-area">
            <div class="pc main_fix">
                <div class="top-member">
                    <div class="d-flex justify-content-end">
                        <div class="log">
                            <div class="ngonngu pt-2 mr-4">
                                <a data-lang_dir="vietnamese" data-lang="vi" href="<?= site_url(); ?>"><img src="<?= image_default('vi') ?>" alt="Tiếng Việt" /></a>
                                <a style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;" data-lang_dir="english" data-lang="en" href="<?= site_url(); ?>">
                                    <img src="<?= image_default('en') ?>" alt="English" />
                                </a>
                                <a data-lang_dir="" data-lang="vi" href="<?= site_url(); ?>" style="pointer-events: none;" title="China" class="flag zh-CN">
                                    <img src="<?= image_default('ko') ?>" alt="Korea" style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;" />
                                </a>
                                <a href="<?= site_url(); ?>" style="pointer-events: none;" title="China" class="flag zh-CN">
                                    <img src="<?= image_default('cn') ?>" alt="China" border="0" style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;" />
                                </a>
                                <a href="<?= site_url(); ?>" style="pointer-events: none;" title="Malaysia" class="flag ma">
                                    <img src="<?= image_default('ma') ?>" alt="Malaysia" border="0" style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;" />
                                </a>
                            </div>
                            <a href="/gio-hang" class="xans-element- xans-layout xans-layout-orderbasketcount lnk">
                                <?= getLang('giohang') ?>
                                <span class="count"><?= (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0 ?></span>
                            </a>
                            <?php $isLogin = $this->session->userdata('isLogin'); if ($isLogin) { ?>
                            <a class="lnk" href="<?= site_url(); ?>account/thong-tin">
                                <span><?= getLang('trangcuatoi') ?></span>
                            </a>
                            <a class="lnk" href="<?= site_url(); ?>account/dang-xuat">
                                <span><?= getLang('dangxuat') ?></span>
                            </a>
                            <a class="lnk" href="<?= site_url(); ?>account/lich-su-mua-hang">
                                <span><?= getLang('lichsu') ?></span>
                            </a>
                            <?php } else { ?>
                            <a class="lnk" href="<?= site_url(); ?>account/dang-nhap">
                                <span><?= getLang('dangnhap') ?></span>
                            </a>
                            <a class="lnk" href="<?= site_url(); ?>account/dang-ky">
                                <span><?= getLang('dangky') ?></span>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--TODO MENU-->
            <?php /*$this->load->view('common/menu', $this->data); */?>
            <div id="menu"></div>
            <div class="clear"></div>
        </div>
    </div>
</header>
