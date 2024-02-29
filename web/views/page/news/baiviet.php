<?= create_BreadCrumbs(@$items['url'], @$items['description']) ?>
<?= structureddata() ?>

<?php
if (

	$items['url'] == 'gioi-thieu' ||
	$items['url'] == 'bai-viet-thuong-hieu'
) {
	echo @$items['contentvi'];
} else {
	echo '<div class="main_fix">' . @$items['contentvi'] . '</div>';
}
?>

<?php if (!empty($items['csspath']) && $items['csspath'] != ''): ?>
<style>
	<?= @file_get_contents(SHAREDPATH . 'assets/online/css/' . @$items['csspath'] . '.css')?>
</style>

<?php endif; ?>
<?php if (!empty($items['jspath']) && $items['jspath'] != ''): ?>

<?php endif; ?>
