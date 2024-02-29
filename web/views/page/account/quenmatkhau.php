<?= create_BreadCrumbs('account/quen-mat-khau', 'Quên mật khẩu') ?>
<div class="main_fix my-5">
	<div class="wrap-user">
		<div class="title-user">
			<span><?= getLang('quenmatkhau')?></span>
		</div>
		<form class="form-user validation-user" novalidate method="post" action="account/quen-mat-khau" enctype="multipart/form-data">
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-envelope"></i></div>
				</div>
				<input type="email" class="form-control" id="email" name="email" placeholder="<?= getLang('nhapemail')?>" required>
				<div class="invalid-feedback"><?= getLang('vuilongnhapdiachiemail')?></div>
			</div>
			<div class="button-user">
				<input type="submit" class="btn btn-primary" name="quenmatkhau" value="<?= getLang('laymatkhau')?>" disabled>
			</div>
		</form>
	</div>
</div>
