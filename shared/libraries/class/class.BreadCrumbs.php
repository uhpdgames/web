<?php
	class BreadCrumbs
	{
 		private $data = array();

		public function setBreadCrumbs($slug='', $name='')
		{
			if($name != '')
			{
				$this->data[] = array('slug' => $slug, 'name' => $name);
			}

		}

		public function getBreadCrumbs()
		{
			$config_base = getenv('APP_URL');

			$json = array();

		
			$breadcumb = '<div class="container-fluid p-0 p-lg-2" style="max-height:2.5rem;background-color: #e9ecef;"><nav class="main_fix  h-25" aria-label="breadcrumb">';
			$breadcumb .= '<ol class="breadcrumb w-100 h-25 p-0 m-0">';
			if($this->data)
			{

				$breadcumb .= '<li class="breadcrumb-item "><a href="'.$config_base.'">'.getLang('trangchu').'</a></li>';
				$k = 1;
				foreach($this->data as $key => $value)
				{
					if($value['name'] != '')
					{
						$slug = ($value['slug']) ? $config_base.$value['slug'] : $config_base;
						$active = ($key == count($this->data) - 1) ? "active" : "";
						$truncate = 'truncate';
						if($active == 'active'){
							$truncate = '';
						}
						$name = str_slit($value['name'],  150);
						//$name = $value['name'];
						$breadcumb .= '<li class="breadcrumb-item '.$active.' '.$truncate.'"><a title="" href="'.$slug.'">'.$name.'</a></li>';
						$json[] = array("@type"=>"ListItem","position"=>$k,"name"=>$name,"item"=>$slug);
						$k++;
					}
				}
			}
			$breadcumb .= ' </ol>';
			$breadcumb .= '</nav></div>';

			$breadcumb .= '<script type="application/ld+json">{"@context": "https://schema.org","@type": "BreadcrumbList","itemListElement": '.((json_encode($json))).'}</script>';
		    return $breadcumb;
		}
	}
?>