<?php


$row = $this->d->rawQueryOne("select id, maxacnhan, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1", array($username));























/*/

- xac-nhan-dang-ky
- don-hang
- quen-mat-khau


/*/

?>
