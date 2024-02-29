<?php

#[\AllowDynamicProperties]
class Twig
{

	function __construct()
	{
		require_once ROOT . 'shared/libraries/twig/autoload.php';
		$this->init();
	}

	private function init()
	{
		$loader = new \Twig\Loader\FilesystemLoader(SHAREDPATH . 'twig');
		$this->twig = new \Twig\Environment($loader, ['cache' => false,
			'debug' => true,]);
	}
//'cache' => SHAREDPATH . '/caches'

	public function render($filename, $data = array())
	{
		$template = $this->twig->load("{$filename}.twig");
		echo $template->render($data);
	}
}