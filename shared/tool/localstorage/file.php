<?php
//localstorage.php
//	include_once SHAREDPATH. 'tool' . DIRECTORY_SEPARATOR . 'localstorege' .DIRECTORY_SEPARATOR . 'localstorage.php';

class LocalStorage implements LocalStorageInterface{
	public function get($key){
		$path = $this->getPath($key);
		if(file_exists($path)){
			return file_get_contents($path);
			//$handle = fopen($path, "r");
			//fclose($handle);
			//return  fread($handle, filesize($path));

			//return file_get_contents($path);
		}
		return null;
	}
	
	public function add($key, $value){
		$path = $this->getPath($key);
		$file = fopen($path,"w+");
		fwrite($file, $value);
		fclose($file);
	//	file_put_contents($path, $value);
	}
	
	public function delete($key){
		$path = $this->getPath($key);
		unlink($path);
	}
	
	private function getFolder(){
		$folder = "";
		if(defined("LOCALSTORAGE_FOLDER")){
			$folder = LOCALSTORAGE_FOLDER;
		}
		else{
			$folder = "./loc_s";
		}
		return $folder;
	}
	
	private function getPath($key){

		return $this->getFolder()."\\".$key.".uhpd";


		//return $this->getFolder()."\\".$key.".val";
	}
}
?>
