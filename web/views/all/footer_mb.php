<?php
$cache = new FileCache($d);

$hotro = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten, photo, noidung$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('ho-tro'));
/*$mangxahoi = $d->rawQuery("select link, photo, options
from #_photo where type = ? order by stt,id desc", array('mangxahoi'));*/
$lienhe = $cache->getCache("select noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('trungtam'));
$thongtinkhac = $cache->getCache("select
noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('thong-tin-khac'));
$chinhsach = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten from #_news where type = ? order by stt,id desc",
array('chinh-sach'));?>



<footer id="footer" class="mb-5">
    <div class="container">
        <div class="font-footer-mb">
        <div class="row">
            <div class="col-12">
                <div class="footer-title-info">
                    <div class="footer-info-1" style="text-align: center;">
                        <div class="footer-address">
                            <div class="font-weight-bold">
                                <?= getLang('ctttnhhbluepink') ?>
                            </div>
                            <div>
                                <?= $optsetting['diachi'] ?>
                            </div>
                        </div>
                        <div class="pt-2"></div>
                        <div class="footer-phone font-weight-bold">
                            <?= getLang('thongtinfooter2') ?>
                            <br />
                            <?= getLang('thongtinfooter3') ?>
                            <br />
                        </div>
                        <div class="pt-2"></div>
                        <div class="footer-contact">
                            <?= mySetting('email')?>
                            <br />
                            <?= getLang('chitietxuatkhau') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="font-sm">
                    <div class="highlighted-text"><?= $lienhe['ten'] ?? "" ?></div>
                    <div>
                        <?= htmlspecialchars_decode($lienhe['noidung'] ?? '') ?>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="font-sm">
                    <div class="highlighted-text"><?= $thongtinkhac['ten'] ?? "" ?></div>
                    <div>
                        <?= htmlspecialchars_decode($thongtinkhac['noidung'] ?? "") ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <a title="<?=$seo_alt?>" href="<?= MYSITE ?>">
                    <img class="img-fluid img-lazy"
                    src="<?= image_default() ?>"
                    data-src="<?= image_default('logo-footer') ?>"
                    alt="<?=$seo_alt?>" />
                </a>
            </div>
            <div class="col-6">
                <a title="<?=$seo_alt?>" href="<?= MYSITE ?>">
                    <img style="width: 160px;"
                     class="img-fluid img-lazy"
                     src="<?= image_default() ?>"
                     data-src="<?= image_default('bocongthuong') ?>"
                     alt="<?=$seo_alt?>" />
                </a>
            </div>
        </div>
        </div>
        <div class="row text-center justify-content-center mt-3">
            <div class="col-12">
				<div class="font-weight-bold">
					<?= getLang('chapnhanthanhtoan') ?>
				</div>
                <img class="img-fluid cover_img_30_30 img-lazy"
                src="<?= image_default() ?>"
                data-src="<?= image_default('momo') ?>"
                alt="<?=$seo_alt?>"
                 />

                <img class="img-fluid cover_img_30_30 img-lazy"
                src="<?= image_default() ?>"
                data-src="<?= image_default('zalo') ?>"
                alt="<?=$seo_alt?>"
                 />
                <img class="img-fluid cover_img_30_30 img-lazy"
                src="<?= image_default() ?>"
                data-src="<?= image_default('delivery-transfer-footer') ?>"
                alt="<?=$seo_alt?>"
                 />
                <img class="img-fluid cover_img_30_30 img-lazy"
                src="<?= image_default() ?>"
                data-src="<?= image_default('delivery-local-footer') ?>"
                alt="<?=$seo_alt?>"

                />
            </div>
        </div>

        <div class="pb-3 mt-3 accordion text-align-left-cover">
            <div class="card mb-3">
                <div id="headingOne">
                    <div class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="row p-2 custom-font-size-1">
                            <div class="col-12">
                                <?= getLang('lienhevoichungtoi') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="p-2">
                        <div class="row p-0">
                            <?php
							foreach ($hotro as $h) {
								?>
                            <div class="col-4">
                                <?= $h['ten'] ?>
                            </div>
                            <div class="col-8">
                                <?= strip_tags_content($h['mota'] ?? "") ?>
                            </div>

                            <?php
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div id="headingTwo">
                    <h5 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <div class="row p-2 custom-font-size-1">
                            <div class="col-12">
                                <?= getLang('hotro') ?>
                            </div>
                        </div>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div>
                        <div class="p-2">
                            <div class="row p-0">
                                <?php
								foreach ($chinhsach as $cs) {
									?>
                                <div class="col-12">
                                    <a title="<?=$seo_alt?>" href="<?= $cs['link'] ?? '#' ?>" target="_self"><?= $cs['ten'] ?></a>
                                </div>
                                <?php
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
