<div class="overlay-cover"> <a class="cart-fixed text-decoration-none " href="gio-hang" title="Giỏ hàng"> <i class="fas fa-shopping-bag"></i> <span class="count-cart"><?= (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0 ?></span> </a> <a class="btn-zalo btn-frame text-decoration-none " target="_blank" href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>"> <i><img class="img-lazy" src="<?= image_default('empty') ?>" data-src="assets/images/zl.webp" alt="Zalo" class="no_lazy"></i> </a> <a href="<?= $optsetting['inter']; ?>" target="_blank" class="inter "> <img class="img-lazy" src="<?= image_default('empty') ?>" data-src="assets/images/inter.svg" alt="istargram"></a> </div>
