<?php
/**
 * @project omnipay-anymoney
 * @author  Phuong Dev
 * @email   phuongdev89@gmail.com
 * @date    6/15/2021
 * @time    11:09 AM
 */

namespace Omnipay\AnyMoney\Message;
class BalanceResponse extends AbstractResponse {

	/**
	 * @return bool
	 */
	public function isSuccessful() {
		return isset($this->data['result']);
	}

	/**
	 * @return mixed
	 */
	public function getResult() {
		return $this->data['result'];
	}

	/**
	 * @return mixed
	 */
	public function getError() {
		return $this->data['error'];
	}

	/**
	 * @return mixed|string|null
	 */
	public function getMessage() {
		if (!$this->isSuccessful()) {
			return $this->getError()['message'];
		}
		return 'OK';
	}
}
