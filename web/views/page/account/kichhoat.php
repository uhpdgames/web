<?= create_BreadCrumbs('account/kich-hoat', 'Kích hoạt tài khoản') ?>
<div class="main_fix my-5">
	<div class="wrap-user">
		<div class="title-user">
			<span><?= getLang('kichhoat') ?></span>
		</div>
		<form class="form-user validation-user" novalidate method="post"
			  action="account/kich-hoat?id=<?= getRequest('id') ?>" enctype="multipart/form-data">
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-qrcode"></i></div>
				</div>
				<input type="text" class="form-control" id="maxacnhan" name="maxacnhan"
					   placeholder="<?= getLang('nhapmakichhoat') ?>" required>
				<div class="invalid-feedback"><?= getLang('vuilongnhapmakichhoat') ?></div>
			</div>
			<div class="button-user">
				<input type="submit" class="btn btn-primary" name="kichhoat" value="<?= getLang('kichhoat') ?>"
					   disabled>
			</div>
		</form>
	</div>

</div>
