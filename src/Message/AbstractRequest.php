<?php
/**
 * Created by FES VPN.
 * @project omnipay-anymoney
 * @author  Le Phuong
 * @email   phuong17889[at]gmail.com
 * @date    6/15/2021
 * @time    10:49 AM
 */

namespace Omnipay\AnyMoney\Message;

use Omnipay\AnyMoney\SignTrait;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest {

	use  SignTrait;

	/**
	 * Return the endpoint.
	 *
	 * @return string
	 */
	public function getEndpoint() {
		return $this->getParameter('endpoint');
	}

	/**
	 * Set the endpoint.
	 *
	 * @param string $value
	 *
	 * @return AbstractRequest
	 */
	public function setEndpoint($value) {
		return $this->setParameter('endpoint', $value);
	}

	/**
	 * Get merchant ID.
	 *
	 * @return string
	 */
	public function getMerchant() {
		return $this->getParameter('merchant');
	}

	/**
	 * Set merchant ID.
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function setMerchant($value) {
		return $this->setParameter('merchant', $value);
	}

	/**
	 * Get API private key.
	 *
	 * @return string
	 */
	public function getApiKey() {
		return $this->getParameter('api_key');
	}

	/**
	 * Set API private key.
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function setApiKey($value) {
		return $this->setParameter('api_key', $value);
	}

	/**
	 * @param $method
	 * @param $data
	 *
	 * @return array
	 */
	public function request($method, $data) {
		return [
			'method'  => $method,
			'params'  => $data,
			'jsonrpc' => '2.0',
			'id'      => 1,
		];
	}

	/**
	 * @param $data
	 *
	 * @return bool|string
	 */
	public function curl($data) {
		$utc_now     = strval(((int) round(microtime(true) * 1000)));
		$data_string = json_encode($data);
		$ch          = curl_init($this->getEndpoint());
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string),
			'x-merchant: ' . $this->getMerchant(),
			'x-signature: ' . $this->sign($this->getApiKey(), $data['params'] ? : array(), $utc_now),
			'x-utc-now-ms: ' . $utc_now,
		));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}
