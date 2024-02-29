<?php
$isIndex = !empty($myckd) ? true : false;
?>
<!doctype html>
<html lang="<?= $lang ?>">
<head>
	<?php $this->load->view('all/head'); ?>
	<script src="<?= site_url() ?>assets/swiper/swiper-bundle.min.js?v=<?= time() ?>"></script>
	<link rel="stylesheet" href="<?= site_url() ?>assets/swiper/swiper-bundle.min.css?v=<?= time() ?>">
	<link rel="stylesheet" href="<?= site_url() ?>assets/css/base.css?v=<?= time() ?>">
</head>

<body id="<?= !empty($isIndex) ? 'main' : 'prod' ?>" class="loading">
<?php $this->load->view('all/header'); ?>

<main class="wapper">
	<?php $this->load->view($template); ?>
</main>
<?php $this->load->view('all/under'); ?>

<?php if ($isIndex): ?>
	<script type="text/javascript" src="<?= MYSITE ?>assets/js/home.js?v=<?= time() ?>"></script>
<?php else: ?>
	<script type="text/javascript" src="<?= MYSITE ?>assets/js/ckd.js?v=<?= time() ?>"></script>
<?php endif; ?>


<div class="overlay"></div>
<div id="loader" style="display:none">
	<div class="spinner-border" role="status"></div>
</div>
</body>
</html>
