<?php

include(SHAREDPATH. 'tool' . '/' . 'localstorage' .'/' . "file.php");

interface LocalStorageInterface{
	public function get($key);
	public function add($key, $value);
	public function delete($key);
}

function localStorage($key, $value = ""){
	$obj = new LocalStorage;
	if($value !== "" && $value !== null){
		$obj->add($key, @base64_encode(@serialize($value)));
		return;
	}
	else if($value === null){
		$obj->delete($key);
	}
	$value = $obj->get($key);
	//@ob_start();
	return ($value == null ? null : unserialize(base64_decode($value)));
	//@ob_end_clean();
}
?>
