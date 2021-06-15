<?php
/**
 * Created by FES VPN.
 * @project omnipay-anymoney
 * @author  Le Phuong
 * @email   phuong17889[at]gmail.com
 * @date    6/15/2021
 * @time    3:22 PM
 */

namespace Omnipay\AnyMoney\Message;
class InvoiceResponse extends AbstractResponse {

	public $method;

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
	public function getField() {
		if (!$this->isSuccessful()) {
			return $this->data['error']['data']['field'];
		}
		return '';
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
			return $this->getError()['message'] . ' - ' . json_encode($this->getError()['data']);
		}
		return 'OK';
	}

	/**
	 * @return mixed|string
	 */
	public function getStatus() {
		if ($this->isSuccessful()) {
			return $this->getResult()['status'];
		}
		return '';
	}

	/**
	 * @return mixed|string
	 */
	public function getToken() {
		if ($this->isSuccessful()) {
			return $this->getResult()['token'];
		}
		return '';
	}

	/**
	 * @return mixed|string
	 */
	public function getLid() {
		if ($this->isSuccessful()) {
			return $this->getResult()['lid'];
		}
		return '';
	}

	/**
	 * @return bool
	 */
	public function isRedirect() {
		if ($this->method == 'invoice.create') {
			return $this->isSuccessful();
		}
		return false;
	}

	/**
	 * @return string
	 */
	public function getRedirectUrl() {
		if ($this->isRedirect()) {
			return 'https://sci.any.money/en/#token=' . $this->getResult()['token'];
		}
		return '';
	}
}
