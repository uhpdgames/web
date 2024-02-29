<?php
defined('BASEPATH') or exit('No direct script access allowed');

use ImageKit\ImageKit;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MY_Controller extends CI_Controller
{

	public $gg_client;
	public $gg_token;

	public $data;
	public $current_lang;
	public $sluglang = 'tenkhongdau';
	public $session_member = 'LoginMember';
	public $isLogin;
	public $facebook;

	public function __construct()
	{
		parent::__construct();

		$this->isLogin = $this->session->userdata('isLogin');
		$this->current_lang = $this->session->userdata('lang');
		$this->userInfo = $this->session->userdata($this->session_member);


		if (!$this->userInfo) $this->session->set_userdata($this->session_member, array());

		if (!$this->current_lang) {
			$this->session->set_userdata('lang', 'vi');
			$this->current_lang = 'vi';
		}

		if ($this->current_lang == 'vi') $this->session->set_userdata('site_lang', 'vietnamese');

		$this->sluglang .= $this->current_lang;

		$config = $this->config->item('main_config');
		$info_db = $config['database'];

		require_once SHAREDLIBRARIES . 'autoload.php';
		new AutoLoad();

		$d = new PDODb($info_db);
		$cache = new FileCache($d);
		$statistic = new Statistic($d, $cache);

		$statistic->getCounter();
		$statistic->getOnline();

		$seo = new Seo($d);

		$seoInfo = $seo->getSeoDB('0', 'setting', 'capnhat', 'setting');

		if (is_array($seoInfo) && count($seoInfo)) {
			$seo->setSeo('title', $seoInfo['title' . $this->current_lang]);
			$seo->setSeo('description', $seoInfo['description' . $this->current_lang]);
		}

		//$_Affiliate = new Affiliate($d);

		//$router = new AltoRouter();
		$func = new Functions($d);
		//$api = new API();
		//$breadcr = new BreadCrumbs($d);
		//$cart = new Cart($d);
		$detect = new MobileDetect();
		//$addons = new AddonsOnline();

		//$css = new CssMinify(true, $func);
		//$js = new JsMinify(true, $func);


		$sqlCache = "select * from #_setting";
		$setting = $cache->getCache($sqlCache, 'fetch', 7200);


		$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'], true) : null;
		$deviceType = ($detect->isMobile()) ? 'mobile' : 'computer';

		$m = 'm';
		if (!$this->agent->is_mobile()) $m = '';
		// if ($deviceType == 'mobile') $m = '';

		$lang = $this->current_lang;
		$slogan = $d->rawQuery("select ten$lang as ten, mota$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('slogan'));


		$this->data = array(
			'slogan' => $slogan,
			'config' => $config,
			'sluglang' => $this->sluglang,
			'd' => $d,
			'setting' => $setting,
			'optsetting' => $optsetting,
			'seo' => $seo,
			'cache' => $cache,
			'breadcr' => new BreadCrumbs(),
			'func' => $func,
			//'api' => new API(),

			//'statistic' => $statistic,
			//'cart' => new Cart($d),
			'detect' => $detect,
			'addons' => new AddonsOnline(),
			'template' => 'page/home/index',

			'source' => 'index',
			'lang' => $this->current_lang,
			//'css' => $css,
			//'js' => $js,
			'm' => $m,
			'deviceType' => $deviceType,
			'isMobile' => $this->agent->is_mobile(),
			// 'isMobile' => $detect->isMobile(),

			'config_base' => MYSITE,
			'login_admin' => 'LoginAdmin',
			'login_member' => $this->session_member,
			'login_ctv' => 'CTVMember',
			'config_url' => $info_db['server-name'] . $info_db['url'],
			'seolang' => $this->current_lang,
			'title_crumb' => '',
			'com' => '',
			'isLogin' => $this->isLogin,
			'info' => array(),
			'seo_alt' => $seo->getSeo('title'),
			'template_full' => '<div class="static-background"> <div class="background-masker btn-divide-left"></div> </div>'
		);
	}

	public function fb_init()
	{
		require APPPATH . 'libraries/fb/src/facebook.php';

		$this->facebook = new Facebook(array(
			'appId'  => '914665893545200',
			'secret' => '9c54838cb21f126b80f8d351db035cda',
		));
	}


	protected function ImageKit_Init()
	{
		require SHAREDLIBRARIES . 'vendor/autoload.php';
		$this->imageKit = new ImageKit(
			"public_Jsw5AvM92Y26cUir3xhcxjHfecM=",
			"private_ou1Oc96hWT2A/pC/BDkfA2W17jQ=",
			"https://ik.imagekit.io/ckd"
		);
	}

	protected function ImageKit_Generation($file, $type = 'news/')
	{
		$this->ImageKit_Init();

		$imageURL = $this->imageKit->url(
			[

				'path' => $type . $file,
				'urlEndpoint' => 'https://ik.imagekit.io/ckd',
				'transformation' => [
					[
						'format' => 'webp',
						//'height' => '400',
						//'width' => '400',
						'quality' => 80,
						'raw' => "f-auto,l-image,i-ik_canvas,w-360,h-640,l-end",
					]
				]
			]
		);

		echo $imageURL;
	}


	public function infoEmail()
	{
		$data = array();

		$socialString = '';
		$options = $this->data['d']->rawQueryOne("select options, tenvi from #_setting limit 0,1");

		$logo = $this->data['d']->rawQueryOne("select photo from #_photo where type = ? and act = ? limit 0,1", array('logo', 'photo_static'));
		$social = $this->data['d']->rawQuery("select photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc", array('mangxahoi'));

		if ($social && count($social) > 0) {
			foreach ($social as $value) {
				$socialString .= '<a href="' . $value['link'] . '" target="_blank"><img src="' . MYSITE . UPLOAD_PHOTO_L . $value['photo'] . '" style="max-height:30px;margin:0 0 0 5px" /></a>';
			}
		}


		$data['color'] = '#3d5b2d';
		$data['home'] = MYSITE;
		$data['logo'] = '<img src="' . MYSITE . UPLOAD_PHOTO_L . $logo['photo'] . '" style="max-height:70px;" >';
		$data['social'] = $socialString;
		$data['datesend'] = time();
		$data['company'] = $options['tenvi'] ?? '';
		$data['company:address'] = $this->optcompany['diachi'] ?? '';
		$data['company:email'] = $this->optcompany['email'] ?? '';
		$data['email'] = $this->optcompany['email'] ?? '';
		$data['company:hotline'] = $this->optcompany['hotline'] ?? '';
		$data['company:website'] = $this->optcompany['website'] ?? '';
		$data['company:worktime'] = '(8-21h cả T7,CN)';

		return $data;
	}
	public function sendEmail($to, $subject, $message)
	{
		$id = 'bluepink@ckdcosvietnam.com';
		$pass = '5uyIffmDvlhj';
		#$setting = $this->data['setting'];
		$optsetting = $this->data['optsetting'];

		/*
		$config_host = $optsetting['ip_host'];
		$config_port = $optsetting['port_host'];
		# $config_secure = $optsetting['secure_host'];
		$config_email = $optsetting['email_host'];
		$config_password = $optsetting['password_host'];
		*/

		$config = array();
		if ($optsetting['mailertype'] == 2) {
			/* 	$config['protocol'] = 'smtp';
			#$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_user'] = trim($optsetting['email_gmail']);
			$config['smtp_pass'] = trim($optsetting['password_gmail']);
			$config['smtp_port'] = 465;
			$config['smtp_timeout'] = "";
			$config['charset']   = 'utf-8';


			$config['_smtp_auth'] = TRUE;
			$config['smtp_crypto'] = 'tls'; */
		} else {
		}
		#$config['protocol'] = 'mail';

		$config['protocol'] = 'smtp';
		$config['smtp_host'] =  '103.77.162.8';
		$config['smtp_port'] =  '587';
		$config['smtp_user'] = $id;
		$config['smtp_pass'] = $pass;
		$config['smtp_crypto'] = 'tls';
		$config['_smtp_auth'] = TRUE;


		$config['send_multipart'] = FALSE;
		$config['mailtype'] = "html";
		$config['charset'] = "utf-8";
		$config['newline'] = "\r\n";
		$config['validate'] = FALSE;
		$config['wordwrap'] = TRUE;

		$this->load->library('email', $config);

		$this->email->set_newline("\r\n");


		$this->email->from($id, 'CKD VIỆT NAM');
		$this->email->to($to);
		$this->email->cc('kenjidangbluepink@gmail.com');
		#$this->email->bcc('them@their-example.com');

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send(NULL);

		echo  0;
		return 1;
		echo $this->email->print_debugger(array('headers'));
	}


	public function toEmail()
	{
		require APPPATH . 'libraries/email/src/Exception.php';
		require APPPATH . 'libraries/email/src/PHPMailer.php';
		require APPPATH . 'libraries/email/src/SMTP.php';

		$mail = new PHPMailer(true);

		$id = 'bluepink@ckdcosvietnam.com';
		$pass = '5uyIffmDvlhj';
		$host = 'mail.ckdcosvietnam.com';

		try {
			//Server settings
			$mail->SMTPDebug = TRUE;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = $host;                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = $id;                     //SMTP username
			$mail->Password   = $pass;                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom($id, 'Mailer');
			$mail->addAddress('kenjidangbluepink@gmail.com', 'Joe User');     //Add a recipient
			//Name is optional
			$mail->addReplyTo('ixdbikerdawg@gmail.com', 'Information');
			#$mail->addCC('cc@example.com');

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}
