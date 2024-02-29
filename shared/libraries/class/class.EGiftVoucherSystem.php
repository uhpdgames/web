<?php
#[\AllowDynamicProperties]
class EGiftVoucher
{
	/** @var int $voucherId The unique identifier for the e-gift voucher. */
	private $voucherId;

	/** @var string $recipientName The name of the recipient of the e-gift voucher. */
	private $recipientName;

	/** @var float $amount The amount of the e-gift voucher. */
	private $amount;

	/**
	 * EGiftVoucher constructor.
	 *
	 * @param int $voucherId The unique identifier for the e-gift voucher.
	 * @param string $recipientName The name of the recipient of the e-gift voucher.
	 * @param float $amount The amount of the e-gift voucher.
	 */
	public function __construct($voucherId, $recipientName, $amount)
	{
		$this->voucherId = $voucherId;
		$this->recipientName = $recipientName;
		$this->amount = $amount;
	}

	/**
	 * Get the unique identifier for the e-gift voucher.
	 *
	 * @return int The voucher ID.
	 */
	public function getVoucherId()
	{
		return $this->voucherId;
	}

	/**
	 * Get the name of the recipient of the e-gift voucher.
	 *
	 * @return string The recipient name.
	 */
	public function getRecipientName()
	{
		return $this->recipientName;
	}

	/**
	 * Get the amount of the e-gift voucher.
	 *
	 * @return float The voucher amount.
	 */
	public function getAmount()
	{
		return $this->amount;
	}
}

class EGiftVoucherSystem
{
	/** @var array $vouchers An array to store the e-gift vouchers. */
	private $vouchers;

	/**
	 * EGiftVoucherSystem constructor.
	 */
	public function __construct()
	{
		$this->vouchers = array();
	}

	/**
	 * Generate a new e-gift voucher.
	 *
	 * @param string $recipientName The name of the recipient of the e-gift voucher.
	 * @param float $amount The amount of the e-gift voucher.
	 *
	 * @return EGiftVoucher The generated e-gift voucher.
	 */
	public function generateVoucher($recipientName, $amount)
	{
		// $voucherId = $this->generateVoucherId();
		$voucherId = stringRandom(5);
		$voucher = new EGiftVoucher($voucherId, $recipientName, $amount);
		$this->vouchers[] = $voucher;
		return $voucher;
	}

	/**
	 * Generate a unique voucher ID.
	 *
	 * @return int A unique voucher ID.
	 */
	private function generateVoucherId()
	{
		// Generate a random voucher ID
		$voucherId = mt_rand(100000, 999999);

		// Check if the voucher ID is already used
//        while ($this->isVoucherIdUsed($voucherId)) {
//            $voucherId = mt_rand(100000, 999999);
//        }

		return $voucherId;
	}

	/**
	 * Check if a voucher ID is already used.
	 *
	 * @param int $voucherId The voucher ID to check.
	 *
	 * @return bool True if the voucher ID is already used, false otherwise.
	 */
	public function isVoucherIdUsed($voucherId)
	{
		foreach ($this->vouchers as $voucher) {
			if ($voucher->getVoucherId() === $voucherId) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Get all the e-gift vouchers in the system.
	 *
	 * @return array An array of EGiftVoucher objects.
	 */
	public function getAllVouchers()
	{
		return $this->vouchers;
	}

	public function getVouchers($type = 'register')
	{
		return $this->vouchers[$type];
	}

	public function setAllVouchers($v)
	{
		$this->vouchers = $v;
	}
}

#[\AllowDynamicProperties]
class EGiftVoucherUser
{
	private $uid;
	private $d;

	public function __construct($d, $uid = 0)
	{
		$this->vouchers = array();
		$this->voucher = array();//type

		$this->uid = $uid;
		$this->d = $d;
		$this->type = 'register';
		$this->id_voucher = 0;

		//$this->setAllVouchers($d);

		$this->init();
	}

	public function init()
	{
		$this->Voucher();
		$this->settingVoucher();

	}

	public function getStart()
	{
		return $this->start;
	}

	public function getEnd()
	{
		return $this->end;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function rate()
	{
		$q = $this->d->rawQueryOne("select rate from #coupons_cate where code = ? limit 0,1", array($this->type));
		$this->rate = $q['rate'] ?? 0;
	}

	public function getRate()
	{
		return $this->rate;
	}

	public function once()
	{
		$q = $this->d->rawQueryOne("select rate from #coupons_cate where code = ? limit 0,1", array($this->type));
		$this->once = $q['once'] ?? 0;
	}

	public function getOnce()
	{
		return $this->once;
	}


	public function setAllVouchers()
	{

		$rsVoucher = $this->d->rawQuery('select * from #_coupons where uid =?', array($this->uid));

		if (is_array($rsVoucher) && count($rsVoucher)) {
			$this->vouchers = $rsVoucher;
		}
	}

	public function Voucher()
	{

		$rsVoucher = $this->d->rawQueryOne('select code,id from #_coupons where uid =? and type = ?', array($this->uid, $this->type));

		if (is_array($rsVoucher) && count($rsVoucher)) {
			$this->voucher[$this->type] = $rsVoucher['code'];
			$this->id_voucher = $rsVoucher['id'];
		}
	}

	public function settingVoucher()
	{
		$rsVoucher = $this->d->rawQueryOne('select * from #_coupons_cate where code = ?', array($this->type));


		$this->rate = $rsVoucher['rate'] ?? 10;
		$this->once = $rsVoucher['once'] ?? 1;
		$this->start = $rsVoucher['start'] ?? '';
		$this->end = $rsVoucher['end'] ?? '';
	}


	public function getIdVoucher()
	{
		return $this->id_voucher;
	}

	public function getVoucher()
	{
		return !empty($this->voucher[$this->type]) ? $this->voucher[$this->type] : '';
	}

	public function checkVoucher($code)
	{
		return !empty($this->type) && !empty($this->voucher[$this->type]) && $code == $this->voucher[$this->type];
	}

	public function getAllVouchers()
	{
		return $this->vouchers;
	}


	public function updateHasUsed($id){
		$this->d->where('id', $id);
		$this->d->update('coupons', '');

	}
}
