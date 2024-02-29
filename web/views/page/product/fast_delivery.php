<?php $fast_delivery_2h = mySetting('fast_delivery_2h');
if($fast_delivery_2h):
	?>
	<div class="quick_ship">
		<div class="d-flex flex-wrap center align-items-center">
			<img class="imgimage_quick_ship loading" src="<?=MYSITE?>assets/images/now-free.png">
			<?=mySetting('title_delivery');?>
		</div>

		<?=htmlspecialchars_decode($fast_delivery_2h)?>
		<style>
			.imgimage_quick_ship {
				height: 40px;
				margin-right: 2px;
				padding: 5px 0;
				margin-top: -4px;
				border: 0px;
				font-size: 0;
				line-height: 0;
				max-width: 100%;
			}
		</style>
	</div>
<?php endif;?>
