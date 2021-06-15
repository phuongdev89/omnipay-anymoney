<?php
/**
 * Created by FES VPN.
 * @project omnipay-anymoney
 * @author  Le Phuong
 * @email   phuong17889[at]gmail.com
 * @date    6/15/2021
 * @time    10:51 AM
 */

namespace Omnipay\AnyMoney\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class BalanceRequest extends AbstractRequest {

	/**
	 * @param $value
	 *
	 * @return BalanceRequest
	 */
	public function setCurr($value) {
		return $this->setParameter('curr', $value);
	}

	/**
	 * @return mixed
	 */
	public function getCurr() {
		return $this->getParameter('curr');
	}

	/**
	 * @return array
	 * @throws InvalidRequestException
	 */
	public function getData() {
		$this->validate('curr');
		return ['curr' => $this->getCurr()];
	}

	/**
	 * @param mixed $data
	 *
	 * @return BalanceResponse
	 */
	public function sendData($data) {
		$response = $this->curl($this->request('balance', $data));
		return new BalanceResponse($this, json_decode($response, true));
	}
}
