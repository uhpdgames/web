<?php
    class AutoLoad
    {
        public function __construct()
        {
            spl_autoload_register(array($this,'_autoload'));
        }

        private function _autoload($file)
        {
            $file = SHAREDLIBRARIES."class/class.".str_replace("\\","/",trim($file,'\\')).'.php';
            if(file_exists($file)) require_once $file;
        }
    }
?>
